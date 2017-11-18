<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
$contactmodel = $data['contactmodel'];
$model = $data['model'];
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
                    'options' => ['class' => 'form-horizontal form-row-seperated'],
                    'enableClientValidation' => false
                ])
        ?>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Country<span class="required">*</span></label>
                <div class="col-md-6">
                    <?php
                    $country_list = \app\models\Countries::find()->all();
                    $listData = ArrayHelper::map($country_list, 'id', 'name');
                    echo $form->field($model, 'country_id', ['enableAjaxValidation' => true])->dropDownList($listData, ['prompt' => 'Select', 'onchange' => '
                    $.post("getstates?id=' . '"+$(this).val(),function(data){
                      $("select#ambulancemaster-state_id").html(data);
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
                    echo $form->field($model, 'state_id', ['enableAjaxValidation' => true])->dropDownList($listData, ['prompt' => 'Select', 'onchange' => '
                    $.post("getcities?id=' . '"+$(this).val(),function(data){
                      $("select#ambulancemaster-city_id").html(data);
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
                    echo $form->field($model, 'city_id', ['enableAjaxValidation' => true])->dropDownList($listData, ['prompt' => 'Select'])->label(false);
                    ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Title<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'title', ['enableAjaxValidation' => true])->textInput(['class' => 'form-control'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Vehicle number <span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'vehiclenumber', ['enableAjaxValidation' => true])->textInput(['class' => 'form-control'])->label(false); ?>
                </div>
            </div>
        </div>
        <?php
        if ($model->isNewRecord) {
            ?>
            <div class="form-body" id="contactdiv">
                <div class="form-group contactdivmain">
                    <label class="control-label col-md-3">Contact Number<span class="required">*</span></label>
                    <div class="col-md-6">
                        <?= $form->field($contactmodel, 'contact_number[]', ['enableAjaxValidation' => true])->textInput(['class' => 'form-control contact', "id" => 'contactid'])->label(false); ?>
    <!--                    <input type="text" name="ambulancecontact[]" class="form-control" id="contact1" value="">-->
                        <!--                    <div class="help-block" id="errorcontactid"></div>-->
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-success addContact" style="font-size:17px;">
                            + ADD MORE
                        </button>
                    </div>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="form-body" id="contactdiv">
                <div class="form-group contactdivmain">
                    <label class="control-label col-md-3">Contact Number<span class="required">*</span></label>
                    <div class="col-md-6">
                        <?php 
                        //$form->field($contactmodel, 'contact_number[]', ['enableAjaxValidation' => true])->textInput(['class' => 'form-control contact', "id" => 'contactid'])->label(false); ?>
  
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-success addContact" style="font-size:17px;">
                            + ADD MORE
                        </button>
                    </div>
                </div>
            </div>
        <?php }
        ?>


        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Address<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'address', ['enableAjaxValidation' => true])->textArea(['class' => 'form-control', 'rows' => '6'])->label(false); ?>
                </div>
            </div>
        </div>
        <!--        <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Add map location</label>
                        <div class="col-md-6">
                            <a href="javascript:void(0)" class="google_map">Click here</a>
                        </div>
                    </div>
                </div>-->
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Location in Map<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'lat', ['enableAjaxValidation' => true])->hiddenInput(['class' => 'form-control', 'id' => 'lat'])->label(false); ?>
                    <?= $form->field($model, 'longi', ['enableAjaxValidation' => true])->hiddenInput(['class' => 'form-control', 'id' => 'long'])->label(false); ?>
                    <input id="pac-input" class="form-control controls1" type="text" placeholder="Search Box"><br>
                    <div id="map" style="height: 324px;width: 100%;"></div>

                </div>
            </div>
        </div>


        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">24X7 Available<span class="required">*</span></label>
                <div class="col-md-6">
                    <?php
                    if ($model->isNewRecord) {
                        $model->all_time = '0';
                    }
                    if ($model->all_time == 0) :
                        ?>
                        <?= $form->field($model, 'all_time')->radioList(['0' => 'No', '1' => 'Yes'])->label(false) ?>
                    <?php else : ?>
                        <?= $form->field($model, 'all_time')->radioList(['1' => 'Yes', '0' => 'No'])->label(false) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Oxygen<span class="required">*</span></label>
                <div class="col-md-6">
                    <?php
                    if ($model->isNewRecord) {
                        $model->oxygen = '0';
                    }
                    if ($model->oxygen == 0) :
                        ?>
                        <?= $form->field($model, 'oxygen')->radioList(['0' => 'Not Available', '1' => 'Available'])->label(false) ?>
                    <?php else : ?>
                        <?= $form->field($model, 'oxygen')->radioList(['1' => 'Available', '0' => 'Not Available'])->label(false) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">AC<span class="required">*</span></label>
                <div class="col-md-6">
                    <?php
                    if ($model->isNewRecord) {
                        $model->ac = '0';
                    }
                    if ($model->ac == 0) :
                        ?>
                        <?= $form->field($model, 'ac')->radioList(['0' => 'No', '1' => 'Yes'])->label(false) ?>
                    <?php else : ?>
                        <?= $form->field($model, 'ac')->radioList(['1' => 'Yes', '0' => 'No'])->label(false) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Status<span class="required">*</span></label>
                <div class="col-md-6">
                    <?php
                    if ($model->isNewRecord) {
                        $model->status = '1';
                    }
                    if ($model->status == 0) :
                        ?>
                        <?= $form->field($model, 'status')->radioList(['0' => 'Inactive', '1' => 'Active'])->label(false) ?>
                    <?php else : ?>
                        <?= $form->field($model, 'status')->radioList(['1' => 'Active', '0' => 'Inactive'])->label(false) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn green']) ?>
                    <a href="<?php echo Url::to(['ambulancemaster/index']); ?>" class="btn default">Back</a>
                </div>
            </div>
        </div>
        <?php ActiveForm::end() ?>
        <!-- END FORM-->
    </div>
</div>
<script>

    function initAutocomplete() {
        var myLatlng = new google.maps.LatLng(22, 79);
        var myOptions = {
            zoom: 5,
            center: myLatlng,
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        var map = new google.maps.Map(document.getElementById("map"), myOptions),
                marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    draggable: true,
                });
        google.maps.event.addListener(marker, 'dragend', function () {
            document.getElementById('lat').value = marker.getPosition().lat();
            document.getElementById('long').value = marker.getPosition().lng();
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
        document.getElementById('lat').value = marker.getPosition().lat();
        document.getElementById('long').value = marker.getPosition().lng();
        marker.addListener('drag', handleEvent);
        marker.addListener('dragend', handleEvent);
    }
    function handleEvent(event) {
        document.getElementById('lat').value = event.latLng.lat();
        document.getElementById('long').value = event.latLng.lng();
    }
    global_val = 1;
    $('.addContact').click(function () {
        global_val++;
        if (global_val <= 4) {
            $("#contactdiv").append('<div class="form-group content" id="container-' + global_val + '"><label class="control-label col-md-3">Alternate Number</label><div class="col-md-6">' +
                    '<input type="text" name="AmbulanceContact[contact_number][]" class="form-control contacts" id="contact' + global_val + '" value=""><div class="help-block" id="error' + global_val + '"></div></div>' +
                    '<div class="col-md-3">' +
                    '<button type="button" class="btn btn-danger" style="font-size:17px;" id="' + global_val + '"onclick="removeRow(' + global_val + ')">X</button>' +
                    '</div>' +
                    '</div></div>');
        }


    });

    function removeRow(id) {
        //$('#container-' + id).removeClass("has-error");
        $('#container-' + id).remove();
        global_val--;
    }
    $("#w1").submit(function () {
        lat_error = 0;
        if ($("#lat").val().replace(/^\s+|\s+$/g, "").length == 0) {
            lat_error = 1;
        }
        if ($("#long").val().replace(/^\s+|\s+$/g, "").length == 0) {
            lat_error = 1;
        }
        if (global_val > 1) {
            has_error = 0;
            $("div.content").each(function (e) {
                //alert(e)
                obj = $(this);
                containerId = $(this).attr('id');
                temp = containerId.split("-");
                if ($("#contact" + temp[1]).val().replace(/^\s+|\s+$/g, "").length == 0) {
                    $(obj).addClass("has-error");
                    $("#error" + temp[1]).html("Alternat contact number required.");
                    has_error++;

                } else {
                    $(obj).removeClass("has-error");
                    $("#error" + temp[1]).html("");
                    has_error--;
                }

            });
            if (lat_error == 1) {
                $("#pac-input").css('border', 'red');
                $("#pac-input").focus();
            }
            if ((has_error != 0) && (lat_error != 0)) {
                return false;
            }
        }
    })
</script>
