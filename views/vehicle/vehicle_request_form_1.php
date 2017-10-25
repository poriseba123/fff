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
                                        <?php
                                        $alertClass = $vReadOnly = $uReadOnly = $alertMessage = $cause = $viewVehicle = $addVehicle = $viewVehicleStatus = "";
                                        $addVacelContainerDisplay = "noDisplay";
                                        if (isset($findVehicle) && count($findVehicle) > 0) {
                                            $addVehicle = "noDisplay";
                                            if ($findVehicle->status == 0) {
                                                $alertClass = "alert-info";
                                                $alertMessage = Yii::t('app', "Your request is under progress. Plase wait 48 hours for admin approval.");
                                            }
                                            if ($findVehicle->status == 2) {
                                                $alertClass = "alert-danger";
                                                $uReadOnly = "readonly";
                                                $alertMessage = Yii::t('app', "Your request is decliend.");
                                                $cause = $findVehicle->cancelation_cause;
                                                $viewVehicle = "noDisplay";
                                                $addVacelContainerDisplay = "";
                                            }

                                            if ($findVehicle->status == 1) {
                                                $alertClass = "alert-success";
                                                $alertMessage = Yii::t('app', "Your request has been approved.");
                                            }
                                        } else {
                                            $viewVehicleStatus = "noDisplay";
                                            $viewVehicle = "noDisplay";
                                        }
                                        ?>
                                        <div class="row  <?= $viewVehicleStatus ?>" id="cancelVehicleReqContainer">
                                            <div class="col-md-8 col-md-offset-2 text-center">
                                                <div class="alert <?= $alertClass ?>" role="alert">
                                                    <strong><?= $alertMessage ?></strong>
                                                    <?php if ($cause != "") : ?>
                                                        <p class="text-left" style="margin-top:10px;"><strong>Causa de cancelación:&nbsp;</strong><?= $cause ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row  <?= $addVehicle ?>" id="addvehicleoptioncontainer">
                                            <div class="col-md-7 col-md-offset-2 text-center">
                                                <button type="button" onclick="openAddVehicleContainer(this)" id="addvehicleoption_<?= $user->id ?>" class="btn btn-default-cust">A&ntilde;adir su veh&iacute;culo</button>
                                            </div>
                                        </div>
                                        <div id="addvehiclecontainer" class="<?= $addVacelContainerDisplay ?>">
                                            <form class="form form-horizontal userVehicleRequestform" id="userVehicleRequest" role="form" method="post" enctype="multipart/form-data">
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
                                                <!--==== licence image ================-->
                                                <!--                                                <div class="form-group row">
                                                                                                    <div class="col-md-6 col-sm-12">
                                                                                                        <label class="control-label">Licencia de conducir Imagen frontal</label>
                                                                                                        <input type="file" name="UserMaster[licence_font_image]" id="usermaster-drive_frontimage" class="form-control"/>
                                                                                                        <div class="help-block"></div>
                                                <?php // if ($user->drive_backimage != "") : ?>
                                                                                                            <img src="<?php // $this->context->getUserDrivingFontImg();  ?>" class="img-responsive driving-lic-img" style="margin-top: 10px;"/>
                                                <?php // endif; ?>
                                                                                                    </div>
                                                                                                    <div class="col-md-6 col-sm-12">
                                                                                                        <label class="control-label">Parte posterior Imagen de la licencia de conducir</label>
                                                                                                        <input type="file" name="UserMaster[licence_back_image]" id="usermaster-drive_backimage" class="form-control"/>
                                                                                                        <div class="help-block"></div>
                                                <?php // if ($user->drive_backimage != "") : ?>
                                                                                                            <img src="<?php // $this->context->getUserDrivingBackImg();  ?>" class="img-responsive driving-lic-img" style="margin-top: 10px;"/>
                                                <?php // endif; ?>
                                                                                                    </div>
                                                                                                </div>-->
                                                <!--==== choose car section ================-->
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
                                                        <label class="control-label">Número de placa del vehículo</label>
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
                                                        <div class="clearfix">
                                                            <h1 onclick="$('#uservehicle-vehicleImg').click()" class="link-coursor">Imagen del vehículo <i class="fa fa-plus" aria-hidden="true"></i></h1>
                                                            <input type="file" style="height: 0px; width:0px" name="UserVehicle[vehicleImg]" id="uservehicle-vehicleImg" onchange="checkVehicleImg(this)"/>
                                                            <p>PNG, JPEG o GIF, máximo 3 Mo.
                                                                <!--(Suba una foto clara y luminosa, con solo una cara y sin gafas de sol para identificarlo bien,)-->
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
                                                    <button class="btn all-default-btn" type="submit">REGISTRAR</button>
                                                </div>
                                            </form>  
                                        </div>
                                        <div id="viewVehicleDetailsContainer" class="viewVehicleDetailsContainer <?= $viewVehicle ?>">
                                            <div class="row">
                                                <?php if (isset($findVehicle) && count($findVehicle) > 0) : ?>
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <!--======= driver details ===================-->
                                                        <h4 class="text-left border-bottom sep-hding-stl">Detalles del conductor</h4>
                                                        <div class="form-group clearfix">
                                                            <label class="control-label col-md-4 sep-para-stl">Nombre del conductor</label>
                                                            <label class="control-label col-md-8 staticdata sep-para-stl"><?= $findVehicle->userDetails->first_name . " " . $findVehicle->userDetails->last_name ?></label>
                                                        </div>
                                                        <div class="form-group clearfix">
                                                            <label class="control-label col-md-4 sep-para-stl">Número de licencia</label>
                                                            <label class="control-label col-md-8 staticdata sep-para-stl"><?= $findVehicle->userDetails->driving_id ?></label>
                                                        </div>
                                                        <!--                                                        <div class="form-group clearfix">
                                                                                                                    <label class="control-label col-md-12">Imagen de licencia de conducir</label>
                                                                                                                    <div class="col-md-6">
                                                                                                                        <img src="<?php // $this->context->getUserDrivingFontImg();  ?>" class="img-responsive driving-lic-img"/>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-6">
                                                                                                                        <img src="<?php // $this->context->getUserDrivingBackImg();  ?>" class="img-responsive driving-lic-img"/>
                                                                                                                    </div>
                                                                                                                </div>-->
                                                        <div class="form-group clearfix">
                                                            <label class="control-label col-md-4 sep-para-stl">Experiencia de manejo</label>
                                                            <label class="control-label col-md-8 staticdata sep-para-stl"><?= $findVehicle->userDetails->driving_exp . " (Años)" ?></label>
                                                        </div>
                                                        <!--======= vehicle details ===================-->
                                                        <h4 class="text-left border-bottom sep-hding-stl">Detalles del vehículo</h4>
                                                        <div class="form-group clearfix">
                                                            <label class="control-label col-md-4 sep-para-stl">Marca de vehículo</label>
                                                            <label class="control-label col-md-8 staticdata sep-para-stl"><?= $findVehicle->vBrand->brand ?></label>
                                                        </div>
                                                        <div class="form-group clearfix">
                                                            <label class="control-label col-md-4 sep-para-stl">Modelo de vehículo</label>
                                                            <label class="control-label col-md-8 staticdata sep-para-stl"><?= $findVehicle->vModel->model_no ?></label>
                                                        </div>
                                                        <div class="form-group clearfix">
                                                            <label class="control-label col-md-4 sep-para-stl">Color del vehículo</label>
                                                            <label class="control-label col-md-8 staticdata sep-para-stl"><?= $findVehicle->vColor->color_name_es . " (" . $findVehicle->vColor->color_code . ")" ?></label>
                                                        </div>
                                                        <div class="form-group clearfix">
                                                            <label class="control-label col-md-4 sep-para-stl">Número de placa del vehículo</label>
                                                            <label class="control-label col-md-8 staticdata sep-para-stl"><?= $findVehicle->plate_number ?></label>
                                                        </div>
                                                        <div class="form-group clearfix">
                                                            <img src="<?= $this->context->getUserVehicleImg($findVehicle->car_img); ?>" class="img-responsive vehicle-img"/>
                                                        </div>
                                                        <div class="form-group clearfix">
                                                            <a href="<?= Yii::$app->urlManager->createUrl("vehicle/editvehicle") ?>" class="all-default-btn">Editar detalles del veh&iacute;culo</a>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="foot-part">
                            <p>Las informaciónes recabadas por 123poriseba están utilizadas para crear su cuenta y publicarla en nuestra plataforma. Son  obligatorias. 
                                Al completar esta información, está aceptando nuestras <a href="#">Condiciones Generales.</a> Puede consultar nuestros <a href="#">Preceptos de Confidencialidad</a> para saber más. 
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->registerJsFile(Yii::$app->request->baseUrl . '/themes/frontend/custom/js/user-vehicle.js', ['depends' => [\yii\web\JqueryAsset::className()]]) ?>