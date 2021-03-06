<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

//if (!$model->isNewRecord) {
    $doctor_id = $data['doctor_id'];
    $model = $data['model'];
    $doctor_chamber_time = $data['doctor_chamber_time'];
//}
/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<!--<div class="user-form">

<?php $form = ActiveForm::begin(); ?>


    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>-->
<style>
    .btn span.glyphicon {    			
	opacity: 0;				
}
.btn.active span.glyphicon {				
	opacity: 1;				
}
    .radio-inline label{
        margin-right:30px;
    }
    .time .row{
        margin-bottom: 2px;
    }

</style>
<style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map {
        height: 100%;
    }
    /* Optional: Makes the sample page fill the window. */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
    }

    #infowindow-content .title {
        font-weight: bold;
    }

    #infowindow-content {
        display: none;
    }

    #map #infowindow-content {
        display: inline;
    }

    .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
    }

    #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
    }

    .pac-controls {
        display: inline-block;
        padding: 5px 11px;
    }

    .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
    }

    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
    }

    #pac-input:focus {
        border-color: #4d90fe;
    }

    #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
    }
    #target {
        width: 345px;
    }
</style>

<?php 
//$start = '12:00AM';
//$end = '11:59PM';
////$interval = '+1 hour';
//
// $interval = '+30 minutes';
//// $interval = '+15 minutes';
//
//$start_str = strtotime($start);
//$end_str = strtotime($end);
//$now_str = $start_str;
//
//echo '<select id="time_dropdown">';
//while($now_str <= $end_str){
//    echo '<option value="' . date('h:i A', $now_str) . '">' . date('h:i A', $now_str) . '</option>';
//    $now_str = strtotime($interval, $now_str);
//}
//echo '</select>';
?>
<div class="portlet light bordered form-fit">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa <?= $model->isNewRecord ? 'fa-plus' : 'fa-edit'; ?> font-green-haze" aria-hidden="true"></i>

            <span class="caption-subject font-green-haze bold uppercase">
                <?= Html::encode($this->title) ?>
            </span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <?php
        $form = ActiveForm::begin([
                    'id'=>'create-chamber-form',
                    'options' => ['class' => 'form-horizontal form-row-seperated'],
                    'enableClientValidation' => false
                ])
        ?>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Chamber Name<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'chamber_name')->textInput(['class' => 'form-control'])->label(false); ?>
                    <input type="hidden" name="doctor_id" id="doctor_id" value="<?=(isset($doctor_id) && $doctor_id!='')?$doctor_id:''?>">
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Contact Person<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'contact_person')->textInput(['class' => 'form-control'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">address<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'address')->textArea(['class' => 'form-control', 'rows' => '2'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Country<span class="required">*</span></label>
                <div class="col-md-6">
                    <?php
                    $country_list = \app\models\Countries::find()->all();
                    $listData = ArrayHelper::map($country_list, 'id', 'name');
                    echo $form->field($model, 'country_id')->dropDownList($listData, ['prompt' => 'Select', 'onchange' => '
                    $.post("getstates?id=' . '"+$(this).val(),function(data){
                      $("select#doctorchamber-state_id").html(data);
                    });'])->label(false);
                    ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">State<span class="required">*</span></label>
                <div class="col-md-6">
                    <?php
                    $state_list = \app\models\States::find()->where(["id" => 0])->all();
                    $listData = ArrayHelper::map($state_list, 'id', 'name');
                    echo $form->field($model, 'state_id')->dropDownList($listData, ['prompt' => 'Select', 'onchange' => '
                    $.post("getcities?id=' . '"+$(this).val(),function(data){
                      $("select#doctorchamber-city_id").html(data);
                    });'])->label(false);
                    ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">City<span class="required">*</span></label>
                <div class="col-md-6">
                    <?php
                    $city_list = \app\models\Cities::find()->where(["id" => 0])->all();
                    $listData = ArrayHelper::map($city_list, 'id', 'name');
                    echo $form->field($model, 'city_id')->dropDownList($listData, ['prompt' => 'Select'])->label(false);
                    ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Map<span class="required">*</span></label>
                <div class="col-md-6">
                    <input type="hidden" id="doctorchamber-latitude" class="form-control" name="DoctorChamber[latitude]">
                    <input type="hidden" id="doctorchamber-longitude" class="form-control" name="DoctorChamber[longitude]">
                    <input id="pac-input" class="form-control controls1" type="text" placeholder="Search Box"><br>
                    <div id="map" style="height: 324px;width: 100%;"></div>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Time<span class="required">*</span></label>
                <div class="col-md-9">
                    <?php
                    $day_master= \app\models\DayMaster::find()->all();
                    foreach ($day_master as $key => $val) {
                    ?>
                    <div class="daymaster_main_div">
                        <div class="row" style="margin-bottom:5px;">
                            <div class="col-md-8 text-center">
                                <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-success active">
                                    <input type="checkbox" name="dayMaster[]" autocomplete="off" checked value="<?=$val->id?>">
				<span class="glyphicon glyphicon-ok"></span>&nbsp;<?=$val->day?>
                                </label>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom:5px;">
                            <div class="col-md-4">
                                Start Time
                            </div>
                            <div class="col-md-4">
                                End time
                            </div>
                        </div>
                        <div class="time <?='day_master_time_'.$val->id?>" style="margin-bottom:5px;">
                            <div class="row <?='each_time_'.$val->id.'_0'?>">
                                <div class="col-md-4">
                                    <div class='input-group date timepicker'>
                                        <input type='text' class="form-control" name="start_time[<?=$val->id?>][]"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                        <div class="help-block"></div>
                                </div>
                                <div class="col-md-4">
                                    <div class='input-group date timepicker'>
                                        <input type='text' class="form-control" name="end_time[<?=$val->id?>][]"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                    <div class="help-block"></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="btn-group btn-group-solid">
                                        <button type="button" class="btn btn-success" style="font-size:17px;" onclick="addTime(<?=$val->id?>);">
                                            + ADD MORE
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php if (!$model->isNewRecord) { ?>
            <div class="form-group">
                <label class="control-label col-md-3">Status <span class="required">*</span></label>
                <div class="col-md-6">
                    <div class="radio-list">                        
                        <label class="radio-inline">
                            <?php
                            echo $form->field($model, 'status')->radioList(['1' => 'Active', '0' => 'Inactive'])->label(false);
                            ?>
                        </label>
                    </div>
                </div>
            </div>
        <?php } ?>


        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn green']) ?>
                    <a href="<?php echo Url::to(['doctor/index']); ?>" class="btn default">Back</a>
                </div>
            </div>
        </div>
        <?php ActiveForm::end() ?>
        <!-- END FORM-->
    </div>
</div>
<script>
    $(function () {
                $('.timepicker').datetimepicker({
                    format: 'LT'
                });
            });
    var global_val = 1;
    function addTime(id){
        var day_master_id=id;
        $('.day_master_time_'+id).append('<div class="row each_time_'+id+'_'+global_val+'">'+
                                '<div class="col-md-4">'+
                                    '<div class="input-group date timepicker">'+
                                        '<input type="text" class="form-control" name="start_time['+id+'][]"/>'+
                                        '<span class="input-group-addon">'+
                                            '<span class="glyphicon glyphicon-time"></span>'+
                                        '</span>'+
                                    '</div>'+
                                    '<div class="help-block"></div>'+
                                '</div>'+
                                '<div class="col-md-4">'+
                                    '<div class="input-group date timepicker">'+
                                        '<input type="text" class="form-control" name="end_time['+id+'][]"/>'+
                                        '<span class="input-group-addon">'+
                                            '<span class="glyphicon glyphicon-time"></span>'+
                                        '</span>'+
                                    '</div>'+
                                    '<div class="help-block"></div>'+
                                '</div>'+
                                '<div class="col-md-4">'+
                                    '<div class="btn-group btn-group-solid">'+
                                        '<button type="button" class="btn btn-danger" style="font-size:17px;" onclick="removeRow('+id+','+global_val+')">X</button>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'
                            );
        global_val=global_val+1;
        $('.timepicker').datetimepicker({
                    format: 'LT'
                });
        
    }
    function removeRow(id,val){
        $('.each_time_'+id+'_'+val).remove();
    }
    </script>
<script>
    function initAutocomplete() {
        var myLatlng = new google.maps.LatLng(22, 79);
        var myOptions = {
            zoom: 5,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        var map = new google.maps.Map(document.getElementById("map"), myOptions),
                marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    draggable: true,
                });
        google.maps.event.addListener(marker, 'dragend', function () {
            document.getElementById('doctorchamber-latitude').value = marker.getPosition().lat();
            document.getElementById('doctorchamber-longitude').value = marker.getPosition().lng();
        });


        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var autocomplete = new google.maps.places.Autocomplete(input, {
            types: ["geocode"]
        });
        autocomplete.bindTo('bounds', map);
        var infowindow = new google.maps.InfoWindow();
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            infowindow.close();
            var place = autocomplete.getPlace();
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            moveMarker(place.name, place.geometry.location, map);
        });
    }
    function moveMarker(placeName, latlng, map) {
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            draggable: true
        });
        marker.setPosition(latlng);

        marker.addListener('drag', handleEvent);
        marker.addListener('dragend', handleEvent);
    }
    function handleEvent(event) {
        document.getElementById('doctorchamber-latitude').value = event.latLng.lat();
        document.getElementById('doctorchamber-longitude').value = event.latLng.lng();
    }
</script>

