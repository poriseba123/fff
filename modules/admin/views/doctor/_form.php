<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

if (!$model->isNewRecord) {
    $model = $data['model'];
    $doc_type = $data['doc_type'];
}
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
    .radio-inline label{
        margin-right:30px;
    }

</style>
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
                <label class="control-label col-md-3">First Name<span class="required">*</span></label>
                <div class="col-md-6">
<?= $form->field($model, 'first_name')->textInput(['class' => 'form-control'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Last Name<span class="required">*</span></label>
                <div class="col-md-6">
<?= $form->field($model, 'last_name')->textInput(['class' => 'form-control'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Doctor type<span class="required">*</span></label>
                <div class="col-md-6">
                    <?php
                    $listData = ArrayHelper::map($doc_type, 'id', 'type');
                    echo $form->field($model, 'doctor_type_id')->dropDownList($listData, ['prompt' => 'Select', 'onchange' => '
                    $.post("getspecialities?id=' . '"+$(this).val(),function(data){
                      $("select#doctormaster-doctor_specialities_id").html(data);
                    });'])->label(false);
                    ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Doctor Specialities<span class="required">*</span></label>
                <div class="col-md-6">
<?= $form->field($model, 'doctor_specialities_id')->dropDownList(ArrayHelper::map(app\models\DoctorSpecialities::find()->all(), 'id', 'speciality'), ['prompt' => 'Select Specialities'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Registration No<span class="required">*</span></label>
                <div class="col-md-6">
<?= $form->field($model, 'registration_no')->textInput(['class' => 'form-control'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Email<span class="required">*</span></label>
                <div class="col-md-6">
<?= $form->field($model, 'email')->textInput(['class' => 'form-control'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Mobile No<span class="required">*</span></label>
                <div class="col-md-6">
<?= $form->field($model, 'mobile_no')->textInput(['class' => 'form-control'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Description<span class="required">*</span></label>
                <div class="col-md-6">
<?= $form->field($model, 'description')->textArea(['class' => 'form-control', 'rows' => '6'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">keywords<span class="required">*</span></label>
                <div class="col-md-6">
<?= $form->field($model, 'keywords')->textInput(['class' => 'form-control'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Gender <span class="required">*</span></label>
                <div class="col-md-6">
                    <div class="radio-list">                        
                        <label class="radio-inline">
<?php
echo $form->field($model, 'gender')->radioList(['0' => 'Unknown', '1' => 'Male', '2' => 'Female'])->label(false);
?>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Home Visit <span class="required">*</span></label>
                <div class="col-md-6">
                    <div class="radio-list">                        
                        <label class="radio-inline">
<?php
echo $form->field($model, 'home_visit')->radioList(['0' => 'Unknown', '1' => 'Yes', '2' => 'No'])->label(false);
?>
                        </label>
                    </div>
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
