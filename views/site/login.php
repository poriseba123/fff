<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Iniciar sesión');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="login-wrap open-sans">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form id="userloginForm" class="" name="userloginForm" action="post">
                    <div class="impu-form-N form-group">
                        <i class="fa-ihc fa fa-user"></i>
                        <input type="text" value="" name="LoginForm[email]" id="loginform-email" placeholder="<?= Yii::t('app', 'Identificación de correo') ?>" class="form-control cust-input">
                        <div class="help-block"></div>
                    </div>
                    <div class="impu-form-N form-group">
                        <i class="fa-ihc fa fa-lock"></i>
                        <input type="password" value="" name="LoginForm[password]" id="loginform-password" placeholder="<?= Yii::t('app', 'Contraseña') ?>" class="form-control cust-input">
                        <div class="help-block"></div>
                    </div>
                    <div class="checkbox text-right">
                        <label>
                            <input value="1" name="LoginForm[rememberMe]" id="loginform-rememberMe" type="checkbox">
                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                            <em><?= Yii::t('app', 'Seguir Conectado') ?></em>
                        </label>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Conéctate" name="Submit" class="btn-block submit-btn">
                    </div>
                </form>
                <div class="text-center"><div class="ihc-top-social-login">- O -</div></div>
                <div class="text-center">
                    <a href="javascript:;" onclick="facebookLogin()">
                        <div class="ihc-sm-item ihc-fb">
                            <i class="fa-ihc-sm fa fa-facebook"></i>
                            <span class="ihc-sm-item-label">Facebook</span>
                        </div>
                    </a>
                    <ul class="login-btm-link">
                        <li><a href="<?= Yii::$app->urlManager->createUrl('registration/') ?>">Regístrate</a></li>
                        <li><a href="javascript:;" onclick="showForgotPassModal()"><?= Yii::t('app', 'Perdiste tu contraseňa') ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
