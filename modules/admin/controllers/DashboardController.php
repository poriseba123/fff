<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\UserMaster;
use yii\web\NotFoundHttpException;
use app\modules\admin\components\AdminController;

class DashboardController extends AdminController {

    public function actionIndex() {
        $data=[];
        $user_id= \Yii::$app->user->id;
        $this->view->title = $this->getProjectName().": Dashboard";
        
        return $this->render('index',$data);
    }

}
