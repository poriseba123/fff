<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Settings;
use app\models\TripLocation;
use app\models\TripMaster;
use app\models\UserMaster;
$user_id = Yii::$app->user->id;
$um = UserMaster::find()->where(['id' => $user_id])->one();
$kmprice= Settings::find()
        ->where(['slug' => 'km_price'])
        ->one();
//echo "<pre>";
//print_r($model->userDetailsTripLocationStart->location_a_name);
//exit;

?>
<script>
var km_price=<?php echo $kmprice->value ?>;
</script>
<section class="publicar-btm" id="publicar-btm" style=""><!--display:none; -->
    <div class="container">
        <div class="publicar-btm-wrap ">
            <h2 class="publicar-title">Hacer el pago para confirmar su reserva</h2>
            <div class="detail-form-wrap" id='directions-panel'>
                <div class="row">
                <form class="form" id="tripReservationform-not-instant" name="tripReservationform-not-instant" method="post">
                        <input type="hidden" id="bookingmaster-trip_id" name="BookingMaster[trip_id]" value="<?=$model->trip_id?>"/>
                        <input type="hidden" id="bookingmaster-booking_process" name="BookingMaster[booking_process]" value="2"/>
                        <div class="col-sm-12 col-md-8">
                            <div class="clearfix form-group">
                                <label>Starting Location</label>
                                <input type="text" id="bookingmaster-booking_location_start_id" name="BookingMaster[booking_location_start_id]" class="readonly form-control" readonly value="<?=$model->userDetailsTripLocationStart->location_a_name;?>">
                            </div>
                            <div class="clearfix form-group">
                                <label>End Location</label>
                                <input type="text" id="bookingmaster-booking_location_end_id" name="BookingMaster[booking_location_end_id]" class="readonly form-control" readonly value="<?=$model->userDetailsTripLocationEnd->location_b_name?>">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="clearfix form-group">
                                <label>Un asiento</label>
                                <input type="text" class="form-control readonly" id="bookingmaster-seat" name="BookingMaster[seat]" readonly="readonly" value="<?=$model->no_of_seat?>">
                            </div>
                            <div class="clearfix form-group">
                                <label>Travel Fee</label>
                                <input type="hidden" id="bookingmaster-total_price" name="BookingMaster[total_price]" value="<?=round($model->total_price)?>"/>
                                <h1 class="heading">$<span id="modal_total_price"><?=round($model->total_price)?></span></h1>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">Close</button>
                                <input id="reservationmodal_submit" type="submit" class="btn open-sans common-upbtn" value="RESERVAR" style="float:right;"/>
                            </div>
                        </div>
                    </form>
                    <form method="post" name="payulatamform-not-instant" id="payulatamform-not-instant" action="https://sandbox.gateway.payulatam.com/ppp-web-gateway/">
    <?php
    $ApiKey='4Vj8eK4rloUd272L48hsrarnUA'; //"4Vj8eK4rloUd272L48hsrarnUA";//mylive VVQNJ449ao3qmZl3FlMtIDQZN7
    $merchantId='508029';//"508029";//mylive 670009
    $referenceCode=time();
    $amount=round($model->total_price);
    $currency='COP';
    $signature=md5($ApiKey.'~'.$merchantId.'~'.$referenceCode.'~'.$amount.'~'.$currency);
    $accountId='512321';//"512321";//mylive 672644
    ?>
  <input name="merchantId" id="merchantId"    type="hidden"  value="<?=$merchantId?>"   >
  <input name="accountId" id="accountId"     type="hidden"  value="<?=$accountId?>" >
  <input name="ApiKey"   id="ApiKey"  type="hidden"  value="<?=$ApiKey?>" >
  <input name="description" id="description"  type="hidden"  value="Test PAYU"  >
  <input name="referenceCode" id="referenceCode" type="hidden"  value="<?=$referenceCode?>" >
  <input name="amount"  id="amount"       type="hidden"  value="<?=$amount?>"   >
  <input name="tax"    id="tax"        type="hidden"  value="0"  >
  <input name="taxReturnBase" id="taxReturnBase" type="hidden"  value="0" >
  <input name="currency"  id="currency"    type="hidden"  value="<?=$currency?>" >
  <input name="signature"  id="signature"    type="hidden"  value="<?=$signature?>"  >
  <input name="test"     id="test"      type="hidden"  value="1" >
  <input name="buyerEmail"  id="buyerEmail"   type="hidden"  value="<?=$um->email?>" >
  <input name="responseUrl"  id="responseUrl"  type="hidden"  value="<?= Yii::$app->urlManager->createAbsoluteUrl(["book/payuresponsemanual"]) ?>" >
  <input name="confirmationUrl" id="confirmationUrl"   type="hidden"  value="<?= Yii::$app->urlManager->createAbsoluteUrl(['book/payuconfirmation']); ?>" >
</form>
            </div>
            </div>
        </div>
    </div>
</section>
<?php
$this->registerJsFile(
        Yii::$app->request->baseUrl . '/themes/frontend/custom/js/trip-booking.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>