<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" id="123vamos-admin-login" action="" method="post">
        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken(); ?>"/>
        <h3 class="form-title text-center">Login to your account</h3>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" id="loginform_email" type="text" autocomplete="off" placeholder="Email Id" name="LoginForm[email]" /> 
            </div>
            <div class="help-block" id="loginform_email_em_"></div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" id="loginform_password" type="password" autocomplete="off" placeholder="Password" name="LoginForm[password]" /> 
            </div>
            <div class="help-block" id="loginform_password_em_"></div>
        </div>
        <div class="form-actions">
            <a href="javascript:;" onclick="openForgotPassModal()" class="forget-pass-link">Forgot your password?</a>
            <button type="submit" class="btn green pull-right" id="admin-login-sub-btn"> Login </button>
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
                        <button type="button" id="back-btn" class="btn red btn-outline" onclick="closeForgotPassModal()">Back </button>
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