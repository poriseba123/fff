<?php

namespace app\controllers;

use Yii;
use yii\web\UploadedFile;
use app\models\UserMaster;
use app\models\IdentityDocument;
use yii\filters\VerbFilter;
use app\models\PasswordModel;
use yii\filters\AccessControl;
use app\components\FrontendController;

class UserController extends FrontendController {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                // ...
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
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
        $user = UserMaster::find()->where(['id' => Yii::$app->user->id])->one();
        return $this->render('dashboard', ['user' => $user]);
    }

    public function actionProfile() {
        $this->view->title = "Profil";
        $user_id = Yii::$app->user->id;
        $model = UserMaster::find()->where(['id' => $user_id])->one();
        if (Yii::$app->request->isAjax) {
            $resp['flag'] = false;
            $resp['imgError'] = false;
            $oldPhone = $model->phone;
            $oldPhoneCode = $model->phone_code;
            $oldEmail = $model->email;
            $model->scenario = "update_profile_info";
            $model->attributes = $_POST['UserMaster'];
            $model->userimage = UploadedFile::getInstance($model, 'userimage');
            if ($model->validate() && $model->save()) {
                $emailCode = strtoupper($this->rand_string(10));
                if ($model->email != $oldEmail) {
                    $model->email_varified = 0;
                    $model->email_code = $emailCode;
                    $model->save(false);
                    //======================= email verification email =========================
                    $link = Yii::$app->urlManager->createAbsoluteUrl(["site/verifyuseremail", "tId" => $emailCode]);
                    $homeLink = Yii::$app->urlManager->createAbsoluteUrl("/");
                    $email_setting = $this->get_email_data('email_verify', array('LINK' => $link, 'FULL_NAME' => $model->first_name, 'PROJECT_NAME' => $this->getProjectName(), 'HOME_LINK' => $homeLink));
                    $email_data = [
                        'to' => $model->email,
                        'subject' => $email_setting['subject'],
                        'template' => 'forget_pass',
                        'body' => $email_setting['body']
                    ];
                    $this->SendMail($email_data);
                }
                if ($model->phone != $oldPhone || $model->phone_code != $oldPhoneCode) {
                    $model->phone_verification = 0;
                    $model->save(false);
                }

                if ($model->userimage != '') {
                    $email_setting['body'] = "El usuario " . $model->first_name . " " . $model->last_name . " registró su foto de perfil. Porfavorverificala. ";
                    $email_setting['subject'] = "Foto de perfil";
                    $email_data = [
                        'to' => 'verificaciones@123vamos.co',
                        'subject' => $email_setting['subject'],
                        'template' => 'forget_pass',
                        'body' => $email_setting['body']
                    ];
                    $this->SendMail($email_data);
                }


                $resp['flag'] = true;
                $resp['msg'] = Yii::t('app', 'Profile data successfully updated.');
                if (isset($model->userimage)) {
                    if (isset($model->userimage->name)) {
                        $imageName = date("ymdhis") . "_" . $model->userimage->name;
                        $model->image = $imageName;
                        $path = Yii::$app->basePath . '/uploads/profile_pictures/';
                        if ($model->userimage->saveAs($path . '/' . $imageName)) {
                            $model->save(false);
                        } else {
                            $resp['imgError'] = true;
                            $resp['imgErrorMsg'] = Yii::t('app', 'Image Uploding Error. Please try again after some times');
                        }
                    } else {
                        $resp['imgError'] = true;
                        $resp['imgErrorMsg'] = Yii::t('app', 'Image Uploding Error. Please try again after some times');
                    }
                }
            } else {
                $resp['errors'] = $model->getErrors();
            }
            echo json_encode($resp);
            exit;
        }
        return $this->render('profile', ['model' => $model,]);
    }

    public function actionChangepassword() {
        $userId = Yii::$app->user->id;
        $user = UserMaster::findOne($userId);
        if (Yii::$app->request->isAjax) {
            $resp = [];
            $resp['flag'] = false;
            $model = new PasswordModel;
            $model->scenario = "change-pass";
            if ($model->load(Yii::$app->request->post())) {
                $model->attributes = $_REQUEST['PasswordModel'];
                if ($model->validate()) {
                    $user->password = Yii::$app->security->generatePasswordHash($model->new_password);
                    $user->save(false);
                    $resp['flag'] = true;
                    $resp['msg'] = Yii::t('app', "Your password has been changed.");
                } else {
                    $resp['error'] = $model->getErrors();
                }
            } else {
                $resp['msg'] = Yii::t('app', "Error! Please try again after some times.");
            }
            echo json_encode($resp);
            exit;
        }
        return $this->render("change_password", ['user' => $user]);
    }

    public function actionUserverification() {
        $userId = Yii::$app->user->id;
        $user = UserMaster::findOne($userId);

        return $this->render("user-verification", ['model' => $user]);
    }

    public function actionSendemailverificationlink() {
        if (Yii::$app->request->isAjax) {
            $resp = [];
            $resp['flag'] = false;
            $userId = isset($_REQUEST['userId']) ? $_REQUEST['userId'] : 0;
            if ($userId == 0) {
                $userId = Yii::$app->user->id;
            }
            $model = UserMaster::findOne($userId);
            $model->email_code = strtoupper($this->rand_string(10));
            $model->save(false);
//======================= email verification email =========================
            $link = Yii::$app->urlManager->createAbsoluteUrl(["site/verifyuseremail", "tId" => $model->email_code]);
            $homeLink = Yii::$app->urlManager->createAbsoluteUrl("/");
            $email_setting = $this->get_email_data('email_verify', array('LINK' => $link, 'FULL_NAME' => $model->first_name, 'PROJECT_NAME' => $this->getProjectName(), 'HOME_LINK' => $homeLink));
            $email_data = [
                'to' => $model->email,
                'subject' => $email_setting['subject'],
                'template' => 'forget_pass',
                'body' => $email_setting['body']
            ];
            if ($this->SendMail($email_data)) {
                $resp['flag'] = true;
                $resp['msg'] = Yii::t('app', "Email Verification link have been send to your email address");
            } else {
                $resp['msg'] = Yii::t('app', "Error! Please try again after some time");
            }

            echo json_encode($resp);
            exit;
        }
    }

    public function actionVerifyphone() {
        if (Yii::$app->request->isAjax) {
            $data = [];
            $userId = Yii::$app->user->id;
            $model = UserMaster::findOne($userId);
            $otp = $this->generatePIN(); //random_string(4);

            $phone = $model->phone;
            if (!isset($model->phoneCode)) {
                $data['msg'] = 'Please add your Phone ISD code to verify your phone!';
                $data['type'] = 'error';
            } else if (!isset($phone)) {
                $data['msg'] = 'Please add your Phone number verify your phone!';
                $data['type'] = 'error';
            } else {
                $code = $model->phoneCode->phonecode;
                $nexmo_msg = 'Hola ' . $model->first_name . ' ' . $model->last_name . '. Tu codigo para confermar tu celular es ' . $otp . '.El equipo 123Vamos';
                $res = Yii::$app->nexmo->sendSms($code . $phone, 'Nexmo', $nexmo_msg);
                if ($res['type'] == 'success') {
                    $model->phone_verify_code = $otp;
                    $model->save(false);
                    $data['msg'] = "Código de verificación enviado exitosamente.";
                    $data['type'] = 'success';
                } else {
                    $data['type'] = 'error';
                    $data['msg'] = $res['msg']['error-text'];
                }
            }
            echo json_encode($data);
            exit;
        }
    }

    public function actionCheckotp() {
        $user_id = Yii::$app->user->id;
        $model = UserMaster::find()->where(['id' => $user_id])->one();
        $data = [];
        if (Yii::$app->request->isAjax) {
            $verify_code = $_POST['verifyCode'];
            if ($verify_code == '') {
                $data['type'] = 'error';
                $data['msg'] = 'Por favor escribe tu código';
            } elseif ($verify_code != $model->phone_verify_code) {
                $data['type'] = 'error';
                $data['msg'] = "Invalid Code!";
            } else {
                $data['type'] = 'success';
                $data['msg'] = "Phone no varified successfully";
                $model->phone_verify_code = '';
                $model->phone_verification = 1;
                $model->save(false);
            }
        } else {
            $data['type'] = 'error';
            $data['msg'] = 'Invalid Request!';
        }
        echo json_encode($data);
        exit;
    }

    public function actionCheckdocumentverify() {
        if (Yii::$app->request->isAjax) {
            $resp['flag'] = false;
            $userId = Yii::$app->user->id;

            $user = UserMaster::findOne($userId);
            if (count($user) > 0) {
                if ($user->identity_document_verified == 0 || $user->identity_document_verified == 3) {
                    $resp['alertType'] = "notApplied";
                } elseif ($user->identity_document_verified == 2) {
                    $resp['alertType'] = "wating";
                    $resp['msg'] = "Tu identidad aún no ha sido verificada. Por favor, espere a que la administración verifique tu identidad.";
                } elseif ($user->identity_document_verified == 1) {
                    $resp['alertType'] = "approved";
                    $resp['msg'] = "Tu documento de identidad ha sido verificado.";
                }
            } else {
                $resp['buttonText'] = "Agregue tu identidad";
                $resp['msg'] = "¡Error! Inténtalo de nuevo después de algún tiempo.";
            }
            echo json_encode($resp);
            exit;
        }
    }

    public function actionSubmituseridentifydocument() {
        if (Yii::$app->request->isAjax) {
            $resp['flag'] = false;
            $user = UserMaster::findOne(Yii::$app->user->id);
            $model = new IdentityDocument();
            $model->isNewRecord = true;
            $model->id = null;
            $model->scenario = "upload_identity_document";
            $model->load(Yii::$app->request->post());
            $model->user_id = Yii::$app->user->id;
            $model->added_date = date("Y-m-d H:i:s");
            $model->status = 0;
            $model->document = UploadedFile::getInstance($model, 'document');
            if ($model->validate()) {
                $previousRec = IdentityDocument::find()->where("user_id=:userId AND (status=:status OR status=:status1)", [":userId" => Yii::$app->user->id, ":status" => 0, ":status1" => 1])->all();
                if (isset($model->document)) {
                    if (isset($model->document->name)) {
                        $imageName = date("ymdhis") . "_" . $model->document->name;
                        $model->file_name = $imageName;
                        $path = Yii::$app->basePath . '/uploads/identify_document/';
                        if ($model->document->saveAs($path . '/' . $imageName)) {
                            $model->save(false);
                            $user->identity_document_verified = 2;
                            $user->save(false);
                            foreach ($previousRec as $v) {
                                $v->status = 3;
                                $v->save(false);
                            }
                            if ($model->file_name != '') {
                                $email_setting['body'] = "El usuario " . $user->first_name . " " . $user->last_name . " registró su documento deidentidad. Porfavorverificalo.";
                                $email_setting['subject'] = "Imagen de identificación guardada";
                                $email_data = [
                                    'to' => 'verificaciones@123vamos.co',
                                    'subject' => $email_setting['subject'],
                                    'template' => 'forget_pass',
                                    'body' => $email_setting['body']
                                ];
                                $this->SendMail($email_data);
                            }

                            $resp['flag'] = true;
//                            $resp['msg'] = "Su identidad ha sido enviada correctamente. Espere la aprobación del administrador.";
                            $resp['msg'] = "Estamos verificando tu documento de identidad";
                        } else {
                            $resp['imgError'] = true;
                            $resp['imgErrorMsg'] = "Error de carga del documento. Inténtalo de nuevo varias veces.";
                        }
                    } else {
                        $resp['imgError'] = true;
                        $resp['imgErrorMsg'] = "Error de carga del documento. Inténtalo de nuevo varias veces.";
                    }
                }
            } else {
                $resp['errors'] = $model->getErrors();
            }
            echo json_encode($resp);
            exit;
        }
    }

    public function actionSendforgotpassmail() {
        if (Yii::$app->request->isAjax) {
            $resp['flag'] = false;
            $user = UserMaster::findOne(Yii::$app->user->id);
            if (count($user) > 0) {
                $full_name = $user->first_name;
                $user->reset_password_token = $this->rand_string(10);
                $user->save(false);
                $link = $link = Yii::$app->urlManager->createAbsoluteUrl(["site/changepass", 'token' => $user->reset_password_token]);
                $email_setting = $this->get_email_data('forgot_password', array('LINK' => $link, 'FULL_NAME' => $full_name, 'PROJECT_NAME' => $this->getProjectName(), 'UEMAIL' => $user->email));
                $email_data = [
                    'to' => $user->email,
                    'subject' => $email_setting['subject'],
                    'template' => 'main',
                    'body' => $email_setting['body']
                ];
                $this->SendMail($email_data);
                $resp['flag'] = true;
                $resp['msg'] = Yii::t('app', 'Change Password link has been sent to your register Email Id. Please check your Email.');
            } else {
                $resp['msg'] = Yii::t('app', 'Error! Please try again after sometime.');
            }
            echo json_encode($resp);
            exit;
        }
    }

}
