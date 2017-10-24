<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use app\models\BookingMaster;
?>
<div class="index-body account-9">
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
                                    <h1 class="heading">Tus próximos viajes</h1>
                                </div>
                            </div>
                            <div class="clearfix">
                                <div class="col-md-10 col-md-offset-1 col-sm-12">
                                    <div class="ttl-media-area">
                                        <div class="top-area-1">
                                            <?php
                                            if (count($model) > 0) {
                                                foreach ($model as $row) {
                                                    $bm = BookingMaster::findOne($row['id']);
                                                    $start_trip = app\models\TripLocation::findOne($row['booking_location_start_id']);
                                                    $end_trip = app\models\TripLocation::findOne($row['booking_location_end_id']);
                                                    $tm = \app\models\TripMaster::findOne($row['trip_id'])
                                                    ?>
                                                    <div class="grp-media-area">
                                                        <div class="price-box clearfix">
                                                            <div class="row">
                                                                <div class="col-md-8 col-sm-12">
                                                                    <ul>
                                                                        
                                                                        <li><?=$this->context->getSmallAddress($bm->userDetailsTripLocationStart->location_a_name) ?> > <?= $this->context->getSmallAddress($bm->userDetailsTripLocationEnd->location_b_name) ?></li>
                                                                        <li><?= $this->context->getFormatedDate($start_trip->departure_datetime) ?></li>
                                                                        <li>Precio total $<?= $row['total_price'] ?></li>
                                                                    </ul>
                                                                    <ul class="list-inline">
                                                                        <?php 
                                                                        $a=trim($this->context->getSmallAddress($bm->userDetailsTripLocationStart->location_a_name));
                                                                        $b=trim($this->context->getSmallAddress($bm->userDetailsTripLocationStart->location_b_name));
                                                                        ?>
                                                                        <li><a href="<?= Yii::$app->urlManager->createUrl(["search/postdetail", "id" => $row['trip_id'],'location_a_name'=>$a,'location_b_name'=>$b]) ?>" target="_blank">Ver el anuncio</a></li>
                                                                        <li><a href="javascript:;" onclick="booking_cancel_by_user('<?php echo $row['id'] ?>');" data-val="<?php echo $row['id'] ?>">Cancelar la reserva </a></li>
                                                                    </ul>
                                                                </div>

                                                                <div class="col-md-4 col-sm-12">
                                                                    <h1></h1>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--new-->
                                                    


                                                <?php }
                                                ?>
                                           
                                                <div class="text-right">
                                                    <?php
                                                    echo LinkPager::widget([
                                                        'pagination' => $pages,
                                                    ]);
                                                    ?>
                                                </div>
                                            <?php } else {
                                                ?>
                                                <div class="grp-media-area">
                                                    <div class="price-box clearfix">
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12">
                                                                <ul class="list-inline text-center">
                                                                    <li><a href="javascript:;" class="linkDisabled">No se han encontrado resultados</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                                    <div class="text-center">
                                                        <p>¡Para tener un excelente viaje lee estos <a href="<?= Url::toRoute(['site/reglamento_interno']); ?>" class="greenlink" target="_blank">consejos</a> que te pueden ayudar!</p>
                                                    </div>
                                        </div>
                                    </div>


                                    <!--completed-->
                                    <h1 class="heading">Tus viajes anteriores</h1>
                                    <div class="ttl-media-area">
                                        <div class="top-area-1">
                                            <?php
                                            if (count($completed_trips) > 0) {
                                                foreach ($completed_trips as $row) {
                                                    $bm = BookingMaster::findOne($row['id']);
                                                    $start_trip = app\models\TripLocation::findOne($row['booking_location_start_id']);
                                                    $end_trip = app\models\TripLocation::findOne($row['booking_location_end_id']);
                                                    $tm = \app\models\TripMaster::findOne($row['trip_id']);
                                                    $rating_master= \app\models\RatingMaster::find()->where(['user_id'=>Yii::$app->user->id,'booking_id'=>$row['id'],'status'=>1])->one();
                                                    ?>
                                            
                                            <div class="castom-mda-box form-group">
                                                    <div class="md-hd">
                                                        <div class="row">
                                                            <div class="col-md-6 col-xs-6">
                                                                <h1><?= $this->context->getSmallAddress($bm->userDetailsTripLocationStart->location_a_name) ?> > <?= $this->context->getSmallAddress($bm->userDetailsTripLocationEnd->location_b_name) ?></h1>
                                                            </div>
                                                            <div class="col-md-6 col-xs-6">
                                                                <!--<p>ESTÁ ESPERANDO A SU APROBACIÓN</p>-->
                                                                <?php
                                                                if ($row['booking_status']==1) {
                                                                    ?>
                                                                    <p>CONFIRMADO</p>
                                                                <?php } else { ?>
                                                                    <p>CANCELADO</p>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media">
                                                        <div class="media-left">

                                                        </div>
                                                        <div class="media-body">
                                                            <ul>
                                                                <?php 
                                                                $a=trim($this->context->getSmallAddress($bm->userDetailsTripLocationStart->location_a_name));
                                                                $b=trim($this->context->getSmallAddress($bm->userDetailsTripLocationStart->location_b_name));
                                                                ?>
                                                                <li><a href="<?= Yii::$app->urlManager->createUrl(["search/postdetail", "id" => $row['trip_id'],'location_a_name'=>$a,'location_b_name'=>$b]) ?>" target="_blank">Ver el anuncio</a></li>
                                                                <li><?= $this->context->getFormatedDate($start_trip->departure_datetime) ?></li>
                                                                <li>Precio total $<?= $row['total_price'] ?></li>
                                                            </ul>
                                                        </div>
                                                        <div class="media-right">
                                                            <div class="btn-rap text-center">
                                                               <?php
                                                                if ($row['booking_status']==1) {
                                                                    ?>
                                                                    <?php if(count($rating_master)==0){ ?>
                                                    <div class="btn-rap text-center">
                                                        <a href="javascript:;" onclick="giveRating('<?php echo $row['id']; ?>');" class="btn"><font><font>Calificaci&oacute;n y revisi&oacute;n </font></font></a>
                                                    </div>
                                                    <?php }else{ ?>
                                                    <div class="rating-pop cust-rating">
                                                        <input type="text" data-hover-enabled='false' data-display-only='true' class="ratingAnalysisItems rating rating-loading" data-size='sm' data-min="0" data-max="5" data-step="1" data-show-caption="false" data-show-clear='false' id="analysisRating_<?= $rating_master->id ?>_input" class="form-control ratingAnalysisItems" type="number" value="<?= $rating_master->rating ?>">
                                                    </div>
                                                    <?php } ?>
                                                    <?php 
                                                    if($this->context->getTimeDifferenceinHour(date('Y-m-d H:i:s'),$end_trip->arrival_datetime)<72){
                                                    ?>
                                                     <div class="btn-rap text-center">
                                                        <a href="javascript:;" onclick="booking_claim_by_user('<?php echo $row['id'] ?>');" class="btn"><font><font>solicitud de reembolso</font></font></a>
                                                    </div>
                                                    <?php } ?>
                                                                <?php } else { ?>
                                                                    <p><?=$row['cancel_reason']?></p>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            <!--end-->
                                                    


                                                <?php }
                                                ?>
                                                <div class="text-right">
                                                    <?php
                                                    echo LinkPager::widget([
                                                        'pagination' => $completed_pages,
                                                    ]);
                                                    ?>
                                                </div>
                                            <?php } else {
                                                ?>
                                                <div class="grp-media-area">
                                                    <div class="price-box clearfix">
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12">
                                                                <ul class="list-inline text-center">
                                                                    <li><a href="javascript:;" class="linkDisabled">No se han encontrado resultados</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <!--completed-->





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
<div class="modal fade cust-my-modal-2" id="booking_cancel_by_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"  aria-hidden="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 col-sm-12">
                        <div class="text-center">
                            <div class="mdl-prt-2">
                                <h1>¿Porque quieres cancelar tu viaje?</h1>
                            </div>
                            <form class="form" role="form" method="post" id="cancel_by_user_form">
                                <input type="hidden" name="booking_id" id="booking_id" value="">
                                <div class="form-group row">
                                    <select class="form-control" name="reason_category" id="reason_category">
                                        <option value="">Seleccionar</option>
                                        <option value="Tengo un imprevisto, no puedo viajar">Tengo un imprevisto, no puedo viajar</option>
                                        <option value="Cambio las fechas del viaje">Cambio las fechas del viaje</option>
                                        <option value="Cambio el horario del viaje">Cambio el horario del viaje</option>
                                        <option value="Cambio el itinerario">Cambio el itinerario</option>
                                        <option value="Hice más de una reserva para el mismo viaje">Hice más de una reserva para el mismo viaje</option>
                                        <option value="Tengo un desacuerdo con el pasajero">Tengo un desacuerdo con el conductor</option>
                                    </select>
                                    <div class="help-block" id="reason_category-help-block" style="text-align: left;"></div>
                                </div>
                                <div class="form-group row">
                                    <textarea name="reason" id="reason" placeholder="¡Cuéntanosmás! Queremossaber las razones para que en nuestracomunidad los conductores no pierdan su confianza para publicarmásviajes y podamosmejorar." class="form-control"></textarea>
                                    <div class="help-block" id="reason-help-block" style="text-align: left;"></div>
                                </div>
                                <div class="form-group row">
                                    <p>La tasa de cancelación será registrada en tu perfil</p>
                                    <div class="btn-rap text-center">
                                        <input type="submit" class="btn" value="CANCELAR">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade cust-my-modal-2" id="message-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"  aria-hidden="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 col-sm-12">
                        <div class="text-center">
                            <div class="mdl-prt-2">
                                <h1>Escribe un mensaje</h1>
                            </div>
                            <form id="message-form" name="message-form">
                                <input type="hidden" id="to_id" name="to_id" value="">
                                <textarea id="message" name="message" class="form-control cust-textarea" placeholder="Escribir tu mensaje aquí"></textarea>
                                <div class="help-block" id="message-help-block"></div>
                                <div class="text-right">
                                    <button class="all-default-btn" type="submit">ENVIAR</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade cust-my-modal-2" id="booking_claim_by_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"  aria-hidden="false">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 col-sm-12">
                                <div class="text-center">
                                    <div class="mdl-prt-2">
                                        <h1>¿Porque quieres cancelar tu viaje?</h1>
                                    </div>
                                    <form class="form" role="form" method="post" id="claim_by_user_form">
                                        <input type="hidden" name="booking_id" id="claim_refund_booking_id" value="">
                                        <div class="form-group row">
                                            <select class="form-control" name="reason_category" id="claim_reason_category">
                                                <option value="">Seleccionar</option>
                                                <option value="Tengo un imprevisto, no puedo viajar">Tengo un imprevisto, no puedo viajar</option>
                                                <option value="Cambio las fechas del viaje">Cambio las fechas del viaje</option>
                                                <option value="Cambio el horario del viaje">Cambio el horario del viaje</option>
                                                <option value="Cambio el itinerario">Cambio el itinerario</option>
                                                <option value="Hice más de una reserva para el mismo viaje">Hice más de una reserva para el mismo viaje</option>
                                                <option value="Tengo un desacuerdo con el pasajero">Tengo un desacuerdo con el pasajero</option>
                                            </select>
                                            <div class="help-block" id="claim_reason_category-help-block" style="text-align: left;"></div>
                                        </div>
                                        <div class="form-group row">
                                            <textarea name="reason" id="claim_reason" placeholder="Díganos más" class="form-control"></textarea>
                                            <div class="help-block" id="claim_reason-help-block" style="text-align: left;"></div>
                                        </div>
                                        <div class="form-group row">
                                            <p>La tasa de cancelación será registrada en tu perfil</p>
                                            <div class="btn-rap text-center">
                                                <input type="submit" class="btn" value="CANCELAR">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div class="modal fade cust-my-modal-2" id="give_rating_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"  aria-hidden="false">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 col-sm-12">
                                <div class="text-center">
                                    <div class="mdl-prt-2">
                                        <h1></h1>
                                    </div>
                                    <form class="form" role="form" method="post" id="give_rating_form">
                                        <input type="hidden" name="booking_id" id="booking_id" value="">
                                        <div class="form-group row">
                                            <div class="rating-pop">
                                                <input type="text" type="number" name="rating" id="rating" value="0">
                                            </div>
                                            <div class="help-block" id="rating-help-block" style="text-align: center;"></div>
                                        </div>
                                        <div class="form-group row">
                                            <textarea name="review" id="review" placeholder="Escribe tu reseña" class="form-control"></textarea>
                                            <div class="help-block" id="review-help-block" style="text-align: center;"></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="btn-rap text-center">
                                                <input type="submit" class="btn" value="Enviar">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script>
    function giveRating(booking_id) {
        $('#booking_id').val(booking_id);
         $('.modal').modal('hide');
         $('#give_rating_modal').modal('show');
        $('#rating').rating({ min: 0, max: 5, step: 0.5, size: 'sm', showClear: false });
       
    }
    if ($('.ratingAnalysisItems').length > 0) {
            var ids = $('.ratingAnalysisItems').map(function () {
                return $(this).attr('id');
            });
            $.each(ids, function (item, value) {
                var _this = $('#' + value);

                _this.rating({
                    min: 0,
                    max: 5,
                    step: 0.5,
                    size: 'xs',
                    showClear: false
                });
            });
        }
</script>
<script>
    function booking_cancel_by_user(id) {
        $('#booking_id').val(id);
        $('.modal').modal('hide');
        $('#booking_cancel_by_user').modal('show');

    }
    function booking_claim_by_user(id) {
        $('#claim_refund_booking_id').val(id);
         $('.modal').modal('hide');
         $('#booking_claim_by_user').modal('show');
        
    }
    function sendMessage(id) {
        $('#to_id').val(id);
//            alert('something went wrong');
        $('#message-modal').modal('show');
    }
</script>

<?php
$this->registerJsFile(
        Yii::$app->request->baseUrl . '/themes/frontend/custom/js/trip-booking.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>