<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
?>
<div class="main-body-wrap">
            <div class="mensajes mensajes-detail">
                <section class="total-tab-sec">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="row">
                                   <?= $this->context->renderPartial("../partials/user_pro_main_tab_ul") ?>
                                </div>
                                <div class="row">
                                    <div class="btm-area clearfix">

                                        <div class="col-md-10 col-md-offset-1">
                                            <?php if(count($model)>0){ 
                                            foreach ($model as $key => $v) {
                                                ?>
                                            <div class="media btn-block">
                                                <div class="media-left media-middle">
                                                    <img src="<?php echo $this->context->getUserProfileImage($v->from_id); ?>" class="media-object img-circle" style="width:60px;height:60px;">
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading mensajes-name"><?php echo $v->fromUserDetails->first_name.' '.$v->fromUserDetails->last_name?> : </h4>
                                                    <p class="mensajes-title"><?=$v->message?></p>
                                                    <p class="sm-date senalar">
                                                        <span class="row btn-block">
                                                            <span class="col-sm-7"><?=$this->context->getMessageDate($v->created_at)?> a las <?=date('H:i',strtotime($v->created_at))?></span>
                                                            <?php
                                                            if($v->from_id!= Yii::$app->user->id){
                                                            ?>
                                                            <span class="col-sm-5 text-center"><a href="javascript:;" onclick="reportMessage('<?php echo $v->id ?>')">Señalar</a></span>
                                                            <?php } ?>
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <?php }} ?>
                                            <div class="msg-block">
                                                <div class="msg-body">
                                                    <form id="message-form" name="message-form">
                                                        <input type="hidden" id="to_id" name="to_id" value="<?=$message_to?>">
                                                        <textarea id="message" name="message" class="form-control cust-textarea" placeholder="Escribir tu mensaje aquí"></textarea>
                                                        <div class="help-block" id="message-help-block"></div>
                                                        <div class="text-right">
                                                            <button class="all-default-btn" type="submit">ENVIAR</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="text-center">
                                                    <div class="foot-part">
                                                        <p>Podemos controlar los mensajes. Leer nuestras <a href="#">condiciones generales</a>.</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>



                                    </div>

                                    <div class="foot-part">
                                        <p>
                                La información recibida por poriseba es utilizada para crear y verificar tu cuenta, por eso es obligatoria. Al completar esta información estás aceptando nuestras <a href="<?= Url::toRoute(['site/terminos_y_condiciones']); ?>" class="greenlink" target="_blank">Condiciones Generales</a>. Para saber más puedes consultar nuestras <a href="<?= Url::toRoute(['site/preceptos_de_confidencialidad']); ?>" class="greenlink" target="_blank">Políticas de Confidencialidad</a>.
                            </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>


            </div>
        </div>

<div class="modal fade cust-my-modal-2" id="report_msg_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"  aria-hidden="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1 col-sm-12">
                                <div class="text-center">
                                    <div class="mdl-prt">
                                        <h1>Reportar a un moderador poriseba</h1>
                                        <div class="chk-group btn-block">
                                            <div class="step-1">
                                                <div class="checkbox">
                                                    <label>
                                                        <input value="" type="checkbox">
                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                        <span class=""> Comportamiento peligroso o inapropiado</span>
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input value="" type="checkbox">
                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                        <span class="">Un problema con el anuncio o el perfil</span>
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input value="" type="checkbox">
                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                        <span class="">Precio dudoso</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="step-2">
                                                <div class="checkbox">
                                                    <label>
                                                        <input value="" type="checkbox">
                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                        <span class=""> Agresividad</span>
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input value="" type="checkbox">
                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                        <span class="">Conducción peligrosa</span>
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input value="" type="checkbox">
                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                        <span class="">Comportamiento ilegal</span>
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input value="" type="checkbox">
                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                        <span class="">Envío de spams</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="step-3">
                                                <div class="checkbox">
                                                    <label>
                                                        <input value="" type="checkbox">
                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                        <span class=""> Agresividad</span>
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input value="" type="checkbox">
                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                        <span class="">Número de telefono falso o ilocalizable</span>
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input value="" type="checkbox">
                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                        <span class="">Perfil dudoso</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="step-4">
                                                <div class="checkbox">
                                                    <label>
                                                        <input value="" type="checkbox">
                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                        <span class=""> Precios más altos comparados con el anuncio</span>
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input value="" type="checkbox">
                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                        <span class="">Uso comercial</span>
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input value="" type="checkbox">
                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                        <span class="">Modo de  pago dudoso</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <a class="btn-block btn all-default-btn" href="javascript:void(0);" onclick="right_review();">SEGUIR</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script>
    function reportMessage(id) {
        $('#message_id').val(id);
         $('#report_msg_modal').modal('show');
    }
    function booking_reject_by_driver(id) {
        $('#booking_id').val(id);
         $('.modal').modal('hide');
         $('#reward').modal('show');
        
    }
    function showModal(obj) {
        var id = $(obj).attr('data-val');
        $('#post_id').val(id);
        $('#deleteModal').modal('show');
    }
</script>
<?php
$this->registerJsFile(
        Yii::$app->request->baseUrl . '/themes/frontend/custom/js/trip-booking.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>