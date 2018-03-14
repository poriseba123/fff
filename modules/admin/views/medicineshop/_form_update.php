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
                    'id' => 'update_medicine_shop_form',
                    'options' => ['class' => 'form-horizontal form-row-seperated', 'enctype' => 'multipart/form-data'],
                    'enableClientValidation' => false
                ])
        ?>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Name<span class="required">*</span></label>
                <div class="col-md-6">
                    <input type="hidden" name="medicine_shop_id" value="<?= $model->id ?>">
                    <?= $form->field($model, 'name')->textInput(['class' => 'form-control'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Medicine shop type<span class="required">*</span></label>
                <div class="col-md-6">
                    <?php
                    $type = app\models\DoctorType::find()->all();
                    $listData = ArrayHelper::map($type, 'id', 'type');
                    echo $form->field($model, 'category_id')->dropDownList($listData, ['prompt' => 'Select Medicine Type'])->label(false);
                    ?>
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
                <label class="control-label col-md-3">Pin<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'pin')->textInput(['class' => 'form-control'])->label(false); ?>
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
                    echo $form->field($model, 'country_id')->widget(Select2::classname(), [
                        'data' => $listData,
                        'options' => ['placeholder' => 'Search Country', 'multiple' => false, 'onchange' => '
                        $.post("' . Url::to(['dashboard/getstates']) . '?id=' . '"+$(this).val(),function(data){
                          $("select#medicineshopmaster-state_id").html(data);
                        });'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'tags' => true,
                        ],
                    ])->label(false);
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
                    echo $form->field($model, 'state_id')->widget(Select2::classname(), [
                        'data' => $listData,
                        'options' => ['placeholder' => 'Search State', 'multiple' => false, 'onchange' =>
                            '$.post("' . Url::to(['dashboard/getdistricts']) . '?id=' . '"+$(this).val(),function(data){
                         $("select#medicineshopmaster-district_id").html(data);
                        });'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'tags' => true,
                        ],
                    ])->label(false);
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
                    echo $form->field($model, 'district_id')->widget(Select2::classname(), [
                        'data' => $listData,
                        'options' => ['placeholder' => 'Search District', 'multiple' => false, 'onchange' =>
                            '$.post("' . Url::to(['dashboard/getcities']) . '?id=' . '"+$(this).val(),function(data){
                         $("select#medicineshopmaster-city_id").html(data);
                        });'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'tags' => true,
                        ],
                    ])->label(false);
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
                    echo $form->field($model, 'city_id')->widget(Select2::classname(), [
                        'data' => $listData,
                        'options' => ['placeholder' => 'Search City', 'multiple' => false],
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
                <label class="control-label col-md-3">Map<span class="required">*</span></label>
                <div class="col-md-6">
                    <input id="pac-input" class="pac-input form-control controls1" value="" type="text" placeholder="Search Box"><br>
                    <div id="map" class="map" style="height: 324px;width: 100%;"></div>
                </div>
                <div class="col-md-3">
                    <div class="btn-group btn-group-solid">
                        <button type="button" class="btn btn-success" style="font-size:17px;" onclick="getLocation();">
                            MY LOCATION
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label class="control-label col-md-3">Lat(First one)</label>
                                <input type="text" id="medicineshopmaster-latitude" class="latitude form-control" name="MedicineShopMaster[latitude]" value="<?= $model->latitude ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="control-label col-md-3">Long(Second one)</label>
                                <input type="text" id="medicineshopmaster-longitude" class="longitude form-control" name="MedicineShopMaster[longitude]" value="<?= $model->longitude ?>">
                            </div>
                        </div>

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
                                    <input type="text" id="medicineshopmaster-open_time" class="form-control" name="MedicineShopMaster[open_time]" value="<?= $model->open_time ?>">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                                <div class="help-block"></div>
                            </div>
                            <div class="col-md-6">
                                <div class='input-group date timepicker'>
                                    <input type="text" id="medicineshopmaster-close_time" class="form-control" name="MedicineShopMaster[close_time]" value="<?= $model->close_time ?>">
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
                        <img src="<?= Yii::$app->request->baseUrl . '\uploads\medicineshop\\' . $model->image ?>" class="thumb-image" style="height: 80px;">
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
                    <a href="<?php echo Url::to(['medicineshop/index']); ?>" class="btn default">Back</a>
                </div>
            </div>
        </div>
        <?php ActiveForm::end() ?>
        <!-- END FORM-->
    </div>
</div>
<script>
    state_id = "<?php echo $model->state_id ?>";
    district_id = "<?php echo $model->district_id ?>";
    city_id = "<?php echo $model->city_id ?>";

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

</script>



