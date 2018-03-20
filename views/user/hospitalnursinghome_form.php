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
<style>
    .notActve{
        background-color: #FFF;
        color: #204d74;
    }
</style>
<div class="portlet light bordered form-fit">
    <div class="portlet-title">
        <!--        <div class="caption">
                    <i class="fa <?= $model->isNewRecord ? 'fa-plus' : 'fa-edit'; ?> font-green-haze" aria-hidden="true"></i>
        
                    <span class="caption-subject font-green-haze bold uppercase">
        <?= Html::encode($this->title) ?>
                    </span>
                </div>-->
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <?php
        $form = ActiveForm::begin([
                    'id' => 'create_hospitalnursinghome_form',
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
                <label class="control-label col-md-3">Type<span class="required">*</span></label>
                <div class="col-md-6">
                    <?php
                    $type_list = \app\models\Typeofhospital::find()->all();
                    $listData = ArrayHelper::map($type_list, 'id', 'name');
                    echo $form->field($model, 'type')->widget(Select2::classname(), [
                        'data' => $listData,
                        'options' => ['placeholder' => 'Search type', 'multiple' => false],
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
                <label class="control-label col-md-3">Units<span class="required">*</span></label>
                <div class="col-md-6">
                    <?php
                    $facility_list = \app\models\Hospitalfacility::find()->all();
                    $listData = ArrayHelper::map($facility_list, 'id', 'name');
                    echo $form->field($model, 'facility')->widget(Select2::classname(), [
                        'data' => $listData,
                        'options' => ['placeholder' => 'Search Units', 'multiple' => true],
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
                <label class="control-label col-md-3">Establishment Date<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'establishment_date')->textInput(['class' => 'form-control datepicker', 'id' => 'establishment_date'])->label(false); ?>

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
                <label class="control-label col-md-3">Pin<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'pin')->textInput(['class' => 'form-control', 'maxlength' => '6'])->label(false); ?>
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
                      $("select#hospitalnursingmaster-state_id").html(data);
                    });'],
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
                <label class="control-label col-md-3">State<span class="required">*</span></label>
                <div class="col-md-6">
                    <?php
                    $state_list = \app\models\States::find()->where(["id" => 0])->all();
                    $listData = ArrayHelper::map($state_list, 'id', 'name');
                    echo $form->field($model, 'state_id')->widget(Select2::classname(), [
                        'data' => $listData,
                        'options' => ['placeholder' => 'Search State', 'multiple' => false, 'onchange' =>
                            '$.post("' . Url::to(['dashboard/getdistricts']) . '?id=' . '"+$(this).val(),function(data){
                         $("select#hospitalnursingmaster-district_id").html(data);
                        });'],
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
                <label class="control-label col-md-3">District<span class="required">*</span></label>
                <div class="col-md-6">
                    <?php
                    $district_list = \app\models\Districts::find()->where(["id" => 0])->all();
                    $listData = ArrayHelper::map($district_list, 'id', 'name');
                    echo $form->field($model, 'district_id')->widget(Select2::classname(), [
                        'data' => $listData,
                        'options' => ['placeholder' => 'Search District', 'multiple' => false, 'onchange' =>
                            '$.post("' . Url::to(['dashboard/getcities']) . '?id=' . '"+$(this).val(),function(data){
                         $("select#hospitalnursingmaster-city_id").html(data);
                        });'],
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
                    <input id="pac-input" class="pac-input form-control controls1" type="text" placeholder="Search Box"><br>
                    <div id="map" class="map" style="height: 324px;width: 100%;"></div>
                </div>
                <!--                <div class="col-md-3">
                                    <div class="btn-group btn-group-solid">
                                        <button type="button" class="btn btn-success" style="font-size:17px;" onclick="getLocation();">
                                            MY LOCATION
                                        </button>
                                    </div>
                                </div>-->
                <div class="row">
                    <div class="col-md-3">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <!--                                <label class="control-label col-md-3">Lat(First one)</label>-->
                                <input type="hidden" id="hospitalnursingmaster-latitude" class="latitude form-control" name="HospitalNursingMaster[latitude]">
                            </div>
                            <div class="col-md-6">
                                <!--                                <label class="control-label col-md-3">Long(Second one)</label>-->
                                <input type="hidden" id="hospitalnursingmaster-longitude" class="longitude form-control" name="HospitalNursingMaster[longitude]">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Out door <span class="required">*</span></label>
            <div class="col-md-6">

                <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-primary btn-sm active outdore" data-toggle="hospitalnursingmaster-outdore" data-title="1">YES</a>
                        <a class="btn btn-primary btn-sm notActive outdore" data-toggle="hospitalnursingmaster-outdore" data-title="0">NO</a>
                    </div>
                    <input type="hidden" name="HospitalNursingMaster[outdore]" id="hospitalnursingmaster-outdore">
                </div>
                <!--                <div class="radio-list">                        
                                    <label class="radio-inline">
                <?php
                echo $form->field($model, 'outdore')->radioList(['1' => 'Yes', '0' => 'No'])->label(false);
                ?>
                                    </label>
                                </div>-->
            </div>
        </div>
        <div class="form-body showme" style="display: none;">
            <div class="form-group">
                <label class="control-label col-md-3">Out doer Time<span class="required">*</span></label>
                <div class="col-md-9">
                    <?php
                    $day_master = \app\models\DayMaster::find()->all();
                    foreach ($day_master as $key => $val) {
                        if ($val->id != '8') {
                            //echo $val;
                            ?>
                            <div class="daymaster_main_div">
                                <div class="row" style="margin-bottom:5px;">
                                    <div class="col-md-8 text-center">
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-success active">
                                                <input type="checkbox" name="dayMaster[]" autocomplete="off" checked value="<?= $val->id ?>">
                                                <span class="glyphicon glyphicon-ok"></span>&nbsp;<?= $val->day ?>
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
                                <div class="time <?= 'day_master_time_' . $val->id ?>" style="margin-bottom:5px;">
                                    <div class="row <?= 'each_time_' . $val->id . '_0' ?>">
                                        <div class="col-md-4">
                                            <div class='input-group date timepicker'>
                                                <input type='text' class="form-control" name="start_time[<?= $val->id ?>][]"/>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-time"></span>
                                                </span>
                                            </div>
                                            <div class="help-block"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class='input-group date timepicker'>
                                                <input type='text' class="form-control" name="end_time[<?= $val->id ?>][]"/>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-time"></span>
                                                </span>
                                            </div>
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
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Description<span class="required">*</span></label>
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
                <div class="form-group">
                    <label class="control-label col-md-3">Featured Image<span class="required">*</span></label> 
                    <div class="col-md-9">
                        <input class="file" id="featured-img" type="file" name="HospitalNursingMaster[image]"><br>
                    </div>
                </div>
                <div class="help-block"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3">Emergency Word<span class="required">*</span></label>
            <div class="col-md-6">
                <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-primary btn-sm active" data-toggle="hospitalnursingmaster-emergency" data-title="1">YES</a>
                        <a class="btn btn-primary btn-sm notActive" data-toggle="hospitalnursingmaster-emergency" data-title="0">NO</a>
                    </div>
                    <input type="hidden" name="HospitalNursingMaster[emergency]" id="hospitalnursingmaster-emergency">
                </div>
                <!--                <div class="radio-list">                        
                                    <label class="radio-inline">
                <?php
                echo $form->field($model, 'emergency')->radioList(['1' => 'Yes', '0' => 'No'])->label(false);
                ?>
                                    </label>
                                </div>-->
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">OT <span class="required">*</span></label>
            <div class="col-md-6">
                <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-primary btn-sm active" data-toggle="hospitalnursingmaster-ot" data-title="1">YES</a>
                        <a class="btn btn-primary btn-sm notActive" data-toggle="hospitalnursingmaster-ot" data-title="0">NO</a>
                    </div>
                    <input type="hidden" name="HospitalNursingMaster[ot]" id="hospitalnursingmaster-ot">
                </div>
                <!--                <div class="radio-list">                        
                                    <label class="radio-inline">
                <?php
                echo $form->field($model, 'ot')->radioList(['1' => 'Yes', '0' => 'No'])->label(false);
                ?>
                                    </label>
                                </div>-->
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Life support <span class="required">*</span></label>
            <div class="col-md-6">
                <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-primary btn-sm active" data-toggle="hospitalnursingmaster-life_support" data-title="1">YES</a>
                        <a class="btn btn-primary btn-sm notActive" data-toggle="hospitalnursingmaster-life_support" data-title="0">NO</a>
                    </div>
                    <input type="hidden" name="HospitalNursingMaster[life_support]" id="hospitalnursingmaster-life_support">
                </div>
                <!--                <div class="radio-list">                        
                                    <label class="radio-inline">
                <?php
                echo $form->field($model, 'life_support')->radioList(['1' => 'Yes', '0' => 'No'])->label(false);
                ?>
                                    </label>
                                </div>-->
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Ambulance Service<span class="required">*</span></label>
            <div class="col-md-6">
                <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-primary btn-sm active" data-toggle="hospitalnursingmaster-ambulance" data-title="1">YES</a>
                        <a class="btn btn-primary btn-sm notActive" data-toggle="hospitalnursingmaster-ambulance" data-title="0">NO</a>
                    </div>
                    <input type="hidden" name="HospitalNursingMaster[ambulance]" id="hospitalnursingmaster-ambulance">
                </div>
                <!--                <div class="radio-list">                        
                                    <label class="radio-inline">
                <?php
                echo $form->field($model, 'ambulance')->radioList(['1' => 'Yes', '0' => 'No'])->label(false);
                ?>
                                    </label>
                                </div>-->
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Own medicine shop <span class="required">*</span></label>
            <div class="col-md-6">
                <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-primary btn-sm active" data-toggle="hospitalnursingmaster-medicine_shop" data-title="1">YES</a>
                        <a class="btn btn-primary btn-sm notActive" data-toggle="hospitalnursingmaster-medicine_shop" data-title="0">NO</a>
                    </div>
                    <input type="hidden" name="HospitalNursingMaster[medicine_shop]" id="hospitalnursingmaster-medicine_shop">
                </div>
                <!--                <div class="radio-list">                        
                                    <label class="radio-inline">
                <?php
                echo $form->field($model, 'medicine_shop')->radioList(['1' => 'Yes', '0' => 'No'])->label(false);
                ?>
                                    </label>
                                </div>-->
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Payment accepted other than cash <span class="required">*</span></label>
            <div class="col-md-6">
                <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-primary btn-sm active" data-toggle="hospitalnursingmaster-payment_otherthancash" data-title="1">YES</a>
                        <a class="btn btn-primary btn-sm notActive" data-toggle="hospitalnursingmaster-payment_otherthancash" data-title="0">NO</a>
                    </div>
                    <input type="hidden" name="HospitalNursingMaster[payment_otherthancash]" id="hospitalnursingmaster-payment_otherthancash">
                </div>
                <!--                <div class="radio-list">                        
                                    <label class="radio-inline">
                <?php
                echo $form->field($model, 'payment_otherthancash')->radioList(['1' => 'Yes', '0' => 'No'])->label(false);
                ?>
                                    </label>
                                </div>-->
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3">Status <span class="required">*</span></label>
            <div class="col-md-6">
                <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-primary btn-sm active" data-toggle="hospitalnursingmaster-status" data-title="1">YES</a>
                        <a class="btn btn-primary btn-sm notActive" data-toggle="hospitalnursingmaster-status" data-title="0">NO</a>
                    </div>
                    <input type="hidden" name="HospitalNursingMaster[status]" id="hospitalnursingmaster-status">
                </div>
                <!--                <div class="radio-list">                        
                                    <label class="radio-inline">
                <?php
                echo $form->field($model, 'status')->radioList(['1' => 'Active', '0' => 'Inactive'])->label(false);
                ?>
                                    </label>
                                </div>-->
            </div>
        </div>


        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-info']) ?>
                    <a href="" class="btn btn-warning">Reload</a>
                </div>
            </div>
        </div>
        <?php ActiveForm::end() ?>
        <!-- END FORM-->
    </div>
</div>
<script>
<?php
if ($model->isNewRecord) {
    ?>
        currentlat = 20.5937;               //// india lat and long
        currentlong = 78.9629;
<?php } else { ?>
        currentlat = '<?= $model->latitude; ?>';               //// india lat and long
        currentlong = '<?= $model->longitude; ?>';
    <?php
}
?>
</script>



