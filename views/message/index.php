<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
?>
<div class="main-body-wrap">
            <div class="mensajes">
                <section class="total-tab-sec">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="row">
                                   <?= $this->context->renderPartial("../partials/user_pro_main_tab_ul") ?>
                                </div>

                                <div class="row">
                                    <div class="btm-area clearfix">

                                        <div class="col-md-6 col-md-offset-3">
                                            <?php if(count($model)>0){ 
                                            foreach ($model as $key => $v) {
                                                ?>
                                            <a href="<?= Url::toRoute(['message/allmessages','id'=>$v->from_id]); ?>" class="media btn-block">
                                                <div class="media-left">
                                                  <img src="<?php echo $this->context->getUserProfileImage($v->from_id); ?>" class="media-object img-circle" style="width:60px;height:60px;">
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading mensajes-name"><?php echo $v->fromUserDetails->first_name.' '.$v->fromUserDetails->last_name?></h4>
                                                    <p class="mensajes-title"><?=(strlen($v->message)>50)?substr($v->message,0,50):$v->message?></p>
                                                    <p class="sm-date"><?=$this->context->getMessageDate($v->created_at)?></p>
                                                </div>
                                            </a>
                                            <?php } }?>
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
        </div>


<script>
    function booking_accept_by_driver(id) {
        $('#accept_booking_id').val(id);
         $('#ACEPTAR').modal('show');
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