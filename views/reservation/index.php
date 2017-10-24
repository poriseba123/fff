<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
?>
<div class="account-9">
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
                                    <div class="ttl-media-area">
                                        <div class="top-area-1">
                                           <h1 class="heading">Tus solicitudes de reserva</h1>
                                        <?php if (isset($req_models) && count($req_models) > 0) { ?>
                                            <?php foreach ($req_models as $row) { ?>
                                                <div class="castom-mda-box form-group">
                                                    <div class="md-hd">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h1><?= $this->context->getSmallAddress($row->userDetailsTripLocationStart->location_a_name) . ' > ' . $this->context->getSmallAddress($row->userDetailsTripLocationEnd->location_b_name) ?>&nbsp; <?= $this->context->getFormatedDate($row->userDetailsTripLocationStart->departure_datetime) ?></h1>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p><a href="javascript:;" class="linkDisabled">ESTÁ ESPERANDO A TU APROBACIÓN</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="<?= Url::toRoute(['publicprofile/index', 'id' => $row->user_id]); ?>" target="_blank">
                                                                <img src="<?= $this->context->getUserProfileImage($row->user_id) ?>" class="media-object img-circle">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <ul>
                                                                <li><a href="<?= Url::toRoute(['publicprofile/index', 'id' => $row->user_id]); ?>" target="_blank">Ver el perfil</a></li>
                                                                <li><a href="javascript:;">Mandar un mensaje</a></li>
                                                                <?php 
                                                                $a=trim($this->context->getSmallAddress($row->userDetailsTripLocationStart->location_a_name));
                                                                $b=trim($this->context->getSmallAddress($row->userDetailsTripLocationStart->location_b_name));
                                                                ?>
                                                                <li><a href='<?= Yii::$app->urlManager->createUrl(["search/postdetail", "id" => $row->trip_id,"location_a_name"=>$a,"location_b_name"=>$b]) ?>' target="_blank">Ver el anuncio</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="media-right">
                                                            <div class="btn-rap text-center">
                                                                <a href="javascript:;" onclick="booking_accept_by_driver('<?php echo $row->id ?>');" class="btn">ACEPTAR</a>
                                                                <a href="javascript:;" onclick="booking_reject_by_driver('<?php echo $row->id ?>');" class="cst_link_1">Rechazar</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="text-right">
                                                <?php
                                                echo LinkPager::widget([
                                                    'pagination' => $req_pages,
                                                ]);
                                                ?>
                                            </div>
                                        <?php } else { ?>
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
                                        
                                        <h1 class="heading">Tus próximos viajes</h1>
                                            <?php if (isset($model) && count($model) > 0) : ?>
                                                <?php foreach ($model as $row) : ?>
                                                    <?php
                                                    $seat_booked = app\models\TripLocation::find()->where(['trip_id' => $row->id])->orderBy('id asc')->one();
                                                    ?>
                                                    <div class="grp-media-area">
                                                        <div class="price-box clearfix">
                                                            <div class="row">
                                                                <div class="col-md-8 col-sm-12">
                                                                    <ul>
                                                                        <li><?= $this->context->getSmallAddress($row->starting_location) ?>&nbsp;>&nbsp;<?= $this->context->getSmallAddress($row->end_location) ?></li>
                                                                        <li><?= $this->context->getFormatedDate($row->start_time) ?></li>
                                                                        <li><?= $row->seat_available - $seat_booked->total_booked ?> asientos libres</li>
                                                                    </ul>
                                                                    <ul class="list-inline">
                                                                        <li><a href="<?= Yii::$app->urlManager->createUrl(["search/postdetail", "id" => $row->id]) ?>">Ver el anuncio</a></li>
                                                                        <?php
                                                                        if (Yii::$app->user->id == $row->user_id && $seat_booked->total_booked==0) {
                                                                            ?>
                                                                        
                                                                            <li><a href="<?= Yii::$app->urlManager->createUrl(["post/postedit", "id" => $row->id]) ?>">Modificar el anuncio</a></li> 
                                                                            <li><a href="javascript:;" onclick="showModal(this)" data-val="<?= $row->id ?>">Borrar el anuncio</a></li>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </div>

                                                                <div class="col-md-4 col-sm-12">
                                                                    <h1>$<?= round($row->total_cost) ?> por viajero</h1>
                                                                </div>

                                                            </div>
                                                            <?php
                                                            if (Yii::$app->user->id == $row->user_id  && $seat_booked->total_booked==0) {
                                                                ?>
                                                                <div class="text-center cust-single-p">
                                                                    <p>¡Puedes modificar tu anuncio sin cancelarlo! </p>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                                <div class="text-right">
                                                    <?php
                                                    echo LinkPager::widget([
                                                        'pagination' => $pages,
                                                    ]);
                                                    ?>
                                                </div>
                                            <?php else: ?>
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
                                            <?php endif; ?>

                                        <!--completed trips confirm and cancelled-->
                                        <h1 class="heading">Tus viajes anteriores</h1>
                                        <?php if (isset($completed_models) && count($completed_models) > 0) { ?>
                                            <?php
                                            foreach ($completed_models as $row) {
                                                $total_booking = \app\models\BookingMaster::find()->where('trip_id=:tripId AND booking_status=:bookingStatus', [':tripId' => $row->id, ':bookingStatus' => 1])->count();
                                                $booking_detail = \app\models\BookingMaster::find()->where('trip_id=:tripId AND booking_status=:bookingStatus', [':tripId' => $row->id, ':bookingStatus' => 1])->all();
                                                ?>
                                                <div class="castom-mda-box form-group">
                                                    <div class="md-hd">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h1><?= $this->context->getSmallAddress($row->starting_location) ?>&nbsp;>&nbsp;<?= $this->context->getSmallAddress($row->end_location) ?></h1>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <!--<p>ESTÁ ESPERANDO A SU APROBACIÓN</p>-->
                                                                <?php
                                                                if ($total_booking > 0) {
                                                                    ?>
                                                                    <p><?= 'PAGADO - $' . round($row->total_cost) . ' por viajero' ?></p>
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
                                                                <li><?= $this->context->getFormatedDate($row->start_time) ?></li>
                                                                <?php
                                                                if (count($booking_detail) > 0) {
                                                                    ?>
                                                                    <li>
                                                                        Con
                                                                        <?php
                                                                        $i = 0;
                                                                        $total_seats = 0;
                                                                        foreach ($booking_detail as $k => $bd) {
                                                                            $total_seats = $total_seats + $bd->no_of_seat;
                                                                            if ($k != 0 && $i != count($booking_detail)) {
                                                                                echo " y ";
                                                                            } else {
                                                                                echo " ";
                                                                            }
                                                                            ?>
                                                                            <a href="<?= Url::toRoute(['publicprofile/index', 'id' => $bd->user_id]); ?>" target="_blank"><font><font><?= $bd->userDetails->first_name . ' ' . $bd->userDetails->last_name ?></font></font></a>
                                                                            <?php
                                                                            $i++;
                                                                        }
                                                                        ?>
                                                                    </li>
                                                                    <li><?= $total_seats ?>&nbsp;asientos pagados</li>
                                                                <li><a href='<?= Yii::$app->urlManager->createUrl(["search/postdetail", "id" => $row->id]) ?>' target="_blank">Ver el anuncio</a></li>
                                                                <?php } ?>
                                                            </ul>
                                                        </div>
                                                        <div class="media-right">
                                                            <div class="btn-rap text-center">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="text-right">
                                                <?php
                                                echo LinkPager::widget([
                                                    'pagination' => $completed_pages,
                                                ]);
                                                ?>
                                            </div>
                                        <?php } else { ?>
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
                                        <!--confirm and cancelled-->


                                        
                                        
                                         
                                        
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
<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">¿Eliminar el anuncio?</h4>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de eliminar el anuncio?</p>
            </div>
            <div class="modal-footer">
                <input type='hidden' id='post_id' value=''>
                <button type="button" style="background-color:#ddd !important" class="btn common-upbtn" data-dismiss="modal">No</button>
                <a href="javascript:void(0);" onclick="deletePost()" class="btn common-upbtn">Sí</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade cust-my-modal-2" id="reward" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"  aria-hidden="false">
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
                                <!--<h1>¿Razón de la cancelación?</h1>-->
                                <h1>¿Porque quieres cancelar tu viaje?</h1>
                            </div>
                            <form class="form" role="form" method="post" id="cancel_by_driver_form">
                                <input type="hidden" name="booking_id" id="booking_id" value="">
                                <div class="form-group row">
                                    <select class="form-control" name="reason_category" id="reason_category">
                                        <option value="">Seleccionar</option>
                                        <option value="Tengo un imprevisto, no puedo viajar">Tengo un imprevisto, no puedo viajar</option>
                                        <option value="Cambio las fechas del viaje">Cambio las fechas del viaje</option>
                                        <option value="Cambio el horario del viaje">Cambio el horario del viaje</option>
                                        <option value="Cambio el itinerario">Cambio el itinerario</option>
                                        <option value="Hice más de una reserva para el mismo viaje">Hice más de una reserva para el mismo viaje</option>
                                        <option value="Tengo un desacuerdo con el pasajero">Tengo un desacuerdo con el pasajero</option>
                                    </select>
                                    <div class="help-block" id="reason_category-help-block" style="text-align: left;"></div>
                                </div>
                                <div class="form-group row">
                                    <textarea name="reason" id="reason" placeholder="¡Cuentanos más! Queremos saber las razones para que en nuestra comunidad los conductores no pierdan su confianza para publicar más viajes y podamos mejorar." class="form-control"></textarea>
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

<div class="modal fade cust-my-modal-2" id="ACEPTAR" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"  aria-hidden="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="text-center">
                            <div class="mdl-prt-2">
                                <h1>Cuando acepta esta solicitud</h1>
                                <ul class="open-sans">
                                    <li> > enviamos  un mensaje al pasajero para notificarle</li>
                                    <li> > se compromete a apartar el número de asientos reservados  y a viajar juntos </li>
                                </ul>
                            </div>
                            <form class="form" role="form" method="post" id="accept_by_driver_form">
                                <input type="hidden" name="booking_id" id="accept_booking_id" value="">
                                <div class="form-group row">
                                    <div class="btn-rap text-center">
                                        <input type="submit" class="btn" value="ACEPTAR">
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