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
    public function actionGetstates() {
        $type_id=$_REQUEST['id'];
        $doc_specialities= \app\models\States::find()->where("country_id=:country_id",[":country_id"=>$type_id])->all();
        $html='<option value="">Select</option>';
        if(count($doc_specialities)>0){
        foreach ($doc_specialities as $key => $value) {
            $html.='<option value="'.$value->id.'">'.$value->name.'</option>';
        }
        }else{
           $html.='<option value="">No Data</option>';  
        }
        return $html;
    }
     public function actionGetdistricts() {
        $type_id=$_REQUEST['id'];
        $doc_specialities= \app\models\Districts::find()->where("state_id=:state_id",[":state_id"=>$type_id])->all();
        $html='<option value="">Select</option>';
        if(count($doc_specialities)>0){
        foreach ($doc_specialities as $key => $value) {
            $html.='<option value="'.$value->id.'">'.$value->name.'</option>';
        }
        }else{
           $html.='<option value="">No Data</option>';  
        }
        return $html;
    }
    public function actionGetcities() {
        $type_id=$_REQUEST['id'];
        $doc_specialities= \app\models\Cities::find()->where("district_id=:district_id",[":district_id"=>$type_id])->all();
        $html="";
        if(count($doc_specialities)>0){
        foreach ($doc_specialities as $key => $value) {
            $html.='<option value="'.$value->id.'">'.$value->name.'</option>';
        }
        }else{
           $html.='<option value="">No Data</option>';  
        }
        return $html;
    }

}
