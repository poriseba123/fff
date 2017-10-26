<?php
use yii\helpers\Url;
?>
<section class="buscar-5-top-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-sm-12">
                <div class="decoreted-box-2 clearfix">
                    <h3>El conductor</h3>
                    <div class="doted-top clearfix">
                        <div class="col-md-8 col-sm-7">
                            <div class="left-part open-sans">
                                <div class="media">
                                    <div class="media-left">
                                         <a href="<?= Url::toRoute(['publicprofile/index','id'=>$model->id]); ?>" target="_blank">
                                            <img src="<?php echo $this->context->getUserProfileImage($model->id); ?>" class="media-object img-circle" style="width:60px;height:60px;">
                                            </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading heading"><?php echo $model->first_name . ' ' . $model->last_name ?></h4>
                                            <p class="heading"><?php echo $this->context->getAge($model->birth_year); ?></p>
                                    </div>
                                    <div class="media-bottom1">
                                        <?php if(count($rating_master)>0){ ?>
                                         <!--<img src="<?php // echo $this->context->getStaticImage('rating_1.png') ?>" class="media-object img-responsive">-->
                                        <div class="rating-pop cust-rating">
                                            <input type="text" data-hover-enabled='false' data-display-only='true' class="ratingAnalysisItems rating rating-loading" data-size='sm' data-min="0" data-max="5" data-step="1" data-show-caption="false" data-show-clear='false' id="analysisRating_id_input" class="form-control ratingAnalysisItems" type="number" value="<?= $avg_rating['avg_rating'] ?>">
                                        </div>
                                          <span><?=count($rating_master);?> opiniónes</span>
                                        <?php }else{ ?>
                                          <div class="rating-pop cust-rating">
                                            <input type="text" data-hover-enabled='false' data-display-only='true' class="ratingAnalysisItems rating rating-loading" data-size='sm' data-min="0" data-max="5" data-step="1" data-show-caption="false" data-show-clear='false' id="analysisRating_id_input" class="form-control ratingAnalysisItems" type="number" value="0">
                                        </div>
                                          <span>0 opiniónes</span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-5">
                            <div class="right-part">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="<?php echo $this->context->getStaticImage('grn_right_icon.png') ?>" class="media-object img-circle title-tooltip" title="Conductor flexible">
                                    </div>
                                    <div class="media-body open-sans">
                                        <ul>
                                                <?php if($model->identity_document_verified==1){?>
                                                <li><a href="javascript:;" class="linkDisabled">Cédula verificada</a></li>
                                                <?php }if($model->phone_verification==1){?>
                                                <li><a href="javascript:;" class="linkDisabled">Teléfono verificado</a></li>
                                                <?php }if($model->email_varified==1){ ?>
                                                <li><a href="javascript:;" class="linkDisabled">Email verificado</a></li>
                                                <?php } ?>
                                        </ul>
                                    </div>

                                     <?php
                                        if(Yii::$app->user->id!=$model->id){
                                        ?>
                                            <div class="media-bottom">
                                                <a href="javascript:;" onclick="sendMessage('<?=$model->id?>')" class="btn-block btn bascar-btn open-sans">CONTACTAR EL CONDUCTOR</a>
                                            </div>
                                        <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="doted-btm clearfix open-sans">

                        <div class="col-md-12">
                            <?php
                            
                            if(count($rating_master)>0){
                                $k=0;
                                foreach ($rating_master as $k=>$v) {
                               if($k>7){
                                   break;
                               }     
                            ?>
                            <div class="media">
                                <div class="media-left">
                                   <a href="<?= Url::toRoute(['publicprofile/index','id'=>$v->user_id]); ?>" target="_blank">
                                            <img src="<?php echo $this->context->getUserProfileImage($v->user_id); ?>" class="media-object img-circle" style="width:60px;height:60px;">
                                            </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading mensajes-name"><?php echo $v->userDetails->first_name . ' ' . $v->userDetails->last_name ?></h4>
                                    <p class="mensajes-title"><?php echo $v->userDetails->first_name?> : <?= $v->review ?></p>
                                    <p class="sm-date"><?= $this->context->get_month_name(date("F", strtotime($v->added_date))).' , '.date("Y", strtotime($v->added_date))?></p>
                                </div>
                            </div>
                            <?php }} ?>

                             <?php if(count($rating_master)>0){ if($k>7){ ?>
                            <a href="<?= Url::toRoute(['publicprofile/opinions','id'=>$v->user_id]); ?>" class="btn open-sans">Ver todas las opiniones</a>
                             <?php } }?>
                        </div>

                    </div>
                </div>

                <div class="decoreted-box-3 clearfix">

                    <div class="doted-top clearfix">
                        <div class="col-md-12">
                            <div class="left-part open-sans">
                                <ul>
                                    <li>Miembro desde:&nbsp;<?= $this->context->get_month_name(date("F", strtotime($model->added_date))).' , '.date("Y", strtotime($model->added_date))?></li>
                                    <li>Anuncios publicads:&nbsp;<?=$total_ads?></li>
                                </ul>

                                <div class="travel-dtl">
                                    <h1>Biografia corta</h1>

                                    <p><?=$model->bio?></p>
                                    <?php if($model->id!= Yii::$app->user->id){ ?>
                                    <h2><a href="javascript:;" onclick="reportProfile('<?= $model->id?>')">Señalar este perfil</a></h2>
                                    <?php } ?>

                                </div>

                                <div class="new-btm-line">
                                    <ul>
                                        <?php
                                        $brand='Not Set';
                                        $model_no='';
                                        $color='Not Set';
                                        $car_img='';
                                        if(isset($model->vehicle) && $model->vehicle!=''){
                                            $brand=$model->vehicle->vBrand->brand;
                                            $model_no=$model->vehicle->vModel->model_no;
                                            $color=$model->vehicle->vColor->color_name_es;
                                            $car_img=$model->vehicle->car_img;
                                        }
                                        ?>
                                        <li><span>El vehículo es :</span> <?php echo $brand.' '.$model_no; ?></li>
                                        <li><span>Color :</span> <?php echo $color; ?></li>
                                    </ul>
                                    <img src="<?= $this->context->getUserVehicleImg($car_img); ?>" class="media-object" style="width: 95px;height: auto;margin: 33px 0 0 0;display: inline-block;float: right;">
                                </div>

                            </div>
                        </div>


                    </div>


                </div>



            </div>
        </div>
        <div class="foot-part">
            <p>
                                La información recibida por poriseba es utilizada para crear y verificar tu cuenta, por eso es obligatoria. Al completar esta información estás aceptando nuestras <a href="<?= Url::toRoute(['site/terminos_y_condiciones']); ?>" class="greenlink" target="_blank">Condiciones Generales</a>. Para saber más puedes consultar nuestras <a href="<?= Url::toRoute(['site/preceptos_de_confidencialidad']); ?>" class="greenlink" target="_blank">Políticas de Confidencialidad</a>.
                            </p>
        </div>
    </div>
</section>
<div class="modal fade cust-my-modal-2" id="report-profile-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"  aria-hidden="false">
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
                                        <h1>¿Razón del informe?</h1>
                                    </div>
                                    <form class="form" role="form" method="post" id="report_profile_form">
                                        <input type="hidden" name="to_user_id" id="to_user_id" value="">
                                        <div class="form-group row">
                                            <textarea name="reason" id="reason" placeholder="Díganos" class="form-control"></textarea>
                                            <div class="help-block" id="reason-help-block" style="text-align: left;"></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="btn-rap text-center">
                                                <input type="submit" class="btn" value="Informe">
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
<div class="modal fade cust-my-modal-2" id="message-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"  aria-hidden="false">
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
                                        <h1>Escribe un mensaje</h1>
                                    </div>
                                    <form id="message-form" name="message-form">
                                        <input type="hidden" id="to_id" name="to_id" value="">
                                        <textarea id="message" name="message" class="form-control cust-textarea" placeholder="Escribir tu mensaje aquí"></textarea>
                                        <div class="help-block" id="message-help-block"></div>
                                        <div class="text-right">
                                            <button class="all-default-btn" type="submit">ENVIAR</button>
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
    if ($('.ratingAnalysisItems').length > 0) {
            var ids = $('.ratingAnalysisItems').map(function () {
                return $(this).attr('id');
            });
            $.each(ids, function (item, value) {
                window.console.log(value);
                var _this = $('#' + value);

                _this.rating({
                    min: 0,
                    max: 5,
                    step: 0.5,
                    size: 'xs',
                    showClear: false
                });
            });
        }
        function reportProfile(id){
            $('#to_user_id').val(id);
            $('#report-profile-modal').modal('show');
        }
         function sendMessage(id){
            $('#to_id').val(id);
//            alert('something went wrong');
            $('#message-modal').modal('show');
        }
</script>
<?php
$this->registerJsFile(
        Yii::$app->request->baseUrl . '/themes/frontend/custom/js/trip-booking.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>