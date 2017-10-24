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
                <form id="userchangeforgotpassword" class="" name="userchangeforgotpassword" action="post">
                    <input type="hidden" value="<?= $model->id ?>" name="userId" id="passuserId"/>
                    <div class="impu-form-N form-group">
                        <i class="fa-ihc fa fa-user"></i>
                        <input type="text" name="UserMaster[email]" disabled="true" value="<?= $this->context->getUserEmailId($model->id) ?>" id="usermaster-email" placeholder="<?= Yii::t('app', 'Identificación de correo') ?>" class="form-control cust-input">
                        <div class="help-block"></div>
                    </div>
                    <div class="impu-form-N form-group">
                        <i class="fa-ihc fa fa-lock"></i>
                        <input type="password" value="" name="UserMaster[new_password]" id="usermaster-new_password" placeholder="<?= Yii::t('app', 'Contraseña') ?>" class="form-control cust-input">
                        <div class="help-block"></div>
                    </div>
                    <div class="impu-form-N form-group">
                        <i class="fa-ihc fa fa-lock"></i>
                        <input type="password" value="" name="UserMaster[retype_password]" id="usermaster-retype_password" placeholder="Confirmez le mot de passe*" class="form-control cust-input">
                        <div class="help-block"></div>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="<?= Yii::t('app', 'Conectarse') ?>" name="Submit" class="btn-block submit-btn">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>