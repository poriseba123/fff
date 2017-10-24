<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
?>
<section class="como-func-banner-sec">
    <div class="container">
        <h1 class="title"><?= $this->context->span_accent('¿Usted es pasajero?') ?></h1>
    </div>
</section>

<section class="como-func-page-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="upper-part-text">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <h1><?= $this->context->span_accent('Simple y económico:') ?></h1> 
                            <p><?= $this->context->span_accent('Reserve fácilmente su puesto en línea y viaje<br> másbarato, más rápido y con toda confianza.') ?></p>
                        </div>
                    </div>
                </div>

                <div class="bottom-part-text">
                    <h1><?= $this->context->span_accent('Busque su trayecto'); ?></h1>
                    <p>
                        <?= $this->context->span_accent('Ingrese su ciudad de partid y su ciudad de llegada, escoja la fecha del viaje y una selección de conductores aparecerá. 
                        ¡No le faltará más que escoger!<br> Si usted necesita detalles específicos sobre un trayecto usted puede enviar un mensaje al conductor. 
                        Usted puede confiar en nosotros: cada conductor es<br> aprobado manualmente por nuestros equipos y usted puede saber más sobre ellos al 
                        consultar su perfil (foto, biografía, comentarios).<br><a href="#"> Enlace hacia la carta de confianza de la comunidad.</a>') ?> 
                    </p>
                </div>

                <div class="bottom-part-text">
                    <h1><?= $this->context->span_accent('Reserve y pague en línea'); ?></h1>
                    <p>
                        <?=
                        $this->context->span_accent('Usted reserva su lugar en línea. Su conductor será notificado inmediatamente de su reservación a través de correo electrónico y '
                                . 'mensaje de texto.<br> Enseguida, usted puede llamar al conductor para ponerse de acuerdo con respecto a los detalles finales (por ejemplo, el lugar exacto '
                                . 'del encuentro).<br><a href="#"> Enlace hacia las condiciones de anulación.</a> ')
                        ?> 
                    </p>
                </div>

                <div class="bottom-part-text">
                    <h1><?= $this->context->span_accent('Viaje'); ?></h1>
                    <p>
                        <?= $this->context->span_accent('Una vez establecido el lugar de salida con el conductor, ¡sea puntual!<br> No olvide dejar un comentario en el perfil de su conductor luego del trayecto. ') ?> 
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="como-func-banner-sec-2">
    <div class="container">
        <h1 class="title"><?= $this->context->span_accent('¿Usted es conductor?') ?></h1>
    </div>
</section>

<section class="como-func-page-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="upper-part-text">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <h1><?= $this->context->span_accent('Económico y social') ?></h1> 
                            <p><?= $this->context->span_accent('Comparta sus gastos al tener pasajeros amigables en su<br>viaje de automóvil y dele una mano al medio ambiente. ') ?></p>
                        </div>
                    </div>
                </div>

                <div class="bottom-part-text">
                    <h1><?= $this->context->span_accent('Publique un anuncio'); ?></h1>
                    <p>
                        <?= $this->context->span_accent('Indique la fecha y el horario de su trayecto, su itinerario y el precio por pasajero. <br>123Vamos le indicará el precio recomendado para aumentar sus oportunidades de compartir vehículo.') ?> 
                    </p>
                </div>

                <div class="bottom-part-text">
                    <h1><?= $this->context->span_accent('Los pasajeros reservan y realizan los pagos en línea'); ?></h1>
                    <p>
                        <?=
                        $this->context->span_accent('Sus pasajeros reservan y pagan en línea a través de 123Vamos. Usted será notificado automáticamente por correo electrónico y mensaje de texto<br> por cada nueva reservación.Seguidamente, usted puede comunicarse con la persona para fijar los detalles finales.<br> Usted puede ver más información de los pasajeros en sus perfiles en línea. ')
                        ?> 
                    </p>
                </div>

                <div class="bottom-part-text">
                    <h1><?= $this->context->span_accent('Viaje'); ?></h1>
                    <p>
                        <?= $this->context->span_accent('Una vez establecido el lugar de salida, ¡sea puntual! ¡Considere colocar una foto de su vehículo en su perfil! Eso le permitirá obtener más contactos<br> para compartir su vehículo y los pasajeros podrán reconocerlo con más facilidad al momento del encuentro.') ?> 
                    </p>
                </div>
                
                 <div class="bottom-part-text">
                    <h1><?= $this->context->span_accent('Reciba su dinero'); ?></h1>
                    <p>
                        <?= $this->context->span_accent('Usted recibirá el pago automáticamente en su cuenta bancaria 15 días después del trayecto.') ?> 
                    </p>
                </div>
                
            </div>
        </div>
    </div>
</section>



