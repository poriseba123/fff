<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
?>
<?php
if ($model->email_varified == 1) {
    $emailVerified = "grn_right_icon.png";
} else {
    $emailVerified = "blu_cross_icon.png";
}
if ($model->phone_verification == 1) {
    $phoneVerified = "grn_right_icon.png";
} else {
    $phoneVerified = "blu_cross_icon.png";
}
if ($model->identity_document_verified == 1) {
    $iDVerified = "grn_right_icon.png";
} else {
    $iDVerified = "blu_cross_icon.png";
}
?>
<div class="account-6">
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
                                    <div class="cmn-upper-pad">
                                        <p>Queremos generar confianza en los miembros de esta comunidad, por eso por favor verifica tu información. ¡Así encontrarás más personas para compartir tus viajes!</p>
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix">
                                <div class="col-md-10 col-md-offset-1 col-sm-12">
                                    <div class="ttl-media-area">
                                        <div class="media">
                                            <div class="media-left">
                                                <img src="<?= $this->context->getStaticImage($emailVerified) ?>" class="media-object img-circle">
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading">Email comprobado</h4>
                                                <p>Tu email es : <?= $model->email ?> <a href="javascript:;" onclick="sendEmailVerificationLink()">Modificar</a> </p>
                                            </div>
                                        </div>

                                        <div class="media">
                                            <div class="media-left">
                                                <?php
                                                if ($model->phone_verification == 1) {
                                                    $var = $emailVerified;
                                                } else {
                                                    $var = $phoneVerified;
                                                }
                                                ?>
                                                <img src="<?= $this->context->getStaticImage($phoneVerified) ?>" class="media-object img-circle">
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading">Verificar número de teléfono</h4>
                                                <p>Registrar tu número de teléfono, es importante para organizar el viaje con los otros pasajeros</p>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="spinner-q">
                                                            <div class="input-group spinner">
                                                                <?php
                                                                $countryPhoneCodeList = $this->context->getAllCountryMobileCodes();
                                                                ?>
                                                                <?php
                                                                $countryPhoneCodeList = $this->context->getAllCountryMobileCodes();
                                                                if ($model->phone_code > 0) {
                                                                    $selectedCode = $model->phone_code;
                                                                } else {
                                                                    $selectedCode = 47;
                                                                }
                                                                ?>
                                                                <select class="form-control linkDisabled" readonly name="UserMaster[phone_code]" id="usermaster-phone_code">
                                                                    <option value="">seleccionar país</option>
                                                                    <?php foreach ($countryPhoneCodeList as $v) : ?>
                                                                        <option value="<?= $v->id ?>" <?= ($v->id == $selectedCode) ? "selected" : "" ?>><?= $v->nicename . "&nbsp;(+" . $v->phonecode . ")" ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="spinner-q">
                                                            <input class="form-control" type="text" readonly value="<?= $model->phone ?>"  name="UserMaster[phone]" id="usermaster-phone">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="btn-rap text-left">
                                                    <a href="javascript:void(0)" onclick="phoneVerify();" class="btn">VERIFICAR MI TELÉFONO</a>
                                                </div>
                                            </div>

                                        </div>
                                        <?php if ($model->identity_document_verified == 3) : ?>
                                            <div class="alert alert-danger" role="alert">
                                                <strong>Tu identidad no es verificada por el administrador.</strong>
                                            </div>
                                        <?php endif; ?>
                                        <div class="media">
                                            <div class="media-left">
                                                <img src="<?= $this->context->getStaticImage($iDVerified) ?>" class="media-object img-circle">
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading">Verificar documento de identidad</h4>
                                                <p>¡Así los otros viajeros tendrán más confianza!</p>
                                                <div class="btn-rap text-left">
                                                    <a href="javascript:;" id="useridentityverify" onclick="useridentityverify(this)" class="btn">VERIFICAR MI DOCUMENTO<br> DE IDENTIDAD</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
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

