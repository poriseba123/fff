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
    <div class="alert alert-danger" role="alert" style="font-size: 15px;text-align: center;">
        <strong>Note:</strong>&nbsp;This is an Expired Url
    </div>
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