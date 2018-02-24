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
use app\models\ContactUs;

class ContactusController extends FrontendController {

    public function actionIndex() {
        //$this->view->title = "Home";
        $this->view->title = "Contact Us";
        $model = [];
        return $this->render('contactus', ['model' => $model]);
    }

    public function actionContact() {
        $resp = [];
        $resp['flag'] = false;
        if (Yii::$app->request->isAjax) {
            $model = new ContactUs;
            $model->scenario = 'create';
            $model->attributes = $_POST['ContactUs'];
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//                die('hello');
                $model->status = 0;
                $model->submit_date = date("Y-m-d H:i:s");
                $model->save(false);
                $name = $_POST['ContactUs']['name'];
                $email = $_POST['ContactUs']['email'];
                $email_setting = $this->get_email_data('contact_email', array('FULL_NAME' => $name,
                    'PROJECT_NAME' => 'poriseba.com',
                    'EMAIL' => $email,
                    'LINK' => 'http://poriseba.com'
                ));
//                print_r($email_setting);

                $email_data = [
                    'to' => $email,
                    'subject' => $email_setting['subject'],
                    'template' => 'contact_email',
                    'body' => $email_setting['body']
                ];
                $this->SendMail($email_data);
                $resp['flag'] = true;
                $resp['msg'] = Yii::t('app', 'Thank You for writhing to us');
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

}

?>