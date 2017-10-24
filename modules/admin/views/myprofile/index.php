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
<h1 class="page-title"> Account Setting</h1>
<div class="row">
    <div class="col-md-12">
        <div class="profile-sidebar">
            <div class="portlet light profile-sidebar-portlet ">
                <div class="profile-userpic">
                    <img src="<?= $this->context->getProfilePicture() ?>" onerror="this.src='<?= $this->context->getProfileImgErrorImg() ?>'" class="img-responsive" alt=""> </div>
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> <?= $model->first_name . ' ' . $model->last_name ?> </div>
                </div>
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="active">
                            <a href="javascript:;">
                                <i class="icon-settings"></i> Account Settings 
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
                                <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                </li>
                                <li>
                                    <a href="#tab_1_2" data-toggle="tab">Change Password</a>
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
                                                'options' => ['id' => 'admin-pro-update', 'class' => '', 'enctype' => 'multipart/form-data'],
                                                'enableClientValidation' => false
                                            ])
                                    ?>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label text-primary">First Name<span class="required">*</span></label>
                                                <?= $form->field($model, 'first_name')->textInput(['class' => 'form-control', 'placeholder' => 'First Name'])->label(false) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label text-primary">Last Name<span class="required">*</span></label>
                                                <?= $form->field($model, 'last_name')->textInput(['class' => 'form-control', 'placeholder' => 'Last Name'])->label(false) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label text-primary">Email <span class="required">*</span></label>
                                                <?= $form->field($model, 'email')->textInput(['class' => 'form-control', 'placeholder' => 'Email Address'])->label(false) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label text-primary">Phone Number<span class="required">*</span></label>
                                                <?= $form->field($model, 'phone')->textInput(['class' => 'form-control', 'placeholder' => 'Phone Number'])->label(false) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label text-primary">Upload Image</label>
                                                <?= $form->field($model, 'newImage')->fileInput(['class' => 'form-control', 'placeholder' => 'Choose Image'])->label(false); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12" id="upload-preview-img">
                                            <div class="form-group text-center" id='preview-img-holder'>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="margiv-top-10">
                                        <button type="submit" class="btn green"> Save Changes </button>
                                    </div>
                                    <?php ActiveForm::end() ?>
                                    <!--</form>-->
                                </div>
                                <div class="tab-pane" id="tab_1_2">
                                    <?php if (Yii::$app->session->hasFlash('pro-success-msg')) : ?>
                                        <div class="alert alert-success" role="alert">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong>Success!&nbsp;</strong>
                                            <?= Yii::$app->session->getFlash('pro-success-msg') ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php
                                    $pass = ActiveForm::begin([
                                                'options' => ['id' => 'admin-change-pass', 'class' => '', 'enctype' => 'multipart/form-data'],
                                                'enableClientValidation' => false
                                            ])
                                    ?>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label text-primary">Current Password<span class="required">*</span></label>
                                                <?= $pass->field($password, 'old_password')->passwordInput(['class' => 'form-control', 'placeholder' => 'Current Password'])->label(false) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label text-primary">New Password<span class="required">*</span></label>
                                                <?= $pass->field($password, 'new_password')->passwordInput(['class' => 'form-control', 'placeholder' => 'New Password'])->label(false) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label text-primary">Retype Password<span class="required">*</span></label>
                                                <?= $pass->field($password, 'retype_password')->passwordInput(['class' => 'form-control', 'placeholder' => 'Retype Password'])->label(false); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="margiv-top-10">
                                        <button type="submit" class="btn green"> Change Password </button>
                                    </div>
                                    <?php ActiveForm::end() ?>
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