<?php

namespace app\controllers;

//namespace yashop\ses;
//use ofat\yii2-yashop-ses\libs\SimpleEmailService;
///var/www/html/vendor/ofat/yii2-yashop-ses/libs
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
//use yii\mail\BaseMailer;
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
use app\models\Landingpage;

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
            'bootstrap' => ['log', 'userCounter'],
        ];
    }

    public function google_count() {

        require_once ('/var/www/html/vendor/autoload.php');
        $client = new Google_Client();
//        $client->setApplicationName("XXXX");
//        $client->setAuthConfig('path_to_Auth_jsno_file');
//        $client->addScope('https://www.googleapis.com/auth/analytics.readonly');
//        $GA_VIEW_ID = 'ga:XXXX';
//        $service = new Google_Service_Analytics($client);
//        try {
//            $result = $service->data_realtime->get($GA_VIEW_ID, 'rt:activeVisitors');
//            $count = $result->totalsForAllResults['rt:activeVisitors'];
//            echo $count;
//        } catch (Exception $e) {
//            var_dump($e);
//        }
    }

    public function actionSuggestion() {
        $limit = 10;  //no of value to be fatched.
        $arr_result = array();
        $arr_result_second = array();
        $result_empty = array();
        $match_result = array();

//$value=trim($_REQUEST['key']);
        $raw_value = trim(strtolower($_REQUEST['key']));
        $category = trim($_REQUEST['category']);
        $state = trim($_REQUEST['state']);
        $city = trim($_REQUEST['city']);
        $explode_value = explode(" ", $raw_value);
        $explode_end_value = end($explode_value);

        if ((count($explode_value) > 1) && (strlen($explode_end_value) == 1)) {
            if (ctype_alpha($explode_end_value) == true) {
                $msg[0] = "last char alpha";
                echo json_encode($msg);
                die();
            }
        } else {
            $value = $raw_value;
        }

        if ($value != "") {

            if ($category != "") {
                $url = 'curl -X GET "https://search-poriseba007--7zqiehj6l6mmfrl3tno3i3pp4m.ap-south-1.es.amazonaws.com/poriseba/bomsankar/_search?size=25" -d \'{"query":{"bool":{"must":[{"term":{"category_id":"' . $category . '"}},{"wildcard":{"name":{ "value" : "*' . $value . '*", "boost" : 2.0 }}}]}}}\'';
            }
            if ($category != "" && $state != '') {
                $url = 'curl -X GET "https://search-poriseba007--7zqiehj6l6mmfrl3tno3i3pp4m.ap-south-1.es.amazonaws.com/poriseba/bomsankar/_search?size=25" -d \'{"query":{"bool":{"must":[{"term":{"category_id":"' . $category . '"}},{"term":{"state_id":"' . $state . '"}},{"wildcard":{"name":{ "value" : "*' . $value . '*", "boost" : 2.0 }}}]}}}\'';
                //$url = 'curl -X GET "https://search-poriseba007--7zqiehj6l6mmfrl3tno3i3pp4m.ap-south-1.es.amazonaws.com/poriseba/bomsankar/_search?size=25" -d \'{"query":{"bool":{"should":[{"term":{"category_id":"' . $category . '"}},{"term":{"state_id":"' . $state . '"}},{"term":{"name":"' . $value . '"}]}}}\'';
                //$url = 'curl -X GET "https://search-poriseba007--7zqiehj6l6mmfrl3tno3i3pp4m.ap-south-1.es.amazonaws.com/poriseba/bomsankar/_search?size=25" -d \'{"query":{"bool":{"should":[{"term":{"category_id":"' . $category . '"}},{"term":{"state_id":"' . $state . '"}},{"match_phrase_prefix":{"name":"' . $value . '"}}]}}}\'';
            }
            if ($category != "" && $state != '' && $city != "") {
//                die('sss');
                $url = 'curl -X GET "https://search-poriseba007--7zqiehj6l6mmfrl3tno3i3pp4m.ap-south-1.es.amazonaws.com/poriseba/bomsankar/_search?size=25" -d \'{"query":{"bool":{"must":[{"term":{"category_id":"' . $category . '"}},{"term":{"state_id":"' . $state . '"}},{"term":{"city_id":"' . $city . '"}},{"wildcard":{"name":{ "value" : "*' . $value . '*", "boost" : 2.0 }}}]}}}\'';
                //$url = 'curl -X GET "https://search-poriseba007--7zqiehj6l6mmfrl3tno3i3pp4m.ap-south-1.es.amazonaws.com/poriseba/bomsankar/_search?size=25" -d \'{"query":{"bool":{"should":[{"term":{"category_id":"' . $category . '"}},{"term":{"state_id":"' . $state . '"}},{"term":{"city_id":"' . $city . '"}},{"term":{"name":"' . $value . '"}]}}}\'';
                //$url = 'curl -X GET "https://search-poriseba007--7zqiehj6l6mmfrl3tno3i3pp4m.ap-south-1.es.amazonaws.com/poriseba/bomsankar/_search?size=25" -d \'{"query":{"bool":{"should":[{"term":{"category_id":"' . $category . '"}},{"term":{"state_id":"' . $state . '"}},{"term":{"city_id":"' . $city . '"}},{"match_phrase_prefix":{"name":"' . $value . '"}}]}}}\'';
            } if ($category == "" && $state == '' && $city == "") {
                $url = 'curl -X GET "https://search-poriseba007--7zqiehj6l6mmfrl3tno3i3pp4m.ap-south-1.es.amazonaws.com/poriseba/bomsankar/_search?size=25" -d \'{"query":{"bool":{"must":[{"match_phrase_prefix":{"name":"' . $value . '"}}]}}}\'';
            }

//            if ($_REQUEST['flag'] == 0) {
//                
//            } else {
//                $url = 'curl -X GET "https://search-poriseba007--7zqiehj6l6mmfrl3tno3i3pp4m.ap-south-1.es.amazonaws.com/poriseba/bomsankar/_search?size=25" -d \'{"query":{"bool":{"should":[{"match_phrase_prefix":{"name":"' . $value . '"}}]}}}\'';
//            }
////die();

            $value_users = exec($url);
            $value_users = json_decode($value_users);
            $total = $value_users->hits->total;     // total number of result found.

            $arr = $value_users->hits->hits;         // store result value.
            //foreach($arr as $values){
            //        echo $values->_source->name."<br/>";
            //}
            //die();
            //print_r($arr);die();
            if ($total < $limit) {
                $limit = $total;
            }
            $j = 0;
            $val_hal = ucwords($value);
            for ($i = 0; $i < $limit; $i++) {
                //echo $value."<br/>";
                //print_r($arr[$i]);
                //$pregmeatch = "/^'.$value.'(.*)/i";
                //$preg_match_all($pregmeatch,$arr[$i]->_source->brand,$val);
                //print_r($val);
                //var_dump($value);
                //echo $arr[$i]->_source->brand;

                if ($j < $limit) {
                    $finder = isset($arr[$i]) ? $this->startsWith($arr[$i]->_source->name, $val_hal) : false;
                    //echo $finder;
                    if ($finder == true) {
                        if (isset($arr[$i]) && ($arr[$i]->_source->name != null)) {
                            array_push($arr_result, strtoupper($arr[$i]->_source->name) . '@' . $arr[$i]->_source->category_id . '@' . $arr[$i]->_source->city_id);
                            $j++;
                        }
                    } else {
                        if (isset($arr[$i]) && ($arr[$i]->_source->name != null)) {
                            array_push($arr_result_second, strtoupper($arr[$i]->_source->name) . '@' . $arr[$i]->_source->category_id . '@' . $arr[$i]->_source->city_id);
                        }
                    }
                } else {
                    break;
                }
            }


            $result = array_merge($arr_result, $arr_result_second);
//            print_r($result);
//            die();
            if (!empty($result)) {
                if (isset($result[0]) && ($result[0] != null)) {

                    echo json_encode(array_unique($result));
                    //echo implode(",",$result);   
                } else {
                    //ucwords()
                    //array_push($arr_result_second,$arr[$i]->_source->name);
                    $value_users = exec($url);
                    $value_users = json_decode($value_users);
                    $arr = $value_users->hits->hits;
                    //print_r($arr);
                    //die();
                    if (isset($arr[0]) && ($arr[0]->_source->name != null)) {
                        array_push($match_result, strtoupper($arr[0]->_source->name) . '@' . $arr[0]->_source->category_id . '@' . $arr[0]->_source->city_id);
                        echo json_encode(array_unique($match_result));
                    } else {
                        $result_empty[0] = "No result found";
                        echo json_encode($result_empty);
                    }
                }
            } else {
                $result_empty[0] = "No result found";
                echo json_encode($result_empty);
            }
        }
    }

    function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
    }

    public function actionIndex() {
        //$this->google_count();

        $this->view->title = "Home";
        $data = [];

        $all_services = ServicesList::find()->where(['status' => '1'])->all();
        $data['all_services'] = $all_services;

        $landing_page = Landingpage::find()->where(['id' => '1'])->all();
        $data['landing_page'] = $landing_page;

        $med_shop_result = MedicineShopMaster::find()->select(['*,COUNT(id) as cityrow_count'])->where(['status' => '1'])->groupBy(['city_id'])->all();
        $data['med_shop_result'] = $med_shop_result;

        $ambulance_result = AmbulanceMaster::find()->select(['*,COUNT(id) as cityrow_count'])->where(['status' => '1'])->groupBy(['city_id'])->all();
        $data['ambulance_result'] = $ambulance_result;

        $ambulance_result = AmbulanceMaster::find()->select(['*,COUNT(id) as cityrow_count'])->where(['status' => '1'])->groupBy(['city_id'])->all();
        $data['ambulance_result'] = $ambulance_result;

        $eyebank_result = EyeBankMaster::find()->select(['*,COUNT(id) as cityrow_count'])->where(['status' => '1'])->groupBy(['city_id'])->all();
        $data['eyebank_result'] = $eyebank_result;

        $bloodbank_result = BloodBankMaster::find()->select(['*,COUNT(id) as cityrow_count'])->where(['status' => '1'])->groupBy(['city_id'])->all();
        $data['eyebank_result'] = $eyebank_result;

        $mortuary_result = MortuaryMaster::find()->select(['*,COUNT(id) as cityrow_count'])->where(['status' => '1'])->groupBy(['city_id'])->all();
        $data['mortuary_result'] = $mortuary_result;

        $diagnostic_result = DiagnosticCentre::find()->select(['*,COUNT(id) as cityrow_count'])->where(['status' => '1'])->groupBy(['city_id'])->all();
        $data['diagnostic_result'] = $diagnostic_result;


        return $this->render('index', $data);
    }

//    ******************* custom Not Found and Url error function ****************
    public function actionUsernotfoundexc() {
        return $this->render("user-not-found");
    }

    public function actionUrlerror() {
        return $this->render("url-error");
    }

    public function actionActivateaccount() {
        if (Yii::$app->request->get('tId') != '') {
            $trackId = Yii::$app->request->get('tId');
            $model = UserMaster::find()->where(["activation_token" => $trackId])->one();
            if ($model) {
                $model->activation_token = '';
                $model->email_verified = 1;
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
//        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }
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
                $resp['msg'] = Yii::t('app', 'You are successfully Signin.');
                if (isset(Yii::$app->session['requrl']) && Yii::$app->session['requrl'] != "") {
                    $resp['redirectUrl'] = Yii::$app->session['requrl'];
                    unset(Yii::$app->session['requrl']);
                } else {
                    $resp['redirectUrl'] = Yii::$app->urlManager->createAbsoluteUrl('/');
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
                $model->email_id = $_POST['Newsletter']['email_id'];
                $email_check = \app\models\Newsletter::find()->where(['email_id' => $model->email_id])->one();
                if (count($email_check) > 0) {
                    if ($email_check->status == 1) {
                        $model->addError('email_id', Yii::t('app', 'Already subscribed'));
                        $resp['error'] = $model->getErrors();
                    } else {
                        $model->status = 1;
                        $model->subscription_data = date("Y-m-d");
                        $model->save(false);
                        $resp['flag'] = true;
                        $resp['msg'] = Yii::t('app', 'newsletter subscribed');
                    }
                } else {
                    $model->subscription_data = date("Y-m-d");
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

    public function actionHowitworks() {
        $model = Cms::find()->where(['slug' => "how_it_works"])->one();
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
        $resp = [];
        $html = '<option class="subitem" value="">All Cities</option>';
        if (isset($_POST['state_id']) && $_POST['state_id'] != '') {
            $state_id = $_POST['state_id'];
            $city_id = $_POST['city_id'];
            $sql = "select c.* from cities as c LEFT JOIN districts as d ON c.district_id=d.id LEFT JOIN states as s ON d.state_id=s.id where s.id=$state_id and d.status=1 and c.status=1 order by c.name ASC";
            $result = Yii::$app->db->createCommand($sql)->queryAll();
            if (count($result) > 0) {
                foreach ($result as $key => $value) {
                    $val = (object) $value;
                    $select = '';
                    if ($city_id == $val->id) {
                        $select = 'selected="selected"';
                    }
                    $html .= '<option class="subitem" value="' . $val->id . '" ' . $select . '>' . $val->name . '</option>';
                }
            }
        }
        $resp['html'] = $html;
        echo json_encode($resp);
        exit;
    }

    public function actionCheckmailtemplate() {
        $to = "poriseba.com@gmail.com";
        $body = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.";
        $content = Yii::$app->controller->renderPartial('@app/mail/layouts/template.php', array('message' => $body), true);
        echo "<pre>";
        print_r($content);
        exit;
//        $result = Yii::$app->mailer->compose()
//                ->setTo($to)
////                ->setFrom([])
//                ->setFrom('poriseba.com@gmail.com')
//                ->setSubject("testing Email Template")
//                ->setHtmlBody($content)
//                ->send();
        echo "<pre>";
        echo "here</br/>";
        print_r($result);
        echo "</pre>";
        exit;
    }

}
