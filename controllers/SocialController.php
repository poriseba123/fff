<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\UserMaster;
use app\models\UserDetails;
use app\models\SocialLoginForm;
use app\components\FrontendController;

class SocialController extends FrontendController {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionSocialsignin() {
        if (Yii::$app->request->isAjax) {
            $data = [];
            $resp = [];
            $resp['flag'] = false;
            $password = $this->rand_string(6);
            if ($_POST['loginType'] == 'google') {
                $googleId = (isset($_POST['googleId']) && $_POST['googleId'] != "") ? $_POST['googleId'] : "";
                $registerType = 3;
                $socialEmail = (isset($_POST['email']) && $_POST['email'] != "") ? $_POST['email'] : "";

                $findUser = UserMaster::find()->where('user_type=:user_type AND google_id=:googleId AND status != :status', ['user_type' => 2, ':googleId' => $googleId, ':status' => 3])->one();

                if (count($findUser) > 0) {
                    $findUser->google_image = $_POST['imgUrl'];
                    $findUser->google_email = $socialEmail;

                    if ($findUser->email == $findUser->google_email && $findUser->email_varified == 0) {
                        $findUser->email_varified = 1;
                    }

                    if ($findUser->status == 0) {
                        $findUser->status = 1;
                    }
                    $findUser->save(false);
//                    ========== call to login function =============
                    $login = $this->socialLogin($findUser->google_id, $registerType);

                    if ($login['flag'] == 1) {
                        $resp['flag'] = true;
                        $resp['msg'] = $login['msg'];
                        $resp['redirectUrl'] = $login['redirectUrl'];
                    } else {
                        $resp['msg'] = $login['msg'];
                    }
                } else {
                    $findSocialEmail = UserMaster::find()->where('user_type=:user_type AND (email=:email OR facebook_email=:email) AND status != :status', ['user_type' => 2, ':email' => $socialEmail, ':status' => 3])->one();
                    if (count($findSocialEmail) > 0) {
                        $findSocialEmail->google_id = $googleId;
                        $findSocialEmail->google_email = $socialEmail;
                        $findSocialEmail->google_image = $_POST['imgUrl'];
                        if ($findSocialEmail->email == $findSocialEmail->google_email && $findSocialEmail->email_varified == 0) {
                            $findSocialEmail->email_varified = 1;
                        }
                        if ($findSocialEmail->status == 0) {
                            $findSocialEmail->status = 1;
                        }
                        $findSocialEmail->save(false);
//                        ========== call to login function =============
                        $login = $this->socialLogin($findSocialEmail->google_id, $registerType);

                        if ($login['flag'] == 1) {
                            $resp['flag'] = true;
                            $resp['msg'] = $login['msg'];
                            $resp['redirectUrl'] = $login['redirectUrl'];
                        } else {
                            $resp['msg'] = $login['msg'];
                        }
                    } else {
                        $model = new UserMaster();
                        $model->scenario = "google-signup";

                        $data['UserMaster']['reg_type'] = $registerType;
                        $data['UserMaster']['google_id'] = $googleId;
                        $data['UserMaster']['first_name'] = isset($_POST['firstName']) ? $_POST['firstName'] : "";
                        $data['UserMaster']['last_name'] = isset($_POST['lastName']) ? $_POST['lastName'] : "";
                        $data['UserMaster']['email'] = $socialEmail;
                        $data['UserMaster']['google_email'] = $socialEmail;
                        $data['UserMaster']['google_image'] = $_POST['imgUrl'];
                        $data['UserMaster']['status'] = 1;

                        $model->load($data);
                        $model->user_type = 2;
                        $model->email_varified = 1;
                        $model->added_date = date('Y-m-d H:i:s');
                        $model->update_date = date('Y-m-d H:i:s');

                        if ($model->validate() && $model->save()) {
                            $model->password = Yii::$app->security->generatePasswordHash($password);
                            $model->save(false);
                            if ($socialEmail != "") {
                                //======================= welcome email =========================
                                $linkLogin = Yii::$app->urlManager->createAbsoluteUrl(["site/login"]);
                                $wellcome_email = $this->get_email_data('social_wellcome_email', array('LINK' => $linkLogin, 'FULL_NAME' => $model->first_name, 'PROJECT_NAME' => $this->getProjectName(), 'EMAIL' => $model->email, 'PASSWORD' => $password));
                                $wellcome_email_data = [
                                    'to' => $model->email,
                                    'subject' => $wellcome_email['subject'],
                                    'template' => 'forget_pass',
                                    'body' => $wellcome_email['body']
                                ];
                                $this->SendMail($wellcome_email_data);
                            }
//                        ========== call to login function =============
                            $login = $this->socialLogin($model->google_id, $registerType);

                            if ($login['flag'] == 1) {
                                $resp['flag'] = true;
                                $resp['msg'] = $login['msg'];
                                $resp['redirectUrl'] = $login['redirectUrl'];
                            } else {
                                $resp['msg'] = $login['msg'];
                            }
                        } else {
                            $resp['msg'] = Yii::t('app', "Error! Please try  again after some times.");
                        }
                    }
                }
            } elseif ($_POST['loginType'] == 'facebook') {
                $facebookId = isset($_POST['facebookId']) ? $_POST['facebookId'] : "";
                $registerType = 2;
                $socialEmail = isset($_POST['email']) ? $_POST['email'] : "";
                $findUser = UserMaster::find()->where('user_type=:user_type AND facebook_id=:fbId AND status != :status', ['user_type' => 2, ':fbId' => $facebookId, ':status' => 3])->one();

                if (count($findUser) > 0) {
                    $findUser->facebook_image = $_POST['imgUrl'];
                    $findUser->facebook_email = $socialEmail;
                    if ($findUser->email == $findUser->facebook_email && $findUser->email_varified == 0) {
                        $findUser->email_varified = 1;
                    }
                    if ($findUser->status == 0) {
                        $findUser->status = 1;
                    }
                    $findUser->save(false);
//                        ========== call to login function =============
                    $login = $this->socialLogin($findUser->facebook_id, $registerType);

                    if ($login['flag'] == 1) {
                        $resp['flag'] = true;
                        $resp['msg'] = $login['msg'];
                        $resp['redirectUrl'] = $login['redirectUrl'];
                    } else {
                        $resp['msg'] = $login['msg'];
                    }
                } else {
                    $findSocialEmail = UserMaster::find()->where('user_type=:user_type AND (email=:email OR google_email=:email) AND status != :status', ['user_type' => 2, ':email' => $socialEmail, ':status' => 3])->one();
                    if (count($findSocialEmail) > 0) {
                        $findSocialEmail->facebook_image = $_POST['imgUrl'];
                        $findSocialEmail->facebook_id = $facebookId;
                        $findSocialEmail->facebook_email = $socialEmail;
                        if ($findSocialEmail->email == $findSocialEmail->facebook_email && $findSocialEmail->email_varified == 0) {
                            $findSocialEmail->email_varified = 1;
                        }
                        if ($findSocialEmail->status == 0) {
                            $findSocialEmail->status = 1;
                        }
                        $findSocialEmail->save(false);
//                        ========== call to login function =============
                        $login = $this->socialLogin($findSocialEmail->facebook_id, $registerType);

                        if ($login['flag'] == 1) {
                            $resp['flag'] = true;
                            $resp['msg'] = $login['msg'];
                            $resp['redirectUrl'] = $login['redirectUrl'];
                        } else {
                            $resp['msg'] = $login['msg'];
                        }
                    } else {
                        $model = new UserMaster();
                        $model->scenario = "facebook-signup";

                        $data['UserMaster']['facebook_id'] = $facebookId;
                        $data['UserMaster']['first_name'] = $_POST['firstName'];
                        $data['UserMaster']['last_name'] = $_POST['lastName'];
                        $data['UserMaster']['email'] = $socialEmail;
                        $data['UserMaster']['facebook_email'] = $socialEmail;
                        $data['UserMaster']['facebook_image'] = $_POST['imgUrl'];
                        $data['UserMaster']['status'] = 1;

                        $model->load($data);
                        $model->user_type = 2;
                        $model->facebook_email = $socialEmail;
                        $model->email_varified = 1;
                        $model->reg_type = $registerType;
                        $model->added_date = date('Y-m-d H:i:s');
                        $model->update_date = date('Y-m-d H:i:s');

                        if ($model->validate() && $model->save()) {
                            $model->password = Yii::$app->security->generatePasswordHash($password);
                            $model->save(false);
                            if ($socialEmail != "") {
                                //======================= welcome email =========================
                                $linkLogin = Yii::$app->urlManager->createAbsoluteUrl(["site/login"]);
                                $wellcome_email = $this->get_email_data('social_wellcome_email', array('LINK' => $linkLogin, 'FULL_NAME' => $model->first_name, 'PROJECT_NAME' => $this->getProjectName(), 'EMAIL' => $model->email, 'PASSWORD' => $password));
                                $wellcome_email_data = [
                                    'to' => $model->email,
                                    'subject' => $wellcome_email['subject'],
                                    'template' => 'forget_pass',
                                    'body' => $wellcome_email['body']
                                ];
                                $this->SendMail($wellcome_email_data);
                            }
//                        ========== call to login function =============
                            $login = $this->socialLogin($model->facebook_id, $registerType);

                            if ($login['flag'] == 1) {
                                $resp['flag'] = true;
                                $resp['msg'] = $login['msg'];
                                $resp['redirectUrl'] = $login['redirectUrl'];
                            } else {
                                $resp['msg'] = $login['msg'];
                            }
                        } else {
                            $resp['msg'] = Yii::t('app', "Error! Please try  again after some times.");
                        }
                    }
                }
            }

            return json_encode($resp);
            exit();
        }
    }

    public function socialLogin($identifyId, $agent) {
        $resp = [];
        $resp['flag'] = false;
        $loginModel = new SocialLoginForm();
        if ($agent == 3) {
            $loginModel->googleId = $identifyId;
            $loginModel->loginType = $agent;
            $loginModel->scenario = "google-login";

            if ($loginModel->validate() && $loginModel->login()) {
                $resp['flag'] = true;
                $resp['msg'] = Yii::t('app', 'You are successfully Signin. Please wait we are redirecting you..');
                $resp['redirectUrl'] = Yii::$app->urlManager->createAbsoluteUrl("user/profile");
            } else {
                $resp['msg'] = $this->getSocialUser($identifyId);
            }
        } elseif ($agent == 2) {
            $loginModel->fbId = $identifyId;
            $loginModel->loginType = $agent;
            $loginModel->scenario = "facebook-login";

            if ($loginModel->validate() && $loginModel->login()) {
                $resp['flag'] = true;
                $resp['msg'] = Yii::t('app', 'You are successfully Signin. Please wait we are redirecting you..');
                $resp['redirectUrl'] = Yii::$app->urlManager->createAbsoluteUrl("user/profile");
            } else {
                $resp['msg'] = $this->getSocialUser($identifyId);
            }
        } else {
            $resp['msg'] = Yii::t('app', 'Something Error! Please try again after some time.');
        }
        return $resp;
    }

    public function getSocialUser($socialId) {
        $user = UserMaster::find()->where("(google_id=:socialId OR facebook_id=:socialId) AND user_type = 2 AND status!=:status", [':socialId' => $socialId, ':status' => 3])->one();
        if (count($user) > 0) {
            if ($user->status == 2) {
                $resp = Yii::t('app', 'Your account is suspended now. Please contact to site administrator.');
            } elseif ($user->status == 0) {
                $resp = Yii::t('app', 'We have already send a email verification email. Please firstly verify your email address.');
            }
        }
        return $resp;
    }

}
