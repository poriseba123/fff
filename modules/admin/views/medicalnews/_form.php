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
                    'id' => 'create_medical_news_form',
                    'options' => ['class' => 'form-horizontal form-row-seperated', 'enctype' => 'multipart/form-data'],
                    'enableClientValidation' => false
                ])
        ?>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Link<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'link')->textInput(['class' => 'form-control'])->label(false); ?>
                </div>
            </div>
        </div>

        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Description<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'description')->textArea(['class' => 'form-control ', 'rows' => '2'])->label(false); ?>


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

        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Source<span class="required">*</span></label>
                <div class="col-md-6">
                    <?= $form->field($model, 'sourse')->textInput(['class' => 'form-control'])->label(false); ?>
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
                    <a href="<?php echo Url::to(['medicalnews/index']); ?>" class="btn default">Back</a>
                </div>
            </div>
        </div>
        <?php ActiveForm::end() ?>
        <!-- END FORM-->
    </div>
</div>
<script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.editorConfig = function (config) {
        config.language = 'es';
        config.uiColor = '#F7B42C';
        config.height = 300;
        config.toolbarCanCollapse = true;

    };
    CKEDITOR.replace('medicalnewsmaster-description');

</script>




