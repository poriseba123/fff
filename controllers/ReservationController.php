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
use app\models\RatingMaster;
use app\models\BookingMaster;
use app\models\TripMaster;
use yii\data\Pagination;

class ReservationController extends FrontendController {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
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
    
    public function actionIndex() {
        $data_msg=[];
        
        $user_id= Yii::$app->user->id;
        //Upcoming and running trips
        $query = TripMaster::find()->where('status<>:status AND user_id=:userID AND (start_time >:startTime OR end_time >:endTime)', [':userID'=>$user_id, ':status' => 3, ":startTime" => date("Y-m-d H:i:s"),":endTime" => date("Y-m-d H:i:s")])->orderBy([
            'id' => SORT_DESC,
        ]);
        $countQuery = clone $query;
        $pages = new Pagination(['pageSize' => 5, 'totalCount' => $countQuery->count(),'pageParam' => 'upcoming']);
        $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        
        $data_msg['pages']=$pages;
        $data_msg['model']=$models;
        
        //Upcoming and running trips
        
        //completed or cancelled trip
        $completed_query = TripMaster::find()->where('status<>:status AND user_id=:userID AND (end_time <:endTime)', [':userID'=>$user_id,':status' => 3,":endTime" => date("Y-m-d H:i:s")])->orderBy([
            'id' => SORT_DESC,
        ]);
        

        $completed_countQuery = clone $completed_query;
        $completed_pages = new Pagination(['pageSize' => 5, 'totalCount' => $completed_countQuery->count(),'pageParam' => 'completed']);
        $completed_models = $completed_query->offset($completed_pages->offset)
                ->limit($completed_pages->limit)
                ->all();
        
        $data_msg['completed_pages']=$completed_pages;
        $data_msg['completed_models']=$completed_models;
        
        //completed or cancelled trip
        
        
        //booking request
        $req_query = \app\models\BookingMaster::find()->where('booking_status=:status AND driver_id=:driver_id', [':status' => 0,':driver_id'=>$user_id])->orderBy([
            'id' => SORT_DESC,
        ]);
        
        $req_countQuery = clone $req_query;
        $req_pages = new Pagination(['pageSize' => 5, 'totalCount' => $req_countQuery->count(),'pageParam' => 'booking']);
        $req_models = $req_query->offset($req_pages->offset)
                ->limit($req_pages->limit)
                ->all();
        $data_msg['req_pages']=$req_pages;
        $data_msg['req_models']=$req_models;
        
        //booking request
       // return $this->render("index", ['model' => $models, 'pages' => $pages,'completed_models' => $completed_models, 'completed_pages' => $completed_pages,'req_models' => $req_models, 'req_pages' => $req_pages]);
        return $this->render("index", $data_msg);
    }

    public function actionBooked() {
        $user_id=Yii::$app->user->id;
        $trip_sql = "SELECT bm.*,tl.id as tlid FROM booking_master AS bm 
                        LEFT JOIN trip_location AS tl ON bm.booking_location_end_id = tl.id where bm.user_id=$user_id and tl.arrival_datetime >= NOW() and bm.booking_status=1";
        $total_trips = Yii::$app->db->createCommand($trip_sql)->queryAll();
        return $this->render('booked', ['model' => $total_trips]);
    }
    public function actionCompletedtrip() {
        $user_id=Yii::$app->user->id;
        $trip_sql = "SELECT bm.*,tl.id as tlid FROM booking_master AS bm 
                        LEFT JOIN trip_location AS tl ON bm.booking_location_end_id = tl.id where bm.user_id=$user_id and tl.arrival_datetime < NOW() and bm.booking_status=1";
        $total_trips = Yii::$app->db->createCommand($trip_sql)->queryAll();
        return $this->render('completed', ['model' => $total_trips]);
    }
    public function actionAlreadycancelled() {
        $user_id=Yii::$app->user->id;
        $trip_sql = "SELECT bm.*,tl.id as tlid FROM booking_master AS bm 
                        LEFT JOIN trip_location AS tl ON bm.booking_location_start_id = tl.id where bm.user_id=$user_id and (bm.booking_status=2 OR bm.booking_status=3)";
        $total_trips = Yii::$app->db->createCommand($trip_sql)->queryAll();
        return $this->render('cancelled', ['model' => $total_trips]);
    }
     public function actionSubmitrating() {
        if (Yii::$app->request->isAjax) {
           $resp = [];
            $resp['flag'] = false;
            $user_id= Yii::$app->user->id;
            $booking_id = $_POST['booking_id']; 
            $bm= BookingMaster::findOne($booking_id);
            if(count($bm)>0){
            $rating = $_POST['rating'];  
            $review = $_POST['review'];
            $trip_id=$bm->trip_id;
            $tm= TripMaster::findOne($trip_id);
            $driver_id=$tm->user_id;
            $model= new RatingMaster();
            $model->user_id=$user_id;
            $model->driver_id=$driver_id;
            $model->trip_id=$trip_id;
            $model->booking_id=$booking_id;
            $model->rating=$rating;
            $model->review=$review;
            $model->added_date=date('Y-m-d H:i:s');
            $model->updated_date=date('Y-m-d H:i:s');
            $model->save(false);
            $resp['flag'] = true;
            $resp['msg'] = 'Gracias por calificar';
            }else{
            $resp['flag'] = false;
            $resp['msg'] = 'Algo salió mal'; 
            }
            echo json_encode($resp);
            exit;
        }
     }

}
