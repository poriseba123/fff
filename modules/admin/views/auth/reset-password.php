<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Reset Password';
?>
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="reset-password" id="admin-reset-password" action="" method="post">
        <div class="clearfix" style="margin-bottom: 15px;">
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken(); ?>"/>
            <h2 class="form-title text-center" style="color: #FFF">Reset Your Password</h2>
            <div class="form-group">
                <label class="control-label">Email Address</label>
                <input class="form-control placeholder-no-fix" value="<?= $model->email ?>" disabled="disabled" id="resetpass_email" type="text" autocomplete="off" placeholder="Email Id" /> 
            </div>
            <div class="form-group">
                <label class="control-label">New Password<span class="required">*</span></label>
                <input class="form-control placeholder-no-fix" id="usermaster_new_password" type="password" autocomplete="off" placeholder="New Password" name="UserMaster[new_password]" /> 
                <div class="help-block" id="usermaster_new_password_em_"></div>
            </div>
            <div class="form-group">
                <label class="control-label">Retype Password<span class="required">*</span></label>
                <input class="form-control placeholder-no-fix" id="usermaster_retype_password" type="password" autocomplete="off" placeholder="Password" name="UserMaster[retype_password]" /> 
                <div class="help-block" id="usermaster_retype_password_em_"></div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn green pull-right" id="admin-reset-pass-sub-btn"> Save Password </button>
            </div>
        </div>
    </form>

    <div class="copyright"> Copyright &copy; <?= $this->context->getProjectName() . ', ' . date('Y') ?></div>
</div>
<!--============ forgot password modal ====================-->
<div class="modal fade" id="forgot-password-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title forgot-title">Forget Password ?</h4>
            </div>
            <div class="modal-body">
                <form class="forget-form" id="admin-pass-forgot" method="post">
                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
                    <p> Enter your e-mail address below to reset your password. </p>
                    <div class="form-group">
                        <div class="input-icon">
                            <i class="fa fa-envelope"></i>
                            <input class="form-control placeholder-no-fix" id="forgotEmailId" type="text" autocomplete="off" placeholder="Email" name="forgotEmailId" /> 
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" id="back-btn" class="btn red btn-outline">Back </button>
                        <button type="submit" class="btn green pull-right"> Submit </button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--============ end forgot password modal ====================-->
<div id="back-img" style="display: none;">
    <img src="<?= Yii::$app->request->baseUrl ?>/themes/backend/assets/img/bg/car-img-11.jpg"/>
    <img src="<?= Yii::$app->request->baseUrl ?>/themes/backend/assets/img/bg/car-img-21.jpg"/>
    <img src="<?= Yii::$app->request->baseUrl ?>/themes/backend/assets/img/bg/car-img-31.jpg"/>
    <img src="<?= Yii::$app->request->baseUrl ?>/themes/backend/assets/img/bg/car-img-41.jpg"/>
</div>