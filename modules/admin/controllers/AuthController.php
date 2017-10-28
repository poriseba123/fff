<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Session;
use yii\web\Cookie;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use app\modules\admin\models\LoginForm;
use app\modules\admin\models\UserMaster;
use app\modules\admin\components\AdminController;

/**
 * UserController implements the CRUD actions for Users model.
 */
class AuthController extends AdminController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'forgotpass', 'resetpassword'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->response->redirect(['admin/dashboard/']);
        }
        if (Yii::$app->request->isAjax) {
			$resp = [];
            $resp['flag'] = false;
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                $resp['flag'] = true;
                $resp['msg'] = "You have successfully logged in, Please wait...";
                $resp['redirectUrl'] = Yii::$app->urlManager->createUrl(['admin/dashboard/']);
            } else {
                $resp['msg'] = "Error! Please check your creadentials.";
                $resp['errors'] = $model->getErrors();
            }
            echo json_encode($resp);
            exit;
        }
        return $this->render('login');
    }

    public function actionForgotpass() {
        if (Yii::$app->request->isAjax) {
            $resp = [];
            $resp['flag'] = false;
            if (isset($_POST['forgotEmailId']) && $_POST['forgotEmailId'] != '') {
                $email = $_POST['forgotEmailId'];
                $findUser = UserMaster::adminFindByEmail($email);

                if ($findUser) {
                    $full_name = $findUser->first_name;
                    $activationCode = strtoupper($this->rand_string(6));
                    $findUser->reset_password_token = $activationCode;
                    $findUser->save(false);
                    $link = Yii::$app->urlManager->createAbsoluteUrl(["admin/auth/resetpassword", "tId" => $activationCode]);
                    $email_setting = $this->get_email_data('forgot_password', array('LINK' => $link, 'FULL_NAME' => $full_name, 'PROJECT_NAME'=>  $this->getProjectName(), 'UEMAIL' => $findUser->email));
                    $email_data = [
                        'to' => $findUser->email,
                        'subject' => $email_setting['subject'],
                        'template' => 'forget_pass',
                        'body' => $email_setting['body']
                    ];
                    $this->SendMail($email_data);
                    $resp['flag'] = true;
//                    $resp['msg'] = "Your password has been changed. Please check your email id.";
                    $resp['msg'] = "A password reset link has been send to your email address. Please check your email for reset your password.";
                } else {
                    $resp['msg'] = "Error! we can't track your Email Id. Please check your email id.";
                    $resp['errorMsg'] = "Email id doesn't found. Please check your email id.";
                }
            } else {
                $resp['errorMsg'] = "Email Id can not be blank.";
            }
            echo json_encode($resp);
            exit;
        }
    }

    public function actionResetpassword() {
        
        if (Yii::$app->request->isAjax) {
            $resp = [];
            $resp['flag'] = false;
            $userId = Yii::$app->session['forgotUserId'];
            $user = UserMaster::findOne($userId);
            $user->scenario = "admin-reset-password";
            if($user->load(Yii::$app->request->post())){
                if($user->validate()){
                    $user->reset_password_token = null;
                    $user->password = Yii::$app->security->generatePasswordHash($user->new_password);
                    $user->save(false);
                    unset(Yii::$app->session['forgotUserId']);
                    $resp['flag'] = true;
                    $resp['redirectUrl'] = Yii::$app->urlManager->createUrl('/admin/');
                    $resp['msg'] = "Password successfully reset. Please login to continue";
                }else{
                    $resp['error'] = $user->getErrors();
                }
            }
            echo json_encode($resp);
            exit;
        }
        
        if (Yii::$app->request->get('tId') != '') {
            $trackId = Yii::$app->request->get('tId');

            $model = UserMaster::find()->where(["reset_password_token" => $trackId])->one();
            if ($model) {
                $model->scenario = "admin-reset-password";
                Yii::$app->session['forgotUserId'] = $model->id;
                return $this->render('reset-password', ['model' => $model]);
            } else {
                return $this->render('error-page');
            }
        } else {
            return $this->render('error-page');
        }
        
    }

    public function actionLogout() {
        $cookies = Yii::$app->response->cookies;
        $cookies->remove('_chucrhbackendSessionId');
        Yii::$app->user->logout();
        session_write_close();
        Yii::$app->response->redirect(['admin/']);
    }

}
