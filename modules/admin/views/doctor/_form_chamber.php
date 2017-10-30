<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
if(!$model->isNewRecord){
$model=$data['model'];
$doctor_chamber_time=$data['doctor_chamber_time'];
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
                <label class="control-label col-md-3">Chamber Name<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'chamber_name')->textInput(['class' => 'form-control'])->label(false); ?>
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
                    $country_list= \app\models\Countries::find()->all();
                    $listData=ArrayHelper::map($country_list,'id','name');
                    echo $form->field($model, 'country_id')->dropDownList($listData,['prompt'=>'Select','onchange' => '
                    $.post("getstates?id=' . '"+$(this).val(),function(data){
                      $("select#doctorchamber-state_id").html(data);
                    });'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">State<span class="required">*</span></label>
                <div class="col-md-6">
                    <?php 
                    $state_list= \app\models\States::find()->where(["id"=>0])->all();
                    $listData=ArrayHelper::map($state_list,'id','name');
                    echo $form->field($model, 'state_id')->dropDownList($listData,['prompt'=>'Select','onchange' => '
                    $.post("getcities?id=' . '"+$(this).val(),function(data){
                      $("select#doctorchamber-city_id").html(data);
                    });'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">City<span class="required">*</span></label>
                <div class="col-md-6">
                    <?php 
                    $city_list= \app\models\Cities::find()->where(["id"=>0])->all();
                    $listData=ArrayHelper::map($city_list,'id','name');
                    echo $form->field($model, 'city_id')->dropDownList($listData,['prompt'=>'Select'])->label(false); ?>
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
