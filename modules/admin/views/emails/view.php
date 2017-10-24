<?php
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<?php
$this->title = "Manage Email's";
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
                            <h4><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update Email Content</h4>
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
                                        <label class="col-md-2 control-label text-primary">Email Code</label>
                                        <div class="col-md-10">
                                            <?= $form->field($model, 'email_code')->textInput(['class' => 'form-control', 'disabled' => 'disabled'])->label(false); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label text-primary">Email About</label>
                                        <div class="col-md-10">
                                            <?= $form->field($model, 'about')->textInput(['class' => 'form-control'])->label(false); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label text-primary">Email Subject</label>
                                        <div class="col-md-10">
                                            <?= $form->field($model, 'subject')->textInput(['class' => 'form-control'])->label(false); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label text-primary">Email Variables</label>
                                        <div class="col-md-10">
                                            <div class="alert alert-info">
                                                <p style="border-bottom: 1px solid rgba(51, 122, 183, 0.21);padding-bottom: 5px;">
                                                    <?php echo $model->variable ?>
                                                </p>
                                                <p><strong>Note:&nbsp;</strong> Please don't change above variables from email body content.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label text-primary">Email Body</label>
                                        <div class="col-md-10">
                                            <?= $form->field($model, 'body')->textArea(['class' => 'ckeditor form-control'])->label(false); ?>
                                        </div>
                                    </div>
                                    <div class="action-result-div text-right">
                                        <button type="submit" class="btn btn-info">Save Details</button>
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