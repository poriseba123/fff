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
        //echo $model->logo_image;
        $form = ActiveForm::begin([
                    'id' => 'update_image_form',
                    'options' => ['class' => 'form-horizontal form-row-seperated', 'enctype' => 'multipart/form-data'],
                    'enableClientValidation' => false
                ])
                
        ?>

        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Logo Image <span class="required">*</span></label>
                <div class="col-md-6">
                    <?php echo $form->field($model, 'logo_image')->fileInput(['class' => 'form-control image-input', 'placeholder' => 'Choose Image'])->label(false); ?>
                </div>
                <div class="col-md-3">
                    <div class="form-group text-center" id='preview-img-holder'>
                        <img src="<?= Yii::$app->request->baseUrl . '../../\uploads\logoslider\thumbnail\\' . $model->logo_image ?>" class="img-thumbnail thumb-image" style="height: 80px;">
                    </div>
                </div>
                <div class="help-block" id="err-image"></div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Slider Image 1<span class="required">*</span></label>
                <div class="col-md-6">
                    <?php echo $form->field($model, 'slider_image1')->fileInput(['class' => 'form-control image-input', 'placeholder' => 'Choose Image'])->label(false); ?>
                </div>
                <div class="col-md-3">
                    <div class="form-group text-center" id='preview-img-holder'>
                        <img src="<?= Yii::$app->request->baseUrl . '../../\uploads\logoslider\thumbnail\\' . $model->slider_image1 ?>" class="img-thumbnail thumb-image" style="height: 80px;">
                    </div>
                </div>
                <div class="help-block" id="err-image"></div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Slider Image 2<span class="required">*</span></label>
                <div class="col-md-6">
                    <?php echo $form->field($model, 'slider_image2')->fileInput(['class' => 'form-control image-input', 'placeholder' => 'Choose Image'])->label(false); ?>
                </div>
                <div class="col-md-3">
                    <div class="form-group text-center" id='preview-img-holder'>
                        <img src="<?= Yii::$app->request->baseUrl . '../../\uploads\logoslider\thumbnail\\' . $model->slider_image2 ?>" class="img-thumbnail thumb-image" style="height: 80px;">
                    </div>
                </div>
                <div class="help-block" id="err-image"></div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Slider Image 3<span class="required">*</span></label>
                <div class="col-md-6">
                    <?php echo $form->field($model, 'slider_image3')->fileInput(['class' => 'form-control image-input', 'placeholder' => 'Choose Image'])->label(false); ?>
                </div>
                <div class="col-md-3">
                    <div class="form-group text-center" id='preview-img-holder'>
                        <img src="<?= Yii::$app->request->baseUrl . '../../\uploads\logoslider\thumbnail\\' . $model->slider_image3 ?>" class="img-thumbnail thumb-image" style="height: 80px;">
                    </div>
                </div>
                <div class="help-block" id="err-image"></div>
            </div>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">Slider Image 4<span class="required">*</span></label>
                <div class="col-md-6">
                    <?php echo $form->field($model, 'slider_image4')->fileInput(['class' => 'form-control image-input', 'placeholder' => 'Choose Image'])->label(false); ?>
                </div>
                <div class="col-md-3">
                    <div class="form-group text-center" id='preview-img-holder'>
                      
                        <img src="<?= Yii::$app->request->baseUrl . '../../\uploads\logoslider\thumbnail\\' . $model->slider_image4 ?>" class="img-thumbnail thumb-image" style="height: 80px;">
                    </div>
                </div>
                <div class="help-block" id="err-image"></div>
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn green']) ?>
                    <a href="<?php echo Url::to(['homepagelogoslider/index']); ?>" class="btn default">Back</a>
                </div>
            </div>
        </div>
        <?php ActiveForm::end() ?>
        <!-- END FORM-->
    </div>
</div>



