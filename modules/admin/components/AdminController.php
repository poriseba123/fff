<?php

namespace app\modules\admin\components;

use Yii;
use yii\web\Controller;
use app\modules\admin\models\UserMaster;
use app\models\EmailNotify;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

class AdminController extends Controller {

    public function beforeAction($action) {
        require_once 'set-layout.php';
        return parent::beforeAction($action);
    }

    public function getProjectName() {
        return ucwords("PoriseBa.com");
    }

    public function getProjectLogo() {
        return Yii::$app->request->baseUrl . '/assets/img/adminlogo.png';
    }

    public function resizeImage($foldername, $imgName) {
        Image::getImagine()->open(Yii::$app->basePath . '/uploads/' . $foldername . '/original/' . $imgName)->thumbnail(new Box(120, 120))->save(Yii::$app->basePath . '/uploads/' . $foldername . '/thumbnail/' . $imgName, ['quality' => 90]);
        Image::getImagine()->open(Yii::$app->basePath . '/uploads/' . $foldername . '/original/' . $imgName)->thumbnail(new Box(180, 250))->save(Yii::$app->basePath . '/uploads/' . $foldername . '/preview/' . $imgName, ['quality' => 90]);
    }

    public function getProjectFavicon() {
        return Yii::$app->request->baseUrl . '\themes\common-images\favicons\favicon.ico';
    }

    public function rand_string($digits) {
        $alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz" . time();
        $rand = substr(str_shuffle($alphanum), 0, $digits);
        return $rand;
    }

    public function getStaticImage($image) {
        return Yii::$app->request->baseUrl . '\themes\backend\assets\img\\' . $image;
    }

    public function getAvatarImg($img) {
        return Yii::$app->request->baseUrl . '\themes\backend\assets\img\avatar-img\\' . $img;
    }

    public function getProfilePicture($id = '') {
        if (!Yii::$app->user->isGuest) {
            if ($id == '') {
                $userDetails = UserMaster::find()->where('id =' . Yii::$app->user->id)->one();
            } else {
                $userDetails = UserMaster::find()->where('id =' . $id)->one();
            }
            if ($userDetails->image != '') {
                return Yii::$app->request->baseUrl . '\uploads\profile_pictures\\' . $userDetails->image;
            } else {
                return Yii::$app->request->baseUrl . '\themes\common-images\undefind_pro_pic\user-no-img-pro-1.png';
            }
        } else {
            return Yii::$app->request->baseUrl . '\themes\common-images\undefind_pro_pic\user-no-img-pro-1.png';
        }
    }

    public function getProfileImgErrorImg() {
        return Yii::$app->request->baseUrl . '\themes\common-images\undefind_pro_pic\user-no-img-pro-1.png';
    }

    public function getLogedInUser() {
        return UserMaster::findOne(Yii::$app->user->id);
    }

    public function SendMail($data) {
//        print_r($data);

        $template = Yii::$app->controller->renderPartial('@app/mail/layouts/template.php');

//        $content = Yii::$app->controller->renderPartial('@app/mail/' . $data['template'] . '.php', array('message' => $data['body']));
        //$content = Yii::$app->controller->renderPartial('@app/mail/layouts/template.php', ['message' => $data['body']]);
        $view = str_replace('{{email_message}}', $data['body'], $template);
        return Yii::$app->mailer->compose()
                        ->setTo($data['to'])
                        ->setFrom([])
                        ->setFrom(['poriseba.com@gmail.com' => 'Poriseba'])
                        ->setSubject(isset($data['subject']) ? $data['subject'] : '')
                        ->setHtmlBody($view)
                        ->send();

        $headers = 'From:"' . $this->getProjectName() . '" <admin@' . $this->getProjectName() . '.co>' . "\r\n";
        $headers .= 'Reply-To: noreply@' . $this->getProjectName() . '.co' . "\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        //$va = str_replace('{{email_message}}', $content, $template);
        return mail($data['to'], $data['subject'], $content, $headers);
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

    public static function route() {
        return Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;
    }

    public function getAdminLeftLogo($image) {
        return Yii::$app->request->baseUrl . '\global\img\\' . $image;
    }

    public function adminUrl($route) {
        return Yii::$app->urlManager->createUrl('admin/' . $route);
    }

    public function getAllCountryMobileCodes() {
        return \app\models\CountryPhonecodes::find()->where("iso3!=:iso3", [":iso3" => ""])->all();
    }

    public function getUserDrivingFontImg($id = "") {
        if ($id == "") {
            $id = Yii::$app->user->id;
        }
        $user = UserMaster::findOne($id);
        if ($user) {
            return Yii::$app->request->baseUrl . '\uploads\driving_licence\\' . $user->drive_frontimage;
        }
    }

    public function getUserDrivingBackImg($id = "") {
        if ($id == "") {
            $id = Yii::$app->user->id;
        }
        $user = UserMaster::findOne($id);
        if ($user) {
            return Yii::$app->request->baseUrl . '\uploads\driving_licence\\' . $user->drive_backimage;
        }
    }

    public function getUserVehicleImg($img = "") {
        if ($img == "") {
            return $this->getStaticImage("no-image.png");
        } else {
            return Yii::$app->request->baseUrl . '\uploads\vehicle_pictures\\' . $img;
        }
    }

    public function getUserIdentificationImage($id) {
//        $userIdentification = \app\models\IdentityDocument::find()->where("user_id=:userId AND status<>:status", [":userId" => $id, ":status" => 3], ["order" => "id desc"])->one();
        $userIdentification = \app\models\IdentityDocument::find()->where("user_id=:userId", [":userId" => $id])->orderBy("id desc")->one();
        return Yii::$app->request->baseUrl . '/uploads/identify_document/' . $userIdentification->file_name;
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
                                $interval .= $intervalDiff->s . " " . yii::t('app', 'second');
                            } else {
                                $interval .= $intervalDiff->s . " " . yii::t('app', 'seconds');
                            }
                        } else {
                            if ($intervalDiff->i == 1) {
                                $interval .= $intervalDiff->i . " " . yii::t('app', "minute"); //minute
                            } else {
                                $interval .= $intervalDiff->i . " " . yii::t('app', "minutes");
                            }
                        }
                    } else {
                        if ($intervalDiff->h == 1) {
                            $interval .= $intervalDiff->h . " " . yii::t('app', 'hour'); //hour
                        } else {
                            $interval .= $intervalDiff->h . " " . yii::t('app', 'hours');
                        }
                    }
                } else {
                    if ($intervalDiff->d == 1) {
                        $interval .= $intervalDiff->d . " " . yii::t('app', 'day'); //day
                    } else {
                        $interval .= $intervalDiff->d . " " . yii::t('app', 'days');
                    }
                }
            } else {
                if ($intervalDiff->m == 1) {
                    $interval .= $intervalDiff->m . " " . 'month'; //month
                } else {
                    $interval .= $intervalDiff->m . " " . 'months';
                }
            }
        } else {
            if ($intervalDiff->y == 1) {
                $interval .= $intervalDiff->y . " " . 'year'; //years
            } else {
                $interval .= $intervalDiff->y . " " . 'years';
            }
        }

        return $interval;
    }

    public function getTimeDifferenceinHour($date1, $date2) {
        $interval = "";
//       return $date1.' '.$date2;
        $date1 = date("Y-m-d H:i:s", strtotime($date1));

        $date2 = date("Y-m-d H:i:s", strtotime($date2));

        $datetime1 = date_create($date1);
        $datetime2 = date_create($date2);

        $intervalDiff = date_diff($datetime1, $datetime2);


//        echo "<pre>";
//        print_r($intervalDiff);
//        exit;
        $total_hours = 0;
        if ($intervalDiff->d > 0) {
            $total_hours += $intervalDiff->d * 24;
        }if ($intervalDiff->h > 0) {
            $total_hours += $intervalDiff->h;
        }
        return $total_hours;
    }

    public function actionGetstates() {
        $type_id = $_REQUEST['id'];
        $doc_specialities = \app\models\States::find()->where("country_id=:country_id", [":country_id" => $type_id])->all();
        $html = '<option value="">Select</option>';
        if (count($doc_specialities) > 0) {
            foreach ($doc_specialities as $key => $value) {
                $html .= '<option value="' . $value->id . '">' . $value->name . '</option>';
            }
        } else {
            $html .= '<option value="">No Data</option>';
        }
        return $html;
    }

    public function getdistricts() {
        $type_id = $_REQUEST['id'];
        $doc_specialities = \app\models\Districts::find()->where("state_id=:state_id", [":state_id" => $type_id])->all();
        $html = '<option value="">Select</option>';
        if (count($doc_specialities) > 0) {
            foreach ($doc_specialities as $key => $value) {
                $html .= '<option value="' . $value->id . '">' . $value->name . '</option>';
            }
        } else {
            $html .= '<option value="">No Data</option>';
        }
        return $html;
    }

    public function actionGetcities() {
        $type_id = $_REQUEST['id'];
        $doc_specialities = \app\models\Cities::find()->where("district_id=:district_id", [":district_id" => $type_id])->all();
        $html = "";
        if (count($doc_specialities) > 0) {
            foreach ($doc_specialities as $key => $value) {
                $html .= '<option value="' . $value->id . '">' . $value->name . '</option>';
            }
        } else {
            $html .= '<option value="">No Data</option>';
        }
        return $html;
    }

    public function getFacebookLink() {
        //$seting = Settings::find()->select('value')->where('slug=:slug', [':slug' => 'facebook_url'])->one();
//        return $seting->value;
    }

    public function getGoogleLink() {
        //$seting = Settings::find()->select('value')->where('slug=:slug', [':slug' => 'google_plus_url'])->one();
        //return $seting->value;
    }

    public function getInstagramLink() {
        //$seting = Settings::find()->select('value')->where('slug=:slug', [':slug' => 'instagram'])->one();
        //return $seting->value;
    }

}
