<?php
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<?php
$form = ActiveForm::begin([
            'options' => ['class' => '', 'enctype' => 'multipart/form-data'],
            'enableClientValidation' => false
        ])
?>
<div class="row">
    <div class="col-sm-10 col-md-offset-1">
        <div class="form-group">
            <label class="col-md-2 control-label text-primary">Page Slug</label>
            <div class="col-md-10">
                <?= $form->field($model, 'slug')->textInput(['class' => 'form-control', 'disabled' => 'disabled'])->label(false); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label text-primary">Page Title</label>
            <div class="col-md-10">
                <?= $form->field($model, 'title')->textInput(['class' => 'form-control'])->label(false); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label text-primary">Page Content</label>
            <div class="col-md-10">
                <?= $form->field($model, 'content')->textArea(['class' => 'ckeditor form-control'])->label(false); ?>
            </div>
        </div>
        <div class="action-result-div text-right">
            <button type="submit" class="btn btn-info">Save Details</button>
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>