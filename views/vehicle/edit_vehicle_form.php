<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
?>
<div class="account-3">
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
                                <div class="col-md-10 col-md-offset-1 col-sm-12">
                                    <div class="cmn-upper-pad">
                                        <div class="alert alert-info text-center" role="alert">
                                            <strong>No se puede publicar un anuncio hasta que se apruebe tu vehículo</strong>
                                        </div>
                                        <div id="addvehiclecontainer" class="">
                                            <form class="form form-horizontal userVehicleRequestform" id="userVehicleEditRequest" role="form" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
                                                <div class="form-group row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="control-label">Nombre del conductor</label>
                                                        <input type="text" class="form-control readonly" value="<?= $user->first_name . " " . $user->last_name ?>" readonly="true"/>
                                                        <input type="hidden" name="UserVehicle[user_id]" id="uservehicle-user_id" value="<?= $user->id ?>"/>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="control-label">Número de la licencia</label>
                                                        <input type="text" name="UserMaster[driving_id]" value="<?= $user->driving_id ?>" id="usermaster-driving_id" class="form-control" placeholder="Número de licencia de conducir"/>
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="control-label">Marca del vehículo</label>
                                                        <select class="form-control" onchange="getVehicleModelList(this)" name="UserVehicle[car_brand]" id="uservehicle-car_brand">
                                                            <option value="">Seleccione la marca del vehículo</option>
                                                            <?php foreach ($vehicleBrand as $k => $v) : ?>
                                                                <option value="<?= $v->id ?>" <?= (isset($findVehicle) && $findVehicle->car_brand == $v->id) ? "selected" : "" ?>><?= $v->brand ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <div class="help-block"></div>
                                                    </div>
                                                    <?php
                                                    if (isset($findVehicle) && $findVehicle->car_brand > 0) {
                                                        $getModels = app\models\VehicleModel::find()->where('brand_id=:brandId AND status=:status', [":brandId" => $findVehicle->car_brand, ":status" => 1])->all();
                                                    } else {
                                                        $getModels = "";
                                                    }
                                                    ?>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="control-label">Modelo del vehículo</label>
                                                        <select class="form-control" name="UserVehicle[car_model]" id="uservehicle-car_model">
                                                            <option value="">Seleccione el modelo del vehículo</option>
                                                            <?php if (isset($getModels) && $getModels != "") : ?>
                                                                <?php foreach ($getModels as $k => $v) : ?>
                                                                    <option value="<?= $v->id ?>" <?= (isset($findVehicle) && $findVehicle->car_model == $v->id) ? "selected" : "" ?>><?= $v->model_no ?></option>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </select>
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="control-label">Color del vehículo</label>
                                                        <div class="input-group">
                                                            <select class="form-control" name="UserVehicle[color]" id="uservehicle-color" onchange="getVehiclecolor(this)">
                                                                <option value="">Seleccione el color del vehículo</option>
                                                                <?php foreach ($vehicleColor as $k => $v) : ?>
                                                                    <option value="<?= $v->id ?>" <?= (isset($findVehicle) && $findVehicle->color == $v->id) ? "selected" : "" ?>><?= $v->color_name_es ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <div class="input-group-addon">
                                                                <span class="vehicel-color-span" id="vehicel-color-span" style="<?= (isset($findVehicle) && $findVehicle->color != "") ? "background-color:" . $findVehicle->vColor->color_code : "" ?>"></span>
                                                            </div>
                                                        </div>
                                                        <div class="help-block"></div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="control-label">Número de placa del vehículo (sin espacios)</label>
                                                        <input type="text" value="<?= isset($findVehicle) ? $findVehicle->plate_number : "" ?>" name="UserVehicle[plate_number]" id="uservehicle-plate_number" class="form-control" placeholder="Número de placa del vehículo"/>
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="control-label">Experiencia de manejo (en años)</label>
                                                        <input type="number" value="<?= isset($user) ? $user->driving_exp : "" ?>" name="UserMaster[driving_exp]" min="0" max="50" id="usermaster-driving_exp" class="form-control" placeholder="Experiencia de manejo (en años)"/>
                                                        <div class="help-block"></div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="clearfix" style=" margin-top: 20px;">
                                                            <h1 onclick="$('#uservehicle-vehicleImg').click()" class="link-coursor">Imagen del vehículo <i class="fa fa-plus" aria-hidden="true"></i></h1>
                                                            <input type="file" style="height: 0px; width:0px" name="UserVehicle[vehicleImg]" id="uservehicle-vehicleImg" onchange="checkVehicleImg(this)"/>
                                                            <p>PNG, JPEG o GIF, máximo 3 MG. (La foto debe ser clara, bien enfocada y no debe mostrar la placa del vehículo)
                                                            </p>
                                                            <div class="help-block"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-12" id="vehicleImgContainer">
                                                        <img src="<?= $this->context->getUserVehicleImg((isset($findVehicle) && $findVehicle->car_img != "") ? $findVehicle->car_img : ""); ?>" class="img-responsive vehicle-img" id="userIdentityVehicleImg"/>
                                                    </div>
                                                </div>
                                                <div class="row form-group"></div>
                                                <div class="row form-group text-center">
                                                    <a href="<?= Yii::$app->urlManager->createUrl("vehicle/addvehicle") ?>" class="btn all-default-btn " style=" width: 185px; margin: 5px;">CANCELAR</a>
                                                    <button class="btn all-default-btn " type="submit" style=" margin: 5px;">guardar cambios</button>
                                                </div>
                                            </form>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="foot-part">
                            <p>
                                La información recibida por 123poriseba es utilizada para crear y verificar tu cuenta, por eso es obligatoria. Al completar esta información estás aceptando nuestras <a href="<?= Url::toRoute(['site/terminos_y_condiciones']); ?>" class="greenlink" target="_blank">Condiciones Generales</a>. Para saber más puedes consultar nuestras <a href="<?= Url::toRoute(['site/preceptos_de_confidencialidad']); ?>" class="greenlink" target="_blank">Políticas de Confidencialidad</a>.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->registerJsFile(Yii::$app->request->baseUrl . '/themes/frontend/custom/js/user-vehicle.js', ['depends' => [\yii\web\JqueryAsset::className()]]) ?>