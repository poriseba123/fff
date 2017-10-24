<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\UserMaster;
use app\models\UserDetails;
use app\models\SocialLoginForm;
use app\components\FrontendController;
use app\models\TripLocation;
use app\models\TripMaster;
use yii\data\Pagination;

class PostController extends FrontendController {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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
        $user_id = Yii::$app->user->id;
        $isVehicle = \app\models\UserVehicle::find()->where("user_id=:userId AND status=:status", [":userId" => $user_id, ":status" => 1])->count();
        if($isVehicle == 0){
             Yii::$app->session->setFlash('error', 'Agregue los detalles de tu vehículo antes de agregar un anuncio.');
            return $this->redirect(['vehicle/addvehicle']);
        }
        $query = TripMaster::find()->where('user_id=:user_id AND status<>:status', [':user_id' => $user_id, ':status' => 3])->orderBy([
            'id' => SORT_DESC,
        ]);
        $countQuery = clone $query;
        $pages = new Pagination(['pageSize' => 5, 'totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        return $this->render('index', ['model' => $models, 'pages' => $pages,]);
    }

    public function actionCreate() {
        $user_id = Yii::$app->user->id;
//        $isVehicle = \app\models\UserVehicle::find()->where("user_id=:userId AND status=:status", [":userId" => $user_id, ":status" => 1])->count();
        //this conditions are modified as because client want that driver can post an ad without verified the car.
        $isVehicle = \app\models\UserVehicle::find()->where("user_id=:userId", [":userId" => $user_id])->count();
        if($isVehicle == 0){
             Yii::$app->session->setFlash('error', 'Agregue los detalles de tu vehículo antes de agregar un anuncio.');
            return $this->redirect(['vehicle/addvehicle']);
        }
        $this->view->title = "Crear anuncio";
        return $this->render("create_post");
    }

    public function actionSuccess() {
        $post_id = $_GET['id'];
        $model = TripMaster::findOne((isset($post_id) && $post_id != '') ? $post_id : 0);
        
        $tm= TripMaster::findOne((isset($post_id) && $post_id != '') ? $post_id : 0);
        if(count($tm)>0){
        $driver=$this->getUserDetails($tm->user_id);
        $driver_name=$driver->first_name.' '.$driver->last_name;
        $user_email=$this->getUserEmailId($tm->user_id);
        $link = Yii::$app->urlManager->createAbsoluteUrl(["money/index"]);
        $email_setting = $this->get_email_data('driver_bank_details_info', array('DRIVER_NAME' => $driver_name,'BANK_DETAILS_LINK' => $link));
        $email_data = [
            'to' => $this->getUserEmailId($tm->user_id),
            'subject' => $email_setting['subject'],
            'template' => 'create_user',
            'body' => $email_setting['body']
        ];
        $this->SendMail($email_data);
//        $driver_master= UserMaster::findOne($tm->user_id);
//        $driver_ph_code=$driver_master->phoneCode->phonecode;
//        $driver_phone=$driver_ph_code.$driver_master->phone;
//        $driver_msg="Hi ".$driver_name." Su trayecto ha sido publicado.¡Asegúrese de poder recibir los pagos de sus pasajeros luego del viaje";
//        if($driver_master->phone!=''){
//        Yii::$app->nexmo->sendSms($driver_phone, 'Nexmo', $driver_msg);
//        }
        }
        
        
        
        
        return $this->render("success", ['model' => $model]);
    }

    public function actionPostedit($id) {
        $data = [];
        $user_id = Yii::$app->user->id;
        $model = TripMaster::find()->where(['id' => $id, 'user_id' => $user_id])->one();
        $data['model'] = $model;
        if (count($model) > 0) {
            $location = TripLocation::find()->where(['trip_id' => $id])->all();
            $data['location'] = $location;
            return $this->render("edit_post", $data);
        }
    }

    public function actionDelete() {
        if (Yii::$app->request->isAjax) {
        $resp = [];
        $resp['flag'] = false;
        $post_id=$_POST['post_id'];
        $model= TripMaster::findOne($post_id);
        if(count($model)>0){
        $model->status=3;
        $model->save(false);
        $resp['flag'] = true;
        $resp['msg'] = 'Anuncio eliminado correctamente';
        }
        }
        echo json_encode($resp);
        exit;
    }
    public function actionStep2() {
        if (Yii::$app->request->isAjax) {
            $resp = [];
            $resp['flag'] = false;
            $model = TripMaster::findOne((isset($_POST['post_id']) && $_POST['post_id'] != '') ? $_POST['post_id'] : 0);
            if (count($model) > 0) {
//                $model->title = $_POST['title'];
                $model->flexible = $_POST['isflexible'];
                $model->interval_time = $_POST['interval_time'];
                $model->description = $_POST['description'];
                $model->total_seat = $_POST['total_seat'];
                $model->seat_available = $_POST['total_seat'];
                $model->booking_process = $_POST['booking_process'];
                $model->status = 1;
                $model->save(false);
                $resp['flag'] = true;
                $resp['msg'] = "Tu anuncio se ha guardado en nuestro servidor";
                $resp['redirectUrl'] = Yii::$app->urlManager->createUrl(["post/success", 'id' => $_POST['post_id']]);
            }
            echo json_encode($resp);
            exit;
        }
    }

    public function actionEditpost() {
        if (Yii::$app->request->isAjax) {
            $resp = [];
            $resp['flag'] = false;
            $total_distance = 0;
            $total_price = 0;
            $post_id = $_POST['post_id'];
            $user_id = Yii::$app->user->id;
            if (isset($_POST['not_new']) && $_POST['not_new'] != '') {
                foreach ($_POST['new_final_price'] as $k => $v) {
                    $total_price = $total_price + $v;
                }
                $array_count = count($_POST['start']);

                $model = TripMaster::findOne($post_id);
                $model->increase_parcent = $_POST['percentage'];
                $model->total_cost = $total_price;
                $i = 0;
                foreach ($_POST['start'] as $key => $value) {
                    if ($i == 0) {
                        $model->start_time = $_POST['new_dep_datetime'][$i];
                    } elseif ($i == $array_count - 1) {
                        $model->end_time = (isset($_POST['new_dep_datetime'][$i + 1]) && $_POST['new_dep_datetime'][$i + 1] != '') ? $_POST['new_dep_datetime'][$i + 1] : "";
                    }
                    $i++;
                }
                $model->save(false);
                $i = 0;
                foreach ($_POST['start'] as $k => $v) {
                    $location = TripLocation::findOne($k);
                    $location->departure_datetime = $_POST['new_dep_datetime'][$i];
                    $location->arrival_datetime = $_POST['new_dep_datetime'][$i + 1];
                    if ($i != $array_count - 1) {
                        $location->halt_time = (isset($_POST['halt'][$i + 1]) && $_POST['halt'][$i + 1] != '') ? $_POST['halt'][$i + 1] : 0;
                    }
                    $location->total_price = $_POST['new_final_price'][$i];
                    $location->save(false);
                    $i++;
                }
                $resp['flag'] = true;
                $resp['post_id'] = $model->id;
            } else {
                foreach ($_POST['distance'] as $k => $v) {
                    $total_distance = $total_distance + $v;
                }
                foreach ($_POST['new_final_price'] as $k => $v) {
                    $total_price = $total_price + $v;
                }
                $array_count = count($_POST['start']);
                $model = TripMaster::findOne($post_id);
                $location = TripLocation::find()->where(['trip_id' => $post_id])->all();
                foreach ($location as $k => $v) {
                    $del_location = TripLocation::findOne($v->id);
                    $del_location->delete();
                }
                $model->user_id = $user_id;
                $model->start_time = $_POST['new_datetime'][0];
                $model->end_time = (isset($_POST['new_datetime'][$array_count - 1]) && $_POST['new_datetime'][$array_count - 1] != '') ? $_POST['new_datetime'][$array_count - 1] : "";
                $model->starting_location = $_POST['start'][0];
                $model->end_location = (isset($_POST['start'][$array_count - 1]) && $_POST['start'][$array_count - 1] != '') ? $_POST['start'][$array_count - 1] : "";
                $model->total_distance = $total_distance;
                $model->increase_parcent = $_POST['percentage'];
                $model->total_cost = $total_price;
                $model->total_seat = 0;
                $model->seat_available = 0;
                $model->status = 1;
                $model->added_date = date('Y-m-d H:i:s');
                $model->updated_date = date('Y-m-d H:i:s');
                if ($model->save(false)) {
                    foreach ($_POST['start'] as $k => $v) {
                        if ($k < $array_count - 1) {
                            $location = new TripLocation();
                            $location->trip_id = $model->id;
                            $location->location_a_name = (isset($_POST['start'][$k]) && $_POST['start'][$k] != '') ? $_POST['start'][$k] : "";
                            $location->location_a_lat = (isset($_POST['new_start_lat'][$k]) && $_POST['new_start_lat'][$k] != "") ? $_POST['new_start_lat'][$k] : "";
                            $location->location_a_long = (isset($_POST['new_start_long'][$k]) && $_POST['new_start_long'][$k] != "") ? $_POST['new_start_long'][$k] : "";
                            $location->location_b_name = $_POST['start'][$k + 1];
                            $location->location_b_lat = $_POST['new_start_lat'][$k + 1];
                            $location->location_b_long = $_POST['new_start_long'][$k + 1];
                            $location->departure_datetime = $_POST['new_datetime'][$k];
                            $location->arrival_datetime = $_POST['new_datetime'][$k + 1];
                            $location->halt_time = (isset($_POST['halt'][$k + 1]) && $_POST['halt'][$k + 1] != '') ? $_POST['halt'][$k + 1] : 0;
                            $location->total_distance = $_POST['distance'][$k];
                            $location->total_price = $_POST['new_final_price'][$k];
                            $location->actual_price = $_POST['old_final_price'][$k];
                            $location->save(false);
                        }
                    }
                    $resp['flag'] = true;
                    $resp['post_id'] = $model->id;
                }
            }
            echo json_encode($resp);
            exit;
        }
    }

    public function actionAddpost() {
        if (Yii::$app->request->isAjax) {
            $resp = [];
            $resp['flag'] = false;
            $total_distance = 0;
            $total_price = 0;
            $model = new TripMaster();
            $user_id = Yii::$app->user->id;
            foreach ($_POST['distance'] as $k => $v) {
                $total_distance = $total_distance + $v;
            }
            foreach ($_POST['new_final_price'] as $k => $v) {
                $total_price = $total_price + $v;
            }
            $array_count = count($_POST['start']);
            $model = new TripMaster();
            $model->user_id = $user_id;
            $model->start_time = $_POST['new_datetime'][0];
            $model->end_time = (isset($_POST['new_datetime'][$array_count - 1]) && $_POST['new_datetime'][$array_count - 1] != '') ? $_POST['new_datetime'][$array_count - 1] : "";
            $model->starting_location = $_POST['start'][0];
            $model->end_location = (isset($_POST['start'][$array_count - 1]) && $_POST['start'][$array_count - 1] != '') ? $_POST['start'][$array_count - 1] : "";
            $model->total_distance = $total_distance;
            $model->increase_parcent = $_POST['percentage'];
            $model->total_cost = $total_price;
            $model->total_cost_old = $_POST['total_cost_old'];
            $model->total_seat = 0;
            $model->seat_available = 0;
            $model->status = 0;
            $model->added_date = date('Y-m-d H:i:s');
            $model->updated_date = date('Y-m-d H:i:s');
            if ($model->save(false)) {
                foreach ($_POST['start'] as $k => $v) {
                    if ($k < $array_count - 1) {
                        $location = new TripLocation();
                        $location->trip_id = $model->id;
                        $location->location_a_name = (isset($_POST['start'][$k]) && $_POST['start'][$k] != '') ? $_POST['start'][$k] : "";
                        $location->location_a_lat = (isset($_POST['new_start_lat'][$k]) && $_POST['new_start_lat'][$k] != "") ? $_POST['new_start_lat'][$k] : "";
                        $location->location_a_long = (isset($_POST['new_start_long'][$k]) && $_POST['new_start_long'][$k] != "") ? $_POST['new_start_long'][$k] : "";
                        $location->location_b_name = $_POST['start'][$k + 1];
                        $location->location_b_lat = $_POST['new_start_lat'][$k + 1];
                        $location->location_b_long = $_POST['new_start_long'][$k + 1];
                        $location->departure_datetime = $_POST['new_datetime'][$k];
                        $location->arrival_datetime = $_POST['new_datetime'][$k + 1];
                        $location->halt_time = (isset($_POST['halt'][$k + 1]) && $_POST['halt'][$k + 1] != '') ? $_POST['halt'][$k + 1] : 0;
                        $location->total_distance = $_POST['distance'][$k];
                        $location->total_price = $_POST['new_final_price'][$k];
                        $location->actual_price = $_POST['old_final_price'][$k];
                        $location->duration = $_POST['duration'][$k];
                        $location->save(false);
                    }
                }
                $resp['flag'] = true;
                $resp['post_id'] = $model->id;
            }

            echo json_encode($resp);
            exit;
        }
    }

}
