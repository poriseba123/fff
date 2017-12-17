<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\components\FrontendController;
use yii\db\Query;

use app\models\ServicesList;

class SearchController extends FrontendController {

    public function actionViewall() {
        Yii::$app->session->setFlash('error', 'Rellene el formulario de búsqueda');
        return $this->redirect(['search/searchtrip']);
    }

    public function actionIndex() {
        $page_no = 1;
        $limit = 20;
        $offset = 0;
        return $this->render('searchlist', ['page_no' => $page_no, 'limit' => $limit, 'offset' => $offset]);
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

    public function actionGetsearch() {
        if (Yii::$app->request->isAjax) {
            $data = [];
            $data_msg = [];
            $all_result = [];
            $total_results_count = 0;
            $limit = $_POST['limit'];
            $offset = $_POST['offset'];
            $city = $_POST['city'];
            $categories = $_POST['categories'];
            $state = $_POST['state'];
            $keyword = $_POST['keyword'];
            $services=ServicesList::findOne($categories);
            $category_table=$services->table_name;
            $search_sql = "select * from $category_table where city_id=$city AND status=1 LIMIT $limit OFFSET $offset";
            $results = Yii::$app->db->createCommand($search_sql)->queryAll();
            $total_result_sql = "select count(*) from $category_table where city_id=$city AND status=1";
            $total_results_count = Yii::$app->db->createCommand($total_result_sql)->queryOne();
            $data['results'] = $results;
            $data['image_folder_name'] = $services->image_folder_name;
            $data['limit'] = $limit;
            $data['offset'] = $offset;
            $data['total_results_count'] = $total_results_count;
            $data_msg['html'] = $this->renderPartial('_get_search', $data, true);
//            $data_msg['url'] = Yii::$app->request->baseUrl . '/search/';
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
