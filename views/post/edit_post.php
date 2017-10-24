<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Settings;
$kmprice= Settings::find()
        ->where(['slug' => 'km_price'])
        ->one();
//echo "<pre>";
//print_r(count($location));
//print_r($location[0]->total_distance);
//exit;
?>
<?php

        $useragent=$_SERVER['HTTP_USER_AGENT'];
        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))

        { 
            $device="mobile";
        }
        else{
            $device="desktop";
        }
?>
<script>
var km_price=<?php echo $kmprice->value ?>;
</script>
<section class="publicar-top">
    <div class="container">
	<div class="row spl_header_menu">
	   <?= $this->context->renderPartial("../partials/user_pro_main_tab_ul") ?>
	</div>
        <div class="publicar-top-wrap">
            <h2 class="publicar-title">Recapitulación del viaje</h2>
            <div class="row">
                <div class="col-md-5 col-sm-6">
                    <div class="map-wrap">
                        <div id="map" style="width:100%;height:450px;"></div>
                    </div>
                </div>
                <div class="col-md-7 col-sm-6">
                    <div class="travel-form-wrap">
                        <form action="" class="form">
                            <?php 
                            $total_rows=count($location);//3
                            foreach ($location as $key => $value) {
                                if($key==0){
                            ?>
                            <div class="row">
                                <div class="col-sm-6 no-pad-new-left">
                                    <div class="form-group ">
                                        <div class="">
                                            <label class="label-control">¿Desde cuál ciudad saldrá?</label>
                                            <input type="text" id="start" class="form-control" name="start" placeholder="¿Desde cuál ciudad saldrá?" onfocus="" onkeyup="codeAddress('start')" aria-required="true" autocomplete="off" value="<?php echo $value->location_a_name ?>">
                                            <input type="hidden" name="start_lat" id="start_lat" value="<?php echo $value->location_a_lat;?>">
                                            <input type="hidden" name="start_long" id="start_long" value="<?php echo $value->location_a_long;?>">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                 <?php if($device=="desktop"){ ?>
                                <div class="col-sm-6 no-pad-new-left">
                                    <div class="form-group ">
                                        <div class="">
                                            <label class="label-control">¿Hora de inicio?</label>
                                            <input id="start_time" type="text" readonly placeholder="¿hora de inicio?" class="form-control form_datetime" value="<?php echo $value->departure_datetime; ?>">
                                            <input type='hidden' id='intime_1' value='<?php echo $value->departure_datetime; ?>'>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                                <?php }if($key==$total_rows-1){ ?>
                            <div class="row">
                                <div class="col-sm-6 no-pad-new-left">
                                    <div class="form-group ">
                                        <div class="">
                                            <label class="label-control">¿Hasta cuál ciudad viajará?</label>
                                            <input value="<?php echo $value->location_b_name ?>" type="text" id="end" class="form-control" name="end" placeholder="¿Hasta cuál ciudad viajará?" onfocus="" onkeyup="codeAddress('end')" aria-required="true" autocomplete="off" >
                                            <input type="hidden" id="end_lat" value="<?php echo $value->location_b_lat ?>">
                                            <input type="hidden" id="end_long" value="<?php echo $value->location_b_long ?>">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                 <?php if($device=="mobile"){ ?>
                                <div class="col-sm-6 no-pad-new-left">
                                    <div class="form-group ">
                                        <div class="">
                                            <label class="label-control">¿Hora de inicio?</label>
                                            <input id="start_time" type="text" readonly placeholder="¿hora de inicio?" class="form-control form_datetime" value="<?php echo $value->departure_datetime; ?>">
                                            <input type='hidden' id='intime_1' value='<?php echo $value->departure_datetime; ?>'>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                 <?php } ?>
                            </div>
                            <?php
                            }
                            }
                            ?>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 no-pad-new-left">
                                    <div class="form-group ">
                                        <div class="">
                                            <label class="label-control">¿En cuáles ciudades parará?</label>
                                            <!--<input class="form-control hidden" placeholder="¿En cuáles ciudades parará?" type="text" disabled="" hidden="">-->
                                            <div class="btn-block">
                                                <a href="javascript:;" onclick="addStop();" class="add-stopages"><i class="fa fa-plus" aria-hidden="true"></i> Agregar una nueva parada</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="stopage">
                                <?php
                                 foreach ($location as $key => $value) {
                                     if($key<$total_rows-1){
                                ?>
                                <div class="row stopage_<?php echo $key ?>">
                                        <div class="col-sm-12 no-pad-new-left">
                                            <div class="form-group ">
                                                <div class="">
                                                    <label class="label-control">¿Desde cuál ciudad saldrá?</label>
                                                    <div class="row">
                                                        <div class="col-md-8 col-sm-7">
                                                        <input value="<?php echo $value->location_b_name; ?>" type="text" id="stop<?php echo $key; ?>" class="form-control" name="stop[]" placeholder="Add a location here..." onkeyup="stopageAddress(<?php echo $key; ?>)" aria-required="true" autocomplete="off">
                                                        <div class="help-block"></div>    
                                                        </div>
                                                        <div class="col-md-4 col-sm-5">
                                                         <div class="btn-group btn-group-solid"><button type="button" class="btn btn-danger" style="font-size:17px;" onclick="removeOptionRow(<?php echo $key ?>)"> X </button></div>
                                                        </div>
                                                        </div>
                                                    <input type="hidden" id="stop<?php echo $key;?>_lat" value="<?php echo $value->location_b_lat; ?>">
                                                    <input type="hidden" id="stop<?php echo $key;?>_long" value="<?php echo $value->location_b_long; ?>">
                                                    <input type="hidden" id="intime_<?php echo $key+2;?>" value="<?php echo $value->arrival_datetime; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>                             
                                <?php
                                }
                                }
                                ?>

                            </div>
                            <div class="row">
                                <div class="col-sm-12 no-pad-new-left">
                                    <div class="form-group ">
                                        <button class="all-default-btn" type="button" id="editsubmit">GUARDAR</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="publicar-btm" id="publicar-btm" style="">
    <div class="container">
        <div class="publicar-btm-wrap ">
            <div class="publicar-detail-form">
                <div class="text-right">
                    <div class="value-percentage">
                        <div class="input-group spinner value-input-cust">
                            
                        <div class="row">
                                <div class="col-md-5">
                                     <!--<span id="span_google_price"><?php echo round($model->total_cost_old); ?></span>-->
                            <!--<span class="cust1span" style="display: table-cell;vertical-align: middle;margin-right: 22px;">Aumento de precio(%)</span>-->
                                <div class="custom-price-box">
                                        <h1>Precio recomendado $<span id="span_google_price"><?php echo round($model->total_cost_old); ?></span></h1>
                                    
<!--                                    <span class="cust1span" style="vertical-align: middle;margin-right: 22px;">Expected price</span>-->
                                    </div>
                                </div>
                                <div class="col-md-7">
                            <input type="hidden" name="percentage" id="percentage" old-value="<?php echo $model->increase_parcent; ?>" class="form-control editpercentage" value="<?php echo $model->increase_parcent; ?>" min="0" max="30">
                            <input type="number" name="manual_price" id="manual_price" old-value="<?php echo round($model->total_cost); ?>" class="form-control editmanual_price" value="<?php echo round($model->total_cost); ?>" placeholder="Ponga tu precio aquí">
                            <div class="help-block" id="percentage-help-block"></div>
                                </div>
                            </div>
                        
                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="detail-form-wrap" id='directions-panel'>
                <form class="form" name="postEditForm" id="postEditForm">
                    <input type="hidden" name="post_id" value="<?php echo $model->id ?>">
                    <input type="hidden" name="not_new" value="<?php echo $model->id ?>">
                    <?php
                    for($i=0;$i<=$total_rows;$i++){
                    ?>
                    <?php if($i==0){ ?>
                    <div class="row result_row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="">
                                    <label class="label-control">¿Desde cuál ciudad saldrá?</label>
                                    <input name="start[<?php echo $location[$i]->id; ?>]" class="form-control readonly" readonly placeholder="¿Desde cuál ciudad saldrá?" type="text" value="<?php echo $location[$i]->location_a_name; ?>">
                                    <input name="stop[<?php echo $location[$i]->id; ?>]" class="form-control" placeholder="¿Desde cuál ciudad saldrá?" type="hidden" value="<?php echo $location[$i]->location_b_name; ?>" >
                                    <input name="new_start_lat[<?php echo $location[$i]->id; ?>]" class="form-control" placeholder="¿Desde cuál ciudad saldrá?" type="hidden" value="<?php echo $location[$i]->location_a_lat; ?>" >
                                    <input name="new_start_long[<?php echo $location[$i]->id; ?>]" class="form-control" placeholder="¿Desde cuál ciudad saldrá?" type="hidden" value="<?php echo $location[$i]->location_a_long; ?>" >
                                    <input name="new_stop_lat[<?php echo $location[$i]->id; ?>]" class="form-control" placeholder="¿Desde cuál ciudad saldrá?" type="hidden" value="<?php echo $location[$i]->location_b_lat; ?>" >
                                    <input name="new_stop_long[<?php echo $location[$i]->id; ?>]" class="form-control" placeholder="¿Desde cuál ciudad saldrá?" type="hidden" value="<?php echo $location[$i]->location_b_long; ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group ">
                                <div class="">
                                    <label class="label-control">¿Hora de inicio?</label>
                                    <input id="old_dep_datetime_<?php echo $location[$i]->id; ?>" class="form-control" placeholder="A tiempo" type="hidden" value="<?php echo $value->departure_datetime; ?>">
                                   <input name="new_dep_datetime[]" id="new_dep_datetime_<?php echo $i; ?>" class="form-control form_datetime readonly" readonly placeholder="A tiempo" type="text" value="<?php echo $location[$i]->departure_datetime; ?>">
                                    <input id="old_arr_datetime_<?php echo $location[$i]->id; ?>" class="form-control" placeholder="A tiempo" type="hidden" value="<?php echo $value->arrival_datetime; ?>">
                                   <input name="new_arr_datetime[]" id="new_arr_datetime_<?php echo $i; ?>" class="form-control form_datetime" placeholder="A tiempo" type="hidden" value="<?php echo $location[$i]->arrival_datetime; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-12">
                            <div class="distance-price-cal open-sans">
                                <span>Distancia <i class="fa fa-long-arrow-right fa-fw" aria-hidden="true"></i><?php echo $location[$i]->total_distance.' km' ?></span><span>Duración <i class="fa fa-long-arrow-right fa-fw" aria-hidden="true"></i><?php echo $location[$i]->duration ?></span><input type="hidden" name="duration[]" id="" value="<?php echo $location[$i]->duration ?>"><span id="price_<?php echo $i; ?>"> Precio <i class="fa fa-long-arrow-right fa-fw" aria-hidden="true"></i> <i class="fa fa-usd" aria-hidden="true"></i><?php echo round($location[$i]->total_price) ?></span><input type="hidden" name="distance[]" id="" value="<?php echo $location[$i]->total_distance ?>"><input type="hidden" name="old_final_price[]" id="old_final_price_<?php echo $i; ?>" value="<?php echo round($location[$i]->actual_price) ?>"><input type="hidden" name="new_final_price[]" id="new_final_price_<?php echo $i; ?>" value="<?php echo round($location[$i]->total_price) ?>">
                            </div>
                        </div>
                    </div>
                    <?php }elseif($i==$total_rows){ ?>
                    <div class="row result_row">
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <div class="">
                                    <label class="label-control">Destino</label>
                                    <input name="start[<?php echo $location[$i-1]->id; ?>]" class="form-control" placeholder="¿Desde cuál ciudad saldrá?" type="hidden" value="<?php echo $location[$i-1]->location_a_name; ?>">
                                    <input name="stop[<?php echo $location[$i-1]->id; ?>]" class="form-control readonly" readonly placeholder="¿Desde cuál ciudad saldrá?" type="text" value="<?php echo $location[$i-1]->location_b_name; ?>" >
                                    <input name="new_start_lat[<?php echo $location[$i-1]->id; ?>]" class="form-control" placeholder="¿Desde cuál ciudad saldrá?" type="hidden" value="<?php echo $location[$i-1]->location_a_lat; ?>" >
                                    <input name="new_start_long[<?php echo $location[$i-1]->id; ?>]" class="form-control" placeholder="¿Desde cuál ciudad saldrá?" type="hidden" value="<?php echo $location[$i-1]->location_a_long; ?>" >
                                    <input name="new_stop_lat[<?php echo $location[$i-1]->id; ?>]" class="form-control" placeholder="¿Desde cuál ciudad saldrá?" type="hidden" value="<?php echo $location[$i-1]->location_b_lat; ?>" >
                                    <input name="new_stop_long[<?php echo $location[$i-1]->id; ?>]" class="form-control" placeholder="¿Desde cuál ciudad saldrá?" type="hidden" value="<?php echo $location[$i-1]->location_b_long; ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group ">
                                <div class="">
                                    <label class="label-control">A tiempo</label>
                                    <input id="old_dep_datetime_<?php echo $location[$i-1]->id; ?>" class="form-control" placeholder="A tiempo" type="hidden" value="<?php echo $location[$i-1]->arrival_datetime; ?>">
                                   <input name="new_dep_datetime[]" id="new_dep_datetime_<?php echo $i; ?>" class="form-control form_datetime" placeholder="A tiempo" type="hidden" value="<?php echo $location[$i-1]->arrival_datetime; ?>">
                                    <input id="old_arr_datetime_<?php echo $location[$i-1]->id; ?>" class="form-control" placeholder="A tiempo" type="hidden" value="<?php echo $location[$i-1]->arrival_datetime; ?>">
                                   <input name="new_arr_datetime[]" id="new_arr_datetime_<?php echo $i; ?>" class="form-control form_datetime readonly" readonly placeholder="A tiempo" type="text" value="<?php echo $location[$i-1]->arrival_datetime; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3"></div>
                    </div>
                    <div class="row result_row">
                        <div class="col-sm-12">
                            <div class="form-group ">
                                <button type="submit" class="all-default-btn" type="button">SEGUIR</button>
                            </div>
                        </div>
                    </div>
                    </form>
                    <?php }else{ ?>
                    <div class="row result_row">
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <div class="">
                                    <label class="label-control">Siguiente parada</label>
                                     <input name="start[<?php echo $location[$i]->id; ?>]" class="form-control readonly" readonly placeholder="¿Desde cuál ciudad saldrá?" type="text" value="<?php echo $location[$i]->location_a_name; ?>">
                                    <input name="stop[<?php echo $location[$i]->id; ?>]" class="form-control" placeholder="¿Desde cuál ciudad saldrá?" type="hidden" value="<?php echo $location[$i]->location_b_name; ?>" >
                                    <input name="new_start_lat[<?php echo $location[$i]->id; ?>]" class="form-control" placeholder="¿Desde cuál ciudad saldrá?" type="hidden" value="<?php echo $location[$i]->location_a_lat; ?>" >
                                    <input name="new_start_long[<?php echo $location[$i]->id; ?>]" class="form-control" placeholder="¿Desde cuál ciudad saldrá?" type="hidden" value="<?php echo $location[$i]->location_a_long; ?>" >
                                    <input name="new_stop_lat[<?php echo $location[$i]->id; ?>]" class="form-control" placeholder="¿Desde cuál ciudad saldrá?" type="hidden" value="<?php echo $location[$i]->location_b_lat; ?>" >
                                    <input name="new_stop_long[<?php echo $location[$i]->id; ?>]" class="form-control" placeholder="¿Desde cuál ciudad saldrá?" type="hidden" value="<?php echo $location[$i]->location_b_long; ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group ">
                                <div class="">
                                    <label class="label-control">A tiempo</label>
                                    <input id="old_dep_datetime_<?php echo $i ?>" class="form-control" placeholder="A tiempo" type="hidden" value="<?php echo $value->departure_datetime; ?>">
                                   <input name="new_dep_datetime[]" id="new_dep_datetime_<?php echo $i; ?>" class="form-control form_datetime readonly" readonly placeholder="A tiempo" type="text" value="<?php echo $location[$i]->departure_datetime; ?>">
                                    <input id="old_arr_datetime_<?php echo $i; ?>" class="form-control" placeholder="A tiempo" type="hidden" value="<?php echo $value->arrival_datetime; ?>">
                                   <input name="new_arr_datetime[]" id="new_arr_datetime_<?php echo $i; ?>" class="form-control form_datetime" placeholder="A tiempo" type="hidden" value="<?php echo $location[$i]->arrival_datetime; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group ">
                                <div class="">
                                    <label class="label-control">Tiempo de parada</label>
                                    <input name="halt[<?php echo $location[$i-1]->id; ?>]" class="form-control edithalt" i-value="<?php echo $i ?>" old-value="<?php echo $location[$i-1]->halt_time ?>" placeholder="Tiempo de parada" type="number" value="<?php echo $location[$i-1]->halt_time ?>" min="0">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="distance-price-cal open-sans">
                                <span>Distancia <i class="fa fa-long-arrow-right fa-fw" aria-hidden="true"></i><?php echo $location[$i]->total_distance." km" ?> </span><span>Duración <i class="fa fa-long-arrow-right fa-fw" aria-hidden="true"></i><?php echo $location[$i]->duration ?> </span><input type="hidden" name="duration[]" id="" value="<?php echo $location[$i]->duration ?>"><span id="price_<?php echo $i ?>"> Precio <i class="fa fa-long-arrow-right fa-fw" aria-hidden="true"></i> <i class="fa fa-usd" aria-hidden="true"></i> <?php echo $location[$i]->total_price ?></span><input type="hidden" name="distance[]" id="" value="<?php echo $location[$i]->total_distance ?>"><input type="hidden" name="old_final_price[]" id="old_final_price_<?php echo $i ?>" value="<?php echo $location[$i]->actual_price ?>"><input type="hidden" name="new_final_price[]" id="new_final_price_<?php echo $i ?>" value="<?php echo $location[$i]->total_price ?>">
                            </div>
                        </div>
                    </div>
                    
                    <?php } ?>
                    <?php } ?>
                    
                
                </form>
            </div>
        </div>
        <div class="foot-part">
            <p>La información recibida por 123Vamos es utilizada para crear y verificar tu cuenta, por eso es obligatoria. Al completar esta información estás aceptando nuestras <a href="<?= Url::toRoute(['site/terminos_y_condiciones']); ?>" class="greenlink" target="_blank">Condiciones Generales</a>. Para saber más puedes consultar nuestras <a href="<?= Url::toRoute(['site/preceptos_de_confidencialidad']); ?>" class="greenlink" target="_blank">Políticas de Confidencialidad</a>.
                            </p>
        </div>
    </div>
</section>
<section class="publicar-2-btm" id="step2" style="display:none;"><!--display:none;-->
                <div class="container">
                    <form name="step2_form" id="step2_form">
                        <input type="hidden" name="post_id" id="post_id">
                    <div class="publicar-2-btm-wrap ">
                        <div class="publicar-detail-form">
                            <div class="text-left">
                                <span class="no-seat">Número de asientos</span>
                                <div class="value-percentage">
                                    <div class="input-group spinner" style="width:215px">
                                            <select class="form-control" name="total_seat" id="total_seat">
                                                <option value="" <?php echo($model->total_seat==0)?'selected="selected"':'' ?>>0</option>
                                                <option value="1" <?php echo($model->total_seat==1)?'selected="selected"':'' ?>>1</option>
                                                <option value="2" <?php echo($model->total_seat==2)?'selected="selected"':'' ?>>2</option>
                                                <option value="3" <?php echo($model->total_seat==3)?'selected="selected"':'' ?>>3</option>
                                                <option value="4" <?php echo($model->total_seat==4)?'selected="selected"':'' ?>>4</option>
                                            </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-left">
                                <span class="no-seat">Tiempo de intervalo</span>
                                <div class="value-percentage">
                                    <div class="input-group spinner" style="width:215px">
                                            <select class="form-control" name="interval_time" id="interval_time">
                                                <option value="0">Seleccionar</option>
                                                <option value="15">15 minutos</option>
                                                <option value="30">30 minutos</option>
                                                <option value="45">45 minutos</option>
                                                <option value="60">60 minutos</option>
                                            </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-left">
                                <span class="no-seat">Proceso de reserva</span>
                                <div class="value-percentage">
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input <?php echo($model->booking_process==1)?'checked="checked"':'' ?> value="1" name="process" type="radio" onclick="$('#booking_process').val(this.value)">
                                                            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                            <span class=""> Reserva inmediata</span>
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input <?php echo($model->booking_process==2)?'checked="checked"':'' ?> value="2" type="radio" name="process" onclick="$('#booking_process').val(this.value)">
                                                            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                            <span class="">Confirmar reserva en 6 horas</span>
                                                        </label>
                                                    </div>
                                                    <input type="hidden" name="booking_process" id="booking_process" value="<?php echo $model->booking_process; ?>"/>
                                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="text-left">
                                <span class="no-seat">¿Eres flexible con el tiempo?</span>
                                <div class="value-percentage">
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input <?php echo($model->flexible==1)?'checked="checked"':'' ?> value="1" name="flexible" type="radio" onclick="$('#isflexible').val(this.value)">
                                                            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                            <span class="">Sí</span>
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <label>
                                                            <input <?php echo($model->flexible==2)?'checked="checked"':'' ?> value="2" type="radio" name="flexible" onclick="$('#isflexible').val(this.value)">
                                                            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                            <span class="">No</span>
                                                        </label>
                                                    </div>
                                                    <input type="hidden" name="isflexible" id="isflexible" value="<?php echo $model->flexible; ?>"/>
                                                    <div class="help-block"></div>
                                </div>
                            </div>
<!--                            <div class="form-group ">
                                <div class="">
                                    <label class="label-control">Título</label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Título" value="<?php // echo $model->title; ?>">
                                    <div class="help-block"></div>
                                </div>
                            </div>-->
                            <div class="form-group ">
                                <div class="">
                                    <label class="label-control">Detalles del viaje</label>
                                    <textarea name="description" id="description" placeholder="Dar precisiónes sobre el viaje para no recibir demasiados preguntas.Por ejemplo, Saldremos de la puerta A, estacionamiento Unicentro en Medellín o Acepto solo maletas pequeñas" class="form-control cust-textarea"><?php echo $model->description; ?></textarea>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input value="" type="checkbox" name="terms_conditions" id="terms_conditions">
                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                    <span class="line-text">Acepto las <a href="<?= Url::toRoute(['site/terminos_y_condiciones']); ?>" target="_blank" class="term-con-link">Condiciones Generales</a> y la <a href="<?= Url::toRoute(['site/preceptos_de_confidencialidad']); ?>" target="_blank" class="term-con-link">Política de Confidencialidad</a>. Certifico ser proprietario de una licencia de conducción y de un seguro válido.
                                    </span>
                                </label>
                                <div class="help-block" id="terms_conditions_help_block"></div>
                            </div>
                            <button class="all-default-btn" type="submit">PUBLICAR</button>
                        </div>
                    </div>
                        </form>
                    <div class="foot-part">
                        <p>
                                La información recibida por 123Vamos es utilizada para crear y verificar tu cuenta, por eso es obligatoria. Al completar esta información estás aceptando nuestras <a href="<?= Url::toRoute(['site/terminos_y_condiciones']); ?>" class="greenlink" target="_blank">Condiciones Generales</a>. Para saber más puedes consultar nuestras <a href="<?= Url::toRoute(['site/preceptos_de_confidencialidad']); ?>" class="greenlink" target="_blank">Políticas de Confidencialidad</a>.
                            </p>
                    </div>
                </div>
            </section>
<script>
    var global_val = 0;
    var intime = 2;
    var geocoder;
    var firsttime=true;
    function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 5,
            center: {lat: 3.376614, lng: -74.80247199999997}//spain lat=40.46366700000001,long=-3.7492200000000366
        });
        directionsDisplay.setMap(map);

        document.getElementById('editsubmit').addEventListener('click', function () {
            loader_start();
            $('.help-block').html("");
            var validate=true;
            $(".travel-form-wrap input[type=text]").each(function(){
            var val = this.value;
            window.console.log('==');
            if(val=='' || val==' '){
                loader_stop();
                $(this).parents('.form-group').find('.help-block').text('El campo no puede estar en blanco');
                validate=false;
            }
    });
    if(validate){
    calculateAndDisplayRoute(directionsService, directionsDisplay);
    }
        });
    }

    function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var waypts = [];
        var checkboxArray = document.getElementById('waypoints');
        var inps = document.getElementsByName('stop[]');
        for (var i = 0; i < inps.length; i++) {
            var inp = inps[i];
            var stop_lat = $('#stop' + i + '_lat').val();
            var stop_long = $('#stop' + i + '_long').val();
            waypts.push({
                location: new google.maps.LatLng(stop_lat, stop_long),
                stopover: true
            });
        }


        var start_lat = $('#start_lat').val();
        var start_long = $('#start_long').val();
        var end_lat = $('#end_lat').val();
        var end_long = $('#end_long').val();

        directionsService.route({
            origin: new google.maps.LatLng(start_lat, start_long),
            destination: new google.maps.LatLng(end_lat, end_long),
            waypoints: waypts,
            optimizeWaypoints: true,
            travelMode: 'DRIVING'
        }, function (response, status) {
            if (status === 'OK') {
                $('#publicar-btm').show();
                var start_time=$('#start_time').val();
                $('#intime_1').val(start_time);
                
                directionsDisplay.setDirections(response);
                var route = response.routes[0];
                window.console.log(route);
                // For each route, display summary information.
                var total_length=route.legs.length;
                var html='<form class="form" name="postEditForm" id="postEditForm"><input type="hidden" name="post_id" value="<?php echo $model->id ?>">';
                for (var i = 0; i <= route.legs.length; i++) {
                    var routeSegment = i+1;
                    
            if(i==0){
                var calculated_price=Math.round(route.legs[i].distance.value/1000)*km_price;
                var distance=Math.round(route.legs[i].distance.value/1000);
                    html+='<div class="row result_row">'+
                        '<div class="col-sm-6">'+
                            '<div class="form-group">'+
                                '<div class="">'+
                                    '<label class="label-control">¿Desde cuál ciudad saldrá?</label>'+
                                    '<input name="start['+i+']" class="form-control readonly" readonly placeholder="¿Desde cuál ciudad saldrá?" type="text" value="'+route.legs[i].start_address+'">'+
                                    '<input name="stop['+i+']" class="form-control" placeholder="¿Desde cuál ciudad saldrá?" type="hidden" value="'+route.legs[i].end_address+'" >'+
                                    '<input name="new_start_lat['+i+']" class="form-control" placeholder="¿Desde cuál ciudad saldrá?" type="hidden" value="'+route.legs[i].start_location.lat()+'" >'+
                                    '<input name="new_start_long['+i+']" class="form-control" placeholder="¿Desde cuál ciudad saldrá?" type="hidden" value="'+route.legs[i].start_location.lng()+'" >'+
                                    '<input name="new_stop_lat['+i+']" class="form-control" placeholder="¿Desde cuál ciudad saldrá?" type="hidden" value="'+route.legs[i].end_location.lat()+'" >'+
                                    '<input name="new_stop_long['+i+']" class="form-control" placeholder="¿Desde cuál ciudad saldrá?" type="hidden" value="'+route.legs[i].end_location.lng()+'" >'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-3">'+
                            '<div class="form-group ">'+
                                '<div class="">'+
                                    '<label class="label-control">¿Hora de inicio?</label>'+
                                    '<input id="old_datetime_'+i+'" class="form-control" placeholder="¿hora de inicio?" type="hidden" value="'+start_time+'">'+
                                    '<input name="new_datetime['+i+']" id="new_datetime_'+i+'" class="form-control form_datetime readonly" readonly placeholder="¿hora de inicio?" type="text" value="'+start_time+'">'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-3"></div>'+
                        '<div class="col-sm-12">'+
                            '<div class="distance-price-cal open-sans">'+
                                '<span>Distancia <i class="fa fa-long-arrow-right fa-fw" aria-hidden="true"></i>'+route.legs[i].distance.text+' </span><span>Duración <i class="fa fa-long-arrow-right fa-fw" aria-hidden="true"></i>'+route.legs[i].duration.text+' </span><span id="price_'+i+'"> Precio <i class="fa fa-long-arrow-right fa-fw" aria-hidden="true"></i> <i class="fa fa-usd" aria-hidden="true"></i> '+calculated_price+'</span><input type="hidden" name="distance[]" id="" value="'+distance+'"><input type="hidden" name="old_final_price[]" id="old_final_price_'+i+'" value="'+calculated_price+'"><input type="hidden" name="new_final_price[]" id="new_final_price_'+i+'" value="'+calculated_price+'">'+
                            '</div>'+
                        '</div>'+
                    '</div>';
        }else if(i==total_length){
             var time=route.legs[i-1].duration.value;
                var prev_time=$('#intime_'+i).val();
                var j=i+1;
                var dateString = prev_time,
                dateTimeParts = dateString.split(' '),
                timeParts = dateTimeParts[1].split(':'),
                dateParts = dateTimeParts[0].split('-'),
                date;
                var old_date = new Date(dateParts[0], dateParts[1], dateParts[2], timeParts[0], timeParts[1]);
                var halt_val=Math.round(time/60);
                var r=old_date.setMinutes(old_date.getMinutes() + halt_val);
                var newdate = new Date(r);
                if(newdate.getHours()<10){
                    var hour='0'+newdate.getHours();
                }else{
                   var hour=newdate.getHours(); 
                }
                if(newdate.getMinutes()<10){
                    var mins='0'+newdate.getMinutes();
                }else{
                   var mins=newdate.getMinutes(); 
                }
                var new_time=newdate.getFullYear()+'-'+newdate.getMonth()+'-'+newdate.getDate()+' '+hour+':'+mins;
            html +='<div class="row result_row">'+
                        '<div class="col-sm-6">'+
                            '<div class="form-group ">'+
                                '<div class="">'+
                                    '<label class="label-control">Destino</label>'+
                                    '<input name="start['+i+']" class="form-control readonly" readonly placeholder="destino" type="text" value="'+route.legs[i-1].end_address+'">'+
                                    '<input name="new_start_lat['+i+']" class="form-control" placeholder="destino" type="hidden" value="'+route.legs[i-1].end_location.lat()+'">'+
                                    '<input name="new_start_long['+i+']" class="form-control" placeholder="destino" type="hidden" value="'+route.legs[i-1].end_location.lng()+'">'+
                                    '<input name="stop['+i+']" class="form-control" placeholder="destino" type="hidden" value="">'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-3">'+
                            '<div class="form-group ">'+
                                '<div class="">'+
                                    '<label class="label-control">A tiempo</label>'+
                                    '<input id="old_datetime_'+i+'" class="form-control" placeholder="A tiempo" type="hidden" value="'+new_time+'">'+
                                    '<input name="new_datetime['+i+']" id="new_datetime_'+i+'" class="form-control form_datetime readonly" readonly placeholder="A tiempo" type="text" value="'+new_time+'">'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-3"></div>'+
                    '</div>';
            }else{
                var calculated_price=Math.round(route.legs[i].distance.value/1000)*km_price;
                var distance=Math.round(route.legs[i].distance.value/1000);
                var time=route.legs[i-1].duration.value;
                var prev_time=$('#intime_'+i).val();
                var j=i+1;
                var dateString = prev_time,
                dateTimeParts = dateString.split(' '),
                timeParts = dateTimeParts[1].split(':'),
                dateParts = dateTimeParts[0].split('-'),
                date;
                var old_date = new Date(dateParts[0], dateParts[1], dateParts[2], timeParts[0], timeParts[1]);
                var halt_val=Math.round(time/60);
                var r=old_date.setMinutes(old_date.getMinutes() + halt_val);
                var newdate = new Date(r);
                if(newdate.getHours()<10){
                    var hour='0'+newdate.getHours();
                }else{
                   var hour=newdate.getHours(); 
                }
                if(newdate.getMinutes()<10){
                    var mins='0'+newdate.getMinutes();
                }else{
                   var mins=newdate.getMinutes(); 
                }
                var new_time=newdate.getFullYear()+'-'+newdate.getMonth()+'-'+newdate.getDate()+' '+hour+':'+mins;
                $('#intime_'+j).val(new_time);
                html +='<div class="row result_row">'+
                        '<div class="col-sm-6">'+
                            '<div class="form-group ">'+
                                '<div class="">'+
                                    '<label class="label-control">Siguiente parada</label>'+
                                    '<input name="start['+i+']" class="form-control readonly" readonly placeholder="Siguiente parada" type="text" value="'+route.legs[i-1].end_address+'">'+
                                    '<input name="stop['+i+']" class="form-control" placeholder="Siguiente parada" type="hidden" value="'+route.legs[i].end_address+'">'+
                                    '<input name="new_start_lat['+i+']" class="form-control" placeholder="destino" type="hidden" value="'+route.legs[i-1].end_location.lat()+'">'+
                                    '<input name="new_start_long['+i+']" class="form-control" placeholder="destino" type="hidden" value="'+route.legs[i-1].end_location.lng()+'">'+
                                    '<input name="new_stop_lat['+i+']" class="form-control" placeholder="destino" type="hidden" value="'+route.legs[i].end_location.lat()+'">'+
                                    '<input name="new_stop_long['+i+']" class="form-control" placeholder="destino" type="hidden" value="'+route.legs[i].end_location.lng()+'">'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-3">'+
                            '<div class="form-group ">'+
                                '<div class="">'+
                                    '<label class="label-control">A tiempo</label>'+
                                    '<input id="old_datetime_'+i+'" class="form-control" placeholder="A tiempo" type="hidden" value="'+new_time+'">'+
                                    '<input name="new_datetime['+i+']" id="new_datetime_'+i+'" class="form-control form_datetime readonly" readonly placeholder="A tiempo" type="text" value="'+new_time+'">'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-3">'+
                            '<div class="form-group ">'+
                                '<div class="">'+
                                    '<label class="label-control">Tiempo de parada</label>'+
                                    '<input name="halt['+i+']" class="form-control halt" i-value="'+i+'" placeholder="Tiempo de parada" type="number" value="0" min="0">'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-12">'+
                            '<div class="distance-price-cal open-sans">'+
                                '<span>Distancia <i class="fa fa-long-arrow-right fa-fw" aria-hidden="true"></i>'+route.legs[i].distance.text+' </span><span>Duración <i class="fa fa-long-arrow-right fa-fw" aria-hidden="true"></i>'+route.legs[i].duration.text+' </span><span id="price_'+i+'"> Precio <i class="fa fa-long-arrow-right fa-fw" aria-hidden="true"></i> <i class="fa fa-usd" aria-hidden="true"></i> '+calculated_price+'</span><input type="hidden" name="distance[]" id="" value="'+distance+'"><input type="hidden" name="old_final_price[]" id="old_final_price_'+i+'" value="'+calculated_price+'"><input type="hidden" name="new_final_price[]" id="new_final_price_'+i+'" value="'+calculated_price+'">'+
                            '</div>'+
                        '</div>'+
                    '</div>';
                
                }
                    

                }
                html +='<div class="row result_row">'+
                        '<div class="col-sm-12">'+
                            '<div class="form-group ">'+
                                '<button type="submit" class="all-default-btn" type="button">SEGUIR</button>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '</form>';
                if(!firsttime){
            var summaryPanel = document.getElementById('directions-panel');
            summaryPanel.innerHTML = '';
            summaryPanel.innerHTML +=html;
                }
                firsttime=false;
            loader_stop();
            } else {
            loader_stop();
                $('#errorModal').modal('show');
            }
        });
    }
    function codeAddress(id) {
        var input = document.getElementById(id);
        var options = {
            types: ['(cities)'],
            componentRestrictions: {country: 'CO'}//Turkey only
         };
        var autocomplete = new google.maps.places.Autocomplete(input,options);
        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            $('#' + id + '_lat').val(place.geometry['location'].lat());
            $('#' + id + '_long').val(place.geometry['location'].lng());
        });
    }
    function stopageAddress(val) {
        var id = 'stop' + val;
        var input = document.getElementById(id);
        var options = {
            types: ['(cities)'],
            componentRestrictions: {country: 'CO'}//Turkey only
         };
        var autocomplete = new google.maps.places.Autocomplete(input,options);
        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            $('#' + id + '_lat').val(place.geometry['location'].lat());
            $('#' + id + '_long').val(place.geometry['location'].lng());
        });
    }
    function addStop() {
        $('.stopage').append('<div class="row stopage_'+global_val+'">' +
                '<div class="col-sm-12 no-pad-new-left">' +
                '<div class="form-group ">' +
                '<div class="">' +
                '<label class="label-control">¿Desde cuál ciudad saldrá?</label>' +
                '<div class="row">' +
                '<div class="col-md-8 col-sm-7">' +
                '<input type="text" id="stop' + global_val + '" class="form-control" name="stop[]" placeholder="Entrar en la ubicación" onkeyup="stopageAddress(' + global_val + ')" aria-required="true" autocomplete="off">' +
                '<div class="help-block"></div>' +
                '</div>' +
                '<div class="col-md-4 col-sm-5">' +
                '<div class="btn-group btn-group-solid"><button type="button" class="btn btn-danger" style="font-size:17px;" onclick="removeOptionRow('+global_val+')"> X </button></div>' +
                '</div>' +
                '<input type="hidden" id="stop' + global_val + '_lat" value="">' +
                '<input type="hidden" id="stop' + global_val + '_long" value="">' +
                '<input type="hidden" id="intime_' + intime + '" value="">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>'
                );
        global_val = global_val + 1;
        intime = intime + 1;


    }
//    function addStop() {
//        $('.stopage').append('<div class="row">' +
//                '<div class="col-sm-12 no-pad-new-left">' +
//                '<div class="form-group ">' +
//                '<div class="">' +
//                '<label class="label-control">¿Desde cuál ciudad saldrá?</label>' +
//                '<input type="text" id="stop' + global_val + '" class="form-control" name="stop[]" placeholder="Entrar en la ubicación" onkeyup="stopageAddress(' + global_val + ')" aria-required="true" autocomplete="off">' +
//                '<input type="hidden" id="stop' + global_val + '_lat" value="">' +
//                '<input type="hidden" id="stop' + global_val + '_long" value="">' +
//                '<input type="hidden" id="intime_' + intime + '" value="">' +
//                '<div class="help-block"></div>' +
//                '</div>' +
//                '</div>' +
//                '</div>' +
//                '</div>'
//                );
//        global_val = global_val + 1;
//        intime = intime + 1;
//
//
//    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOankrcwempASqz3CgugpUnpokrfw8CjU&callback=initMap&libraries=places">
</script>
<!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFFmJsdgvGo2Sh0dOHik4eKgimWYAvTX4&callback=initMap&libraries=places">
</script>-->
<div id="errorModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Hoja de ruta no encontrada</h4>
            </div>
            <div class="modal-body">
                <p>Para este viaje no hay mapa de carreteras. Prueba otra ubicación.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
            </div>
        </div>

    </div>
</div>