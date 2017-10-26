<?php

use yii\db\Query;
use app\models\TripLocation;
use app\models\TripMaster;
use yii\helpers\Url;
use app\models\UserMaster;
$user_id = Yii::$app->user->id;
$um = UserMaster::find()->where(['id' => $user_id])->one();
$session = Yii::$app->session;

$locationList = [];
$trip_master = TripMaster::findOne($trip_id);
$trip_master_id = $trip_id;
$trip_start_time = $trip_master->start_time;
$interval_time = $trip_master->interval_time;
if ($location_a_name != NULL && $location_b_name != NULL) {
    $trip_sql = "SELECT * FROM trip_location WHERE id >=(select id from trip_location where location_a_name LIKE '%$location_a_name%' AND trip_id=$trip_master_id) AND id<= (select id from trip_location where location_b_name LIKE '%$location_b_name%' AND trip_id=$trip_master_id)";
} else if ($location_a_name != NULL && $location_b_name == NULL) {
    $trip_sql = "SELECT * FROM trip_location WHERE id >= (select id from trip_location where location_a_name LIKE '%$location_a_name%' AND trip_id=$trip_master_id)";
} else if ($location_b_name != NULL && $location_a_name == NULL) {
    $trip_sql = "SELECT * FROM trip_location WHERE id <= (select id from trip_location where location_b_name LIKE '%$location_b_name%' AND trip_id=$trip_master_id)";
} else {
    $trip_sql = "SELECT * FROM trip_location WHERE trip_id=$trip_master_id";
}
$all_location = Yii::$app->db->createCommand($trip_sql)->queryAll();
foreach ($all_location as $lk => $lv) {
    $locationStartList[$lk]['id'] = $lv['id'];
    $locationEndList[$lk]['id'] = $lv['id'];
    $locationStartList[$lk]['locationName'] = $lv['location_a_name'];
    $locationEndList[$lk]['locationName'] = $lv['location_b_name'];
}

$total_price = $totalDistance = 0;
$total_array = count($all_location);
$from = '';
$to = '';

$departure_datetime = '';
$flag = false;
foreach ($all_location as $k => $loc_value) {
    if ($loc_value['total_booked'] > 0) {
        $flag = true;
    }
    $totalDistance += $loc_value['total_distance'];
    $total_price = $total_price + $loc_value['total_price'];
    if ($k == 0) {
        $seat_booked=$loc_value['total_booked'];
        $start_id=$loc_value['id'];
        $from = $loc_value['location_a_name'];
        $departure_datetime = $loc_value['departure_datetime'];
        $first_departure_datetime = $loc_value['departure_datetime'];
    }if ($k == $total_array - 1) {
        $end_id=$loc_value['id'];
        $to = $loc_value['location_b_name'];
        $last_arrival_datetime = $loc_value['arrival_datetime'];
    }
}
?>
<div class="main-body-wrap">

    <section class="buscar-4-top-sec">
        <div class="container">
		<div class="row">
                                   <?= $this->context->renderPartial("../partials/user_pro_main_tab_ul") ?>
                                </div>
                               
            <div class="row for-border-on">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="decoreted-box clearfix">
                        <div class="col-md-8 col-sm-7">
                            <div class="left-part open-sans">

                                <h1 class="heading"><?php echo $this->context->getSmallAddress($from) ?> &nbsp;> <?php echo $this->context->getSmallAddress($to) ?></h1>
                                <h2 class="heading"><?php echo ($flag == true) ? $this->context->getFormatedDate($departure_datetime) : $this->context->getFormatedDateWithInterval($trip_start_time, $departure_datetime, $interval_time); ?></h2>
                                <ul>
                                    <li>Desde <?php echo $from ?></li>
                                    <li>Hasta <?php echo $to ?></li>
                                    <li><?php echo $trip_master->seat_available-$seat_booked ?> asientos libres</li>
                                    <li><?php echo $total_array - 1 ?> paradas</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-5">
                            <div class="right-part">
                                <h1 class="heading">$<?php echo round($total_price); ?></h1>
                                <?php // if($location_a_name!=""){ ?>
                                <?php
                                $driver_id= Yii::$app->user->id;
                                    if($driver_id!=$trip_master->user_id){
                                ?>
                                <form class="form open-sans" role="form" method="post" id="bookingform" name="bookingform">
                                    <input type="hidden" name="isGuest" id="isGuest" value="<?=(Yii::$app->user->isGuest)?0:1;?>">
                                    <input type="hidden" name="start_id" value="<?php echo $start_id;?>">
                                    <input type="hidden" name="end_id" value="<?php echo $end_id;?>">
                                    <input type="hidden" name="trip_master_id" value="<?php echo $trip_master_id;?>">
                                    <input type="hidden" name="departure_datetime" value="<?php echo $departure_datetime;?>">
                                    <input type="hidden" name="price" value="<?php echo round($total_price);?>">
                                    <div class="form-group">
                                        <div class="spinner-q">
                                            <div class="input-group spinner">
                                                <input name="requested_seat" id="requested_seat" type="number" min="1" max="4" step="1" class="form-control" placeholder="¿cuantos asientos quieres reservar?" value="">
                                            </div>
                                            <div class="help-block help-block text-left" id="requested_seat_help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox checkbox-inline">
                                            <label>
                                                <input value="" type="checkbox" name="terms_conditions" id="terms_conditions">
                                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                <span class="line-text">Acepto las <a href="<?= Url::toRoute(['site/termconditions']); ?>" target="_blank" class="term-con-link">condiciones generales</a> y los <a href="<?= Url::toRoute(['site/privacypolicy']); ?>" target="_blank" class="term-con-link">preceptos de confidencialidad</a></span>
                                            </label>
                                            <div class="help-block" id="terms_conditions_help_block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="btn-rap text-left">
                                            <input type="submit" class="btn open-sans" value="RESERVAR"/>
                                        </div>
                                    </div>
                                </form>
                                <?php }  ?>
                            </div>
                        </div>
                    </div>

                    <div class="decoreted-box-2 clearfix">
                        <h3>El conductor</h3>
                        <div class="doted-top clearfix">
                            <div class="col-md-8 col-sm-7">
                                <div class="left-part open-sans">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="<?= Url::toRoute(['publicprofile/index','id'=>$trip_master->user_id]); ?>" target="_blank">
                                            <img src="<?php echo $this->context->getUserProfileImage($trip_master->user_id); ?>" class="media-object img-circle" style="width:60px;height:60px;">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="<?= Url::toRoute(['publicprofile/index','id'=>$trip_master->user_id]); ?>" target="_blank">
                                                <h4 class="media-heading heading"><?php echo $trip_master->userDetails->first_name . ' ' . $trip_master->userDetails->last_name ?></h4></a>
                                            <p class="heading"><?php echo $this->context->getAge($trip_master->userDetails->birth_year); ?></p>
                                        </div>
                                        <div class="media-bottom1" style="">
                                            <?php if(count($rating_master)>0){ ?>
                                         <!--<img src="<?php // echo $this->context->getStaticImage('rating_1.png') ?>" class="media-object img-responsive">-->
                                        <div class="rating-pop cust-rating">
                                            <input type="text" data-hover-enabled='false' data-display-only='true' class="ratingAnalysisItems rating rating-loading" data-size='sm' data-min="0" data-max="5" data-step="1" data-show-caption="false" data-show-clear='false' id="analysisRating_id_input" class="form-control ratingAnalysisItems" type="number" value="<?= $avg_rating['avg_rating'] ?>">
                                        </div>
                                          <span><?=count($rating_master);?> clasificaciones</span>
                                        <?php }else{ ?>
                                          <div class="rating-pop cust-rating">
                                            <input type="text" data-hover-enabled='false' data-display-only='true' class="ratingAnalysisItems rating rating-loading" data-size='sm' data-min="0" data-max="5" data-step="1" data-show-caption="false" data-show-clear='false' id="analysisRating_id_input" class="form-control ratingAnalysisItems" type="number" value="0">
                                        </div>
                                          <span>0 clasificaciones</span>
                                        <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-5">
                                <div class="right-part">
                                    <div class="media">
                                        <div class="media-left">
                                            <?php
                                        if ($trip_master->flexible == 1) {
                                            ?>
                                            <img src="<?php echo $this->context->getStaticImage('grn_right_icon.png') ?>" class="media-object img-circle title-tooltip" title="Conductor flexible">
                                        <?php }else{ ?>
                                            <img src="<?php echo $this->context->getStaticImage('grey_right_icon.png') ?>" class="media-object img-circle title-tooltip" title="Conductor no flexible">
                                        <?php } ?>
                                        </div>
                                        <div class="media-body open-sans">
                                            <ul>
                                                <li><a href="javascript:;" class="linkDisabled">Cédula verificada</a></li>
                                                <?php if($trip_master->userDetails->phone_verification==1){?>
                                                <li><a href="javascript:;" class="linkDisabled">Teléfono verificado</a></li>
                                                <?php }if($trip_master->userDetails->email_varified==1){ ?>
                                                <li><a href="javascript:;" class="linkDisabled">Email verificado</a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                        
                                        <?php
                                        if(Yii::$app->user->id!=$trip_master->userDetails->id){
                                        ?>
                                            <div class="media-bottom">
                                                <a href="javascript:;" onclick="sendMessage('<?=$trip_master->userDetails->id?>')" class="btn-block btn bascar-btn open-sans">CONTACTAR AL CONDUCTOR</a>
                                            </div>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="doted-btm clearfix open-sans">

                            <div class="col-md-12">
                            <?php
                            if(count($rating_master)>0){
                                foreach ($rating_master as $k=>$v) {
                               if($k>7){
                                   break;
                               }     
                            ?>
                            <div class="media">
                                <div class="media-left">
                                   <a href="<?= Url::toRoute(['publicprofile/index','id'=>$v->user_id]); ?>" target="_blank">
                                            <img src="<?php echo $this->context->getUserProfileImage($v->user_id); ?>" class="media-object img-circle" style="width:60px;height:60px;">
                                            </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading mensajes-name"><?php echo $v->userDetails->first_name . ' ' . $v->userDetails->last_name ?></h4>
                                    <p class="mensajes-title"><?php echo $v->userDetails->first_name?> : <?= $v->review ?></p>
                                    <p class="sm-date"><?= $this->context->get_month_name(date("F", strtotime($v->added_date))).' , '.date("Y", strtotime($v->added_date))?></p>
                                </div>
                            </div>
                            <?php }} ?>

                             <?php if(count($rating_master)>0){ if($k>7){ ?>
                            <a href="<?= Url::toRoute(['publicprofile/opinions','id'=>$v->user_id]); ?>" class="btn open-sans">Ver todas las opiniones</a>
                             <?php } } ?>
                        </div>

                        </div>
                    </div>

                    <div class="decoreted-box-3 clearfix">
                        <h3>El viaje</h3>
                        <div class="doted-top clearfix">
                            <div class="col-md-12">
                                <div class="left-part open-sans">
                                    <ul class="list-inline">
                                        <?php foreach ($all_location as $key => $value) { ?>

                                            <li>
                                                <a href="javascript:;"><?php echo $this->context->getSmallAddress($value['location_a_name']); ?>
                                                    <span><?php echo $this->context->getSmallFormatedDate($value['departure_datetime']); ?></span>
                                                </a>
                                            </li>
                                            <?php if ($key == $total_array - 1) { ?>
                                                <li>
                                                    <a href="javascript:;"><?php echo $this->context->getSmallAddress($value['location_b_name']); ?>
                                                        <span><?php echo $this->context->getSmallFormatedDate($value['arrival_datetime']); ?></span>
                                                    </a>
                                                </li>


                                                <?php
                                            }
                                        }
                                        ?>


                                    </ul>
                                    <p><?php echo $this->context->getTimeDifference($first_departure_datetime, $last_arrival_datetime) ?> de viaje</p>
                                    <p><a href="javascript:;" onclick="toggleFn('postdetailmap')">Ver el viaje en el mapa</a></p>
                                    <div id="postdetailmap" class="row" style=""><!-- display:none; -->
                                        <div class="col-md-12 col-sm-12">
                                            <div class="map-wrap">
                                                <div id="map" style="width:100%;height:450px;"></div>
                                            </div>
                                        </div>
                                    </div>


                                    <ul class="new-btm-line">
                                         <?php
                                        $brand='Not Set';
                                        $model_no='';
                                        $color='Not Set';
                                        $car_img='';
                                        if(isset($trip_master->userDetails->vehicle) && $trip_master->userDetails->vehicle!=''){
                                            $brand=$trip_master->userDetails->vehicle->vBrand->brand;
                                            $model_no=$trip_master->userDetails->vehicle->vModel->model_no;
                                            $color=$trip_master->userDetails->vehicle->vColor->color_name_es;
                                            $car_img=$trip_master->userDetails->vehicle->car_img;
                                        }
                                        ?>
                                        <li><span>El vehículo es :</span> <?php echo $brand . ' ' . $model_no ?></li>
                                        <li><span>Color :</span> <?php echo $color ?></li>
                                    </ul>

                                    <div class="travel-dtl">
                                        <h1>Detalles del viaje :</h1>
                                        <p><?php echo $trip_master->description ?></p>
                                    </div>
                                </div>
                            </div>


                        </div>


                    </div>
                </div>
            </div>
            <div class="foot-part">
                <p>
                                La información recibida por poriseba es utilizada para crear y verificar tu cuenta, por eso es obligatoria. Al completar esta información estás aceptando nuestras <a href="<?= Url::toRoute(['site/terminos_y_condiciones']); ?>" class="greenlink" target="_blank">Condiciones Generales</a>. Para saber más puedes consultar nuestras <a href="<?= Url::toRoute(['site/preceptos_de_confidencialidad']); ?>" class="greenlink" target="_blank">Políticas de Confidencialidad</a>.
                            </p>
            </div>
        </div>
    </section>
</div>

<form action="" class="form" style="display: none;">
    <?php
    $total_rows = count($all_location); //3
    foreach ($all_location as $key => $value) {
        if ($key == 0) {
            ?>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group ">
                        <div class="">
                            <label class="label-control">¿Desde cuál ciudad saldrá?</label>
                            <input type="text" id="start" class="form-control" name="start" placeholder="¿Desde cuál ciudad saldrá?" onfocus="" aria-required="true" autocomplete="off" value="<?php echo $value['location_a_name']; ?>">
                            <input type="hidden" name="start_lat" id="start_lat" value="<?php echo $value['location_a_lat']; ?>">
                            <input type="hidden" name="start_long" id="start_long" value="<?php echo $value['location_a_long']; ?>">
                            <div class="help-block"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group ">
                        <div class="">
                            <label class="label-control">¿hora de inicio?</label>
                            <input id="start_time" type="text" readonly placeholder="¿hora de inicio?" class="form-control form_datetime" value="<?php echo $value['departure_datetime']; ?>">
                            <input type='hidden' id='intime_1' value='<?php echo $value['departure_datetime']; ?>'>
                            <div class="help-block"></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }if ($key == $total_rows - 1) { ?>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group ">
                        <div class="">
                            <label class="label-control">¿Hasta cuál ciudad viajará?</label>
                            <input value="<?php echo $value['location_b_name'] ?>" type="text" id="end" class="form-control" name="end" placeholder="¿Hasta cuál ciudad viajará?" onfocus="" aria-required="true" autocomplete="off" >
                            <input type="hidden" id="end_lat" value="<?php echo $value['location_b_lat'] ?>">
                            <input type="hidden" id="end_long" value="<?php echo $value['location_b_long'] ?>">
                            <div class="help-block"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group ">
                <div class="">
                    <label class="label-control">¿En cuáles ciudades parará?</label>
                    <!--<input class="form-control hidden" placeholder="¿En cuáles ciudades parará?" type="text" disabled="" hidden="">-->
                    <div class="btn-block">
                        <a href="javascript:;" onclick="addStop();" class="add-stopages"><i class="fa fa-plus" aria-hidden="true"></i> Agregar una nueva parada</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="stopage">
        <?php
        foreach ($all_location as $key => $value) {
            if ($key < $total_rows - 1) {
                ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group ">
                            <div class="">
                                <label class="label-control">¿Desde cuál ciudad saldrá?</label>
                                <input value="<?php echo $value['location_b_name']; ?>" type="text" id="stop<?php echo $key; ?>" class="form-control" name="stop[]" placeholder="Add a location here..." onkeyup="stopageAddress(<?php echo $key; ?>)" aria-required="true" autocomplete="off">
                                <input type="hidden" id="stop<?php echo $key; ?>_lat" value="<?php echo $value['location_b_lat']; ?>">
                                <input type="hidden" id="stop<?php echo $key; ?>_long" value="<?php echo $value['location_b_long']; ?>">
                                <input type="hidden" id="intime_<?php echo $key + 2; ?>" value="<?php echo $value['arrival_datetime']; ?>">
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                </div>                             
                <?php
            }
        }
        ?>

    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group ">
                <button class="all-default-btn" type="button" id="editsubmit">enviar</button>
            </div>
        </div>
    </div>
</form>


<div class="modal fade cust-my-modal-2 right-review-modal" id="reservationmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"  aria-hidden="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--<h2 class="text-center">Perdiste tu contraseňa?</h2>-->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="form" id="tripReservationform" name="tripReservationform" method="post">
                        <input type="hidden" id="bookingmaster-trip_id" name="BookingMaster[trip_id]" value="<?= $trip_master->id ?>"/>
                        <input type="hidden" id="bookingmaster-booking_process" name="BookingMaster[booking_process]" value=""/>
                        <div class="col-sm-12 col-md-8">
                            <div class="clearfix form-group">
                                <label>Desde</label>
                                <input type="text" id="bookingmaster-booking_location_start_id" name="BookingMaster[booking_location_start_id]" class="readonly form-control" readonly value="<?=$from?>">
                            </div>
                            <div class="clearfix form-group">
                                <label>Hasta</label>
                                <input type="text" id="bookingmaster-booking_location_end_id" name="BookingMaster[booking_location_end_id]" class="readonly form-control" readonly value="<?=$to?>">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="clearfix form-group">
                                <label>Un asiento</label>
                                <input type="text" class="form-control readonly" id="bookingmaster-seat" name="BookingMaster[seat]" readonly="readonly" value="">
                            </div>
                            <div class="clearfix form-group">
                                <label>Precio</label>
                                <input type="hidden" id="bookingmaster-total_price" name="BookingMaster[total_price]" value=""/>
                                <h1 class="heading">$<span id="modal_total_price"></span></h1>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <input id="reservationmodal_submit" type="submit" class="btn open-sans" value="RESERVAR" style="float:right;"/>
                                <a class="btn open-sans" href="<?= Url::to(['book/payuresponsetest'])?>" style="float: right;margin-right: 6px;">Test Payment</a>
                            </div>
                        </div>
                    </form>
                    
                    <form method="post" name="payulatamform" id="payulatamform" action="https://sandbox.gateway.payulatam.com/ppp-web-gateway/">
    <?php
    $ApiKey='4Vj8eK4rloUd272L48hsrarnUA'; //"4Vj8eK4rloUd272L48hsrarnUA";//mylive VVQNJ449ao3qmZl3FlMtIDQZN7
    $merchantId='508029';//"508029";//mylive 670009
//    $referenceCode=time();
    $amount=200;
    $currency='COP';
//    $signature=md5($ApiKey.'~'.$merchantId.'~'.$referenceCode.'~'.$amount.'~'.$currency);
    $accountId='512321';//"512321";//mylive 672644
    ?>
  <input name="merchantId" id="merchantId"    type="hidden"  value="<?=$merchantId?>"   >
  <input name="accountId" id="accountId"     type="hidden"  value="<?=$accountId?>" >
  <input name="ApiKey"   id="ApiKey"  type="hidden"  value="<?=$ApiKey?>" >
  <input name="description" id="description"  type="hidden"  value="Test PAYU"  >
  <input name="referenceCode" id="referenceCode" type="hidden"  value="" >
  <input name="amount"  id="amount"       type="hidden"  value=""   >
  <input name="tax"    id="tax"        type="hidden"  value="0"  >
  <input name="taxReturnBase" id="taxReturnBase" type="hidden"  value="0" >
  <input name="currency"  id="currency"    type="hidden"  value="<?=$currency?>" >
  <input name="signature"  id="signature"    type="hidden"  value=""  >
  <input name="test"     id="test"      type="hidden"  value="1" >
  <input name="buyerEmail"  id="buyerEmail"   type="hidden"  value="<?=(isset($um->email) && $um->email!="")?$um->email:''; ?>" >
  <input name="responseUrl"  id="responseUrl"  type="hidden"  value="<?= Yii::$app->urlManager->createAbsoluteUrl(["book/payuresponse"]) ?>" >
  <input name="confirmationUrl" id="confirmationUrl"   type="hidden"  value="<?= Yii::$app->urlManager->createAbsoluteUrl(['book/payuconfirmation']); ?>" >
</form>
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade cust-my-modal-2" id="message-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"  aria-hidden="false">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 col-sm-12">
                                <div class="text-center">
                                    <div class="mdl-prt-2">
                                        <h1>Escribe un mensaje</h1>
                                    </div>
                                    <form id="message-form" name="message-form">
                                        <input type="hidden" id="to_id" name="to_id" value="">
                                        <textarea id="message" name="message" class="form-control cust-textarea" placeholder="Escribe tu mensaje aquí"></textarea>
                                        <div class="help-block" id="message-help-block"></div>
                                        <div class="text-right">
                                            <button class="all-default-btn" type="submit">ENVIAR</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script>
    var global_val = 0;
    var intime = 2;
    var geocoder;
    var firsttime = true;
    function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 5,
            center: {lat: 3.376614, lng: -74.80247199999997}//spain lat=40.46366700000001,long=-3.7492200000000366
        });
        directionsDisplay.setMap(map);

        document.getElementById('editsubmit').addEventListener('click', function () {
            loader_start();
            $('.help-block').html("");
            var validate = true;
            $(".travel-form-wrap input[type=text]").each(function () {
                var val = this.value;
                window.console.log('==');
                if (val == '' || val == ' ') {
                    loader_stop();
                    $(this).parents('.form-group').find('.help-block').text('Field cannot be blank');
                    validate = false;
                }
            });
            if (validate) {
                calculateAndDisplayRoute(directionsService, directionsDisplay);
            }
        });
    }

    function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var waypts = [];
        var checkboxArray = document.getElementById('waypoints');
        var inps = document.getElementsByName('stop[]');
        for (var i = 0; i < inps.length; i++) {
            var inp = inps[i];
            var stop_lat = $('#stop' + i + '_lat').val();
            var stop_long = $('#stop' + i + '_long').val();
            waypts.push({
                location: new google.maps.LatLng(stop_lat, stop_long),
                stopover: true
            });
        }


        var start_lat = $('#start_lat').val();
        var start_long = $('#start_long').val();
        var end_lat = $('#end_lat').val();
        var end_long = $('#end_long').val();

        directionsService.route({
            origin: new google.maps.LatLng(start_lat, start_long),
            destination: new google.maps.LatLng(end_lat, end_long),
            waypoints: waypts,
            optimizeWaypoints: true,
            travelMode: 'DRIVING'
        }, function (response, status) {
            if (status === 'OK') {
                $('#publicar-btm').show();
                var start_time = $('#start_time').val();
                $('#intime_1').val(start_time);

                directionsDisplay.setDirections(response);
                var route = response.routes[0];
//                window.console.log(route);
                // For each route, display summary information.
                var total_length = route.legs.length;

                loader_stop();
            } else {
                loader_stop();
                window.alert('Directions request failed due to ' + status);
            }
        });
    }



</script>
<script>
    if ($('.ratingAnalysisItems').length > 0) {
            var ids = $('.ratingAnalysisItems').map(function () {
                return $(this).attr('id');
            });
            $.each(ids, function (item, value) {
                window.console.log(value);
                var _this = $('#' + value);

                _this.rating({
                    min: 0,
                    max: 5,
                    step: 0.5,
                    size: 'xs',
                    showClear: false
                });
            });
        }
        function reportProfile(id){
            $('#to_user_id').val(id);
            $('#report-profile-modal').modal('show');
        }
        function sendMessage(id){
            $('#to_id').val(id);
//            alert('something went wrong');
            $('#message-modal').modal('show');
        }
</script>
<!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOankrcwempASqz3CgugpUnpokrfw8CjU&callback=initMap&libraries=places">
</script>-->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFFmJsdgvGo2Sh0dOHik4eKgimWYAvTX4&callback=initMap&libraries=places">
</script>
<?php
$this->registerJsFile(
        Yii::$app->request->baseUrl . '/themes/frontend/custom/js/trip-booking.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>