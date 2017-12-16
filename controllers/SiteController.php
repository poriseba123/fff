<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\UserMaster;
use app\models\SuccessNotify;
use app\models\Fellowship;
use app\models\LoginForm;
use app\models\ContactForm;
use app\components\FrontendController;
use app\models\MetaLocation;
use app\models\Cms;

use app\models\MedicineShopMaster;
use app\models\AmbulanceMaster;
use app\models\EyeBankMaster;
use app\models\BloodBankMaster;
use app\models\MortuaryMaster;
use app\models\DiagnosticCentre;

use app\models\ServicesList;

class SiteController extends FrontendController {

    /**
     * @inheritdoc
     */
    public function init() {
//        if (!Yii::$app->user->isGuest) {
//            return $this->redirect('dashboard/index');
//        }
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
                    'logout' => ['post', 'get'],
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
        $this->view->title = "Home";
        $data=[];
        
        $all_services=ServicesList::find()->where(['status'=>'1'])->all();
        $data['all_services']=$all_services;
        
        $med_shop_result= MedicineShopMaster::find()->select(['*,COUNT(id) as cityrow_count'])->where(['status'=>'1'])->groupBy(['city_id'])->all();
        $data['med_shop_result']=$med_shop_result;
        
        $ambulance_result= AmbulanceMaster::find()->select(['*,COUNT(id) as cityrow_count'])->where(['status'=>'1'])->groupBy(['city_id'])->all();
        $data['ambulance_result']=$ambulance_result;
        
        $ambulance_result= AmbulanceMaster::find()->select(['*,COUNT(id) as cityrow_count'])->where(['status'=>'1'])->groupBy(['city_id'])->all();
        $data['ambulance_result']=$ambulance_result;
        
        $eyebank_result= EyeBankMaster::find()->select(['*,COUNT(id) as cityrow_count'])->where(['status'=>'1'])->groupBy(['city_id'])->all();
        $data['eyebank_result']=$eyebank_result;
        
        $bloodbank_result= BloodBankMaster::find()->select(['*,COUNT(id) as cityrow_count'])->where(['status'=>'1'])->groupBy(['city_id'])->all();
        $data['eyebank_result']=$eyebank_result;
        
        $mortuary_result= MortuaryMaster::find()->select(['*,COUNT(id) as cityrow_count'])->where(['status'=>'1'])->groupBy(['city_id'])->all();
        $data['mortuary_result']=$mortuary_result;
        
        $diagnostic_result= DiagnosticCentre::find()->select(['*,COUNT(id) as cityrow_count'])->where(['status'=>'1'])->groupBy(['city_id'])->all();
        $data['diagnostic_result']=$diagnostic_result;


        return $this->render('index', $data);
    }

//    ******************* custom Not Found and Url error function ****************
    public function actionUsernotfoundexc() {
        return $this->render("user-not-found");
    }

    public function actionUrlerror() {
        return $this->render("url-error");
    }

    public function actionComo_funciona() {
        $this->view->title = "como-funciona";
//        return $this->redirect(Yii::$app->urlManager->createUrl('/admin/'));
        return $this->render('como_funciona');
    }

    public function actionQuien_somos() {
        $this->view->title = "Quien somos";
//        return $this->redirect(Yii::$app->urlManager->createUrl('/admin/'));
        return $this->render('quien_somos');
    }

    public function actionReglamento_interno() {
        $this->view->title = "reglamento-interno";
//        return $this->redirect(Yii::$app->urlManager->createUrl('/admin/'));
        return $this->render('reglamento_interno');
    }

    public function actionPreguntas_y_respuestas() {
        $this->view->title = "Preguntas_y_respuestas";
//        return $this->redirect(Yii::$app->urlManager->createUrl('/admin/'));
        return $this->render('preguntas_y_respuestas');
    }

    public function actionTerminos_y_condiciones() {
        $this->view->title = "Terminos_y_condiciones";
//        return $this->redirect(Yii::$app->urlManager->createUrl('/admin/'));
        return $this->render('terminos_y_condiciones');
    }

    public function actionPreceptos_de_confidencialidad() {
        $this->view->title = "Preceptos_de_confidencialidad";
//        return $this->redirect(Yii::$app->urlManager->createUrl('/admin/'));
        return $this->render('preceptos_de_confidencialidad');
    }

    public function actionActivateaccount() {
        if (Yii::$app->request->get('tId') != '') {
            $trackId = Yii::$app->request->get('tId');
            $model = UserMaster::find()->where(["activation_token" => $trackId])->one();
            if ($model) {
                $model->activation_token = '';
                $model->email_varified = 1;
                $model->status = 1;
                $model->save(false);
                Yii::$app->session->setFlash('success', Yii::t('app', 'Email Verified. Please Login to access your account.'));
                return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl(['site/login']));
            } else {
                Yii::$app->session->setFlash('error', Yii::t("app", 'Error! Invalid Request.'));
                return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl(['site/index']));
//                $trackId = $this->rand_string(7);
//                Yii::$app->session['trackId'] = $trackId;
//                Yii::$app->session->setFlash('error', 'Solicitud no válida.');
//                return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl(['site/information', 'trackId' => $trackId]));
            }
        } else {
            Yii::$app->session->setFlash('error', Yii::t("app", 'Error! Invalid Request.'));
            return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl(['site/index']));
        }
    }

    public function actionVerifyuseremail() {
        if (Yii::$app->request->get('tId') != '') {
            $trackId = Yii::$app->request->get('tId');
            $model = UserMaster::find()->where(["email_code" => $trackId])->one();
            if (count($model) > 0) {
                $model->email_code = '';
                $model->email_varified = 1;
                $model->status = 1;
                $model->save(false);
                Yii::$app->session->setFlash('success', Yii::t('app', 'Email Address successfully verified.'));
                return $this->redirect(["user/userverification"]);
            } else {
                return $this->render("error");
            }
        } else {
            return $this->render("error");
        }
    }

    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $session = Yii::$app->session;
        if (isset($_GET['redirect']) && $_GET['redirect'] != '') {
            $b = (isset($_GET['location_b_name']) && $_GET['location_b_name'] != '') ? $_GET['location_b_name'] : '';
            $session['requrl'] = $_GET['redirect'] . '&location_b_name=' . $b;
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', ['model' => $model]);
    }

    public function actionAjaxlogin() {
        $resp = [];
        $resp['flag'] = false;
        if (Yii::$app->request->isAjax) {
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                $resp['flag'] = true;
                $resp['msg'] = Yii::t('app', 'You are successfully Signin. Please wait we are redirecting you..');
                if (isset(Yii::$app->session['requrl']) && Yii::$app->session['requrl'] != "") {
                    $resp['redirectUrl'] = Yii::$app->session['requrl'];
                    unset(Yii::$app->session['requrl']);
                } else {
                    $resp['redirectUrl'] = Yii::$app->urlManager->createAbsoluteUrl('user/profile');
                }
            } else {
                $error = $model->getErrors();
                $resp['error'] = $model->getErrors();
            }
        } else {
            $resp['ajaxError'] = true;
            $resp['msg'] = "Bad Request. Please contact to your site admin.";
        }
        echo json_encode($resp);
    }
    

    public function actionForgotpassword() {
        return $this->render("forgot-password");
    }

    public function actionSentforgotpassmail() {
        $resp = [];
        $resp['flag'] = false;
        if (Yii::$app->request->isAjax) {
            if ($_POST['forgotpassemail'] != '') {
                $email = $_POST['forgotpassemail'];
                $findUser = UserMaster::findByActiveUsername($email);
                if (count($findUser) > 0) {
                    $full_name = $findUser->first_name;
                    $findUser->reset_password_token = $this->rand_string(10);
                    $findUser->save(false);
                    $link = $link = Yii::$app->urlManager->createAbsoluteUrl(["site/changepass", 'token' => $findUser->reset_password_token]);
                    $email_setting = $this->get_email_data('forgot_password', array('LINK' => $link, 'FULL_NAME' => $full_name, 'PROJECT_NAME' => $this->getProjectName(), 'UEMAIL' => $findUser->email));
                    $email_data = [
                        'to' => $findUser->email,
                        'subject' => $email_setting['subject'],
                        'template' => 'main',
                        'body' => $email_setting['body']
                    ];
                    $this->SendMail($email_data);
                    $resp['flag'] = true;
                    $resp['msg'] = Yii::t('app', 'Change Password link has been sent to your register Email Id. Please check your Email.');
                } else {
                    $checkUser = UserMaster::findByUsername($email);
                    if (count($checkUser) && $checkUser->status == 0) {
                        $resp['msg'] = Yii::t('app', 'Your Account is Not Activated. Please activate your account.');
                    } elseif (count($checkUser) && $checkUser->status == 2) {
                        $resp['msg'] = Yii::t('app', 'Your account is suspended. Please contact to site administrator');
                    } else {
                        $resp['msg'] = Yii::t('app', 'There are no record with this email id');
                    }
                }
            } else {
                $resp['msg'] = 'Enter Your registered email Id.';
            }
        } else {
            $resp['ajaxError'] = true;
            $resp['msg'] = "Bad Request. Please contact to your site admin.";
        }

        echo json_encode($resp);
        exit;
    }

    public function actionChangepass() {
        if (Yii::$app->request->isAjax) {
            $userId = $_POST['userId'];
            $user = UserMaster::findOne($userId);
            $user->scenario = 'change-for-pass';
            $resp = [];
            $resp['flag'] = false;
            if (isset($_POST['UserMaster'])) {
                $user->attributes = $_POST['UserMaster'];
                $user->password = $_POST['UserMaster']['new_password'];
                if ($user->validate() && $user->save()) {
                    $user->reset_password_token = '';
                    $user->password = Yii::$app->security->generatePasswordHash($user->password);
                    $user->save(false);
                    $resp['flag'] = true;
                    $resp['msg'] = Yii::t('app', 'Your password successfully reset. Please login to access your account');
                    $resp['redirectUrl'] = Yii::$app->urlManager->createAbsoluteUrl('site/login');
                } else {
                    $resp['error'] = $user->getErrors();
                }
            }
            echo json_encode($resp);
            exit;
        }
        if (isset($_GET['token']) && trim($_GET['token']) != '') {
            $token = $_GET['token'];
            $user = UserMaster::findForgetPassUser($token);
            if (count($user) == 0) {
                return $this->render('url-error');
            } else {
                $user->scenario = 'change-for-pass';
            }
            return $this->render('change-forget-pass', ['model' => $user]);
        } else {
            return $this->render('url-error');
        }
    }
    
    public function actionNewsletter() {
        $resp = [];
        $resp['flag'] = false;
        if (Yii::$app->request->isAjax) {
            $model = new \app\models\Newsletter();
            $model->scenario = 'subscribe';
            $model->attributes = $_POST['Newsletter'];
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->full_name=$_POST['Newsletter']['full_name'];
                $model->email_id=$_POST['Newsletter']['email_id'];
                $email_check= \app\models\Newsletter::find()->where(['email_id'=>$model->email_id])->one();
                if(count($email_check)>0){
                    if($email_check->status==1){
                        $model->addError('email_id', Yii::t('app', 'Already subscribed'));
                        $resp['error'] = $model->getErrors();
                    }else{
                        $model->status=1;
                        $model->updated_at=date("Y-m-d H:i:s");
                        $model->save(false); 
                        $resp['flag'] = true;
                        $resp['msg'] = Yii::t('app', 'newsletter subscribed');
                    }
                }else{
                $model->created_at=date("Y-m-d H:i:s");
                $model->updated_at=date("Y-m-d H:i:s");
                $model->save(false);
                $resp['flag'] = true;
                $resp['msg'] = Yii::t('app', 'newsletter subscribed');
                }
            } else {
                $error = $model->getErrors();
                $resp['error'] = $model->getErrors();
            }
        } else {
            $resp['ajaxError'] = true;
            $resp['msg'] = "Bad Request. Please contact to your site admin.";
        }
        echo json_encode($resp);
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        Yii::$app->session->setFlash('success', Yii::t('app', 'You have successfully Loged Out.'));
        return $this->goHome();
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    public function actionHowitworks() {
        $model = Cms::find()->where(['slug' => "how_it_works"])->one();
        return $this->render('cms', ['model' => $model]);
    }

    public function actionFaq() {
        $model = Cms::find()->where(['slug' => "faq"])->one();
        return $this->render('cms', ['model' => $model]);
    }

    public function actionAboutus() {
        $model = Cms::find()->where(['slug' => "about_us"])->one();
        return $this->render('cms', ['model' => $model]);
    }

    public function actionRuleofprocedures() {
        $model = Cms::find()->where(['slug' => "rules_of_procedure"])->one();
        return $this->render('cms', ['model' => $model]);
    }

    public function actionTermconditions() {
        $model = Cms::find()->where(['slug' => "terms_conditions"])->one();
        return $this->render('cms', ['model' => $model]);
    }

    public function actionPrivacypolicy() {
        $model = Cms::find()->where(['slug' => "privacy_policy"])->one();
        return $this->render('cms', ['model' => $model]);
    }

    public function actionAbout() {
        return $this->render('about');
    }

    public function actionInformation() {
        if (isset($_REQUEST['trackId']) && $_REQUEST['trackId'] != "" && strlen($_REQUEST['trackId']) == 6 && $_REQUEST['trackId'] == Yii::$app->session['trackId']) {
            unset(Yii::$app->session['trackId']);
            return $this->render('information');
        } else {
            return $this->render('error');
        }
    }

    public function actionGeturl() {
        exit(Yii::$app->request->baseUrl);
    }

    public function actionGetfellowshipmembers() {
        $fell = Fellowship::find()->all();
        foreach ($fell as $v) {
            $members = \app\models\JoinFellowship::find()->where('fellowship_id=:fellowship_id AND status=:status', [':fellowship_id' => $v->id, ':status' => 1])->count();
            $v->membercount = $members;
            $v->save(false);
        }
    }

    public function actionGetstate($id) {

        $state = MetaLocation::find()->where(['in_location' => $id])->orderBy(['local_name' => SORT_ASC])->all();
        $statecount = MetaLocation::find()->where(['in_location' => $id])->count();
        $html = '';
        if ($statecount > 0) {
            $html .= "<option value=''>Select state/Province</option>";
            foreach ($state as $s) {
                $html .= "<option value='" . $s->id . "'>" . $s->local_name . "</option>";
            }
        } else {
            $html = "<option value=''>No State Available</option>";
        }
        $data_msg['html'] = $html;
        $data_msg['res'] = 1;
        echo json_encode($data_msg);
        exit;
    }

    public function actionGetsearchbarcities() {
        $resp=[];
        $html='<option class="subitem" value="">All Cities</option>';
        if(isset($_POST['state_id']) && $_POST['state_id']!=''){
        $state_id=$_POST['state_id'];
        $sql = "select c.* from cities as c LEFT JOIN districts as d ON c.district_id=d.id LEFT JOIN states as s ON d.state_id=s.id where s.id=$state_id and d.status=1 and c.status=1 order by c.name ASC";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        if(count($result) > 0){
        foreach ($result as $key => $value) {
            $val=(object)$value;
            $html.='<option class="subitem" value="'.$val->id.'">'.$val->name.'</option>';
        }
        }
        }
        $resp['html']=$html;
        echo json_encode($resp);
        exit;
    }
    public function actionCheckmailtemplate() {
        $to = "taslimislam02@gmail.com";
        $body = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.";

        $content = Yii::$app->controller->renderPartial('@app/mail/layouts/template.php', array('message' => $body), true);
        echo "<pre>";
        print_r($content);
//        exit;
        $result = Yii::$app->mailer->compose()
                ->setTo($to)
                ->setFrom([])
                ->setFrom(['noreply@123Vmos.com' => '123Vmos'])
                ->setSubject("testing Email Template")
                ->setHtmlBody($content)
                ->send();
        echo "<pre>";
        echo "here</br/>";
        print_r($result);
        echo "</pre>";
        exit;
    }

}
