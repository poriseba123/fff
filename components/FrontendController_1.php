<?php

namespace app\components;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Settings;
use app\models\UserMaster;
use yii\filters\VerbFilter;
use app\models\EmailNotify;
use app\models\UserVehicle;

class FrontendController extends Controller {

    public function __construct($id, $module, $config = array()) {
        $cookies = Yii::$app->request->cookies;
        if ($cookies->has('123vamos_language')) {
            Yii::$app->language = $cookies->get('123vamos_language')->value;
        } else {
            Yii::$app->language = "es";
        }
        parent::__construct($id, $module, $config);
    }
    public function span_accent($wordz) { $wordz = str_replace( "�","&Aacute;",$wordz); $wordz = str_replace( "�","&Eacute;",$wordz); $wordz = str_replace( "�","&Iacute;",$wordz); $wordz = str_replace( "�","&Oacute;",$wordz); $wordz = str_replace( "�","&Uacute;",$wordz); $wordz = str_replace( "�","&Ntilde;",$wordz); $wordz = str_replace( "�","&Uuml;",$wordz); $wordz = str_replace( "�","&aacute;",$wordz); $wordz = str_replace( "�","&eacute;",$wordz); $wordz = str_replace( "�","&iacute;",$wordz); $wordz = str_replace( "�","&oacute;",$wordz); $wordz = str_replace( "�","&uacute;",$wordz); $wordz = str_replace( "�","&ntilde;",$wordz); $wordz = str_replace( "�","&uuml;",$wordz); $wordz = str_replace( "�","&iquest;",$wordz); $wordz = str_replace( "�","&iexcl;",$wordz); $wordz = str_replace( "�","&euro;",$wordz); $wordz = str_replace( "�","&laquo;",$wordz); $wordz = str_replace( "�","&raquo;",$wordz); $wordz = str_replace( "�","&lsaquo;",$wordz); $wordz = str_replace( "�","&rsaquo;",$wordz); return $wordz; }

    public function beforeAction($action) {
        $this->view->title = $this->getProjectName();
//        $falseCsrfToken = ['deleteFellowship', 'getfellowshipdetails', 'getuserdetails', 'changeuserprofileimg', 'changedrequestapproval', 'sociallogin', 'sendjoiningrequest', 'removemember', 'approvedmemberrequest', 'rejectmemberrequest', 'sociallogin', 'checkuserjoinstatus', 'deleteevent', 'eventrequestresponse', 'deletecategory', 'searchsermoncategory', 'searchannouncement', 'getdetailsofannouncement', 'deleteannouncement', 'searchtransactionhistory'];
//        if (in_array($action->id, $falseCsrfToken)) {
//            $this->enableCsrfValidation = false;
//        }
//        if (!Yii::$app->request->isAjax && ($action->controller->id != "site" || $action->controller->id != "registration") && Yii::$app->user->isGuest) {
//            Yii::$app->session['requrl'] = Yii::$app->request->url;
//        }

        return parent::beforeAction($action);
    }

    public function getFormatedDate($val) {
//        return Yii::t("app", date('F', strtotime($val))) . " " . date("d", strtotime($val)) . " " . Yii::t('app', "at") . " " . date('H:i', strtotime($val));
    
    return 'El'.' '.$this->get_day_name(date("l", strtotime($val))) . " ". date("d", strtotime($val))." " . $this->get_month_name(date("F", strtotime($val)))." a las ".date("H:i", strtotime($val));
        
    }

    public function getFormatedDateWithInterval($trip_start_time, $departure_datetime, $interval_time) {
        $val = $departure_datetime;
        while ($trip_start_time < date("Y-m-d H:i:s")) {
            $trip_start_time = date("Y-m-d H:i:s", strtotime('+' . $interval_time . ' minutes', strtotime($trip_start_time)));
			$val =$departure_datetime = date("Y-m-d H:i:s", strtotime('+' . $interval_time . ' minutes', strtotime($departure_datetime)));
		}
//        return Yii::t("app", date('F', strtotime($val))) . " " . date("d", strtotime($val)) . " " . Yii::t('app', "at") . " " . date('H:i', strtotime($val));
//                el domingo 21 agosto a las 14:00
                return 'El'.' '.$this->get_day_name(date("l", strtotime($val))) . " ". date("d", strtotime($val))." " . $this->get_month_name(date("F", strtotime($val)))." a las ".date("H:i", strtotime($val));
    }
    public function get_day_name($val){
        if($val=="Sunday"){
          return "domingo";  
        }elseif($val=="Monday"){
           return "lunes";  
        }elseif($val=="Tuesday"){
           return "martes";  
        }elseif($val=="Wednesday"){
           return "miércoles";  
        }elseif($val=="Thursday"){
           return "jueves";  
        }elseif($val=="Friday"){
            return "viernes"; 
        }elseif($val=="Saturday"){
            return "sábado"; 
        }
    }
    public function get_month_name($val){
        if($val=="January"){
          return "enero";  
        }elseif($val=="February"){
           return "febrero";  
        }elseif($val=="March"){
           return "marzo";  
        }elseif($val=="April"){
           return "abril";  
        }elseif($val=="May"){
           return "mayo";  
        }elseif($val=="June"){
            return "junio"; 
        }elseif($val=="July"){
            return "julio"; 
        }elseif($val=="August"){
            return "agosto"; 
        }elseif($val=="September"){
            return "septiembre"; 
        }elseif($val=="October"){
            return "octubre"; 
        }elseif($val=="November"){
            return "noviembre"; 
        }elseif($val=="December"){
            return "diciembre"; 
        }
    }
    public function getSmallAddress($val) {
        $val_address = explode(',', $val);
        $val_address_count = count($val_address);
        if($val_address_count>3){
        return $city = $val_address[$val_address_count - 3];
        }else{
          return  $val_address;
        }
//        $c = explode(' ', $city);
//        $c_count = count($c);
//        return $c[$c_count - 1];
    }

    public function getProjectName() {
        return "123Vamos";
    }

    public function getProjectLogo() {
        return Yii::$app->request->baseUrl . '/themes/common-images/logo/logo.png';
    }

    public function getProjectFavicon() {
        return Yii::$app->request->baseUrl . '/themes/common-images/favicons/favicon.ico';
    }

    public function getUserEmailId($id) {
        $getUser = UserMaster::findOne($id);
        if ($getUser->email != "") {
            $email = $getUser->email;
        } elseif ($getUser->google_email != "") {
            $email = $getUser->google_email;
        } elseif ($getUser->facebook_email != "") {
            $email = $getUser->facebook_email;
        }
        return $email;
    }

    public function rand_string($digits) {
        $alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz" . time();
        $rand = substr(str_shuffle($alphanum), 0, $digits);
        return $rand;
    }

    public function SendMail($data) {
        $template = Yii::$app->controller->renderPartial('@app/mail/layouts/template.php');
        $content = Yii::$app->controller->renderPartial('@app/mail/' . $data['template'] . '.php', array('message' => $data['body']));
        $view = str_replace('{{email_message}}', $content, $template);
//        return Yii::$app->mailer->compose()
//                ->setTo($data['to'])
//                ->setFrom([])
//                ->setFrom(['noreply@sportsnotion.com' => 'Sportsnotion'])
//                ->setSubject(isset($data['subject']) ? $data['subject'] : '')
//                ->setHtmlBody($view)
//                ->send();

        $headers = 'From:"' . $this->getProjectName() . '" <admin@' . $this->getProjectName() . '.com>' . "\r\n";
        $headers .= 'Reply-To: noreply@' . $this->getProjectName() . '.com' . "\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();
        $headers .="MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        //$va = str_replace('{{email_message}}', $content, $template);
        return mail($data['to'], $data['subject'], $view, $headers);
    }

    public function get_email_data($code, $replacedata = array()) {
        $email_data = EmailNotify::find()
                ->where("email_code = '$code'")
                ->one();
        $email_msg = "";
        $email_array = array();
        $email_msg = $email_data->body;
        $subject = $email_data->subject;
        if (!empty($replacedata)) {
            foreach ($replacedata as $key => $value) {
                $email_msg = str_replace("{{" . $key . "}}", $value, $email_msg);
            }
        }
        return array('body' => $email_msg, 'subject' => $subject);
    }

    public function getStaticImage($image) {
        return Yii::$app->request->baseUrl . '/themes/frontend/images/' . $image;
    }

    public function getProfileImgErrorImg() {
        return Yii::$app->request->baseUrl . '/themes/common-images/undefind_pro_pic/user-no-img-pro-1.png/';
    }

    public function getUserProfileImage($id = '') {
        if (!Yii::$app->user->isGuest) {
            if ($id == '') {
                $userDetails = UserMaster::find()->where('id =' . Yii::$app->user->id)->one();
            } else {
                $userDetails = UserMaster::find()->where('id =' . $id)->one();
            }
            if ($userDetails->image != '') {
                return Yii::$app->request->baseUrl . '/uploads/profile_pictures/' . $userDetails->image;
            } elseif ($userDetails->google_image != '') {
                return $userDetails->google_image;
            } elseif ($userDetails->facebook_image != '') {
                return $userDetails->facebook_image;
            } else {
                return Yii::$app->request->baseUrl . '/themes/common-images/undefind_pro_pic/user-no-img-pro-1.png';
            }
        } else {
            return Yii::$app->request->baseUrl . '/themes/common-images/undefind_pro_pic/user-no-img-pro-1.png';
        }
    }

    public function getuseruploadedimages($id = '') {
        if (!Yii::$app->user->isGuest) {
            if ($id == '') {
                $userDetails = UserMaster::find()->where('id =' . Yii::$app->user->id)->one();
            } else {
                $userDetails = UserMaster::find()->where('id =' . $id)->one();
            }
            if ($userDetails->image != '') {
                return Yii::$app->request->baseUrl . '/uploads/profile_pictures/' . $userDetails->image;
            } else {
                return Yii::$app->request->baseUrl . '/themes/common-images/undefind_pro_pic/user-no-img-pro-1.png';
            }
        } else {
            return Yii::$app->request->baseUrl . '/themes/common-images/undefind_pro_pic/user-no-img-pro-1.png';
        }
    }

    public function getUserDetails($id) {
        return UserMaster::findOne($id);
    }

//    ============= create analysis track id ==============
    public function createUniqueId($digits = 12) {
        $uniqueId = $this->manageUnickId($digits);

        $chkUniqueId = \app\models\UserAnalysisMaster::find()
                ->where("trackId =:uniqueId", [':uniqueId' => $uniqueId])
                ->count();
        if ($chkUniqueId > 0) {
            $this->createAnalysisUniqueId($digits);
        }
        return $uniqueId;
    }

    public function manageUnickId($digits) {
        $alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $rand = substr(str_shuffle($alphanum), 0, $digits);
        return $rand;
    }

    public function getAllCountryMobileCodes() {
        return \app\models\CountryPhonecodes::find()->where("iso3!=:iso3", [":iso3" => ""])->all();
    }

    public function generatePIN($digits = 4) {
        $i = 0; //counter
        $pin = ""; //our default pin is blank.
        while ($i < $digits) {
//generate a random number between 0 and 9.
            $pin .= mt_rand(0, 9);
            $i++;
        }
        return $pin;
    }

    public function getVehicleTrackId() {
        $uniCode = "UV-" . ucwords($this->rand_string(8));

        $check = UserVehicle::find()->where("trackId=:trackId AND status != :status", [':trackId' => $uniCode, ':status' => 3])->one();
        if (count($check) > 0) {
            $this->getVehicleTrackId();
        } else {
            return $uniCode;
        }
    }

    public function getUserDrivingFontImg($id = "") {
        if ($id == "") {
            $id = Yii::$app->user->id;
        }
        $user = UserMaster::findOne($id);
        if ($user) {
            return Yii::$app->request->baseUrl . '/uploads/driving_licence/' . $user->drive_frontimage;
        }
    }

    public function getUserDrivingBackImg($id = "") {
        if ($id == "") {
            $id = Yii::$app->user->id;
        }
        $user = UserMaster::findOne($id);
        if ($user) {
            return Yii::$app->request->baseUrl . '/uploads/driving_licence/' . $user->drive_backimage;
        }
    }

    public function getFacebookAppID() {
        $seting = Settings::find()->select('value')->where('slug=:slug', [':slug' => 'facebook_app_id'])->one();
        return $seting->value;
    }

    public function getTimeDifference($date1, $date2) {
        $interval = "";
//       return $date1.' '.$date2;
        $date1 = date("Y-m-d H:i:s", strtotime($date1));

        $date2 = date("Y-m-d H:i:s", strtotime($date2));

        $datetime1 = date_create($date1);
        $datetime2 = date_create($date2);

        $intervalDiff = date_diff($datetime1, $datetime2);

        if ($intervalDiff->y == 0) {
            if ($intervalDiff->m == 0) {
                if ($intervalDiff->d == 0) {
                    if ($intervalDiff->h == 0) {
                        if ($intervalDiff->i == 0) {
                            if ($intervalDiff->s <= 1) {
                                $interval = $intervalDiff->s . " " . yii::t('app', 'second');
                            } else {
                                $interval = $intervalDiff->s . " " . yii::t('app', 'seconds');
                            }
                        } else {
                            if ($intervalDiff->i == 1) {
                                $interval = $intervalDiff->i . " " . yii::t('app', "minute");
                            } else {
                                $interval = $intervalDiff->i . " " . yii::t('app', "minutes");
                            }
                        }
                    } else {
                        if ($intervalDiff->h == 1) {
                            $interval = $intervalDiff->h . " " . yii::t('app', 'hour');
                        } else {
                            $interval = $intervalDiff->h . " " . yii::t('app', 'hours');
                        }
                    }
                } else {
                    if ($intervalDiff->d == 1) {
                        $interval = $intervalDiff->d . " " . yii::t('app', 'hace un dia');//day
                    } else {
                        $interval = $intervalDiff->d . " " . yii::t('app', 'hace días');
                    }
                }
            } else {
                if ($intervalDiff->m == 1) {
                    $interval = $intervalDiff->m . " " .  'hace un mes';//month
                } else {
                    $interval = $intervalDiff->m . " " .  'hace meses';
                }
            }
        } else {
            if ($intervalDiff->y == 1) {
                $interval = $intervalDiff->y . " " .  'años';//years
            } else {
                $interval = $intervalDiff->y . " " .  'años';
            }
        }

        return $interval;
    }

    public function getAge($releaseTiming) {
        $interval = "";
        $date1 = date("Y-m-d H:i:s", strtotime($releaseTiming));

        $date2 = date("Y-m-d H:i:s");

        $datetime1 = date_create($date1);
        $datetime2 = date_create($date2);

        $intervalDiff = date_diff($datetime1, $datetime2);

        if ($intervalDiff->y == 0) {
            if ($intervalDiff->m == 0) {
                if ($intervalDiff->d == 0) {
                    if ($intervalDiff->h == 0) {
                        if ($intervalDiff->i == 0) {
                            if ($intervalDiff->s <= 1) {
                                $interval = $intervalDiff->s . " " . yii::t('app', 'second ago');//second
                            } else {
                                $interval = $intervalDiff->s . " " . yii::t('app', 'seconds ago');
                            }
                        } else {
                            if ($intervalDiff->i == 1) {
                                $interval = $intervalDiff->i . " " . yii::t('app', "minute ago");//minute
                            } else {
                                $interval = $intervalDiff->i . " " . yii::t('app', "minutes ago");
                            }
                        }
                    } else {
                        if ($intervalDiff->h == 1) {
                            $interval = $intervalDiff->h . " " . yii::t('app', 'hace una hora');//hour
                        } else {
                            $interval = $intervalDiff->h . " " . yii::t('app', 'horas atras');
                        }
                    }
                } else {
                    if ($intervalDiff->d == 1) {
                        $interval = $intervalDiff->d . " " . yii::t('app', 'hace un dia');//day
                    } else {
                        $interval = $intervalDiff->d . " " . yii::t('app', 'hace días');
                    }
                }
            } else {
                if ($intervalDiff->m == 1) {
                    $interval = $intervalDiff->m . " " . 'hace un mes';//month
                } else {
                    $interval = $intervalDiff->m . " " . 'hace meses';
                }
            }
        } else {
            if ($intervalDiff->y == 1) {
                $interval = $intervalDiff->y . " " . 'años';//years
            } else {
                $interval = $intervalDiff->y . " " . 'años';
            }
        }

        return $interval;
    }

    public function getFacebookLink() {
        $seting = Settings::find()->select('value')->where('slug=:slug', [':slug' => 'facebook_url'])->one();
        return $seting->value;
    }

    public function getGoogleLink() {
        $seting = Settings::find()->select('value')->where('slug=:slug', [':slug' => 'google_plus_url'])->one();
        return $seting->value;
    }

    public function getInstagramLink() {
        $seting = Settings::find()->select('value')->where('slug=:slug', [':slug' => 'instagram'])->one();
        return $seting->value;
    }

    public function getUserVehicleImg($img = "") {
        if ($img == "") {
            return $this->getStaticImage("no-image.png");
        } else {
            return Yii::$app->request->baseUrl . '/uploads/vehicle_pictures/' . $img;
//            if (file_exists($imgPpath)) {
//                return "2<br/>";
//                $imgLink = $path . $img;
//            } else {
//                return "3<br/>";
//                $imgLink = $this->getStaticImage("no-image.png");
//            }
        }
    }

}
