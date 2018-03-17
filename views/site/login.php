<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Iniciar sesión');
$this->params['breadcrumbs'][] = $this->title;
?>
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2 class="title-2">
                    Login
                </h2>
                <!-- Form -->
                <form id="userloginForm" class="" name="userloginForm" action="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" value="" name="LoginForm[email]" id="loginform-email" placeholder="<?= Yii::t('app', 'Identificación de correo') ?>" class="form-control cust-input">
                                        <div class="help-block"></div>
                                    </div>                    
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">                      
                                        <input type="password" value="" name="LoginForm[password]" id="loginform-password" placeholder="<?= Yii::t('app', 'Contraseña') ?>" class="form-control cust-input">
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                            </div>
                        </div>    
                        <div class="col-md-12">
                            <button type="submit" id="submit" class="btn btn-common">Submit</button>
                            <div id="msgSubmit" class="h3 text-center hidden"></div> 
                            <div class="clearfix"></div>   
                        </div>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</section>


<!--<div class="checkbox text-right">
    <label>
        <input value="1" name="LoginForm[rememberMe]" id="loginform-rememberMe" type="checkbox">
        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
        <em><?= Yii::t('app', 'Seguir Conectado') ?></em>
    </label>
</div>
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
</div>-->
