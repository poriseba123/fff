<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
?>
<section class="reglamento-intro-sec-2">
    <div class="container">
        <h1 class="title"><?= $this->context->span_accent('Preguntas y respuestas') ?></h1>
    </div>
</section>

<section class="preguntas_y_respuestas-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="bottom-part-text-smi">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                        ¿Qué es 123poriseba?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <div class="bottom-part-text-smi">
                                        <div class="smi-line-grid-2">
                                            <p>123poriseba pone en contacto a conductores y pasajeros que desean hacer un mismo viaje. </p>
                                            <p>Los conductores ofrecen los puestos libres en sus vehículos y los pasajeros interesados en el mismo trayecto pueden reservar su lugar. ¿Desea saber más? ¡Descubra rápidamente <a href="<?= Url::toRoute(['site/como_funciona']); ?>" class="greenlink" target="_blank">Como Funciona</a>!</p>
                                            <p>Simple, económico y alegre, 123poriseba permite a cientos de conductores ahorrar cantidades importantes en sus trayectos y a los pasajeros a viajar por un mejor precio hacia ciertos destinos a través de toda Colombia. </p>
                                            <p>El registro es rápido y gratuito. ¡123poriseba le permite viajar con toda confianza!</p>
                                            <p><a href="<?= Url::toRoute(['registration/index']); ?>" class="greenlink" target="_blank">Registrarme en 123poriseba.</a></p>       
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿El registro es gratuito?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>¡El registro en 123poriseba es completamente gratis!</p>
                                                <p>Es obligatorio registrarse si desea disfrutar del contacto entre conductores y pasajeros y ahorrar dinero en sus viajes futuros. </p>
                                                <p>Ser miembro de 123poriseba le permite ofrecer sus puestos libres y viajes con mejores precios hacia miles de destinos.</p>
                                                <p><a href="<?= Url::toRoute(['registration/index']); ?>" class="greenlink" target="_blank">¡Inscribirme en 123poriseba!</a></p>       
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿Un menor de edad puede usar el sitio?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>Es necesario tener más de 18 años para inscribirse y utilizar los servicios de 123poriseba. </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="false" aria-controls="collapseTwo">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿Es permitido reservar o publicar viajes en nombre de otra persona?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsefour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>Cada persona que utilice los servicios de 123poriseba debe tener su propio perfil. Es primordial para la confianza y la buena organización al momento de compartir vehículo. </p> 
                                                <p>Cada perfil creado en el sitio es autenticado, manualmente evaluado y un cierto número de datos es verificado con las preguntas de seguridad y confianza entre los miembros, es el caso específico del número telefónico. </p>
                                                <p>Si usted reserva con un conductor basado en la calidad de sus comentarios recibidos y resulta ser otra persona quien se presenta al encuentro, la confianza habrá sido rota y usted estará en su derecho de anular el trayecto. </p> 
                                                <p>Igualmente, si usted acepta la reservación de un pasajero luego de haber visto su perfil y es otra persona quien se presenta, usted está en su derecho de negarse a llevar a la persona ya que no corresponde con la que realizó la reservación. </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwoextra">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefourextra" aria-expanded="false" aria-controls="collapseTwo">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            No logro registrarme.
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsefourextra" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwoextra">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>Para registrarse usted debe llenar todos los campos requeridos, apellido, nombre, fecha de nacimiento, contraseña e ingresar una dirección de correo electrónico válida. </p>
                                                <p>La inscripción a través de Facebook no es obligatoria pero le permite registrarse más rápido y con más facilidad.</p>
                                                <p>Si su número de teléfono aparece como ya utilizado es porque está ligado a otra cuenta previamente registrada en el sitio. Atención, ¡no es posible utilizar un mismo número de teléfono para varias cuentas!</p>
                                                <p>Si usted ha olvidado su contraseña, es necesario seguir el proceso de recuperación al hacer clic en “<a href="<?= Url::toRoute(['site/login']); ?>" class="greenlink" target="_blank">¿Contraseña olvida?</a>”, en la ventana de identificación.</p>
                                                <p>Si un miembro se ha registrado usando su número de teléfono, o si una cuenta ya existe con sus datos de Facebook, o por cualquier otro caso, le invitamos a <a href="mailto:contact@123poriseba.co" class="greenlink">contactarnos</a>. </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefive" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            He perdido mi contraseña, ¿qué debo hacer?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsefive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>Usted puede crear una nueva al hacer clic en “<a href="<?= Url::toRoute(['site/login']); ?>" class="greenlink" target="_blank">¿Contraseña olvida?</a>”, en la ventana de identificación. </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesix" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿Cómo puedo modificar mi contraseña?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>Usted puede acceder a su perfil (al hacer clic en su nombre en la esquina superior derecha de la pantalla), luego seleccionar "contraseña” en la pestaña “cuenta”. Para modificar su contraseña usted debe ingresar nuevamente su contraseña actual, después la nueva contraseña escogida para confirmarla antes de validar las modificaciones. </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseseven-on" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿Dónde y cuándo es mi número visible? 
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseseven-on" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>Su número telefónico es compartido con los conductores cuando usted hace una reservación o a los pasajeros que reservan un trayecto con usted. </p>
                                                <p>El número está registrado en su cuenta, pero no es visible públicamente en el sitio como medida de seguridad. Es compartido solo en caso de reservación. </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseseven-on-extra" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            No he recibido el mensaje de texto de verificación.
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseseven-on-extra" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>El envío del código de 4 cifras es inmediato de haber ingresado su número de teléfono móvil en el campo de verificación. </p>
                                                <p>Si usted no ha recibido el mensaje de texto luego de 10 minutos se puede tratar de un problema con su teléfono o su operadora. </p>
                                                <p>Se le agradece verificar los puntos siguientes:</p>
                                                <p>-que el número haya sido registrado correctamente en su perfil 123poriseba. </p>
                                                <p>-que la memoria de su teléfono no esté llena o saturada. </p>
                                                <p>-que su teléfono esté configurado para recibir todo tipo de mensaje y especialmente los mensajes de números desconocidos, las compañías de envío pueden estar localizadas en un país diferente al suyo. </p>
                                                <p>-que su contrato telefónico permita la recepción de mensajes de texto de otros países (la opción de “roaming” activada)</p>
                                                <p>-que usted no tenga ciertos parámetros activados que bloqueen la recepción de ciertos mensajes.</p>
                                                <p>Si a pesar de todas estas verificaciones usted no recibe el mensaje de texto en cuestión lo invitamos primeramente a contactar a su compañía operadora para recibir asistencia en el tema.</p>
                                                <p>Y si el problema no es solucionado lo invitamos a <a href="mailto:contact@123poriseba.co" class="greenlink">contactarnos</a> a través de este formulario, e indicarnos su compañía operadora y tipo de contrato con el fin de que nosotros podamos proceder a realizar una verificación manual, al llamarlo al número en cuestión para verificar que usted sea el propietario.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseseven" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿Por qué verificar mi documento de identificación?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseseven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>La comunidad 123poriseba se basa en la confianza entre sus miembros. Nosotros les exigimos a los miembros dejarnos verificar varios elementos de su perfil para asegurar la fiabilidad, confianza y la seguridad en el lecho de la comunidad. </p>
                                                <p>Al verificar su documento de identidad, usted mejorará sus oportunidades de encontrar compañeros para compartir vehículo en sus viajes. Todos los otros miembros verás que su identificación está verificada y ¡estarán más inclinados a viajar con usted! </p>
                                                <p>Usted puede verificar su cédula de ciudadanía, su pasaporte o su permiso de conducir. Un servidor se encargará de la verificación pero nosotros no compartiremos con ningún tercero la imagen de su identificación. Los otros miembros no tendrán acceso a sus datos: ellos no verán más que una marca de verificación y la mención de la identificación que ha sido verificada en su perfil. </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseeight" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿Es peligroso enviar un documento de identidad?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseeight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>¡Para nada! Por el contrario, es una garantía de confianza y de seguridad para los usuarios de 123poriseba. Eso le permitirá obtener muchos más compañeros de viaje. </p>
                                                <p>Además, su identificación no será visible para los visitantes de su perfil de 123poriseba. Los otros miembros no verán más que la mención de su identificación verificada en su perfil.</p>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsenine" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿Por qué añadir una foto a su perfil y cómo hacerlo?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsenine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>123poriseba es una plataforma de conexión entre personas que deseen efectuar viajes juntos. Es importante y simplemente tranquilizador ver a las personas con quien uno va a viajar. ¡También es más fácil reconocerse en el lugar del encuentro!</p>
                                                <p>En promedio, ¡los usuarios con foto son 3 veces más contactados! Dos minutos serán suficientes para cargar su foto y le permitirá tener más compañeros de viaje en el futuro. </p>
                                                <p>Usted puede adjuntar su foto desde la página siguiente: Añadir una foto</p>
                                                <p>Usted tiene la posibilidad de enviarnos su foto en formato jpeg, gif o png (máximo 2mb)</p>
                                                <p>Todas las fotos son moderadas por nuestros equipos que crean un enmarcado angosto en el rostro. Su foto será visible para los miembros una vez esta validación sea efectuada. </p>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseten" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿Cuáles son las reglas con respecto a las fotos?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseten" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>Las fotos deben respetar un cierto tamaño y estar en un formato adecuado</p>
                                                <p>Nosotros aceptamos los formatos jpeg, gif y png y archivos de hasta 2mb. </p>
                                                <p>Las fotos deben seguir ciertos criterios:</p>
                                                <p>Estar solo(a)</p>
                                                <p>Ser reconocible</p>
                                                <p>No tener lentes de sol</p>
                                                <p>Estar en primer plano</p>
                                                <p>Estar sonriente (siempre es más amigable)</p>
                                                <p>Adoptar una actitud correcta</p>
                                                <p>Nosotros no aceptamos:</p>
                                                <p>Los dibujos y avatares</p>
                                                <p>Las fotos tomadas de muy lejos</p>
                                                <p>Las fotos borrosas o muy oscuras</p>
                                                <p>Las muecas</p>
                                                <p>¡No lo olvides, el objetivo es que su futuro compañero de viaje pueda reconocerlo en el punto del encuentro!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseelv" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            No logro subir mi foto, ¿qué debo hacer?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseelv" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>Si su foto no es visible, ¡eso significa que no ha sido aceptada aún por nuestros equipos!</p>
                                                <p>Centenares de fotos son moderadas a diario. Procedemos igualmente a recuadrar estas últimas para centrarlas, con el fin que sea posible reconocerlo más fácilmente. La validación de su foto puede tomar hasta 48 horas. </p>
                                                <p>Usted será notificado por correo electrónico y en el sitio cuando su foto esté en línea. </p>
                                                <p>Si su foto no ha sido aceptada, es porque no respeta los criterios requeridos o no pudo ser modificada correctamente, el motivo será indicado en el correo electrónico de notificación de rechazo. </p>
                                                <p>Para recapitular, usted debe:</p>
                                                <p>Estar solo(a)</p>
                                                <p>Ser reconocible</p>
                                                <p>No tener lentes de sol</p>
                                                <p>Estar en primer plano</p>
                                                <p>Estar sonriente (siempre es más amigable)</p>
                                                <p>Adoptar una actitud correcta</p>
                                                <p>Nosotros no aceptamos:</p>
                                                <p>Los dibujos y avatares</p>
                                                <p>Las fotos tomadas de muy lejos</p>
                                                <p>Las fotos borrosas o muy oscuras</p>
                                                <p>Las muecas</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesetwelve" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            Mi foto ha sido rechazada, ¿qué hago?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesetwelve" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>Le aconsejamos subir una nueva foto que acate los puntos anteriores con el fin de que podamos validarla. </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesethreteen" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿Por qué debe registrar los detalles de su vehículo?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesethreteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>Los pasajeros podrán imaginarse mejor el viaje con usted, y la seguridad y la confianza de los miembros de nuestra comunidad serán reforzadas. </p>
                                                <p>Mientras más información usted provea sobre sí mismo y sobre su vehículo, más oportunidades tendrá de encontrar pasajeros. </p>
                                                <p>Usted debe:</p>
                                                <p>Añadir su número de placa si se le es pedida (esta información se mantiene confidencial y no es visible públicamente en su perfil ni su anuncio)</p>
                                                <p>Seleccionar una marca y un modelo en la lista o ingresarlos usted mismo. </p>
                                                <p>Seleccionar el tipo de vehículo</p>
                                                <p>Seleccionar su color</p>
                                                <p>Ingresar la fecha del primer registro del vehículo si se le es pedida. </p>
                                                <p>No logro subir la foto de mi vehículo, ¿qué hago?</p>
                                                <p>Como su foto de perfil, la foto de su vehículo es validada manualmente por nuestros equipos, no será visible inmediatamente en la página, ¡pero lo será sin duda en pocas horas!</p>
                                                <p>Varias razones pueden explicar el rechazo de su foto:</p>
                                                <p>No representa el modelo de su vehículo</p>
                                                <p>Es fantasiosa</p>
                                                <p>No aceptamos fotos donde aparezca usted, ya que la foto de perfil es suficiente para identificarlo. </p>
                                                <p>En caso de rechazo, le invitamos a enviarnos una nueva foto de su vehículo. </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesefortn" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            No puedo enviar mensajes, ¿por qué?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesefortn" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>Si su mensaje no ha sido enviado, puede ser causado por alguna de las siguientes situaciones:</p>
                                                <p>Está en proceso de moderación (nuestros equipos se encargarán lo más rápido posible).</p>
                                                <p>Hemos bloqueado el envío, debido a que el mensaje no corresponde a nuestras reglas. </p>
                                                <p>Usted no tiene señal o su conexión es muy débil.</p>
                                                <p>Usted es pasajero: no puede unirse a un conductor si él rechazó su solicitud de reservación, si no hay ningún lugar libre, si la salida está prevista en menos de 15 minutos, o si ya el trayecto ha tenido lugar hace más de 20 días. </p>
                                                <p>Si no le es posible enviar mensajes, no dude de notificarnos. </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesefiften" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿Cómo dejar un comentario?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesefiften" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>¡Dejar un comentario sobre sus compañeros es importante! Es gracias a su comentario que la confianza aumenta cada día entre los miembros de 123poriseba.</p>
                                                <p>El hecho de publicar un comentario luego de compartir vehículo permite informar a la comunidad de la calidad de la experiencia junto al usuario en cuestión.</p>  
                                                <p>¡Mientras más comentarios positivos tenga un usuario, más confiable será!</p> 
                                                <p>Si la publicación de una opinión concierne a un conductor, preguntas adicionales son hechas al pasajero: la evaluación de la forma de conducir es diferente ya que ella será publicada de forma anónima y permite simplemente crear un promedio en el perfil del conductor. Es un cuestionario simple, es suficiente con escoger la casilla que mejor convenga a la experiencia del pasajero en el trayecto del viaje. </p>  
                                                <p>Si la experiencia fue regular pero su compañero ha cumplido completamente con todas sus obligaciones, escoja una valoración moderada y no dé una valoración mala a menos que la experiencia haya sido verdaderamente mala y lo justifique. Una opinión es visible para todos en el perfil de su compañero de viaje y puede influenciar sus contactos futuros. Por lo tanto, es importante saber moderar sus opiniones y no ser exageradamente negativo si no es necesario. </p>
                                                <p>Por su parte, usted puede encontrar todos los comentarios que ha recibido o que usted ha publicado en la página « opiniones ».</p>
                                                <p>Una opinión, tanto positiva como negativa, está anclada al perfil de la persona de manera permanente. Si usted tiene la intención de dejar una opinión negativa, pero su mala impresión puede ser explicada fácilmente por las circunstancias externas, le aconsejamos explicarlas en el comentario al publicar una opinión justa. Por ejemplo: un pequeño retardo usualmente puede estar ligado al tráfico, y no justifica una opinión negativa. </p>
                                                <p>Nuestros equipos moderan todos los comentarios publicados. La publicación de una opinión puede ser negada por alguno de los motivos siguientes:</p>
                                                <p>El comentario tiene datos personales (dirección de correo, número de teléfono, nombre completo, etc.)</p>
                                                <p>Su contenido es ofensivo, difamatorio o discriminatorio</p>
                                                <p>Su contenido no tiene relación con la valoración dada. </p>
                                                <p>Su contenido no es explicado. </p>
                                                <p>El sistema de comentarios permite al conjunto de la comunidad de 123poriseba hacerse una opinión sobre un usuario y preferirlo al momento de un trayecto. Es importante que un comentario sea factual y argumentado, especialmente si es negativo.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesesixteen" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            He recibido un comentario que considero injusto, ¿qué hago?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesesixteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>Recibir una opinión negativa nunca es agradable y siempre parece injustificable para la persona que lo recibe, ya que es desagradable ser el objeto de críticas. Sin embargo, incluso si comprendemos que un comentario le puede parecer injusto, no podemos eliminarlo. </p>
                                                <p>123poriseba es una comunidad de miembros que interactúan de manera autónoma, no hacemos más que dirigirla. Los únicos comentarios que nos encargamos de eliminar son aquellos de carácter ofensivo, racista o discriminatorio. </p>
                                                <p><a href="#">Ver mis comentarios</a></p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesesaventen" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿Estoy cubierto por mi propio seguro cuando comparto vehículo?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesesaventen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>123poriseba es una plataforma para compartir vehículo, lo que significa que los gastos de transporte son compartidos entre los pasajeros en un ambiente no profesional y no lucrativo. Esta situación no es diferente del uso corriente de un vehículo autorizado para transportar amigos, colegas o niños. En este caso y ya que esta actividad no genera ninguna ganancia para el conductor, ningún seguro automovilístico específica es exigida de parte de terceras personas. </p>
                                                <p>En caso de un accidente, todos los pasajeros están indemnizados por la « responsabilidad civil de terceros ». Este seguro es obligatorio para el conductor, ninguna extensión de este seguro es necesaria.</p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesesaventenextra" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            Usted es pasajero ¿Los niños cuentan con una tarifa especial?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesesaventenextra" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>No, y es necesario tener mínimo 18 años para poder utilizar la plataforma 123poriseba. </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseseeightteen" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿Cuándo ocurre el pago?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseseeightteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">

                                                <p>Usted paga directamente en el sitio para reservar  su puesto en el trayecto que le interesa. Usted será debitado en el momento del registro de su reservación.</p>
                                                <p>La cantidad de su reservación se mantiene en nuestra cuenta para ser dirigida al conductor una vez el trayecto sea efectuado. </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesenineteen" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            Mi solicitud de reservación ha caducado o ha sido rechazada, ¿qué hago?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesenineteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">

                                                <p>¿El conductor ha rechazado su solicitud o no ha respondido a tiempo? No hay problema, ¡no recibirá cobros!</p>
                                                <p>El conductor puede haber cambiado de opinión y simplemente haber querido modificar su trayecto, o puede haberlo querido anular. Debe saber que no es posible hacer una nueva solicitud con el mismo conductor si ya ha sido rechazado previamente. </p>
                                                <p>Asegúrese de que su perfil esté bien completado (foto, biografía…) para maximizar sus oportunidades en sus solicitudes futuras. ¡Mientras más sepa la persona de usted, más confianza tendrá para aceptarlo!</p>
                                                <p>Le aconsejamos simplemente reservar un nuevo trayecto si su solicitud ha sido rechazada: <a href="#">Buscar un trayecto</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesetwenty" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿El pago está protegido?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesetwenty" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">

                                                <p>Por supuesto, ¡usted puede hacer su pago con toda seguridad! Los datos transmitidos a su banco son completamente cifrados con el encriptado SSL y ninguna información es recopilada por nuestros servidores. Por lo tanto, no tenemos en ningún momento, acceso a sus datos bancarios. </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesetwentyextra" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            No logro pagar con mi tarjeta bancaria, ¿qué hago?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesetwentyextra" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>Si el pago ha sido rechazado en el registro de su reservación, dos razones pueden explicarlo:</p>
                                                <p>Usted ha ingresado datos erróneos</p>
                                                <p>Su tarjeta presenta un problema y su banco bloquea la autorización de pago. </p>
                                                <p>Verifique que haya ingresado correctamente:</p>
                                                <p>Las 16 cifras de su tarjeta (sin espacios)</p>
                                                <p>La fecha de validez</p>
                                                <p>El código de seguridad de tres cifras en el reverso de su tarjeta bancaria</p>
                                                <p>Si toda esta información está correcta y el pago sigue siendo rechazado en nuestro servidor, se trata de un problema con su tarjeta y es necesario que contacte a su banco. Se puede tratar de una tarjeta bloqueada, no activada o que el límite máximo ha sido alcanzado. Usted puede volver a intentarlo en las próximas 24.</p>

                                                <p></p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesetwentyone" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿Cuáles son las condiciones de reembolso?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesetwentyone" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>Los reembolsos son realizados dependiendo del momento en el que usted anule su reservación y dependiendo del motivo de la anulación:</p>
                                                <p>-Si usted anula más de 24 horas antes de la salida, reembolso integral menos la cantidad de gastos de reservación pagados en el momento de la reservación. </p>
                                                <p>-Si usted anula en las últimas 24 horas, usted recuperará 50% de la cantidad dirigida al conductor. La retención de 50% le permite a 123poriseba indemnizar al conductor por la anulación tardía. </p>
                                                <p>-Si usted anula luego de la salida o si bien usted no se presenta al momento de la salida, no recibirá un reembolso y su conductor recibirá su dinero como si usted hubiese viajado con él. </p>
                                                <p>-Si la anulación es de parte del conductor, el reembolso será integral menos la cantidad de gastos de reservación pagados al momento del registro de la reservación que será llevado a cabo en su favor. </p>
                                                <p>Por lo tanto, es importante pensar en la anulación de su reservación o registro de su reclamo lo más pronto posible en el sitio para que el reembolso pueda ser realizado de forma correspondiente. </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesetwentytwo" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿Cómo modificar su reservación?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesetwentytwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>Si la reservación no ha sido aceptada por el conductor, es posible anularla y volver a hacerla ya que ningún cargo ha sido debitado en ese punto.</p>
                                                <p>Una vez su reservación sea validada y los datos hayan sido intercambiados con el conductor, no es posible modificarla y toda modificación debe pasar entonces por una anulación. </p>
                                                <p>Por consecuencia, no es posible, por ejemplo, añadir o retirar un lugar o modificar los lugares de salida o llegada. En tal caso, será necesario anular la reservación y volver a hacerla enseguida pero usted estará sujeto a las Condiciones de Anulación habituales. </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesetwentthree" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿Qué hacer si el conductor modifica su trayecto?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesetwentthree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>Si el conductor cambia su horario o lugar de salida, él debe contactar lo más pronto posible a sus pasajeros para informarles. </p>
                                                <p>Si los cambios son convenientes para usted, póngase se acuerdo directamente con él y usted puede llevar a cabo el trayecto como estaba inicialmente previsto. </p>
                                                <p>Si los cambios no le convienen, y la anulación es de parte del conductor, usted puede recibir un reembolso del trayecto menos la cantidad de gastos de reservación pagados al momento del registro de la reservación. </p>
                                                <p>De hecho, si los cambios propuestos no son compatibles con sus posibilidades, usted deberá pedirle a su conductor que anule su reservación en su anuncio de forma que usted reciba la totalidad del reembolso. </p>
                                                <p>Si él no lo hace, usted debe reportar que el trayecto no sucedió en 7 días. Para eso, ¡es muy simple!</p>
                                                <p>Si el viaje no ha pasado aún, vaya a la página «Reservaciones »</p>
                                                <p>Si el trayecto ya pasó, vaya a la página « Historial de reservaciones ». Haga clic en « Ver anuncio » en el trayecto en cuestión. Luego haga clic en « Anular » y reporte el problema. </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesetwentfour" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿Qué hacer si el conductor anula su viaje?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesetwentfour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>Las anulaciones son poco comunes, sin embargo, si eso le sucede usted recibirá un reembolso completo menos la cantidad de los gastos de reservación pagados en el momento del registro de la reservación. </p>
                                                <p>Si el conductor le notifica por teléfono, pídale que anuncie su anulación oficialmente al hacer clic en « Yo anulo este trayecto » en su anuncio. Si no lo hace él mismo, serpa necesario que usted reporte el problema en su cuenta máximo 7 días después del trayecto e indicar que usted no llevó a cabo este último, con el fin de que podamos tomar en cuenta su reclamo. </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesetwentfive" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            USTED ES CONDUCTOR ¿Por qué me recomiendan ingresar las ciudades que atravieso?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesetwentfive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>Ingresar las escalas de su viaje no es obligatorio pero es recomendado para optimizar sus oportunidades de encontrar pasajeros: si usted publica un viaje, las personas podrían no estar interesadas en el trayecto en su totalidad, pero pueden buscar un viaje en una porción del que usted hará. </p>
                                                <p>Por ejemplo: Usted publica un viaje Medellín – Cali.</p>
                                                <p>Al mencionar una escala en Pereira, una persona que busque un trayecto Medellín – Pereira o Pereira – Cali encontrará su trayecto en los resultados de su búsqueda. </p>
                                                <p>Con el fin de ayudarle en su publicación, nosotros ofrecemos sugerencias de escalas en ciudades. Sin embargo, ¡usted es libre de ofrecer las escalas de su preferencia! </p>
                                                <p><a href="<?= Url::toRoute(['post/create']); ?>" class="greenlink" target="_blank">Publicar un viaje</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesetwentyseven" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            No logro ofrecer mi trayecto, ¿qué hago?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesetwentyseven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>Cierta información es indispensable en el momento de publicar su trayecto:</p>
                                                <p>Las ciudades de salida y llegada</p>
                                                <p>Los lugares de encuentro y de dejada. </p>
                                                <p>La fecha y la hora de salida. </p>
                                                <p>¿Su viaje es una ida y vuelta? Usted debe proponer las dos fechas. </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesetwentyeight" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿Cómo establecer la contribución por pasajero de mis viajes?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesetwentyeight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>Le recomendamos un cierto precio para las contribuciones por pasajero en sus trayectos. Se trata de ayudarlo a establecer un precio justo, que le permita costear los gastos de su vehículo. Usted puede ajustar nuestro precio hasta cierto límite. </p>
                                                <p>Esta recomendación nos sirve también para evitar que los miembros puedan hacer ganancias al momento de compartir vehículo.</p>
                                                <p>Nuestro precio sugerido toma en cuenta los elementos que le permitirán ahorrar en el costo de un trayecto dado (combustible, desgaste del vehículo…). Toma en cuenta la distancia del trayecto al aplicar una cantidad fija por kilómetro ($120 por kilómetro)</p>
                                                <p><a href="<?= Url::toRoute(['post/create']); ?>" class="greenlink" target="_blank">Publicar un viaje</a></p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesetwentynine" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿Cuántos pasajeros puedo llevar?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesetwentynine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>El número de pasajeros que usted puede transportar depende de su vehículo. </p>
                                                <p>Usted puede hacer la prueba al colocarse en la parte trasera de su vehículo: ¿cree que el asiento trasero es lo suficientemente cómodo para 2 o 3 lugares?</p>
                                                <p>Igualmente, es indispensable que cada pasajero disponga de un cinturón de seguridad y de la comodidad requerida para un viaje en automóvil. </p>
                                                <p>Entonces, podemos estimar que 3 pasajeros son el máximo para un auto pequeño, 4 son aceptables en una vagoneta cómoda si el equipaje no es numeroso. </p>
                                                <p>Atención: no es posible ofrecer más de 4 lugares a bordo de un vehículo, sea cual sea el precio recomendado. </p>
                                                <p>Le recordamos que compartir vehículo consiste en compartir los gastos y que, si bien es posible recuperar la totalidad de los costos en ciertos trayectos, no sería normal que usted reciba cualquier ganancia, por la regularidad o el volumen de los trayectos efectuados, bajo la posibilidad de verse obligado a declarar ante las autoridades fiscales.</p>
                                                <p><a href="<?= Url::toRoute(['post/create']); ?>" class="greenlink" target="_blank">Publicar un viaje</a></p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesethirty" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            Hay un error en mi anuncio, ¿qué hago?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesethirty" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>Usted ha notado un error en su anuncio en cuanto a las ciudades de salida o llegada, una escala no tiene sentido o está desordenada, el precio es incorrecto, etc. Usted puede verificar su anuncio en su Tablero de borde. </p>
                                                <p>Es muy simple:</p>
                                                <p>Seleccione el anuncio en cuestión</p>
                                                <p>Haga clic en « Modificar »</p>
                                                <p>Verifique que la información ingresada en la primera parte sea correcta</p>
                                                <p>Haga clic en el botón « Continuar » para pasar directamente a la segunda parte de su anuncio</p>
                                                <p>Verifique toda la información </p>
                                                <p>Haga clic en « Continuar y publicar » para registrar sus modificaciones. </p>
                                                <p>Si el problema persiste, le invitamos a <a href="mailto:contact@123poriseba.co" class="greenlink">contactarnos</a> para describirnos el problema en cuestión. </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesethirtyon" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿Cómo anular mi anuncio?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesethirtyon" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>¿Usted tiene un impedimento, un inconveniente de último minuto?</p>
                                                <p>No se tarde, ¡elimine lo más pronto posible su anuncio!</p>
                                                <p>Su pasajero debe ser informado lo más rápido posible para poder encontrar otro compañero de viaje y usted debe registrar la anulación desde su cuenta directamente para que el reembolso sea liberado automáticamente y que no haya ningún reclamo. </p>
                                                <p>Para eso, es muy simple:</p>
                                                <p>Seleccione el anuncio en cuestión</p>
                                                <p>Haga clic en « Eliminar », visible en el cuadro de su anuncio</p>
                                                <p>Indique la razón de su anulación (esta información no serpa publicada y nos permite simplemente mejorar nuestro servicio)</p>
                                                <p>Confirme la anulación al hacer clic en « Sí, anular este trayecto ».</p>
                                                <p>De esa forma, otras reservaciones no podrán ser realizadas y sus pasajeros serán inmediatamente notificados de su anulación por correo electrónico y por mensaje de texto, luego recibirán igualmente su reembolso. </p>
                                                <p>La tarifa de anulación es registrada en su perfil, es tomada en cuenta si las reservaciones están en proceso. No hay sanciones por la anulación de un trayecto, y el motivo que usted escoja al momento de validar su anulación no es publicado. Sin embargo, con el fin de garantizar la fiabilidad de los anuncios y proteger a los pasajeros de anulaciones inoportunas, 123poriseba se reserva el derecho de suspender su posibilidad de publicar anuncios con reservación en línea su usted anula muy seguido. </p>
                                                <p>Usted puede contactar directamente a su pasajero (además de la anulación realizada en el sitio) para notificarle de su anulación, ¡él sabrá apreciar ese esfuerzo de su parte!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesethirtyon-on" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿Y si un pasajero cancela antes de la salida?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesethirtyon-on" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>Como el conductor, usted está indemnizado en cado de anulación de último minuto. </p>
                                                <p>El hecho que sus pasajeros reserven en línea reduce la posibilidad de una anulación antes de la salida porque ellos se comprometen al pagar su lugar de forma adelantada. Sin embargo, nadie está exento de un imprevisto y es posible que uno de sus pasajeros se encuentre en la obligación de anular su reservación.</p>
                                                <p>Las condiciones de anulación de 123poriseba son las siguientes:</p>
                                                <p>Su pasajero anula más de 24 horas antes de la salida: el lugar que estaba reservado para él pasa automáticamente a estar disponible en el sitio. Usted tiene entonces oportunidad de que otro pasajero la reserve antes de su salida. </p>
                                                <p>Su pasajero anula en las últimas 24 horas antes de la salida: el lugar que estaba reservado pasa automáticamente a estar disponible en el sitio, y usted recibe una indemnización de 50% de la cantidad que usted había exigido por lugar. Esta indemnización le será enviada incluso si otro pasajero reserva el lugar en cuestión antes de su salida. </p>
                                                <p>Su pasajero anula luego de la salida o no se presenta al momento de la salida: usted recibe su contribución como si él hubiese hecho el viaje. En ese caso, a usted le basta con reportar luego en su cuenta y en el trayecto en cuestión que la persona no se presentó para que los equipos puedan tomar en cuenta su reclamo. </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesethirtytwo" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿Usted ha notado un fallo en el funcionamiento?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesethirtytwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>A pesar de toda la atención invertida en la concepción del sitio y porque evoluciona permanentemente, pequeños bugs o fallos pueden suceder. </p>
                                                <p>Si usted presencia el menor fallo, problema de presentación o problema recurrente, su reporte será precioso para nosotros ya que nos permitirá resolver rápidamente el problema. </p>
                                                <p>Por lo tanto, no dude de notificarnos cualquier fallo de funcionamiento al darnos la mayor cantidad posible de detalles en los problemas encontrados. </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesethirtythree" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿Usted se ha encontrado con un comportamiento contrario a las reglas?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesethirtythree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>123poriseba es una comunidad de miles de usuarios, que debemos dirigir, supervisar, moderar en todo momento. Y a pesar de todas las verificaciones que hacemos, nada podrá reemplazar el uso que usted tiene del sitio y el tiempo que pasa ahí. </p>
                                                <p>Ya que ustedes son los usuarios del sitio, son ustedes quienes pueden reportarnos las cosas anormales o aquellas que puedan representar un problema para el sitio. </p>
                                                <p>No dude de <a href="mailto:contact@123poriseba.co" class="greenlink">contactarnos</a> en el momento que detecte cualquier cosa anormal:</p>
                                                <p>-En cada anuncio y perfil, existe un enlace para reportar directamente cualquier comportamiento sospechoso. </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesethirtyfour" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="more-less glyphicon glyphicon-chevron-down"></i>
                                            ¿Usted tiene una sugerencia para nosotros?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsesethirtyfour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="bottom-part-text-smi">
                                            <div class="smi-line-grid-2">
                                                <p>¡Nosotros estamos abiertos a escuchar sus buenas ideas, sugerencias de mejoramiento y solicitudes de funciones!</p>
                                                <p>Igualmente si ya pueden haber sido mencionadas y que todas no pueden ser aplicadas, no hay que dudar en hacernos saber. ¿Quién sabe? ¡Podría encontrarse con una agradable sorpresa!</p>
                                                <p>¡Le agradecemos hacernos llegar todas sus buenas ideas!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div><!-- panel-group -->
                    </div>



                </div>


            </div>
        </div>
    </div>
</section>
<script>
    function toggleIcon(e) {
        $(e.target)
                .prev('.panel-heading')
                .find(".more-less")
                .toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
    }
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>





