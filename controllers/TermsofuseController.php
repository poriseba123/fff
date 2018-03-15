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
use app\models\Landingpage;




class TermsofuseController extends FrontendController {

    public function actionIndex() {
        //$this->view->title = "Home";
        $this->view->title = "Terms of Use";
        $model = [];
        return $this->render('termsofuse', ['model' => $model]);
    }

}

?>

