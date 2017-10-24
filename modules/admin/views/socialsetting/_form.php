<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa <?= $model->isNewRecord ? 'fa-plus' : 'fa-edit'; ?> font-green-haze" aria-hidden="true"></i>
            <span class="caption-subject font-green-haze bold uppercase"><?= Html::encode($this->title) ?></span>
        </div>
    </div>
    <div class="portlet-body form">
        <?php
        $form = ActiveForm::begin([
                    'options' => ['class' => 'form-horizontal form-row-seperated', 'enctype' => 'multipart/form-data'],
                    'enableClientValidation' => false
                ])
        ?>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">First Name <span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'first_name')->textInput(['class' => "form-control", 'placeholder' => "First Name"])->label(false); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Last Name <span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'last_name')->textInput(['class' => "form-control", 'placeholder' => "Last Name"])->label(false); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Email <span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'email')->input('email', ['class' => "form-control", 'placeholder' => "Email"])->label(false); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Address <span class="required">*</span></label>
                <div class="col-md-6" id="locationField">
                    <?= $form->field($user_det, 'address')->textInput(['class' => "form-control", 'placeholder' => "Address", 'id' => "autocomplete", 'onFocus' => "geolocate()", 'onkeyup' => "addressValue(this)"])->label(false); ?>
                </div>
                <?= $form->field($user_det, 'latitude')->hiddenInput([])->label(false); ?>
                <?= $form->field($user_det, 'longitude')->hiddenInput([])->label(false); ?>
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
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn green']) ?>
                    <a href="<?php echo Url::to(['users/index']); ?>" class="btn default">Back</a>
                </div>
            </div>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>
<script>
    function addressValue(obj) {
        if ($(obj).val() == '') {
            $("#userdetails-latitude").val('');
            $("#userdetails-longitude").val('');
        }
    }

    var placeSearch, autocomplete;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    function initAutocomplete() {
        autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                {types: ['geocode'], componentRestrictions: {}});
        autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
        var place = autocomplete.getPlace();
        $("#userdetails-latitude").val(place.geometry.location.lat());
        $("#userdetails-longitude").val(place.geometry.location.lng());
        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }
    }
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAnrNPdzVbo5XN6DV_GrQfFoF3fgyhu1hA&libraries=places&callback=initAutocomplete"
async defer></script>
