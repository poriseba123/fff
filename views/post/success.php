<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Settings;
?>
<div class="main-body-wrap">
            <section class="publicar-3-top">
                <div class="container">
                    <div class="publicar-3-top-wrap">
                        <h2 class="publicar-3-title">¡Tú anuncio está en línea!</h2>
                        <a href="<?= Url::toRoute(['search/postdetail', 'id' => $model->id ]); ?>"><h4 class="btm-title open-sans">Ver tu anuncio</h4></a>
                        <h3 class="publicar-3-title">Ahora, ¿qué pasa?</h3>
                    </div>
                </div>
            </section>
            <section class="publicar-3-mid">
                <div class="container">
                    <div class="publicar-3-mid-wrap open-sans">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="single-icon-detail">
                                    <div class="icon-wrap"><i class="fa fa-plus" aria-hidden="true"></i></div>
                                    <h3 class="icon-heading">Contesta a las preguntas</h3>
                                    <p class="icontext">
                                        Recibirás un mensaje cada vez que tengas una nueva 
                                        pregunta. Contesta rápidamente para tener un viaje 
                                        óptimo.
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="single-icon-detail">
                                    <div class="icon-wrap"><i class="fa fa-plus" aria-hidden="true"></i></div>
                                    <h3 class="icon-heading">Acepte las reservas</h3>
                                    <p class="icontext">Después de aceptar la reserva recibirás el número de teléfono de la persona para verificar el viaje.</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="single-icon-detail">
                                    <div class="icon-wrap"><i class="fa fa-plus" aria-hidden="true"></i></div>
                                    <h3 class="icon-heading">Viaja tranquilo</h3>
                                    <p class="icontext">
                                        ¡Es súper seguro!
                                        Verificamos cada perfil,
                                        cada identidad y cada foto.
                                        Los miembros dan sus
                                        opiniones para ayudarlos.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="publicar-3-btm">
                <div class="container">
                    <div class="publicar-3-btm-wrap open-sans">
                        <div class="foot-part">
                            <p>
                                La información recibida por 123Vamos es utilizada para crear y verificar tu cuenta, por eso es obligatoria. Al completar esta información estás aceptando nuestras <a href="<?= Url::toRoute(['site/terminos_y_condiciones']); ?>" class="greenlink" target="_blank">Condiciones Generales</a>. Para saber más puedes consultar nuestras <a href="<?= Url::toRoute(['site/preceptos_de_confidencialidad']); ?>" class="greenlink" target="_blank">Políticas de Confidencialidad</a>.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>