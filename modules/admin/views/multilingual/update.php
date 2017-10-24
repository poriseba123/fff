<?php
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<?php
$this->title = 'Manage Multilingual Messages';
$this->params['breadcrumbs'][] = ["label" => $this->title, "url" => ["index"]];
$this->title = 'Update';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="page-title"> Update Multilingual Message</h1>
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
                            <h4><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update Multilingual Message</h4>
                        </div>
                        <div class="listing view-content">
                            <?php
                            $form = ActiveForm::begin([
                                        'options' => ['class' => ''],
                                        'enableClientValidation' => false
                                    ])
                            ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group clearfix">
                                        <label class="col-md-2 control-label text-primary">Message</label>
                                        <div class="col-md-10">
                                            <?= $form->field($modelSourceMessage, 'message')->textInput(['class' => 'form-control', 'disabled' => 'disabled'])->label(false); ?>
                                        </div>
                                    </div>
                                    <?php if(isset($model['en'])) : ?>
                                    <div class="form-group clearfix">
                                        <label class="col-md-2 control-label text-primary">English Message</label>
                                        <div class="col-md-10">
                                            <?= $form->field($model['en'], 'translation_en')->textInput(['class' => 'form-control'])->label(false); ?>
                                        </div>
                                    </div>
                                    <?php endif;?>
                                    <?php if(isset($model['es'])) : ?>
                                    <div class="form-group clearfix">
                                        <label class="col-md-2 control-label text-primary">Spanish Message</label>
                                        <div class="col-md-10">
                                            <?= $form->field($model['es'], 'translation_es')->textInput(['class' => 'form-control'])->label(false); ?>
                                        </div>
                                    </div>
                                    <?php endif;?>
                                    <div class="action-result-div text-right">
                                        <a href="<?= $this->context->adminUrl('multilingual/')  ?>" class="btn btn-default pull-left">Back</a>
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