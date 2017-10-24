<?php

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?= $this->context->adminUrl('dashboard/') ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="<?= $this->context->adminUrl('users/') ?>">Users</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Update Profile</span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Tody's Date">
            <i class="icon-calendar"></i>&nbsp;
            <span class=""><?= date('F', strtotime(date('Y-m-d'))) . ' ' . date('d', strtotime(date('Y-m-d'))) . ', ' . date('Y', strtotime(date('Y-m-d'))) ?></span>&nbsp;
        </div>
    </div>
</div>
<h1 class="page-title"> View User Profile
</h1>
<div class="row">
    <div class="col-md-12">
        <div class="profile-sidebar">
            <div class="portlet light profile-sidebar-portlet ">
                <div class="profile-userpic">
                    <img src="<?= $this->context->getProfilePicture($model->image) ?>" onerror="this.src='<?= $this->context->getProfileImgErrorImg() ?>'" class="img-responsive" alt=""> </div>
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> <?= $model->first_name . ' ' . $model->last_name ?> </div>
                </div>
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="active">
                            <a href="<?= Yii::$app->urlManager->createUrl(['/admin/users/view','id'=>$model->id]) ?>">
                                <i class="icon-settings"></i> User Details 
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">View User Profile</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_1" data-toggle="tab">User Information</a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1_1">
                                    <?php if (Yii::$app->session->hasFlash('pro-success-msg')) : ?>
                                        <div class="alert alert-success" role="alert">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong>Success!&nbsp;</strong>
                                            <?= Yii::$app->session->getFlash('pro-success-msg') ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php
                                    $form = ActiveForm::begin([
                                                'options' => ['id' => 'user-pro-update', 'class' => '', 'enctype' => 'multipart/form-data'],
                                                'enableClientValidation' => false
                                            ])
                                    ?>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label text-primary">First Name</label>
                                                <?= $form->field($model, 'first_name')->textInput(['class' => 'form-control', 'placeholder' => 'First Name'])->label(false) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label text-primary">Last Name</label>
                                                <?= $form->field($model, 'last_name')->textInput(['class' => 'form-control', 'placeholder' => 'Last Name'])->label(false) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label text-primary">Email Address</label>
                                                <?= $form->field($model, 'email')->textInput(['class' => 'form-control', 'placeholder' => 'Email Address'])->label(false) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label text-primary">Phone Number</label>
                                                <?= $form->field($model, 'phone')->textInput(['class' => 'form-control', 'placeholder' => 'Phone Number'])->label(false) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="margiv-top-10">
                                        <button type="submit" class="btn green"> Save Changes </button>
                                    </div>
                                    <?php ActiveForm::end() ?>
                                    <!--</form>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>