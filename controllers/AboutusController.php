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

class AboutusController extends FrontendController {

    public function actionIndex() {
        //$this->view->title = "Home";
        $this->view->title = "About Us";
        $model = [];
        return $this->render('aboutus', ['model' => $model]);
    }

}

?>