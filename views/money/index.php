<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
?>

<div class="main-body-wrap">
            <div class="account-11">
                <section class="total-tab-sec">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                               <div class="row">
                                   <?= $this->context->renderPartial("../partials/user_pro_main_tab_ul") ?>
                                </div>

                                <div class="row">
                                    <div class="btm-area big-warp-padding clearfix">
                                        <div class="clearfix">
                                            <div class="col-md-8 col-md-offset-2 col-sm-12">
                                                
                                                
                                                    <div class="cmn-upper-pad text-center">
                                                    <h1 class="heading only-fr-color1">Para recibir un pago</h1>
                                                    <p class="smal-marg-pw">Registra los datos de una cuenta bancaria para que puedas recibir el pago cuando compartas un viaje.</p>
                                                    <form class="form form-horizontal" role="form" method="post" id="create-bank-detail-form" name="create-bank-detail-form" style="    margin-top: 20px;">
                                                        <div class="form-group row">
                                                            <div class="col-md-8 col-md-offset-2">
                                                                <div class="spinner-q">
                                                                    <p class="class-fr-padding">Nombre del proprietario de la cuenta</p>
                                                                    <input type="hidden" name="bank_details_id" id="bank_details_id" value="<?=(isset($model->id) && $model->id!='')?$model->id:''?>">
                                                                    <input name="owner_name" id="owner_name" class="form-control" type="text" value="<?=(isset($model->owner_name) && $model->owner_name!='')?$model->owner_name:''?>" placeholder="Nombre del proprietario de la cuenta">
                                                                    <div id="owner_name-help-block" class="help-block"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                          <div class="form-group row">
                                                             <div class="col-md-8 col-md-offset-2">
                                                                <div class="spinner-q">
                                                                     <p class="class-fr-padding">Número de cédula</p>
                                                                    <input name="banknote_number" id="banknote_number" class="form-control" type="text" value="<?=(isset($model->banknote_number) && $model->banknote_number!='')?$model->banknote_number:''?>" placeholder="Número de cédula">
                                                                 <div id="banknote_number-help-block" class="help-block"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                          <div class="form-group row">
                                                            <div class="col-md-8 col-md-offset-2">
                                                                <div class="spinner-q">
                                                                     <p class="class-fr-padding">Nombre del banco</p>
                                                                    <input name="bank_name" id="bank_name" class="form-control" type="text" value="<?=(isset($model->bank_name) && $model->bank_name!='')?$model->bank_name:''?>" placeholder="Nombre del banco">
                                                                 <div id="bank_name-help-block" class="help-block"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                          <div class="form-group row">
                                                             <div class="col-md-8 col-md-offset-2">
                                                                <div class="spinner-q">
                                                                     <p class="class-fr-padding">Número de cuenta</p>
                                                                    <input name="account_number" id="account_number" class="form-control" type="text" value="<?=(isset($model->account_number) && $model->account_number!='')?$model->account_number:''?>" placeholder="Número de cuenta">
                                                                 <div id="account_number-help-block" class="help-block"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                          <div class="form-group row">
                                                             <div class="col-md-8 col-md-offset-2">
                                                                <div class="spinner-q">
                                                                     <p class="class-fr-padding">Tipo de cuenta (ahorros o corriente)</p>
                                                                    <select class="form-control" name="account_type" id="account_type">
                                                                        <option value="">Seleccionar</option>
                                                                        <option value="1" <?=(isset($model->account_type) && $model->account_type==1)?'selected':''?>>Ahorros</option>
                                                                        <option value="2" <?=(isset($model->owner_name) && $model->owner_name==2)?'selected':''?>>Corriente</option>
                                                                    </select>
                                                                 <div id="account_type-help-block" class="help-block"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="form-group row">
                                                             <div class="col-md-8 col-md-offset-2">
                                                                <div class="btn-rap text-center">
                                                                    <button type="submit" class="btn cust-mobi-btn"><?=(isset($model->account_type) && $model->account_type==1)?'ACTUALIZAR':'ACTUALIZAR'?></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div class="btm-txt-area">
                                                        <p>
                                                            La orden de transferencia será realizada a la cuenta bancaria 5 días después de realizar el viaje. <a href="<?= Url::toRoute(['site/preguntas_y_respuestas']); ?>" class="greenlink" target="_blank">Leer más</a>.
                                                        </p>
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