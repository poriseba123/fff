<?php

namespace app\controllers;

use Yii;
use yii\web\UploadedFile;
use app\models\UserMaster;
use app\models\UserVehicle;
use app\models\VehicleBrand;
use app\models\VehicleModel;
use app\models\VehicleColor;
use yii\filters\VerbFilter;
use app\models\TripMaster;
use yii\filters\AccessControl;
use app\components\FrontendController;
use yii\data\Pagination;

use yii\data\SqlDataProvider;

class AdvertisementsController extends FrontendController {

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
        $data_msg = [];
        $user_id = Yii::$app->user->id;
//        $trip_sql = "SELECT bm.*,tl.id as tlid FROM booking_master AS bm 
//                        LEFT JOIN trip_location AS tl ON bm.booking_location_end_id = tl.id where bm.user_id=$user_id and tl.arrival_datetime >= NOW() and bm.booking_status=1";
//        $query = Yii::$app->db->createCommand($trip_sql);


        $query=  \app\modules\admin\models\BookingMaster::find()
                ->joinWith(['userDetailsTripLocationEnd'])
                ->where('booking_master.user_id='.$user_id.' and trip_location.arrival_datetime >= NOW() and booking_master.booking_status=1');

        

        $countQuery = clone $query;
        $pages = new Pagination(['pageSize' => 5, 'totalCount' => $countQuery->count(),'pageParam' => 'upcoming']);
        $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        
        $data_msg['pages']=$pages;
        $data_msg['model']=$models;

//        echo "<pre>";
//        print_r($models);
//        exit;

        //completed and cancelled
//        $completed_sql = "SELECT bm.*,tl.id as tlid FROM booking_master AS bm 
//                        LEFT JOIN trip_location AS tl ON bm.booking_location_end_id = tl.id where bm.user_id=$user_id and (tl.arrival_datetime < NOW() or bm.booking_status=2) and (bm.booking_status=1 or bm.booking_status=2)";
//        $completed_trips = Yii::$app->db->createCommand($completed_sql)->queryAll();
        
        
        
        $query=  \app\modules\admin\models\BookingMaster::find()
                ->joinWith(['userDetailsTripLocationEnd'])
                ->where('booking_master.user_id='.$user_id.' and (trip_location.arrival_datetime < NOW() or booking_master.booking_status=2) and (booking_master.booking_status=1 or booking_master.booking_status=2)');

        

        $countQuery = clone $query;
        $pages = new Pagination(['pageSize' => 5, 'totalCount' => $countQuery->count(),'pageParam' => 'completed']);
        $completed_trips = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        
        $data_msg['completed_pages']=$pages;
        $data_msg['completed_trips']=$completed_trips;
    

        return $this->render("index", $data_msg);
    }

    public function actionIndex1() {
        $user_id = Yii::$app->user->id;
        $query = TripMaster::find()->where('status<>:status AND start_time >:startTime', [':status' => 3, ":startTime" => date("Y-m-d H:i:s")])->orderBy([
            'id' => SORT_DESC,
        ]);
        $countQuery = clone $query;
        $pages = new Pagination(['pageSize' => 5, 'totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        $req_query = \app\models\BookingMaster::find()->where('booking_status=:status AND driver_id=:driver_id', [':status' => 0, ':driver_id' => $user_id])->orderBy([
            'id' => SORT_DESC,
        ]);

        $req_countQuery = clone $req_query;
        $req_pages = new Pagination(['pageSize' => 5, 'totalCount' => $req_countQuery->count()]);
        $req_models = $req_query->offset($req_pages->offset)
                ->limit($req_pages->limit)
                ->all();
        return $this->render("index", ['model' => $models, 'pages' => $pages, 'req_models' => $req_models, 'req_pages' => $req_pages]);
    }

}
