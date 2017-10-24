<?php

use yii\db\Query;
use app\models\TripLocation;

//echo "<pre>";
//print_r($trips);
//exit;
if (isset($trips) && count($trips) > 0) {
    foreach ($trips as $trip) {
        $location_a_name = $trip['location_a_name'];
        $location_b_name = $trip['location_b_name'];
        $trip_master_id = $trip['trip_id'];
        $trip_start_time = $trip['start_time'];
        $interval_time = $trip['interval_time'];
        if ($location_a_name != NULL && $location_b_name != NULL) {
            $trip_sql = "SELECT * FROM trip_location WHERE id >=(select id from trip_location where location_a_name = '$location_a_name' AND trip_id=$trip_master_id) AND id<= (select id from trip_location where location_b_name = '$location_b_name' AND trip_id=$trip_master_id)";
        } else if ($location_a_name != NULL && $location_b_name == NULL) {
            $trip_sql = "SELECT * FROM trip_location WHERE id >= (select id from trip_location where location_a_name = '$location_a_name' AND trip_id=$trip_master_id)";
        } else if ($location_b_name != NULL && $location_a_name == NULL) {
            $trip_sql = "SELECT * FROM trip_location WHERE id <= (select id from trip_location where location_b_name = '$location_b_name' AND trip_id=$trip_master_id)";
        } else {
            $trip_sql = "SELECT * FROM trip_location WHERE trip_id=$trip_master_id";
        }
        $all_location = Yii::$app->db->createCommand($trip_sql)->queryAll();
        $total_price = 0;
        $total_array = count($all_location);
        $from = '';
        $to = '';
        $departure_datetime = '';
        $flag = false;
        foreach ($all_location as $k => $loc_value) {
            if ($loc_value['total_booked'] > 0) {
                $flag = true;
            }
            $total_price = $total_price + $loc_value['total_price'];
            if ($k == 0) {
                $from = $loc_value['location_a_name'];
                $departure_datetime = $loc_value['departure_datetime'];
                $seat_booked = $loc_value['total_booked'];
            }
            if ($k == $total_array - 1) {
                $to = $loc_value['location_b_name'];
            }
        }
        ?>
        <div class="decoreted-box clearfix search-items">
            <div class="col-md-2 col-sm-3">
                <div class="left-part open-sans">
                    <img class="img-responsive img-circle center-block" src="<?= $this->context->getUserProfileImage($trip['user_id']) ?>" alt="">
                    <h1><?= $trip['first_name'] . ' ' . $trip['last_name'] ?></h1>
                    <h2><?= $this->context->getAge($trip['birth_year']) ?></h2>
                    <?php if(isset($trip['identity_document_verified']) && $trip['identity_document_verified']==1){?>
                    <a href="javascript:;" class="btn open-sans linkDisabled">Cédula verificada</a>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-10 col-sm-9">
                <!--<a href="">-->
                <div class="right-part">
                    <div class="right-top-part">
                        <div class="row">
                            <?php
//                                $trip_start_date = date_create($trip['start_time']);
//                                $now_date = date_create(date('Y-m-d H:i:s'));
//                                $interval = date_diff($trip_start_date, $now_date);
                            ?>
                            <div class="col-md-9 col-sm-12"><h1><?= ($flag == true) ? $this->context->getFormatedDate($departure_datetime) : $this->context->getFormatedDateWithInterval($trip_start_time, $departure_datetime, $interval_time) ?></h1>
                                <div class="right-btm-part open-sans" style="margin-top:7px;">
                                    <ul>
                                        <li>Desde <?php echo $from ?></li>
                                        <li>Hasta <?php echo $to ?></li>
                                        <li><?php echo $trip['seat_available'] - $seat_booked ?> asientos libres</li>
                                        <li><?php echo $total_array - 1 ?> paradas</li>
                                    </ul>
                                </div>

                            </div>
                            <div class="col-md-3 col-sm-12"><h2 class="" style="text-align: center;">$<?php echo round($total_price); ?></h2>
                                <a href="<?php echo Yii::$app->urlManager->createUrl(["search/postdetail", 'id' => $trip_master_id, 'location_a_name' => $location_a_name, 'location_b_name' => $location_b_name]) ?>" class="all-default-btn btn-block text-center" style="margin-top:7px;">RESERVAR</a>
                            </div>
                        </div>

                    </div>

                </div>
                <!--</a>-->
            </div>
        </div>
        <?php
    }
    ?>
    <ul class="list-inline page-line">
        <?php
        $total_trip = count($trips);
        for ($i = 1; $i <= $total_trips_count / $limit; $i++) {
            ?>
            <li>
                <a  <?= ($page_no == $i) ? 'class="active"' : '' ?> href="javascript:void(0)" <?= ($page_no != $i) ? 'onclick="setPageNo(this)"' : '' ?>><?= $i ?></a>
            </li>
            <?php
        }
        ?>
    </ul>
    <?php
} else {
    ?>
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>No se han encontrado resultados</h2>
        </div>
    </div>
    <?php
}
?>