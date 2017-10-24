<?php if (Yii::$app->user->isGuest) : ?>
    <div class="modal fade cust-my-modal-2 right-review-modal" id="forgotPassModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"  aria-hidden="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="text-center">¿Perdiste tu contraseña?</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <form id="forget_password_form" name="forget_password_form" method="post">
                                <div class="text-center">
                                    <p style="margin-bottom: 15px;">Ingrese tu dirección de correo electrónico para restablecer tu contraseña.</p>
                                    <div class="mdl-prt">
                                        <input type="text" name="forgotpassemail" id="forgotpassemail" class="form-control" placeholder="Ingrese tu ID de correo electrónico"/>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <button type="submit" class="btn-block btn all-default-btn">ENVIAR</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="modal fade cust-my-modal-2" id="useridentitymodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"  aria-hidden="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form action="" id="checkIdentityDocuentForm" name="checkIdentityDocuentForm">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 col-sm-12">
                                <div class="text-center">
                                    <div class="mdl-prt">
                                        <h1>¿Por qué verificar tu documento de identidad?</h1>
                                        <p>Porque los miembros de nuestra comunidad tendrán más confianza para viajar con las personas que verifican tu identidad.</p>
                                        <p>¡No te preocupes! Nunca usaremos tu documento de identidad públicamente en la plataforma.</p>
                                    </div>
                                    <div class="mdl-prt">
                                        <h1>¿Cuál es tu documento de identidad?</h1>
                                        <div class="radio-group">
                                            <div class="radio">
                                                <label>
                                                    <input value="1" name="IdentityDocument_type" id="identitydocument-type_1" type="radio" onclick="$('#identitydocument-type').val(this.value)">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                    <span class=""> Cédula</span>
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input value="2" name="IdentityDocument_type" id="identitydocument-type_2" type="radio" onclick="$('#identitydocument-type').val(this.value)">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                    <span class="">Pasaporte</span>
                                                </label>
                                            </div>
                                        </div>
                                        <input type="hidden" name="IdentityDocument[type]" id="identitydocument-type" value=""/>
                                        <div class="help-block"></div>
                                    </div>

                                    <div class="mdl-prt identityuploaddoc">
                                        <p>Por favor envía la foto de tu documento de identidad.</p>
                                        <p>Debe ser legible, clara y  bien enfocada.</p>
                                        <p>Sólo en formatos PNG, JPEG o GIF, máximo 3 MG</p>
                                        <!--<p class="title-tooltip link-coursor fileformat-para" title="Haga clic para elegir el documento">Envíe su documento en PNG, JPEG o GIF.Tiene que ser claro, bien cuadrado y legible.</p>-->
                                        <div class="input-group identityuploaddocField">
                                            <span class="input-group-addon link-coursor title-tooltip" title="Haga clic para elegir el documento" onclick="$('#identitydocument-document').click()"><i class="fa fa-upload" aria-hidden="true"></i></span>
                                            <input type="text" readonly="true" onclick="$('#identitydocument-document').click()" class="form-control readonly" placeholder="Cargar documento de identificación" name="file_name" id="identityFileName" value=""/>
                                        </div>
                                        <input type="file" onchange="userIdentificationImage(this)" name="IdentityDocument[document]" id="identitydocument-document" style="height: 0px; width: 0px;"/>
                                        <div class="help-block"></div>
                                        <div class="img-preview noDisplay">
                                            <img src="" id="previewIdentifyImage" class="img-responsive" height="150" width="auto" style="margin: 0 auto;"/>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <!--<label class="custom-file-upload">-->
                                        <button type="submit" class="custom-file-upload common-upbtn">VERIFICAR MI DOCUMENTO <br>DE IDENTIDAD</button>                                                
                                        <!--</label>-->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
