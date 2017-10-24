<?php

namespace app\controllers;

use Yii;
use yii\web\UploadedFile;
use app\models\UserMaster;
use app\models\IdentityDocument;
use yii\filters\VerbFilter;
use app\models\PasswordModel;
use yii\filters\AccessControl;
use app\components\FrontendController;
use app\models\ReportMaster;

class PublicprofileController extends FrontendController {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions'=>['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                // ...
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
public function actionOpinions($id='') {
   $model= UserMaster::findOne($id);
    if(count($model)>0){
        $total_ads= \app\models\TripMaster::find()->where(['user_id'=>$id])->count();
        $rating_master= \app\models\RatingMaster::find()->where(['driver_id'=>$id,'status'=>1])->orderBy('id DESC')->all();
        $avg_sql="select avg(rating) as avg_rating from rating_master where status=1 and driver_id=$id";
        $avg_rating = Yii::$app->db->createCommand($avg_sql)->queryOne();
    return $this->render('opinions',['model'=>$model,'total_ads'=>$total_ads,'rating_master'=>$rating_master,'avg_rating'=>$avg_rating]);
    }else{
        return $this->render("../site/error");
    }
}
public function actionIndex($id='') {
    $model= UserMaster::findOne($id);
    if(count($model)>0){
        $total_ads= \app\models\TripMaster::find()->where(['user_id'=>$id])->count();
        $rating_master= \app\models\RatingMaster::find()->where(['driver_id'=>$id,'status'=>1])->orderBy('id DESC')->all();
        $avg_sql="select avg(rating) as avg_rating from rating_master where status=1 and driver_id=$id";
        $avg_rating = Yii::$app->db->createCommand($avg_sql)->queryOne();
    return $this->render('public_profile',['model'=>$model,'total_ads'=>$total_ads,'rating_master'=>$rating_master,'avg_rating'=>$avg_rating]);
    }else{
        return $this->render("../site/error");
    }
}
    public function actionBooked() {
//        $user = UserMaster::find()->where(['id' => Yii::$app->user->id])->one();
        $user_id=Yii::$app->user->id;
        
        $trip_sql = "SELECT bm.*,tl.id FROM booking_master AS bm 
                        LEFT JOIN trip_location AS tl ON bm.booking_location_start_id = tl.id where bm.user_id=$user_id and tl.departure_datetime >= NOW()";
        $total_trips = Yii::$app->db->createCommand($trip_sql)->queryAll();
//        echo "<pre>";
//        print_r($total_trips);
//        exit;
        return $this->render('booked', ['user' => $user]);
    }
    public function actionSubmitreport() {
        if (Yii::$app->request->isAjax) {
            $resp = [];
            $resp['flag'] = false;
            $from_user_id = Yii::$app->user->id;
            $to_user_id=$_POST['to_user_id'];
            if($to_user_id!=''){
                $model=new ReportMaster;
                $model->from_user_id = $from_user_id;
                $model->to_user_id = $to_user_id;
                $model->reason = $_POST['reason'];
                $model->status = 1;
                $model->created_at = date('Y-m-d H:i:s');
                $model->updated_at = date('Y-m-d H:i:s');
                $model->save(false);
                $resp['flag'] = true;
                $resp['msg'] = 'Informe enviado con éxito. Revisaremos tu información. ¡Gracias por ayudarnos a manterner una comunidad confiable!'; 
              
              
            }else{
              $resp['flag'] = false; 
              $resp['msg'] = 'Algo salió mal'; 
            }

            echo json_encode($resp);
            exit;
        }
    }

}
