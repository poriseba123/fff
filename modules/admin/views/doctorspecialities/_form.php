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
                <label class="control-label col-md-3">speciality</label>
                <div class="col-md-6">
                    <?= $form->field($model, 'speciality')->textInput(['class' => 'form-control'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Description</label>
                <div class="col-md-6">
                    <?= $form->field($model, 'description')->textArea(['class' => 'form-control', 'rows' => '6'])->label(false); ?>
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
                    <a href="<?php echo Url::to(['doctorspecialities/index']); ?>" class="btn default">Back</a>
                </div>
            </div>
        </div>
        <?php ActiveForm::end() ?>
        <!-- END FORM-->
    </div>
</div>
