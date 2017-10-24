<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
?>
<section class="como-func-banner-sec">
    <div class="container">
        <h1 class="title"><?= $this->context->span_accent('�Usted es pasajero?') ?></h1>
    </div>
</section>

<section class="como-func-page-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="upper-part-text">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <h1><?= $this->context->span_accent('Simple y econ�mico:') ?></h1> 
                            <p><?= $this->context->span_accent('Reserve f�cilmente su puesto en l�nea y viaje<br> m�sbarato, m�s r�pido y con toda confianza.') ?></p>
                        </div>
                    </div>
                </div>

                <div class="bottom-part-text">
                    <h1><?= $this->context->span_accent('Busque su trayecto'); ?></h1>
                    <p>
                        <?= $this->context->span_accent('Ingrese su ciudad de partid y su ciudad de llegada, escoja la fecha del viaje y una selecci�n de conductores aparecer�. 
                        �No le faltar� m�s que escoger!<br> Si usted necesita detalles espec�ficos sobre un trayecto usted puede enviar un mensaje al conductor. 
                        Usted puede confiar en nosotros: cada conductor es<br> aprobado manualmente por nuestros equipos y usted puede saber m�s sobre ellos al 
                        consultar su perfil (foto, biograf�a, comentarios).<br><a href="#"> Enlace hacia la carta de confianza de la comunidad.</a>') ?> 
                    </p>
                </div>

                <div class="bottom-part-text">
                    <h1><?= $this->context->span_accent('Reserve y pague en l�nea'); ?></h1>
                    <p>
                        <?=
                        $this->context->span_accent('Usted reserva su lugar en l�nea. Su conductor ser� notificado inmediatamente de su reservaci�n a trav�s de correo electr�nico y '
                                . 'mensaje de texto.<br> Enseguida, usted puede llamar al conductor para ponerse de acuerdo con respecto a los detalles finales (por ejemplo, el lugar exacto '
                                . 'del encuentro).<br><a href="#"> Enlace hacia las condiciones de anulaci�n.</a> ')
                        ?> 
                    </p>
                </div>

                <div class="bottom-part-text">
                    <h1><?= $this->context->span_accent('Viaje'); ?></h1>
                    <p>
                        <?= $this->context->span_accent('Una vez establecido el lugar de salida con el conductor, �sea puntual!<br> No olvide dejar un comentario en el perfil de su conductor luego del trayecto. ') ?> 
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="como-func-banner-sec-2">
    <div class="container">
        <h1 class="title"><?= $this->context->span_accent('�Usted es conductor?') ?></h1>
    </div>
</section>

<section class="como-func-page-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="upper-part-text">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <h1><?= $this->context->span_accent('Econ�mico y social') ?></h1> 
                            <p><?= $this->context->span_accent('Comparta sus gastos al tener pasajeros amigables en su<br>viaje de autom�vil y dele una mano al medio ambiente. ') ?></p>
                        </div>
                    </div>
                </div>

                <div class="bottom-part-text">
                    <h1><?= $this->context->span_accent('Publique un anuncio'); ?></h1>
                    <p>
                        <?= $this->context->span_accent('Indique la fecha y el horario de su trayecto, su itinerario y el precio por pasajero. <br>123Vamos le indicar� el precio recomendado para aumentar sus oportunidades de compartir veh�culo.') ?> 
                    </p>
                </div>

                <div class="bottom-part-text">
                    <h1><?= $this->context->span_accent('Los pasajeros reservan y realizan los pagos en l�nea'); ?></h1>
                    <p>
                        <?=
                        $this->context->span_accent('Sus pasajeros reservan y pagan en l�nea a trav�s de 123Vamos. Usted ser� notificado autom�ticamente por correo electr�nico y mensaje de texto<br> por cada nueva reservaci�n.Seguidamente, usted puede comunicarse con la persona para fijar los detalles finales.<br> Usted puede ver m�s informaci�n de los pasajeros en sus perfiles en l�nea. ')
                        ?> 
                    </p>
                </div>

                <div class="bottom-part-text">
                    <h1><?= $this->context->span_accent('Viaje'); ?></h1>
                    <p>
                        <?= $this->context->span_accent('Una vez establecido el lugar de salida, �sea puntual! �Considere colocar una foto de su veh�culo en su perfil! Eso le permitir� obtener m�s contactos<br> para compartir su veh�culo y los pasajeros podr�n reconocerlo con m�s facilidad al momento del encuentro.') ?> 
                    </p>
                </div>
                
                 <div class="bottom-part-text">
                    <h1><?= $this->context->span_accent('Reciba su dinero'); ?></h1>
                    <p>
                        <?= $this->context->span_accent('Usted recibir� el pago autom�ticamente en su cuenta bancaria 15 d�as despu�s del trayecto.') ?> 
                    </p>
                </div>
                
            </div>
        </div>
    </div>
</section>



