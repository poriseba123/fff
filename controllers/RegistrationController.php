<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\UserMaster;
use app\models\UserDetails;
use app\models\SocialLoginForm;
use app\components\FrontendController;

class RegistrationController extends FrontendController {

    public function init() {
        if (!Yii::$app->user->isGuest) {
            unset(Yii::$app->session['requrl']);
            return $this->redirect(Yii::$app->urlManager->createUrl('user/profile'));
        }
        parent::init();
    }

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

    public function actionIndex() {
        $this->view->title = "Inscription utilisateur";
        return $this->render("registration");
    }

    public function actionRegistration() {
        if (Yii::$app->request->isAjax) {
            $resp = [];
            $resp['flag'] = false;

            $model = new UserMaster();
            $model->scenario = "site-registration";

            if ($model->load(Yii::$app->request->post())) {
                $model->reg_type = 1;
                $activToken = strtoupper($this->rand_string(10));
                $model->user_type = 2;
                $model->activation_token = $activToken;
                $model->added_date = date('Y-m-d H:i:s');
                $model->update_date = date('Y-m-d H:i:s');
                $model->status = 0;
                if ($model->validate() && $model->save()) {
                    $model->password = Yii::$app->security->generatePasswordHash($model->password);
                    $model->save(false);
                    $name = $model->first_name;
                    //======================= email verification email =========================
                    $link = Yii::$app->urlManager->createAbsoluteUrl(["site/activateaccount", "tId" => $activToken]);
                    $homeLink = Yii::$app->urlManager->createAbsoluteUrl("/");
                    $email_setting = $this->get_email_data('registration_email_verify', array('LINK' => $link, 'FULL_NAME' => $name, 'PROJECT_NAME' => $this->getProjectName(), 'HOME_LINK' => $homeLink));
                    $email_data = [
                        'to' => $model->email,
                        'subject' => $email_setting['subject'],
                        'template' => 'forget_pass',
                        'body' => $email_setting['body']
                    ];
                    if ($this->SendMail($email_data)) {
                        //======================= welcome email =========================
                        $linkLogin = Yii::$app->urlManager->createAbsoluteUrl(["site/login"]);
                        $wellcome_email = $this->get_email_data('wellcome_email', array('LINK' => $linkLogin, 'FULL_NAME' => $name, 'PROJECT_NAME' => $this->getProjectName(), 'EMAIL' => $model->email));
                        $wellcome_email_data = [
                            'to' => $model->email,
                            'subject' => $wellcome_email['subject'],
                            'template' => 'forget_pass',
                            'body' => $wellcome_email['body']
                        ];
                        $this->SendMail($wellcome_email_data);
                        //=============================================================
                    }
                    $resp['msg'] = "Vous avez enregistré avec succès. Vérifiez votre identifiant de messagerie pour l'activation du compte";
                    $resp['redirectUrl'] = Yii::$app->urlManager->createUrl("site/login");
                    $resp['flag'] = true;
                } else {
                    $resp['error'] = $model->getErrors();
                }
            }
            echo json_encode($resp);
            exit;
        }
    }

    public function actionActiveaccount() {
        $token = (isset($_GET['token']) && $_GET['token']) ? $_GET['token'] : '';
        if ($token != '') {
            $token = base64_decode($token);
            $model = UserMaster::find()
                    ->where('active_token =:active_token', array(':active_token' => $token))
                    ->one();
            if (count($model) > 0) {
                $model->active_token = '';
                $model->status = 1;
                $model->save(false);
                Yii::$app->session->setFlash('success', 'Profile Activated successfully. Please Login Now');
                return $this->redirect(Yii::$app->urlManager->createUrl('site/'));
            } else {
                Yii::$app->session->setFlash('error', 'Invalid Request.');
                return $this->redirect(Yii::$app->urlManager->createUrl('site/'));
            }
        } else {
            Yii::$app->session->setFlash('error', 'Invalid Request.');
            return $this->redirect(Yii::$app->urlManager->createUrl('site/'));
        }
    }

    public function actionAbs() {
        $email_data = [
            'to' => "taslimislam02@gmail.com",
            'subject' => "checkEmail",
            'template' => 'forget_pass',
            'body' => "checkEmail"
        ];
        echo "<pre>";
        print_r($this->SendMail($email_data));
        echo "</pre>";
        exit;
    }

}
