<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use dosamigos\ckeditor\CKEditor;

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
                    'id' => 'create_homepage_form',
                    'options' => ['class' => 'form-horizontal form-row-seperated', 'enctype' => 'multipart/form-data'],
                    'enableClientValidation' => false
                ])
        ?>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Heading<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'heading')->textInput(['class' => 'form-control'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Tagline<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'tagline')->textArea(['class' => 'ckeditor form-control ', 'rows' => '2'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Listing Heading<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'listing_line')->textArea(['class' => 'ckeditor form-control ', 'rows' => '2'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Slider Heading<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'slider_line')->textArea(['class' => 'ckeditor form-control ', 'rows' => '2'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Subscription Heading<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'subscription_line')->textArea(['class' => 'ckeditor form-control ', 'rows' => '2'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Youtube url<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'youtube_url')->textInput(['class' => 'form-control'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">About Us<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'about_us')->textArea(['class' => 'ckeditor form-control ', 'rows' => '2'])->label(false); ?>


                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Terms of Use<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'tearmsof_use')->textArea(['class' => 'ckeditor form-control ', 'rows' => '2'])->label(false); ?>


                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Privacy Policy<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'privacy_policy')->textArea(['class' => 'ckeditor form-control ', 'rows' => '2'])->label(false); ?>


                </div>
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn green']) ?>
                    <a href="<?php echo Url::to(['landingpage/index']); ?>" class="btn default">Back</a>
                </div>
            </div>
        </div>
        <?php ActiveForm::end() ?>
        <!-- END FORM-->
    </div>
</div>





