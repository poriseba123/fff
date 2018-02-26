<?php

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<?php
$this->title = "Manage User Feedback";
$this->params['breadcrumbs'][] = ["label" => $this->title, "url" => ["index"]];
$this->title = 'View';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="page-title"> View Email Content</h1>
<div class="row">
    <div class="col-md-12">
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <?php if (Yii::$app->session->hasFlash('success-msg')) : ?>
                        <div class="alert alert-success" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!&nbsp;</strong>
                            <?= Yii::$app->session->getFlash('success-msg') ?>
                        </div>
                    <?php endif; ?>
                    <div class="portlet light ">
                        <div class="listing-view-title">
                            <h4><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Send Feed back.</h4>
                        </div>
                        <div class="listing view-content">
                            <?php
                            $form = ActiveForm::begin([
                                        'options' => ['class' => '', 'enctype' => 'multipart/form-data'],
                                        'enableClientValidation' => false
                                    ])
                            ?>
                            <div class="row">
                                <div class="col-sm-10 col-md-offset-1">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label text-primary">Name</label>
                                        <div class="col-md-10">
                                            <?= $form->field($model, 'name')->textInput(['class' => 'form-control'])->label(false); ?>
                                            <input type="hidden" name="ContactUs[status]" value="2">
                                            <input type="hidden" name="ContactUs[reply_date]" value="<?= date('Y-m-d H:i:s'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label text-primary">Email</label>
                                        <div class="col-md-10">
                                            <?= $form->field($model, 'email')->textInput(['class' => 'form-control'])->label(false); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label text-primary">Email Subject</label>
                                        <div class="col-md-10">
                                            <?= $form->field($model, 'subject')->textInput(['class' => 'form-control'])->label(false); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label text-primary">User Message</label>
                                        <div class="col-md-10">
                                            <?= $form->field($model, 'message')->textArea(['class' => 'ckeditor form-control'])->label(false); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label text-primary">Reply</label>
                                        <div class="col-md-10">
                                            <?php
                                            if ($model->status == '2') {
                                                echo $form->field($model, 'reply_message')->textArea(['class' => 'ckeditor form-control', 'disabled' => 'disabled'])->label(false);
                                            } else {
                                                echo $form->field($model, 'reply_message')->textArea(['class' => 'ckeditor form-control'])->label(false);
                                            }
                                            ?>

                                        </div>
                                    </div>
                                    <div class="action-result-div text-right">
                                        <button type="submit" class="btn btn-info">Send Reply</button>
                                    </div>
                                </div>
                            </div>
                            <?php ActiveForm::end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>