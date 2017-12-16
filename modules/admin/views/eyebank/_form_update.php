<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

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
                    'id' => 'update_eye_bank_form',
                    'options' => ['class' => 'form-horizontal form-row-seperated','enctype' => 'multipart/form-data'],
                    'enableClientValidation' => false
                ])
        ?>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Name<span class="required">*</span></label>
                <div class="col-md-6">
                    <input type="hidden" name="eye_bank_id" value="<?= $model->id ?>">
                    <?= $form->field($model, 'name')->textInput(['class' => 'form-control'])->label(false); ?>
                </div>
            </div>
        </div>
		<div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Establishment Date<span class="required">*</span></label>
                <div class="col-md-6">
					<?= $form->field($model, 'establishment_date')->textInput(['class' => 'form-control datepicker'])->label(false); ?>
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
                      $("select#eyebankmaster-state_id").html(data);
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
                    echo $form->field($model, 'state_id')->dropDownList($listData, ['prompt' => 'Select', 'onchange' => 
                        '$.post("'.Url::to(['dashboard/getdistricts']).'?id=' . '"+$(this).val(),function(data){
                      $("select#eyebankmaster-district_id").html(data);
                    });'])->label(false);
                    ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">District<span class="required">*</span></label>
                <div class="col-md-6">
                    <?php
                    $district_list = \app\models\Districts::find()->where(["id" => 0])->all();
                    $listData = ArrayHelper::map($district_list, 'id', 'name');
                    echo $form->field($model, 'district_id')->dropDownList($listData, ['prompt' => 'Select', 'onchange' => '
                    $.post("'.Url::to(['dashboard/getcities']).'?id=' . '"+$(this).val(),function(data){
                      $("select#eyebankmaster-city_id").html(data);
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
                    <input type="hidden" id="eyebankmaster-latitude" class="form-control" name="EyeBankMaster[latitude]" value="<?= $model->latitude ?>">
                    <input type="hidden" id="eyebankmaster-longitude" class="form-control" name="EyeBankMaster[longitude]" value="<?= $model->longitude ?>">
                    <input id="pac-input" class="form-control controls1" type="text" placeholder="Search Box"><br>
                    <div id="map" style="height: 324px;width: 100%;"></div>
                </div>
                <div class="col-md-3">
                    <div class="btn-group btn-group-solid">
                        <button type="button" class="btn btn-success" style="font-size:17px;" onclick="getLocation();">
                            MY LOCATION
                        </button>
                    </div>
                </div>
            </div>
        </div>
	<div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Time<span class="required">*</span></label>
                <div class="col-md-7">
                    <div class="daymaster_main_div">
                        <div class="row">
                            <div class="col-md-6">
                                Open Time
                            </div>
                            <div class="col-md-6">
                                Close time
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class='input-group date timepicker'>
                                    <input type="text" id="eyebankmaster-open_time" class="form-control" name="EyeBankMaster[open_time]" value="<?= $model->open_time ?>">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                                <div class="help-block"></div>
                            </div>
                            <div class="col-md-6">
                                <div class='input-group date timepicker'>
                                    <input type="text" id="eyebankmaster-close_time" class="form-control" name="EyeBankMaster[close_time]" value="<?= $model->close_time ?>">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
	</div>
	
	<div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Free Check-up Time<span class="required">*</span></label>
                <div class="col-md-9">
                    <?php
					$checked='';
                    $day_master= \app\models\DayMaster::find()->all();
					if($model->free_eyetest){
						$eyetest_arr=json_decode($model->free_eyetest);
						
						if(!empty($eyetest_arr)){
							foreach($eyetest_arr as $index=>$content){
								$temp_arr=explode("-",$content);
								$start_time[$temp_arr[0]] = $temp_arr[1];
								$end_time[$temp_arr[0]] = $temp_arr[2];
					
							}
						}
						//die();
						
					}
                    foreach ($day_master as $key => $val) {

						if(isset($start_time[$val->id])){
							  $checked ="checked";
							  $active="active";
							
						}else{
							 $checked ="";
							 $active="";
						}
                    ?>
                    <div class="daymaster_main_div">
                        <div class="row" style="margin-bottom:5px;">
                            <div class="col-md-8 text-center">
                                <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-success <?= $active;?>">
                                    <input type="checkbox" name="dayMaster[]" autocomplete="off" <?= $checked;?> value="<?=$val->id?>">
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
                                        <input type='text' class="form-control" name="start_time[<?=$val->id?>][]" value="<?= isset($start_time[$val->id])? $start_time[$val->id]:''; ?>"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                        <div class="help-block"></div>
                                </div>
                                <div class="col-md-4">
                                    <div class='input-group date timepicker'>
                                        <input type='text' class="form-control" name="end_time[<?=$val->id?>][]" value="<?= isset($end_time[$val->id])? $end_time[$val->id]:''; ?>"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                    <div class="help-block"></div>
                                </div>
                             </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
	</div>
	
	
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Close day<span class="required">*</span></label>
                <div class="col-md-6">
                    <?php
                    $day_master = \app\models\DayMaster::find()->all();
//                    $city_list = \app\models\Cities::find()->where(["id" => 0])->all();
                    $listData = ArrayHelper::map($day_master, 'id', 'day');
                    echo $form->field($model, 'close_day')->dropDownList($listData, ['prompt' => 'Select day'])->label(false);
                    ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">address<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'description')->textArea(['class' => 'form-control', 'rows' => '3'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Contact No<span class="required">*</span></label>
                <div class="col-md-6">
                    <div class="main_contact_div">
                        <?php
                        $contacts = explode(',', $model->contact_no);
                        foreach ($contacts as $key => $value) {
                            ?>
                            <div>
                                <div class="row row_<?= $key ?>">
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="contact_no[]" value="<?= $value ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="btn-group btn-group-solid">
                                            <?php
                                            if ($key == 0) {
                                                ?>
                                                <button type="button" class="btn btn-success" style="font-size:17px;" onclick="addPhone('<?= count($contacts) ?>');">
                                                    + ADD MORE
                                                </button>
                                            <?php } else { ?>
                                                <button type="button" class="btn btn-danger" style="font-size:17px;" onclick="removeRow('<?= $key ?>')">X</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="help-block"></div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
	 <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Image<span class="required">*</span></label>
                <div class="col-md-6">
                    <?php echo $form->field($model, 'image')->fileInput(['class' => 'form-control image-input', 'placeholder' => 'Choose Image'])->label(false); ?>
                </div>
                <div class="col-md-3">
                    <div class="form-group text-center" id='preview-img-holder'>
                        <img src="<?=Yii::$app->request->baseUrl . '\uploads\eyebank\thumbnail\\' . $model->image?>" class="thumb-image" style="height: 80px;">
                                            </div>
                </div>
                <div class="help-block" id="err-image"></div>
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
                    <a href="<?php echo Url::to(['eyebank/index']); ?>" class="btn default">Back</a>
                </div>
            </div>
        </div>
        <?php ActiveForm::end() ?>
        <!-- END FORM-->
    </div>
</div>
<script>
 state_id="<?php echo $model->state_id?>";
 district_id="<?php echo $model->district_id?>";
 city_id="<?php echo $model->city_id?>";
	function fireagain(){
		setTimeout(function(){console.log('now'),$('#eyebankmaster-district_id').val(district_id).then($('#eyebankmaster-district_id').trigger('onchange'));},'2000');
	}
    $(function () {
        $('.timepicker').datetimepicker({
            format: 'LT'
        });
		$( ".datepicker" ).datepicker({
			  changeMonth: true,
			  changeYear: true,
			  dateFormat: 'yy-mm-dd'
		});

		$('#eyebankmaster-country_id').trigger('onchange');
		setTimeout(function(){$('#eyebankmaster-state_id').val(state_id).then($('#eyebankmaster-state_id').trigger('onchange'),fireagain())},'1500');
	});
    var global_val = 1;
    function addPhone(count) {
        if (global_val < count) {
            global_val = count;
        }
        $('.main_contact_div').append('<div><div class="row row_' + global_val + '">' +
                '<div class="col-md-8">' +
                '<input type="text" class="form-control" name="contact_no[]" value="">' +
                '</div>' +
                '<div class="col-md-4">' +
                '<div class="btn-group btn-group-solid">' +
                '<button type="button" class="btn btn-danger" style="font-size:17px;" onclick="removeRow(' + global_val + ')">X</button>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="help-block"></div>' +
                '</div>'
                );
        global_val++;
    }
    function removeRow(id) {
        $('.row_' + id).remove();
    }

    /////////////////////////////map script start/////////////////////////// 
<?php
if ($model->isNewRecord) {
    ?>
        currentlat = 20.5937;               //// india lat and long
        currentlong = 78.9629;
<?php } else { ?>
        currentlat = '<?= $model->latitude; ?>';               //// india lat and long
        currentlong = '<?= $model->longitude; ?>';
      
        setTimeout(function () {
			  geocoder = new google.maps.Geocoder;
            geocodeLatLng(currentlat, currentlong);
        }, 100);


    <?php
}
?>


    message = false;
    function geocodeLatLng(currentlat, currentlong) {

        var latlng = {lat: parseFloat(currentlat), lng: parseFloat(currentlong)};
        //alert(geocoder);
        geocoder.geocode({'location': latlng}, function (results, status) {
            //alert(status);
            if (status === 'OK') {
                if (results[0]) {
                    //alert(results[0].formatted_address);
                    document.getElementById('pac-input').value = results[0].formatted_address;
                    //var mylatlng = new google.maps.LatLng(currentlat, currentlong);
                    // moveMarker(results[0].formatted_address, mylatlng, map);
                    marker.setPosition(results[0].geometry.location);
                    map.setCenter(results[0].geometry.location);
                    map.setZoom(17);

                } else {
                    window.alert('No results found');
                }
            } else {
                window.alert('Geocoder failed due to: ' + status);
            }
        });
    }
    function showPosition(position) {
        currentlat = position.coords.latitude;
        currentlong = position.coords.longitude;
        document.getElementById('eyebankmaster-latitude').value = currentlat;
        document.getElementById('eyebankmaster-longitude').value = currentlong;
        geocodeLatLng(currentlat, currentlong);


    }
    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                message = "User denied the request for Geolocation."
                break;
            case error.POSITION_UNAVAILABLE:
                message = "Location information is unavailable."
                break;
            case error.TIMEOUT:
                message = "The request to get user location timed out."
                break;
            case error.UNKNOWN_ERROR:
                message = "An unknown error occurred."
                break;
        }
    }
    function getLocation() {
        if (navigator.geolocation) {
            //console.log(navigator.geolocation);
            navigator.geolocation.getCurrentPosition(showPosition, showError);

        } else {
            message = "Geolocation is not supported by this browser.";
        }
        if (message) {
            alert(message);
        }
    }

    function initAutocomplete() {
        var myLatlng = new google.maps.LatLng(currentlat, currentlong);
        var myOptions = {
            zoom: 5,
            center: myLatlng,
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        geocoder = new google.maps.Geocoder;
        map = new google.maps.Map(document.getElementById("map"), myOptions),
                marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    draggable: true,
                });
        google.maps.event.addListener(marker, 'dragend', function () {
            document.getElementById('eyebankmaster-latitude').value = marker.getPosition().lat();
            document.getElementById('eyebankmaster-longitude').value = marker.getPosition().lng();
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
            document.getElementById('eyebankmaster-latitude').value = place.geometry.location.lat();
            document.getElementById('eyebankmaster-longitude').value = place.geometry.location.lng();
        });
    }
    function moveMarker(placeName, latlng, map) {
        marker = new google.maps.Marker({
            position: latlng,
            map: map,
            draggable: true
        });
        marker.setPosition(latlng);

        marker.addListener('drag', handleEvent);
        marker.addListener('dragend', handleEvent);
    }
    function handleEvent(event) {
        document.getElementById('eyebankmaster-latitude').value = event.latLng.lat();
        document.getElementById('eyebankmaster-longitude').value = event.latLng.lng();
    }
/////////////////////////////map script end///////////////////////////  
</script>



