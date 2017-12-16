<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\components\FrontendController;
use yii\db\Query;
use app\models\TripMaster;
use app\models\TripLocation;

class SearchController extends FrontendController {

    public function actionViewall() {
        Yii::$app->session->setFlash('error', 'Rellene el formulario de búsqueda');
        return $this->redirect(['search/searchtrip']);
    }

    public function actionSearchtrip() {
//        if (Yii::$app->user->isGuest) {
//            Yii::$app->session->setFlash('error', 'por favor ingresa primero');
//            return $this->redirect(['site/login']);
//        }else{
        $page_no = 1;
        $limit = 20;
        $offset = 0;
        return $this->render('searchtrip', ['page_no' => $page_no, 'limit' => $limit, 'offset' => $offset]);
//        }
    }

    public function actionPostdetail($id) {
        $data = [];
        $data['trip_id'] = $id;
        $data['location_a_name'] = isset($_REQUEST['location_a_name']) ? $_REQUEST['location_a_name'] : "";
        $data['location_b_name'] = isset($_REQUEST['location_b_name']) ? $_REQUEST['location_b_name'] : "";

        $tm = TripMaster::findOne($id);
        $driver_id = $tm->user_id;
        $rating_master = \app\models\RatingMaster::find()->where(['driver_id' => $driver_id, 'status' => 1])->orderBy('id DESC')->all();
        $avg_sql = "select avg(rating) as avg_rating from rating_master where status=1 and driver_id=$driver_id";
        $avg_rating = Yii::$app->db->createCommand($avg_sql)->queryOne();
        $data['rating_master'] = $rating_master;
        $data['avg_rating'] = $avg_rating;
        return $this->render('post_details', $data, TRUE);
    }

    public function actionGettrip() {
        if (Yii::$app->request->isAjax) {
            $data = [];
            $data_msg = [];
            $all_trip = [];
            $total_trips_count = 0;
            $page_no = $_POST['TripLocation']['page_no'];
            $limit = $_POST['TripLocation']['limit'];
            $offset = $_POST['TripLocation']['offset'];
            $post_location_a = $location_a_name = $_POST['TripLocation']['location_a_name'];
            $location_b_name = $_POST['TripLocation']['location_b_name'];
            $location_a_lat = $_POST['TripLocation']['location_a_lat'];
            $location_b_lat = $_POST['TripLocation']['location_b_lat'];
            $location_a_long = $_POST['TripLocation']['location_a_long'];
            $location_b_long = $_POST['TripLocation']['location_b_long'];
            $location_b_city = $_POST['TripLocation']['location_b_city'];
            $departure_datetime = $_POST['TripLocation']['departure_datetime'];
//                                SELECT COUNT(*) FROM trip_location AS tl WHERE 
//                                tl.id BETWEEN 
//                                (
//                                    SELECT tl.id FROM trip_location AS tl WHERE tl.location_a_name LIKE '%$location_a_name%' AND tm.id = tl.trip_id AND 
//                                    (
//                                        (
//                                            (DATE(tl.departure_datetime) = DATE('$departure_datetime')) AND (tl.total_booked =  0)
//                                        ) OR 
//                                        (
//                                            (DATE(tl.departure_datetime) = DATE('$departure_datetime')) AND (tl.departure_datetime >= NOW()) AND (tl.total_booked > 0)
//                                        )
//                                    ) LIMIT 1
//                                ) AND 
//                                (
//                                    SELECT tl.id FROM trip_location AS tl WHERE tl.location_b_name LIKE '%$location_b_name%' AND tm.id = tl.trip_id LIMIT 1
//                                ) AND tl.total_booked < tm.seat_available
            $trip_sql = "SELECT tm.id AS trip_id,tm.user_id,tm.seat_available,tm.start_time,tm.interval_time,um.first_name,um.last_name,um.birth_year,um.identity_document_verified,tl.location_a_name,tl.location_b_name, 
                        (                                             
                            (                                                
                                (                                                   
                                    (                                                        
                                        acos(                                                            
                                            sin(                                                                
                                                (" . floatval($location_a_lat) . " * pi()/180)                                                            
                                            ) * sin(                                                               
                                                (tl.location_a_lat * pi()/180)
                                            ) + cos(                                                               
                                                (" . floatval($location_a_lat) . " * pi()/180)                                                            
                                            ) * cos(                                                               
                                                (tl.location_a_lat * pi()/180)
                                            ) * cos(                                                               
                                                ((" . floatval($location_a_long) . " - tl.location_a_long) * pi()/180)
                                            )                                                        
                                        )                                                    
                                    ) * 180/pi()                                                
                                ) * 60 * 1.1515 * 1.609344                                           
                            )                                        
                        ) as distance FROM trip_master AS tm
                        LEFT JOIN trip_location AS tl ON tl.trip_id = tm.id
                        LEFT JOIN user_master AS um ON um.id = tm.user_id WHERE
                        tl.location_b_name LIKE '%$location_b_city%' AND
                        (
                            (DATE(tl.departure_datetime) = DATE('$departure_datetime')) AND (tl.total_booked =  0) OR
                            (DATE(tl.departure_datetime) = DATE('$departure_datetime')) AND (tl.departure_datetime >= NOW()) AND (tl.total_booked > 0)
                        ) AND
                        tl.total_booked < tm.seat_available AND
                        tm.status = '1'
                        GROUP BY tl.location_a_name having distance <= 100 ORDER BY distance ASC LIMIT $limit OFFSET $offset";
            $trips = Yii::$app->db->createCommand($trip_sql)->queryAll();
            $total_trip_sql = "SELECT COUNT(*), 
                        (                                             
                            (                                                
                                (                                                   
                                    (                                                        
                                        acos(                                                            
                                            sin(                                                                
                                                (" . floatval($location_a_lat) . " * pi()/180)                                                            
                                            ) * sin(                                                               
                                                (tl.location_a_lat * pi()/180)
                                            ) + cos(                                                               
                                                (" . floatval($location_a_lat) . " * pi()/180)                                                            
                                            ) * cos(                                                               
                                                (tl.location_a_lat * pi()/180)
                                            ) * cos(                                                               
                                                ((" . floatval($location_a_long) . " - tl.location_a_long) * pi()/180)
                                            )                                                        
                                        )                                                    
                                    ) * 180/pi()                                                
                                ) * 60 * 1.1515 * 1.609344                                           
                            )                                        
                        ) as distance FROM trip_master AS tm
                        LEFT JOIN trip_location AS tl ON tl.trip_id = tm.id
                        LEFT JOIN user_master AS um ON um.id = tm.user_id WHERE
                        tl.location_b_name LIKE '%$location_b_city%' AND
                        (
                            (DATE(tl.departure_datetime) = DATE('$departure_datetime')) AND (tl.total_booked =  0) OR
                            (DATE(tl.departure_datetime) = DATE('$departure_datetime')) AND (tl.departure_datetime >= NOW()) AND (tl.total_booked > 0)
                        ) AND
                        tl.total_booked < tm.seat_available AND
                        tm.status = '1'
                        GROUP BY tl.location_a_name having distance <= 100";
            $total_trips = Yii::$app->db->createCommand($total_trip_sql)->queryOne();
            $data['trips'] = $trips;
            $data['page_no'] = $page_no;
            $data['limit'] = $_POST['TripLocation']['limit'];
            $data['offset'] = $offset;
            $data['total_trips_count'] = $total_trips_count;
            $data_msg['html'] = $this->renderPartial('_get_trip', $data, true);
            $data_msg['url'] = Yii::$app->request->baseUrl . '/search/searchtrip?TripLocation%5Blocation_a_name%5D=' . $post_location_a . '&TripLocation%5Blocation_b_name%5D=' . $location_b_name . '&TripLocation%5Bdeparture_datetime%5D=' . $departure_datetime;
            $data_msg['res'] = 1;
            echo json_encode($data_msg);
            exit;
        }
    }

    public function actionGettravelfees() {
        if (Yii::$app->request->isAjax) {
            $resp = [];
            $resp['flag'] = true;

            $tripStartId = $_REQUEST['tripStartId'];
            $tripEndId = $_REQUEST['tripEndId'];
            $totalSeat = $_REQUEST['totalSeat'];

            if ($tripStartId == $tripEndId) {
                $getLocation = TripLocation::findOne($tripStartId);
                $distance = $getLocation->total_distance;
                $price = $getLocation->total_price;
                $userViewableFee = $price * $totalSeat;
                $resp['price'] = $userViewableFee;
                $resp['totalDistance'] = $distance;
            } elseif ($tripEndId > $tripStartId) {
                
            }
        }
    }

}
