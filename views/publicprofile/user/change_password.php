<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
use app\models\MetaLocation;
use yii\helpers\ArrayHelper;
?> 
<div class="account-1">
    <section class="total-tab-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="row">
                        <?= $this->context->renderPartial("../partials/user_pro_main_tab_ul") ?>
                    </div>

                    <div class="row">
                        <div class="btm-area clearfix">
                            <div class="clearfix">
                                <div class="col-md-10 col-md-offset-1 col-sm-12">
                                    <div class="prof-nav">
                                        <?= $this->context->renderPartial("../partials/user_pro_sub_tab_ul") ?>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">
                                <div class="col-md-8 col-md-offset-2 col-sm-12">
                                    <?php
                                    if($user->reg_type==1){
                                    ?>
                                    <div class="cmn-upper-pad">
                                        <div class="row">
                                            <div class="col-md-10 col-md-offset-2">
                                                <h1>Cambia la contraseña</h1>
                                                <p>Te enviaremos tu nueva contraseña al email que registraste en tu cuenta.</p>
                                            </div>
                                        </div>
                                        <form class="form form-horizontal" name="userChangePassword" id="userChangePassword" role="form" method="post">
                                            <div class="form-group row">
                                                <div class="col-md-7 col-md-offset-2">
                                                    <input class="form-control" type="password" placeholder="<?= Yii::t('app', 'Current Password') ?>" name="PasswordModel[old_password]" id="passwordmodel-old_password">
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-7 col-md-offset-2">
                                                    <input class="form-control" type="password" placeholder="<?= Yii::t('app', 'New Password') ?>" name="PasswordModel[new_password]" id="passwordmodel-new_password">
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-7 col-md-offset-2">
                                                    <input class="form-control" type="password" placeholder="<?= Yii::t('app', 'Retype Password') ?>" name="PasswordModel[retype_password]" id="passwordmodel-retype_password">
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-email-input" class="col-md-2 control-label"></label>
                                                <div class="col-md-7">
                                                    <div class="btn-rap text-left">
                                                        <button type="submit" class="btn">ENVIAR</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>  
                                        <div class="row">
                                            <div class="col-md-10 col-md-offset-2">
                                                <p>Si has olvidado tu contraseña, has click en este <a href="javascript:;"onclick="sendforgotpassmail()">enlace</a> para recibir una nueva.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }else{ ?>
                                    <div class="cmn-upper-pad">
                                        <div class="row">
                                            <div class="col-md-10 col-md-offset-2">
                                                <h1>Cambia la contraseña</h1>
                                                <p>Puede iniciar sesión en el sitio de UK Social para los Estados Unidos cambiar tu contraseña.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>



                        </div>

                        <div class="foot-part">
                            <p> 
                            La información recibida por 123Vamos es utilizada para crear y verificar tu cuenta, por eso es obligatoria. Al completar esta información estás aceptando nuestras <a href="<?= Url::toRoute(['site/terminos_y_condiciones']); ?>" class="greenlink" target="_blank">Condiciones Generales</a>. Para saber más puedes consultar nuestras <a href="<?= Url::toRoute(['site/preceptos_de_confidencialidad']); ?>" class="greenlink" target="_blank">Políticas de Confidencialidad</a>.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


</div>