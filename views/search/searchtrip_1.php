<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
?>
<section class="buscar-2-top-sec">
    <div class="container">
        <h3 class="buscar-2-title">Estoy buscando un asiento</h3>
        <form id="filter-trip-form" class="row form open-sans" method="post" action="<?= Yii::$app->request->baseUrl . '/search/gettrip' ?>">
            <input id="TripLocation_page_no" value="<?= $page_no ?>" name="TripLocation[page_no]" type="hidden">
            <input id="TripLocation_limit" value="<?= $limit ?>" name="TripLocation[limit]" type="hidden">
            <input id="TripLocation_offset" value="<?= $offset ?>" name="TripLocation[offset]" type="hidden">
            <input id="TripLocation_location_a_lat" value="" name="TripLocation[location_a_lat]" type="hidden">
            <input id="TripLocation_location_a_long" value="" name="TripLocation[location_a_long]" type="hidden">
            <input id="TripLocation_location_b_lat" value="" name="TripLocation[location_b_lat]" type="hidden">
            <input id="TripLocation_location_b_long" value="" name="TripLocation[location_b_long]" type="hidden">
            <input id="TripLocation_location_b_city" value="" name="TripLocation[location_b_city]" type="hidden">
            <div class="col-sm-4">
                <div class="form-group ">
                    <div class="">
                        <input id="TripLocation_location_a_name" required value="<?= isset($_GET['TripLocation']['location_a_name'])?$_GET['TripLocation']['location_a_name']:"" ?>" name="TripLocation[location_a_name]" type="text" class="form-control" placeholder="<?= Yii::t('app', 'desde') ?>" onkeyup="codeAddress('TripLocation_location_a_name')" autocomplete="off">
                    </div>
                </div> 
            </div>
            <div class="col-sm-4">
                <div class="form-group ">
                    <div class="">
                        <input id="TripLocation_location_b_name" required value="<?= isset($_GET['TripLocation']['location_b_name'])?$_GET['TripLocation']['location_b_name']:"" ?>" name="TripLocation[location_b_name]" type="text" class="form-control" placeholder="<?= Yii::t('app', 'hasta') ?>" onkeyup="codeAddress('TripLocation_location_b_name')" autocomplete="off">
                    </div>
                </div> 
            </div>
            <div class="col-sm-2">
                <div class="form-group ">
                    <div class="">
                        <input required value="<?= isset($_GET['TripLocation']['departure_datetime'])?$_GET['TripLocation']['departure_datetime']:"" ?>" name="TripLocation[departure_datetime]" type="text" class="form-control datepicker" placeholder="<?= Yii::t('app', 'fecha') ?>">
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group ">
                    <div class="btn-rap text-left">
                        <button type="submit" class="all-default-btn btn-block">OK</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="row buscar-3-top-sec">
            <div class="col-md-10 col-md-offset-1 col-sm-12">
                <div id="trip-listing">

                </div>
            </div>
        </div>
<!--        <div class="img-wrap">
            <img src="<?= $this->context->getStaticImage("Tucson_Bridge.jpg") ?>" alt="" class="img-responsive center-block full-img" />
        </div>-->
        <div class="foot-part">
            <p>
                                La información recibida por poriseba es utilizada para crear y verificar tu cuenta, por eso es obligatoria. Al completar esta información estás aceptando nuestras <a href="<?= Url::toRoute(['site/terminos_y_condiciones']); ?>" class="greenlink" target="_blank">Condiciones Generales</a>. Para saber más puedes consultar nuestras <a href="<?= Url::toRoute(['site/preceptos_de_confidencialidad']); ?>" class="greenlink" target="_blank">Políticas de Confidencialidad</a>.
                            </p>
        </div>
    </div>
</section>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6ByNv7U0Tc36ib6VTn68Vml-0Z4DrBZc&libraries=places" charset="UTF-8"></script>
<?php
$this->registerJsFile(
        Yii::$app->request->baseUrl . '/themes/frontend/custom/js/search.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>