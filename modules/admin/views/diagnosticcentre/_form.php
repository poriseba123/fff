<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

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
                    'id' => 'create_diagnostic_centre_form',
                    'options' => ['class' => 'form-horizontal form-row-seperated', 'enctype' => 'multipart/form-data'],
                    'enableClientValidation' => false
                ])
        ?>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Name<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'name')->textInput(['class' => 'form-control'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Establishment Date<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'establishment_date')->textInput(['class' => 'form-control datepicker', 'id' => 'establishment_date'])->label(false); ?>

                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Address<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'address')->textArea(['class' => 'form-control', 'rows' => '2'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Website url </label>
                <div class="col-md-6">
                    <?= $form->field($model, 'website')->textInput(['class' => 'form-control'])->label(false); ?>
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
                    $.post("' . Url::to(['dashboard/getstates']) . '?id=' . '"+$(this).val(),function(data){
                      $("select#diagnosticcentre-state_id").html(data);
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
                        '$.post("' . Url::to(['dashboard/getdistricts']) . '?id=' . '"+$(this).val(),function(data){
                      $("select#diagnosticcentre-district_id").html(data);
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
                    $.post("' . Url::to(['dashboard/getcities']) . '?id=' . '"+$(this).val(),function(data){
                      $("select#diagnosticcentre-city_id").html(data);
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
                    <input type="hidden" id="diagnosticcentre-latitude" class="form-control" name="DiagnosticCentre[latitude]">
                    <input type="hidden" id="diagnosticcentre-longitude" class="form-control" name="DiagnosticCentre[longitude]">
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
                <label class="control-label col-md-3">Medical Test<span class="required">*</span></label>
                <div class="col-md-6">
                    <?php
                    $medical_tests_lists = \app\models\MedicalTests::find()->all();
                    $listData = ArrayHelper::map($medical_tests_lists, 'id', 'name');
                    //print_r($listData);
                    echo $form->field($model, 'medical_tests')->widget(Select2::classname(), [
                        'data' => $listData,
                        'options' => ['placeholder' => 'Search Medical Tests ...', 'multiple' => true],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false);
                    ?>
                </div>
            </div>
        </div>

        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Other Details<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'others')->textArea(['class' => 'form-control', 'rows' => '2'])->label(false); ?>
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
                                    <input type="text" id="medicineshopmaster-open_time" class="form-control" name="DiagnosticCentre[open_time]">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                                <div class="help-block"></div>
                            </div>
                            <div class="col-md-6">
                                <div class='input-group date timepicker'>
                                    <input type="text" id="medicineshopmaster-close_time" class="form-control" name="DiagnosticCentre[close_time]">
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
                <label class="control-label col-md-3">Contact No<span class="required">*</span></label>
                <div class="col-md-6">
                    <div class="main_contact_div">
                        <div>
                            <div class="row row_0">
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="contact_no[]" value="">
                                </div>
                                <div class="col-md-4">
                                    <div class="btn-group btn-group-solid">
                                        <button type="button" class="btn btn-success" style="font-size:17px;" onclick="addPhone();">
                                            + ADD MORE
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="help-block"></div>
                        </div>

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
                    </div>
                </div>
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">E-report <span class="required">*</span></label>
            <div class="col-md-6">
                <div class="radio-list">                        
                    <label class="radio-inline">
                        <?php
                        echo $form->field($model, 'e_report')->radioList(['1' => 'Yes', '0' => 'No'])->label(false);
                        ?>
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Home Collection <span class="required">*</span></label>
            <div class="col-md-6">
                <div class="radio-list">                        
                    <label class="radio-inline">
                        <?php
                        echo $form->field($model, 'home_collection')->radioList(['1' => 'Yes', '0' => 'No'])->label(false);
                        ?>
                    </label>
                </div>
            </div>
        </div>


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



        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn green']) ?>
                    <a href="<?php echo Url::to(['diagnosticcentre/index']); ?>" class="btn default">Back</a>
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
            format: 'LT',
        });
        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    });
    var global_val = 1;
    function addPhone() {
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
    currentlat = 20.5937;               //// india lat and long
    currentlong = 78.9629;
    message = false;
    function geocodeLatLng(currentlat, currentlong) {
        var latlng = {lat: parseFloat(currentlat), lng: parseFloat(currentlong)};
        geocoder.geocode({'location': latlng}, function (results, status) {
            if (status === 'OK') {
                if (results[0]) {
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
        document.getElementById('diagnosticcentre-latitude').value = currentlat;
        document.getElementById('diagnosticcentre-longitude').value = currentlong;
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
            document.getElementById('diagnosticcentre-latitude').value = marker.getPosition().lat();
            document.getElementById('diagnosticcentre-longitude').value = marker.getPosition().lng();
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
            document.getElementById('diagnosticcentre-latitude').value = place.geometry.location.lat();
            document.getElementById('diagnosticcentre-longitude').value = place.geometry.location.lng();
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
        document.getElementById('diagnosticcentre-latitude').value = event.latLng.lat();
        document.getElementById('diagnosticcentre-longitude').value = event.latLng.lng();
    }
/////////////////////////////map script end/////////////////////////// 
</script>


