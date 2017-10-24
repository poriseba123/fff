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
use yii\web\Session;
use app\models\BookingMaster;

class BookController extends FrontendController {

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

    public function actionChecktrip() {
        if (Yii::$app->request->isAjax) {
            $resp = [];
            $resp['flag'] = false;
            $start_id = $_POST['start_id'];
            $end_id = $_POST['end_id'];
            $trip_master_id = $_POST['trip_master_id'];
            $departure_datetime = $_POST['departure_datetime'];
            $requested_seat = $_POST['requested_seat'];
            $price = $_POST['price'];
            $tm= TripMaster::findOne($trip_master_id);
            $session = Yii::$app->session;
            $data=[];
            $session['start_id']=$start_id;
            $session['end_id']=$end_id;
            $session['trip_master_id']=$trip_master_id;
            $session['departure_datetime']=$departure_datetime;
            $session['requested_seat']=$requested_seat;
            $session['final_price']=round($requested_seat*$price);
            $session['booking_process']=$tm->booking_process;
            $trip_sql = "SELECT tm.id AS trip_id,tm.user_id,tm.seat_available,um.first_name,um.last_name,um.birth_year FROM trip_master AS tm 
                        LEFT JOIN user_master AS um ON um.id = tm.user_id WHERE 
                        (
                            (
                                SELECT COUNT(*) FROM trip_location AS tl WHERE 
                                tl.id BETWEEN '$start_id' AND '$end_id' AND
                                (
                                    (
                                        (DATE(tl.departure_datetime) = DATE('$departure_datetime')) AND (tl.total_booked = 0)
                                    ) OR 
                                    (
                                        (DATE(tl.departure_datetime) = DATE('$departure_datetime')) AND (tl.departure_datetime >= NOW()) AND (tl.total_booked > 0) AND ((tm.seat_available - tl.total_booked) >= $requested_seat)
                                    )
                                ) AND tl.total_booked < tm.seat_available
                            ) =
                            (
                                SELECT COUNT(*) FROM trip_location AS tl WHERE 
                                tl.id BETWEEN '$start_id' AND '$end_id' AND
                                (
                                    (
                                        (DATE(tl.departure_datetime) = DATE('$departure_datetime')) AND (tl.total_booked = 0)
                                    ) OR 
                                    (
                                        (DATE(tl.departure_datetime) = DATE('$departure_datetime')) AND (tl.departure_datetime >= NOW()) AND (tl.total_booked > 0) AND ((tm.seat_available - tl.total_booked) >= $requested_seat)
                                    )
                                )
                            )
                        ) AND
                        (
                            SELECT COUNT(*) FROM trip_location AS tl WHERE 
                            tl.id BETWEEN '$start_id' AND '$end_id' AND
                            (
                                (
                                    (DATE(tl.departure_datetime) = DATE('$departure_datetime')) AND (tl.total_booked = 0)
                                ) OR 
                                (
                                    (DATE(tl.departure_datetime) = DATE('$departure_datetime')) AND (tl.departure_datetime >= NOW()) AND (tl.total_booked > 0) AND ((tm.seat_available - tl.total_booked) >= $requested_seat)
                                )
                            ) AND
                            tl.total_booked < tm.seat_available
                        ) > 0 AND
                        (
                            SELECT COUNT(*) FROM trip_location AS tl WHERE 
                            tl.id BETWEEN '$start_id' AND '$end_id' AND
                            (
                                (
                                    (DATE(tl.departure_datetime) = DATE('$departure_datetime')) AND (tl.total_booked = 0)
                                ) OR 
                                (
                                    (DATE(tl.departure_datetime) = DATE('$departure_datetime')) AND (tl.departure_datetime >= NOW()) AND (tl.total_booked > 0) AND ((tm.seat_available - tl.total_booked) >= $requested_seat)
                                )
                            )
                        ) > 0 AND
                        tm.status = '1' AND tm.id = '$trip_master_id'";
            $trips = Yii::$app->db->createCommand($trip_sql)->queryAll();
            if (count($trips) > 0) {
                //booked
                $ApiKey='4Vj8eK4rloUd272L48hsrarnUA'; //"4Vj8eK4rloUd272L48hsrarnUA";//mylive VVQNJ449ao3qmZl3FlMtIDQZN7
                $merchantId='508029';//"508029";//mylive 670009
                $referenceCode=time();
                $amount=$session['final_price'];
                $currency='COP';
                $signature=md5($ApiKey.'~'.$merchantId.'~'.$referenceCode.'~'.$amount.'~'.$currency);
                
                
                
                $resp['flag'] = true;
                $resp['final_price'] = $session['final_price'];
                $resp['total_seat'] = $session['requested_seat'];
                $resp['redirectUrl'] = Yii::$app->urlManager->createUrl(["book/paymentform"]);
                $resp['msg'] = 'booked';
                $resp['booking_process'] = $session['booking_process'];
                $resp['referenceCode'] = $referenceCode;
                $resp['signature'] = $signature;
            } else {
                //error
                $resp['flag'] = false;
                $resp['msg'] = 'Lo sentimos, no puedes reservar este viaje';
            }
            echo json_encode($resp);
            exit;
        }
    }

    public function actionPaymentform() {
        $session = Yii::$app->session;
        $start_id=$session['start_id'];
        $end_id= $session['end_id'];
        $trip_master_id= $session['trip_master_id'];
        $departure_datetime=$session['departure_datetime'];
        $requested_seat=$session['requested_seat'];
        $this->view->title = "payment form";
        return $this->render("payment_form");
    }
    public function actionPayment_through_link() {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Para el pago debe ingresar');
            return $this->redirect(['site/login']);
        }else{
        if (Yii::$app->request->get('trackId') != '') {
            $trackId = Yii::$app->request->get('trackId');
            $model = BookingMaster::find()->where(["trackId" => $trackId,'booking_status'=>0,'user_id'=>Yii::$app->user->id])->one();
            if (count($model)>0) {
                $session = Yii::$app->session;
                $session['booking_id']=$model->id;
                return $this->render('payment_through_link', ['model' => $model]);
            } else {
                Yii::$app->session->setFlash('error', 'Solicitud no válida.');
                return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl(['site/index']));
            }
        } else {
            Yii::$app->session->setFlash('error', 'Solicitud no válida');
            return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl(['site/index']));
        }
        }
    }
 public function actionAccept_req_from_driver() {
      if (Yii::$app->request->isAjax) {
     $resp = [];
     $resp['flag'] = false;
         $id=$_POST['booking_id'];
         $bm= BookingMaster::findOne($id);
         if(count($bm)>0){
            $bm->driver_accept=1;
            $bm->updated_date=date('Y-m-d H:i:s');
            $bm->save(false);
//            $user=$this->getUserDetails($bm->user_id);
//            $name=$user->first_name.' '.$user->last_name;
//            $user_email=$this->getUserEmailId($bm->user_id);
//            $link = Yii::$app->urlManager->createAbsoluteUrl(["book/payment_through_link", "trackId" => $bm->trackId]);
//            $email_setting = $this->get_email_data('booking_accepted_by_driver_to_user', array('FULL_NAME' => $name,'TRACK_ID'=>$bm->trackId,'TRIP_TITLE'=>$bm->tripMasterDetails->title,'PAYMENT_LINK'=>$link));
//            $email_data = [
//            'to' => $user_email,
//            'subject' => $email_setting['subject'],
//            'template' => 'create_user',
//            'body' => $email_setting['body']
//        ];
//        $this->SendMail($email_data);
        
        $user_id=$bm->user_id;
        $user=$this->getUserDetails($user_id);
        $name=$user->first_name.' '.$user->last_name;
        $user_email=$this->getUserEmailId($user_id);
        $tm= TripMaster::findOne($bm->trip_id);
        $driver=$this->getUserDetails($tm->user_id);
        $driver_name=$driver->first_name.' '.$driver->last_name;
        $departure_city=$this->getSmallAddress($bm->userDetailsTripLocationStart->location_a_name);
        $arrival_city=$this->getSmallAddress($bm->userDetailsTripLocationEnd->location_b_name);
        $departure_time=$this->getFormatedDate($bm->userDetailsTripLocationStart->departure_datetime);
        $trip_hour=$this->getTimeDifferenceinHour($bm->userDetailsTripLocationStart->departure_datetime,$bm->userDetailsTripLocationEnd->arrival_datetime);
        $total_seat=$session['requested_seat'];
        $total_price=$session['final_price'];
        $trip_details=$tm->description;
        $rating_master= \app\models\RatingMaster::find()->where(['driver_id'=>$tm->user_id,'status'=>1])->orderBy('id DESC')->count();
        $avg_sql="select avg(rating) as avg_rating from rating_master where status=1 and driver_id=$tm->user_id";
        $avg_rating = Yii::$app->db->createCommand($avg_sql)->queryOne();
        $rating=$avg_rating;
        $no_of_opinion=$rating_master;
        $driver_master= UserMaster::findOne($tm->user_id);
        $driver_ph_code=$driver_master->phoneCode->phonecode;
        $driver_phone=$driver_ph_code.$driver_master->phone;
        $driver_ph_no=$driver_phone;
        $vehicle_brand=$driver_master->vehicle->vBrand->brand.' '.$driver_master->vehicle->vModel->model_no;
        $vehicle_color=$driver_master->vehicle->vColor->color_name_es;
        $link = Yii::$app->urlManager->createAbsoluteUrl(["book/payment_through_link", "trackId" => $bm->trackId]);
        $email_setting = $this->get_email_data('passenger_booking_accepted', array('PASSENGER_NAME' => $name,'DRIVER_NAME'=>$driver_name,'DEPARTURE_CITY'=>$departure_city,'ARRIVAL_CITY'=>$arrival_city,'DEPARTURE_TIME'=>$departure_time,'TRIP_HOUR'=>$trip_hour,'TOTAL_SEAT'=>$total_seat,'TOTAL_PRICE'=>$total_price,'TRIP_DETAILS'=>$trip_details,'RATING'=>$rating,'NO_OF_OPINION'=>$no_of_opinion,'DRIVER_PH_NO'=>$driver_ph_no,'VEHICLE_BRAND'=>$vehicle_brand,'VEHICLE_COLOR'=>$vehicle_color,'PAYMENT_LINK'=>$link));
        $email_data = [
            'to' => $this->getUserEmailId($user_id),
            'subject' => $email_setting['subject'],
            'template' => 'create_user',
            'body' => $email_setting['body']
        ];
        $this->SendMail($email_data);
        //for sms
        $user_master= UserMaster::findOne($bm->user_id);
        $user_ph_code=$user_master->phoneCode->phonecode;
        $user_phone=$user_ph_code.$user_master->phone;
        $user_msg='Hola '.$name.'. El conductor '.$driver_name.' aceptó tu solicituad de viaje por el trayecto '.$departure_city.' > '.$arrival_city.'. Tienes que pagaren la plataforma con el enlace que te mandemos por correo electrónico en las 6 proxímas horas. Si no lo confermas, la solicitud va a vencer y tendrías que conseguir un nuevo viaje. El equipo 123Vamos';
        if($user_master->phone!=''){
        Yii::$app->nexmo->sendSms($user_phone, 'Nexmo', $user_msg);
        }
        
//        $driver_master= UserMaster::findOne($tm->user_id);
//        $driver_ph_code=$driver_master->phoneCode->phonecode;
//        $driver_phone=$driver_ph_code.$driver_master->phone;
////        $driver_msg="Hi ".$driver_name." a passenger name ".$name." cancelled a trip.Booking id was ".$bm->trackId;
//        $driver_msg='Hola '.$driver_name.'. El pasajero '.$name.' canceló su reservación por '.$departure_city.' > '.$arrival_city.'. ¡Puedes conseguir otros pasajeros en la plataforma! El equipo 123Vamos';
//        if($driver_master->phone!=''){
//        Yii::$app->nexmo->sendSms($driver_phone, 'Nexmo', $driver_msg);
//        }
        
        
            $resp['flag'] = true;
            $resp['msg'] = 'La réserva se canceló correctamente';
            $resp['redirectUrl'] = Yii::$app->urlManager->createUrl(["advertisements/index"]);
         }else{
            $resp['msg'] = 'Reserva no cancelada';
            $resp['redirectUrl'] = Yii::$app->urlManager->createUrl(["advertisements/index"]); 
         }
         echo json_encode($resp);
         exit;
      }
     
    }
    public function actionReject_req_from_driver() {
      if (Yii::$app->request->isAjax) {
     $resp = [];
     $resp['flag'] = false;
         $id=$_POST['booking_id'];
         $reason_category=$_POST['reason_category'];
         $reason=$_POST['reason'];
         $bm= BookingMaster::findOne($id);
         if(count($bm)>0){
            $bm->booking_status=3;
            $bm->cancel_reason=$reason;
            $bm->reason_category=$reason_category;
            $bm->updated_date=date('Y-m-d H:i:s');
            $bm->save(false);
            $start_id=$bm->booking_location_start_id;
            $end_id=$bm->booking_location_end_id;
            $location= TripLocation::find()->where("id BETWEEN :startL AND :endL", [":startL"=>$start_id,":endL"=>$end_id])->all();
        foreach($location as $k=>$val){
            $tl=TripLocation::findOne($val->id);
            $tl->total_booked=$tl->total_booked-$bm->no_of_seat;
            $tl->save(false);
        }
        
            $user=$this->getUserDetails($bm->user_id);
            $name=$user->first_name.' '.$user->last_name;
            $user_email=$this->getUserEmailId($bm->user_id);
            $email_setting = $this->get_email_data('booking_rejected_by_driver_to_user', array('FULL_NAME' => $name,'TRACK_ID'=>$bm->trackId,'TRIP_TITLE'=>$bm->tripMasterDetails->title));
            $email_data = [
            'to' => $user_email,
            'subject' => $email_setting['subject'],
            'template' => 'create_user',
            'body' => $email_setting['body']
        ];
        $this->SendMail($email_data);
        $tm= TripMaster::findOne($bm->trip_id);
        $driver=$this->getUserDetails($tm->user_id);
        $driver_name=$driver->first_name.' '.$driver->last_name;
        $departure_city=$this->getSmallAddress($bm->userDetailsTripLocationStart->location_a_name);
        $arrival_city=$this->getSmallAddress($bm->userDetailsTripLocationEnd->location_b_name);
        //for sms
        $user_master= UserMaster::findOne($bm->user_id);
        $user_ph_code=$user_master->phoneCode->phonecode;
        $user_phone=$user_ph_code.$user_master->phone;
        $user_msg='Hola '.$name.'. El conductor '.$driver_name.' rechazó tu solicitud de viaje por '.$departure_city.' > '.$arrival_city.'. ¡Lo sentimos! No pagaste nada y puedes conseguir un nuevo compañero de viaje por la plataforma. El equipo 123Vamos';
        if($user_master->phone!=''){
        Yii::$app->nexmo->sendSms($user_phone, 'Nexmo', $user_msg);
        }
        
            $resp['flag'] = true;
            $resp['msg'] = 'La réserva se canceló correctamente';
            $resp['redirectUrl'] = Yii::$app->urlManager->createUrl(["advertisements/index"]);
         }else{
            $resp['msg'] = 'Reserva no cancelada';
            $resp['redirectUrl'] = Yii::$app->urlManager->createUrl(["advertisements/index"]); 
         }
         echo json_encode($resp);
         exit;
      }
     
    }
    public function actionReject_req_from_user() {
      if (Yii::$app->request->isAjax) {
     $resp = [];
     $resp['flag'] = false;
         $id=$_POST['booking_id'];
         $reason_category=$_POST['reason_category'];
         $reason=$_POST['reason'];
         $bm= BookingMaster::findOne($id);
         $departure_city=$this->getSmallAddress($bm->userDetailsTripLocationStart->location_a_name);
        $arrival_city=$this->getSmallAddress($bm->userDetailsTripLocationEnd->location_b_name);
         if(count($bm)>0){
            $bm->booking_status=2;
            $bm->request_time=date('Y-m-d H:i:s');
            $bm->cancel_reason=$reason;
            $bm->reason_category=$reason_category;
            $bm->updated_date=date('Y-m-d H:i:s');
            $bm->save(false);
            $start_id=$bm->booking_location_start_id;
            $end_id=$bm->booking_location_end_id;
            $location= TripLocation::find()->where("id BETWEEN :startL AND :endL", [":startL"=>$start_id,":endL"=>$end_id])->all();
        foreach($location as $k=>$val){
            $tl=TripLocation::findOne($val->id);
            $tl->total_booked=$tl->total_booked-$bm->no_of_seat;
            $tl->save(false);
        }
        
        if($this->getTimeDifferenceinHour($bm->request_time,$bm->userDetailsTripLocationStart->departure_datetime)>24){
                                           
                                           $user=$this->getUserDetails($bm->user_id);
                                            $name=$user->first_name.' '.$user->last_name;
                                            $user_email=$this->getUserEmailId($bm->user_id);
                                            $tm= TripMaster::findOne($bm->trip_id);
                                            $driver=$this->getUserDetails($tm->user_id);
                                            $driver_name=$driver->first_name.' '.$driver->last_name;
                                            $online_listing = Yii::$app->urlManager->createAbsoluteUrl(["search/viewall"]);
                                            $email_setting = $this->get_email_data('passenger_cancellation', array('PASSENGER_NAME' => $name,'DRIVER_NAME'=>$driver_name,'LISTING_ONLINE_LINK'=>$online_listing));
                                            $email_data = [
                                            'to' => $user_email,
                                            'subject' => $email_setting['subject'],
                                            'template' => 'create_user',
                                            'body' => $email_setting['body']
                                            ];
                                            $this->SendMail($email_data);
                                            
                                            
                                            $tm= TripMaster::findOne($bm->trip_id);
                                            $driver=$this->getUserDetails($tm->user_id);
                                            $driver_name=$driver->first_name.' '.$driver->last_name;
                                            $user_email=$this->getUserEmailId($tm->user_id);
                                            $email_setting = $this->get_email_data('driver_message_for_a_passenger_cancellation', array('DRIVER_NAME' => $driver_name,'PASSENGER_NAME' => $name));
                                            $email_data = [
                                                'to' => $this->getUserEmailId($tm->user_id),
                                                'subject' => $email_setting['subject'],
                                                'template' => 'create_user',
                                                'body' => $email_setting['body']
                                            ];
                                            $this->SendMail($email_data);
                                            
                                       }else{
                                           if($this->getTimeDifferenceinHour($bm->request_time,$bm->userDetailsTripLocationStart->departure_datetime)>3){
                                           
                                            $user=$this->getUserDetails($bm->user_id);
                                            $name=$user->first_name.' '.$user->last_name;
                                            $user_email=$this->getUserEmailId($bm->user_id);
                                            $tm= TripMaster::findOne($bm->trip_id);
                                            $driver=$this->getUserDetails($tm->user_id);
                                            $driver_name=$driver->first_name.' '.$driver->last_name;
                                            $online_listing = Yii::$app->urlManager->createAbsoluteUrl(["search/viewall"]);
                                            $email_setting = $this->get_email_data('passenger_cancellation_24_hours', array('PASSENGER_NAME' => $name,'DRIVER_NAME'=>$driver_name,'LISTING_ONLINE_LINK'=>$online_listing));
                                            $email_data = [
                                            'to' => $user_email,
                                            'subject' => $email_setting['subject'],
                                            'template' => 'create_user',
                                            'body' => $email_setting['body']
                                            ];
                                            $this->SendMail($email_data);
                                            
                                            
                                            $tm= TripMaster::findOne($bm->trip_id);
                                            $driver=$this->getUserDetails($tm->user_id);
                                            $driver_name=$driver->first_name.' '.$driver->last_name;
                                            $user_email=$this->getUserEmailId($tm->user_id);
                                            $email_setting = $this->get_email_data('driver_message_for_a_passenger_cancellation_24hours', array('DRIVER_NAME' => $driver_name,'PASSENGER_NAME' => $name));
                                            $email_data = [
                                                'to' => $this->getUserEmailId($tm->user_id),
                                                'subject' => $email_setting['subject'],
                                                'template' => 'create_user',
                                                'body' => $email_setting['body']
                                            ];
                                            $this->SendMail($email_data);
                                               
                                               
                                           }else{
                                            $user=$this->getUserDetails($bm->user_id);
                                            $name=$user->first_name.' '.$user->last_name;
                                            $user_email=$this->getUserEmailId($bm->user_id);
                                            $email_setting = $this->get_email_data('passenger_cancellation_too_late', array('PASSENGER_NAME' => $name));
                                            $email_data = [
                                            'to' => $user_email,
                                            'subject' => $email_setting['subject'],
                                            'template' => 'create_user',
                                            'body' => $email_setting['body']
                                            ];
                                            $this->SendMail($email_data); 
                                            
                                            
                                            $tm= TripMaster::findOne($bm->trip_id);
                                            $driver=$this->getUserDetails($tm->user_id);
                                            $driver_name=$driver->first_name.' '.$driver->last_name;
                                            $user_email=$this->getUserEmailId($tm->user_id);
                                            $email_setting = $this->get_email_data('driver_message_for_a_passenger_cancellation_too_late', array('DRIVER_NAME' => $driver_name,'PASSENGER_NAME' => $name));
                                            $email_data = [
                                                'to' => $this->getUserEmailId($tm->user_id),
                                                'subject' => $email_setting['subject'],
                                                'template' => 'create_user',
                                                'body' => $email_setting['body']
                                            ];
                                            $this->SendMail($email_data);
                                               
                                           }
                                       }
        
        
            
       
        
        //for sms
        $user_master= UserMaster::findOne($bm->user_id);
        $user_ph_code=$user_master->phoneCode->phonecode;
        $user_phone=$user_ph_code.$user_master->phone;
        $user_msg="Hi ".$name." you have successfully cancelled a trip.Your booking id was ".$bm->trackId;
        if($user_master->phone!=''){
        Yii::$app->nexmo->sendSms($user_phone, 'Nexmo', $user_msg);
        }
        
        $driver_master= UserMaster::findOne($tm->user_id);
        $driver_ph_code=$driver_master->phoneCode->phonecode;
        $driver_phone=$driver_ph_code.$driver_master->phone;
//        $driver_msg="Hi ".$driver_name." a passenger name ".$name." cancelled a trip.Booking id was ".$bm->trackId;
        $driver_msg='Hola '.$driver_name.'. El pasajero '.$name.' canceló su reservación por '.$departure_city.' > '.$arrival_city.'. ¡Puedes conseguir otros pasajeros en la plataforma! El equipo 123Vamos';
        if($driver_master->phone!=''){
        Yii::$app->nexmo->sendSms($driver_phone, 'Nexmo', $driver_msg);
        }
        
        
        
        
        
            $resp['flag'] = true;
            $resp['msg'] = 'La réserva se canceló correctamente';
            $resp['redirectUrl'] = Yii::$app->urlManager->createUrl(["advertisements/index"]);
         }else{
            $resp['msg'] = 'Reserva no cancelada';
            $resp['redirectUrl'] = Yii::$app->urlManager->createUrl(["advertisements/index"]); 
         }
         echo json_encode($resp);
         exit;
      }
     
    }
    public function actionClaim_req_from_user() {
      if (Yii::$app->request->isAjax) {
     $resp = [];
     $resp['flag'] = false;
         $id=$_POST['booking_id'];
         $reason_category=$_POST['reason_category'];
         $reason=$_POST['reason'];
         $bm= BookingMaster::findOne($id);
         if(count($bm)>0){
            $bm->booking_status=4;
            $bm->cancel_reason=$reason;
            $bm->reason_category=$reason_category;
            $bm->updated_date=date('Y-m-d H:i:s');
            $bm->save(false);
            $start_id=$bm->booking_location_start_id;
            $end_id=$bm->booking_location_end_id;
            $location= TripLocation::find()->where("id BETWEEN :startL AND :endL", [":startL"=>$start_id,":endL"=>$end_id])->all();
        foreach($location as $k=>$val){
            $tl=TripLocation::findOne($val->id);
            $tl->total_booked=$tl->total_booked-$bm->no_of_seat;
            $tl->save(false);
        }
        
            $user=$this->getUserDetails($bm->user_id);
            $name=$user->first_name.' '.$user->last_name;
            $user_email=$this->getUserEmailId($bm->user_id);
            $email_setting = $this->get_email_data('booking_cancel_by_user', array('FULL_NAME' => $name,'TRACK_ID'=>$bm->trackId));
            $email_data = [
            'to' => $user_email,
            'subject' => $email_setting['subject'],
            'template' => 'create_user',
            'body' => $email_setting['body']
        ];
        $this->SendMail($email_data);
        
        $tm= TripMaster::findOne($bm->trip_id);
        $driver=$this->getUserDetails($tm->user_id);
        $driver_name=$driver->first_name.' '.$driver->last_name;
        $user_email=$this->getUserEmailId($tm->user_id);
        $email_setting = $this->get_email_data('booking_cancel_by_user_to_driver', array('DRIVER_NAME' => $driver_name,'USER_NAME' => $name,'TRACK_ID'=>$bm->trackId,'PROJECT_NAME'=>$this->getProjectName()));
        $email_data = [
            'to' => $this->getUserEmailId($tm->user_id),
            'subject' => $email_setting['subject'],
            'template' => 'create_user',
            'body' => $email_setting['body']
        ];
        $this->SendMail($email_data);
       
        
        //for sms
        $user_master= UserMaster::findOne($bm->user_id);
        $user_ph_code=$user_master->phoneCode->phonecode;
        $user_phone=$user_ph_code.$user_master->phone;
        $user_msg="Hi ".$name." you have successfully cancelled a trip.Your booking id was ".$bm->trackId;
        if($user_master->phone!=''){
        Yii::$app->nexmo->sendSms($user_phone, 'Nexmo', $user_msg);
        }
        
        $driver_master= UserMaster::findOne($tm->user_id);
        $driver_ph_code=$driver_master->phoneCode->phonecode;
        $driver_phone=$driver_ph_code.$driver_master->phone;
        $driver_msg="Hi ".$driver_name." a passenger name ".$name." cancelled a trip.Booking id was ".$bm->trackId;
        if($driver_master->phone!=''){
        Yii::$app->nexmo->sendSms($driver_phone, 'Nexmo', $driver_msg);
        }
        
        
        
        
        
            $resp['flag'] = true;
            $resp['msg'] = 'La réserva se canceló correctamente';
            $resp['redirectUrl'] = Yii::$app->urlManager->createUrl(["advertisements/index"]);
         }else{
            $resp['msg'] = 'Reserva no cancelada';
            $resp['redirectUrl'] = Yii::$app->urlManager->createUrl(["advertisements/index"]); 
         }
         echo json_encode($resp);
         exit;
      }
     
    }
    public function actionManualbooking() {
     $resp = [];
     $resp['flag'] = false;
     $session = Yii::$app->session;   
    if(isset($session['start_id']) && $session['start_id']!=""){
        $tm= TripMaster::findOne($session['trip_master_id']);
        $user_id = Yii::$app->user->id;
        $start_id=$session['start_id'];
        $end_id=$session['end_id'];
        $model=new BookingMaster;
        $model->user_id=$user_id;
        $model->driver_id=$tm->user_id;
        $model->trackId=$this->manageUnickId(6).time();
        $model->trip_id=$session['trip_master_id'];
        $model->booking_type=$session['booking_process'];
        $model->request_time=date('Y-m-d H:i:s');
        $model->booking_status=0;
        $model->booking_location_start_id=$session['start_id'];
        $model->booking_location_end_id=$session['end_id'];
        $model->total_price=$session['final_price'];
        $model->no_of_seat=$session['requested_seat'];
        $model->added_date=date('Y-m-d H:i:s');
        $model->updated_date=date('Y-m-d H:i:s');
        $model->save(false);
        $location= TripLocation::find()->where("id BETWEEN :startL AND :endL", [":startL"=>$start_id,":endL"=>$end_id])->all();
        foreach($location as $k=>$val){
            $tl=TripLocation::findOne($val->id);
            $tl->total_booked=$tl->total_booked+$session['requested_seat'];
            $tl->save(false);
        }
        
        
        
        
        $user=$this->getUserDetails($user_id);
        $name=$user->first_name.' '.$user->last_name;
        $user_email=$this->getUserEmailId($user_id);
        $driver=$this->getUserDetails($tm->user_id);
        $driver_name=$driver->first_name.' '.$driver->last_name;
        $req_expire_time=date('Y-m-d H:i:s', strtotime('6 hour'));
        $user_master= UserMaster::findOne($user_id);
        $user_ph_code=$user_master->phoneCode->phonecode;
        $user_phone=$user_ph_code.$user_master->phone;
        $passenger_ph_no=$user_phone;
        $bm= BookingMaster::findOne($model->id);
        $departure_city=$this->getSmallAddress($bm->userDetailsTripLocationStart->location_a_name);
        $arrival_city=$this->getSmallAddress($bm->userDetailsTripLocationEnd->location_b_name);
        $departure_time=$this->getFormatedDate($bm->userDetailsTripLocationStart->departure_datetime);
        $trip_hour=$this->getTimeDifferenceinHour($bm->userDetailsTripLocationStart->departure_datetime,$bm->userDetailsTripLocationEnd->arrival_datetime);
        $total_seat=$session['requested_seat'];
        $total_price=$session['final_price'];
        $email_setting = $this->get_email_data('passenger_booking_request', array('PASSENGER_NAME' => $name,'DRIVER_NAME'=>$driver_name,'REQUEST_EXPIRE_TIME'=>$req_expire_time,'PASSENGER_PHONE_NO'=>$passenger_ph_no,'DEPARTURE_CITY'=>$departure_city,'ARRIVAL_CITY'=>$arrival_city,'DEPARTURE_TIME'=>$departure_time,'TRIP_HOUR'=>$trip_hour,'TOTAL_SEAT'=>$total_seat,'TOTAL_PRICE'=>$total_price));
        $email_data = [
            'to' => $user_email,
            'subject' => $email_setting['subject'],
            'template' => 'create_user',
            'body' => $email_setting['body']
        ];
        $this->SendMail($email_data);
        
        $driver=$this->getUserDetails($tm->user_id);
        $driver_name=$driver->first_name.' '.$driver->last_name;
        $driver_email=$this->getUserEmailId($tm->user_id);
        $email_setting = $this->get_email_data('booking_request_to_driver', array('DRIVER_NAME' => $driver_name,'BOOKING_ID'=>$model->trackId,'USER_NAME'=>$name,'USER_EMAIL'=>$user_email,'TRIP_TITLE'=>$tm->title));
        $email_data = [
            'to' => $driver_email,
            'subject' => $email_setting['subject'],
            'template' => 'create_user',
            'body' => $email_setting['body']
        ];
        $this->SendMail($email_data);
        
        //for sms
        //not necessary
//        $user_master= UserMaster::findOne($user_id);
//        $user_ph_code=$user_master->phoneCode->phonecode;
//        $user_phone=$user_ph_code.$user_master->phone;
//        $user_msg="Hi ".$name." you have successfully sent a booking request to driver.Your booking id is ".$model->trackId.".Once approved by driver a payment link is to be sent to your email.Please wait for it.";
//        if($user_master->phone!=''){
//        Yii::$app->nexmo->sendSms($user_phone, 'Nexmo', $user_msg);
//        }
        
        $driver_master= UserMaster::findOne($tm->user_id);
        $driver_ph_code=$driver_master->phoneCode->phonecode;
        $driver_phone=$driver_ph_code.$driver_master->phone;
//        $driver_msg="Hi ".$driver_name." a passenger name ".$name." sent you a booking request.Booking id is ".$model->trackId.".Please approve as soon as possible.";
        $driver_msg='Hola '.$driver_name.'. Recibiste un solicitud de viaje de '.$name.' por el trayecto '.$departure_city.' > '.$arrival_city.'. Tienes que confermarlo en la plataforma en las 6 proxímas horas. Si no lo confermas, la solicitud va a vencer y tendrías que conseguir un nuevo pasajero. El equipo 123Vamos';
        if($driver_master->phone!=''){
        Yii::$app->nexmo->sendSms($driver_phone, 'Nexmo', $driver_msg);
        }
        
        
        $resp['flag'] = true;
        $resp['redirectUrl'] = Yii::$app->urlManager->createUrl(["site/index"]);
        $resp['msg'] = 'Solicitud de reserva es exitosa.Por favor, espere a la aprobación.';//request for booking is successful.Please wait for approval.
    }else{
        $resp['flag'] = false;
        $resp['redirectUrl'] = Yii::$app->urlManager->createUrl(["site/index"]);
        $resp['msg'] = 'Algo salió mal';  //something went wrong
    }
        $session->remove('start_id');
        $session->remove('end_id');
        $session->remove('trip_master_id');
        $session->remove('departure_datetime');
        $session->remove('requested_seat');
        $session->remove('final_price');
        $session->remove('booking_process');
    echo json_encode($resp);
    exit;
    }
    public function actionPayuresponse() {
        $payment_txt = '';
            $fp = fopen('payment_log.txt', "w");
            foreach ($_REQUEST as $key=>$val){
                $payment_txt .='Key='.$key.'=>Val='.$val;
            }
            fwrite($fp, $payment_txt);
        $session = Yii::$app->session;
        if(isset($session['start_id']) && $session['start_id']!="" && $_REQUEST['lapTransactionState']=='APPROVED'){
            $tm= TripMaster::findOne($session['trip_master_id']);
        $user_id = Yii::$app->user->id;
        $start_id=$session['start_id'];
        $end_id=$session['end_id'];
        $model=new BookingMaster;
        $model->user_id=$user_id;
        $model->driver_id=$tm->user_id;
        $model->trackId=$this->manageUnickId(6).time();
        $model->trip_id=$session['trip_master_id'];
        $model->booking_type=$session['booking_process'];
        $model->request_time=date('Y-m-d H:i:s');
        $model->booking_status=1;
        $model->booking_location_start_id=$session['start_id'];
        $model->booking_location_end_id=$session['end_id'];
        $model->total_price=$session['final_price'];
        $model->no_of_seat=$session['requested_seat'];
        $model->added_date=date('Y-m-d H:i:s');
        $model->updated_date=date('Y-m-d H:i:s');
        $model->save(false);
        $location= TripLocation::find()->where("id BETWEEN :startL AND :endL", [":startL"=>$start_id,":endL"=>$end_id])->all();
        foreach($location as $k=>$val){
            $tl=TripLocation::findOne($val->id);
            $tl->total_booked=$tl->total_booked+$session['requested_seat'];
            $tl->save(false);
        }
         $user=$this->getUserDetails($user_id);
        $name=$user->first_name.' '.$user->last_name;
        $user_email=$this->getUserEmailId($user_id);
        $tm= TripMaster::findOne($session['trip_master_id']);
        $driver=$this->getUserDetails($tm->user_id);
        $driver_name=$driver->first_name.' '.$driver->last_name;
        $bm= BookingMaster::findOne($model->id);
        $departure_city=$this->getSmallAddress($bm->userDetailsTripLocationStart->location_a_name);
        $arrival_city=$this->getSmallAddress($bm->userDetailsTripLocationEnd->location_b_name);
        $departure_time=$this->getFormatedDate($bm->userDetailsTripLocationStart->departure_datetime);
        $trip_hour=$this->getTimeDifferenceinHour($bm->userDetailsTripLocationStart->departure_datetime,$bm->userDetailsTripLocationEnd->arrival_datetime);
        $total_seat=$session['requested_seat'];
        $total_price=$session['final_price'];
        $trip_details=$tm->description;
        $rating_master= \app\models\RatingMaster::find()->where(['driver_id'=>$tm->user_id,'status'=>1])->orderBy('id DESC')->count();
        $avg_sql="select avg(rating) as avg_rating from rating_master where status=1 and driver_id=$tm->user_id";
        $avg_rating = Yii::$app->db->createCommand($avg_sql)->queryOne();
        $rating=$avg_rating;
        $no_of_opinion=$rating_master;
        $driver_master= UserMaster::findOne($tm->user_id);
        $driver_ph_code=$driver_master->phoneCode->phonecode;
        $driver_phone=$driver_ph_code.$driver_master->phone;
        $driver_ph_no=$driver_phone;
        $vehicle_brand=$driver_master->vehicle->vBrand->brand.' '.$driver_master->vehicle->vModel->model_no;
        $vehicle_color=$driver_master->vehicle->vColor->color_name_es;
        $email_setting = $this->get_email_data('passenger_booking_confirmation', array('PASSENGER_NAME' => $name,'DRIVER_NAME'=>$driver_name,'DEPARTURE_CITY'=>$departure_city,'ARRIVAL_CITY'=>$arrival_city,'DEPARTURE_TIME'=>$departure_time,'TRIP_HOUR'=>$trip_hour,'TOTAL_SEAT'=>$total_seat,'TOTAL_PRICE'=>$total_price,'TRIP_DETAILS'=>$trip_details,'RATING'=>$rating,'NO_OF_OPINION'=>$no_of_opinion,'DRIVER_PH_NO'=>$driver_ph_no,'VEHICLE_BRAND'=>$vehicle_brand,'VEHICLE_COLOR'=>$vehicle_color));
        $email_data = [
            'to' => $this->getUserEmailId($user_id),
            'subject' => $email_setting['subject'],
            'template' => 'create_user',
            'body' => $email_setting['body']
        ];
        $this->SendMail($email_data);
        
//        $user=$this->getUserDetails($user_id);
//        $name=$user->first_name.' '.$user->last_name;
//        $user_email=$this->getUserEmailId($user_id);
//        $email_setting = $this->get_email_data('booking_success', array('FULL_NAME' => $name,'TRACK_ID'=>$model->trackId,'PROJECT_NAME'=>$this->getProjectName()));
//        $email_data = [
//            'to' => $this->getUserEmailId($user_id),
//            'subject' => $email_setting['subject'],
//            'template' => 'create_user',
//            'body' => $email_setting['body']
//        ];
//        $this->SendMail($email_data);
        $tm= TripMaster::findOne($session['trip_master_id']);
        $driver=$this->getUserDetails($tm->user_id);
        $driver_name=$driver->first_name.' '.$driver->last_name;
        $user_email=$this->getUserEmailId($tm->user_id);
        $email_setting = $this->get_email_data('booking_success_to_driver', array('DRIVER_NAME' => $driver_name,'USER_NAME' => $name,'TRACK_ID'=>$model->trackId,'PROJECT_NAME'=>$this->getProjectName()));
        $email_data = [
            'to' => $this->getUserEmailId($tm->user_id),
            'subject' => $email_setting['subject'],
            'template' => 'create_user',
            'body' => $email_setting['body']
        ];
        $this->SendMail($email_data);
       
        
        //for sms
        $user_master= UserMaster::findOne($user_id);
        $user_ph_code=$user_master->phoneCode->phonecode;
        $user_phone=$user_ph_code.$user_master->phone;
//        $user_msg="Hi ".$name." you have successfully book a trip.Your booking id is ".$model->trackId;
        $user_msg='Hola '.$name.'. Tu solicitud de viaje '.$model->trackId.' por el trayecto '.$departure_city.' > '.$arrival_city.' ha sido confermada. ¡Buon viaje! El equipo 123Vamos.';
        if($user_master->phone!=''){
        Yii::$app->nexmo->sendSms($user_phone, 'Nexmo', $user_msg);
        }
        
        $driver_master= UserMaster::findOne($tm->user_id);
        $driver_ph_code=$driver_master->phoneCode->phonecode;
        $driver_phone=$driver_ph_code.$driver_master->phone;
//        $driver_msg="Hi ".$driver_name." a passenger name ".$name." successfully book your trip.Booking id is ".$model->trackId;
        $driver_msg='Hola '.$driver_name.'. Recibiste un solicitud de viaje de '.$name.' por el trayecto '.$departure_city.' > '.$arrival_city.'. Asegurete de poder recibir los pagosde tus pasajerosen la plataforma luego del viaje. El equipo 123Vamos';
        if($driver_master->phone!=''){
        Yii::$app->nexmo->sendSms($driver_phone, 'Nexmo', $driver_msg);
        }
                
        
        
        $session->remove('start_id');
        $session->remove('end_id');
        $session->remove('trip_master_id');
        $session->remove('departure_datetime');
        $session->remove('requested_seat');
        $session->remove('final_price');
        $session->remove('booking_process');
        Yii::$app->session->setFlash('success', 'Tu reserva es correcta');
        return $this->redirect(Yii::$app->urlManager->createUrl('site/index'));
        
        }else{
            Yii::$app->session->setFlash('error', 'Algo salió mal');
        return $this->redirect(Yii::$app->urlManager->createUrl('site/index'));
        }
    }
    
    public function actionPayuresponsetest() {
        
        $session = Yii::$app->session;
        if(isset($session['start_id']) && $session['start_id']!=""){
            $tm= TripMaster::findOne($session['trip_master_id']);
        $user_id = Yii::$app->user->id;
        $start_id=$session['start_id'];
        $end_id=$session['end_id'];
        $model=new BookingMaster;
        $model->user_id=$user_id;
        $model->driver_id=$tm->user_id;
        $model->trackId=$this->manageUnickId(6).time();
        $model->trip_id=$session['trip_master_id'];
        $model->booking_type=$session['booking_process'];
        $model->request_time=date('Y-m-d H:i:s');
        $model->booking_status=1;
        $model->booking_location_start_id=$session['start_id'];
        $model->booking_location_end_id=$session['end_id'];
        $model->total_price=$session['final_price'];
        $model->no_of_seat=$session['requested_seat'];
        $model->added_date=date('Y-m-d H:i:s');
        $model->updated_date=date('Y-m-d H:i:s');
        $model->save(false);
        $location= TripLocation::find()->where("id BETWEEN :startL AND :endL", [":startL"=>$start_id,":endL"=>$end_id])->all();
        foreach($location as $k=>$val){
            $tl=TripLocation::findOne($val->id);
            $tl->total_booked=$tl->total_booked+$session['requested_seat'];
            $tl->save(false);
        }
        
        $user=$this->getUserDetails($user_id);
        $name=$user->first_name.' '.$user->last_name;
        $user_email=$this->getUserEmailId($user_id);
        $email_setting = $this->get_email_data('booking_success', array('FULL_NAME' => $name,'TRACK_ID'=>$model->trackId,'PROJECT_NAME'=>$this->getProjectName()));
        $email_data = [
            'to' => $this->getUserEmailId($user_id),
            'subject' => $email_setting['subject'],
            'template' => 'create_user',
            'body' => $email_setting['body']
        ];
        $this->SendMail($email_data);
        $tm= TripMaster::findOne($session['trip_master_id']);
        $driver=$this->getUserDetails($tm->user_id);
        $driver_name=$driver->first_name.' '.$driver->last_name;
        $user_email=$this->getUserEmailId($tm->user_id);
        $email_setting = $this->get_email_data('booking_success_to_driver', array('DRIVER_NAME' => $driver_name,'USER_NAME' => $name,'TRACK_ID'=>$model->trackId,'PROJECT_NAME'=>$this->getProjectName()));
        $email_data = [
            'to' => $this->getUserEmailId($tm->user_id),
            'subject' => $email_setting['subject'],
            'template' => 'create_user',
            'body' => $email_setting['body']
        ];
        $this->SendMail($email_data);
       
        
        //for sms
        $user_master= UserMaster::findOne($user_id);
        $user_ph_code=$user_master->phoneCode->phonecode;
        $user_phone=$user_ph_code.$user_master->phone;
        $user_msg="Hi ".$name." you have successfully book a trip.Your booking id is ".$model->trackId;
        if($user_master->phone!=''){
        Yii::$app->nexmo->sendSms($user_phone, 'Nexmo', $user_msg);
        }
        
        $driver_master= UserMaster::findOne($tm->user_id);
        $driver_ph_code=$driver_master->phoneCode->phonecode;
        $driver_phone=$driver_ph_code.$driver_master->phone;
        $driver_msg="Hi ".$driver_name." a passenger name ".$name." successfully book your trip.Booking id is ".$model->trackId;
        if($driver_master->phone!=''){
        Yii::$app->nexmo->sendSms($driver_phone, 'Nexmo', $driver_msg);
        }
                
        
        
        $session->remove('start_id');
        $session->remove('end_id');
        $session->remove('trip_master_id');
        $session->remove('departure_datetime');
        $session->remove('requested_seat');
        $session->remove('final_price');
        $session->remove('booking_process');
        Yii::$app->session->setFlash('success', 'Tu reserva es correcta');
        return $this->redirect(Yii::$app->urlManager->createUrl('site/index'));
        
        }else{
            Yii::$app->session->setFlash('error', 'Algo salió mal');
        return $this->redirect(Yii::$app->urlManager->createUrl('site/index'));
        }
    }
     public function actionPayuresponsemanual() {
         $payment_txt = '';
            $fp = fopen('payment_log.txt', "w");
            foreach ($_REQUEST as $key=>$val){
                $payment_txt .='Key='.$key.'=>Val='.$val;
            }
            fwrite($fp, $payment_txt);
        $session = Yii::$app->session;
        if(isset($session['booking_id']) && $session['booking_id']!="" && $_REQUEST['lapTransactionState']=='APPROVED'){
            $model= BookingMaster::findOne($session['booking_id']);
            if(count($model)>0){
              $user_id = Yii::$app->user->id;
              $model->booking_status=1;  
              $model->updated_date=date('Y-m-d H:i:s');
              $model->save(false);
              $user=$this->getUserDetails($user_id);
                $name=$user->first_name.' '.$user->last_name;
                $user_email=$this->getUserEmailId($user_id);
                $email_setting = $this->get_email_data('booking_success', array('FULL_NAME' => $name,'TRACK_ID'=>$model->trackId,'PROJECT_NAME'=>$this->getProjectName()));
                $email_data = [
                    'to' => $this->getUserEmailId($user_id),
                    'subject' => $email_setting['subject'],
                    'template' => 'create_user',
                    'body' => $email_setting['body']
                ];
                $this->SendMail($email_data);
                $tm= TripMaster::findOne($model->trip_id);
        $driver=$this->getUserDetails($tm->user_id);
        $driver_name=$driver->first_name.' '.$driver->last_name;
        $user_email=$this->getUserEmailId($tm->user_id);
        $email_setting = $this->get_email_data('booking_success_to_driver', array('DRIVER_NAME' => $driver_name,'USER_NAME' => $name,'TRACK_ID'=>$model->trackId,'PROJECT_NAME'=>$this->getProjectName()));
        $email_data = [
            'to' => $this->getUserEmailId($tm->user_id),
            'subject' => $email_setting['subject'],
            'template' => 'create_user',
            'body' => $email_setting['body']
        ];
        $this->SendMail($email_data);
        
        //for sms
        $user_master= UserMaster::findOne($user_id);
        $user_ph_code=$user_master->phoneCode->phonecode;
        $user_phone=$user_ph_code.$user_master->phone;
        $user_msg="Hi ".$name." you have successfully book a trip.Your booking id is ".$model->trackId;
        if($user_master->phone!=''){
        Yii::$app->nexmo->sendSms($user_phone, 'Nexmo', $user_msg);
        }
        
        $driver_master= UserMaster::findOne($tm->user_id);
        $driver_ph_code=$driver_master->phoneCode->phonecode;
        $driver_phone=$driver_ph_code.$driver_master->phone;
        $driver_msg="Hi ".$driver_name." a passenger name ".$name." successfully book your trip.Booking id is ".$model->trackId;
        if($driver_master->phone!=''){
        Yii::$app->nexmo->sendSms($driver_phone, 'Nexmo', $driver_msg);
        }
        
                $session->remove('booking_id');
                Yii::$app->session->setFlash('success', 'Tu reserva es correcta');
                return $this->redirect(Yii::$app->urlManager->createUrl('site/index'));
            }else{
               Yii::$app->session->setFlash('error', 'Algo salió mal en la reserva por favor póngase en contacto con admin');//something went wrong in booking please contact with admin
                return $this->redirect(Yii::$app->urlManager->createUrl('site/index')); 
            }
        }else{
        Yii::$app->session->setFlash('error', 'Algo salió mal');
        return $this->redirect(Yii::$app->urlManager->createUrl('site/index'));
        }
    }
    public function actionPayuredirect() {
        echo "<pre>";
        echo "return";
        print_r($_REQUEST);
        exit;
    }
    public function actionPayuconfirmation() {
        echo "<pre>";
        echo "return";
        print_r($_REQUEST);
        exit;
    }

}
