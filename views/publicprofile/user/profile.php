<?php
use yii\helpers\Url;
?>
<div class="index-body">
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
                                        <form class="form form-horizontal" id="updatePersonalInfo" role="form" method="post" enctype="multipart/form-data">
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-md-2 control-label"></label>
                                                <div class="col-md-7">
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input value="1" name="userGender" <?= ($model->gender == 1) ? "checked" : "" ?> type="radio" onclick="$('#usermaster-gender').val(this.value)">
                                                            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                            <span class=""> Hombre</span>
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input value="2" name="userGender" <?= ($model->gender == 2) ? "checked" : "" ?> type="radio" onclick="$('#usermaster-gender').val(this.value)">
                                                            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                            <span class="">Mujer</span>
                                                        </label>
                                                    </div>
                                                    <input type="hidden" name="UserMaster[gender]" id="usermaster-gender" value="<?= $model->gender ?>"/>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-md-2 control-label">Nombre</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" value="<?= $model->first_name ?>" type="text" name="UserMaster[first_name]" id="usermaster-first_name"/>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-md-2 control-label">Apellido</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" value="<?= $model->last_name ?>" type="text" name="UserMaster[last_name]" id="usermaster-last_name"/>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="example-email-input" class="col-md-2 control-label">Email</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" value="<?= $model->email ?>" type="email" name="UserMaster[email]" id="usermaster-email"/>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="example-number-input" class="col-md-2 control-label">Número</label>
                                                <div class="col-md-5">
                                                    <div class="spinner-q">
                                                        <div class="input-group spinner">
                                                            <?php
                                                            $countryPhoneCodeList = $this->context->getAllCountryMobileCodes();
                                                            if ($model->phone_code > 0) {
                                                                $selectedCode = $model->phone_code;
                                                            } else {
                                                                $selectedCode = 47;
                                                            }
                                                            ?>
                                                            <select class="form-control" name="UserMaster[phone_code]" id="usermaster-phone_code">
                                                                <option value="">seleccionar país</option>
                                                                <?php foreach ($countryPhoneCodeList as $v) : ?>
                                                                    <option value="<?= $v->id ?>" <?= ($v->id == $selectedCode) ? "selected" : "" ?>><?= $v->nicename . "&nbsp;(+" . $v->phonecode . ")" ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <div class="help-block"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="spinner-q">
                                                        <input class="form-control" type="text" value="<?= $model->phone ?>"  name="UserMaster[phone]" id="usermaster-phone">
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-md-2 control-label">Año de nacimiento</label>
                                                <div class="col-md-10">
                                                    <?php
                                                    $startYear = date("Y", strtotime("- 97 years", strtotime(date("Y"))));
                                                    $endYear = date("Y", strtotime("- 16 years", strtotime(date("Y"))));
                                                    ?>
                                                    <select class="form-control" name="UserMaster[birth_year]" id="usermaster-birth_year">
                                                        <option value="">Seleccione Año de nacimiento</option>
                                                        <?php for ($i = $endYear; $i >= $startYear; $i--) : ?>
                                                            <option value="<?= $i ?>" <?= ($i == $model->birth_year) ? "selected" : "" ?>><?= $i ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row noDisplay" id="userimg-error-container">
                                                <div class="col-md-10 col-md-offset-2">
                                                    <div class="alert alert-danger" role="alert">
                                                        <strong id="userimg-error"></strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-email-input" class="col-md-2 control-label">Foto</label>
                                                <div class="clearfix">
                                                    <div class="col-md-8">
                                                        <h1 onclick="$('#usermaster-userimage').click()" class="link-coursor">Agregar una foto <i class="fa fa-plus" aria-hidden="true"></i></h1>
                                                        <input type="file" style="height: 0px; width:0px" name="UserMaster[userimage]" id="usermaster-userimage" onchange="updateProfilePicture(this)"/>
                                                        <p>PNG, JPEG o GIF, Máximo de 3 MG. (Sube una foto clara  y luminosa, con solo una cara y sin gafas de sol para identificarte bien)</p>
                                                        <div class="help-block"></div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="text-center">
                                                            <img src="<?= $this->context->getuseruploadedimages() ?>" height="100" width="100" class="title-tooltip img-responsive link-coursor" id="uploaded-image" onclick="$('#usermaster-userimage').click()" style="border: 2px solid rgba(0, 0, 0, 0.44);" title="Cambiar tu foto aqui"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="example-email-input" class="col-md-2 control-label">Biografía corta</label>
                                                <div class="col-md-10">
                                                    <textarea placeholder="¡No coloques tu número de teléfono aquí! Preséntate brevemente (por ejemplo ¿Qué haces en tu tiempo libre? ¿Por qué eres una persona agradable para viajar? Etc...)" class="form-control"  name="UserMaster[bio]" id="usermaster-bio"><?= $model->bio ?></textarea>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="example-email-input" class="col-md-2 control-label"></label>
                                                <div class="col-md-10">
                                                    <div class="btn-rap text-left">
                                                        <button type="submit" id="userUpdateInfoSubBtn" class="btn">REGISTRAR</button>
                                                    </div>
                                                </div>
                                            </div>


                                        </form>
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