<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

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
                    'options' => ['class' => 'form-horizontal form-row-seperated'],
                    'enableClientValidation' => false
                ])
        ?>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Title</label>
                <div class="col-md-6">
                    <?= $form->field($model, 'title')->textInput(['class' => 'form-control'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <div class="portlet-title">
                    <div class="caption" align="center">
                        <i class="fa fa-plus font-green-haze" aria-hidden="true"></i>

                        <span class="caption-subject font-blue-madison bold uppercase">
                            Click to add Contact number           
                        </span>
                    </div>
                </div>
                <label class="control-label col-md-3">Contact Number</label>
                <div class="col-md-6">
                    <?= $form->field($model, 'title')->textInput(['class' => 'form-control'])->label(false); ?>
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
                    <input id="pac-input" class="form-control controls1" type="text" placeholder="Search Box"><br>
                    <div id="map" style="height: 324px;width: 100%;"></div>
                    <?= $form->field($model, 'lat')->hiddenInput(['class' => 'form-control', 'id' => 'lat'])->label(false); ?>
                    <?= $form->field($model, 'longi')->hiddenInput(['class' => 'form-control', 'id' => 'long'])->label(false); ?>
                </div>
            </div>
        </div>


        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">24X7 Available</label>
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
                <label class="control-label col-md-3">Oxygen</label>
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
                <label class="control-label col-md-3">Ac</label>
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
                <label class="control-label col-md-3">Status</label>
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

        marker.addListener('drag', handleEvent);
        marker.addListener('dragend', handleEvent);
    }
    function handleEvent(event) {
        document.getElementById('lat').value = event.latLng.lat();
        document.getElementById('long').value = event.latLng.lng();
    }
</script>