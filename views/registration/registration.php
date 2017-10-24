<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


//Yii::$app->instagram->setAccessToken('5326775729.1677ed0.ad54acc2b33b4f82a4704ba859836b57');
$insta_access_token=$this->context->getInstagramAccessToken();
//Yii::$app->instagram->setAccessToken('5326775729.1677ed0.a2c9ef0fe3024c34a40e003c5dba14b6');
Yii::$app->instagram->setAccessToken($insta_access_token);
$follower = Yii::$app->instagram->getUser();
$media = Yii::$app->instagram->getUserMedia();
?>
<?php

        $useragent=$_SERVER['HTTP_USER_AGENT'];
        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))

        { 
            $device="mobile";
            $no_of_photo=3;
        }
        else{
            $device="desktop";
            $no_of_photo=6;
        }
?>
<section class="signup-wrap open-sans">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-sm-7">
                <h2 class="signup-title heading">¿AÚN NO ERES MIEMBRO DE 123VAMOS?<?php // Yii::t("app", "¿AÚN NO ES MIEMBRO DE 123VAMOS?")    ?></h2>
                <h3 class="signup-subtitle">Regístrate en unos segundos con Facebook</h3>
                <div class="text-center">
                    <a href="javascript:;" onclick="facebookLogin()">
                        <div class="ihc-sm-item ihc-fb">
                            <i class="fa-ihc-sm fa fa-facebook-official"></i>
                            <span class="ihc-sm-item-label">Conéctate con Facebook</span>
                        </div>
                    </a>
                </div>
                <h3 class="signup-subtitle-2">O regístrate en 30 segundos con tu correo electrónico</h3>
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <form class="signup-form" id="user_signup" method="post">
                            <div class="impu-form-N form-group">
                                <input type="text" value="" name="UserMaster[first_name]" id="usermaster-first_name" placeholder="Nombre*" class="form-control cust-input">
                                <div class="help-block"></div>
                            </div>
                            <div class="impu-form-N form-group">
                                <input type="text" value="" name="UserMaster[last_name]" id="usermaster-last_name" placeholder="Apellido*" class="form-control cust-input">
                                <div class="help-block"></div>
                            </div>
                            <div class="impu-form-N form-group">
                                <input type="text" value="" name="UserMaster[email]" id="usermaster-email" placeholder="Email*" class="form-control cust-input">
                                <div class="help-block"></div>
                            </div>
                            <div class="impu-form-N form-group">
                                <input type="password" value="" name="UserMaster[password]" id="usermaster-password" placeholder="Contraseña*" class="form-control cust-input">
                                <div class="help-block"></div>
                            </div>
                            <div class="impu-form-N form-group">
                                <input type="password" value="" name="UserMaster[cnf_password]" id="usermaster-cnf_password" placeholder="Confirmar la contraseña*" class="form-control cust-input">
                                <div class="help-block"></div>
                            </div>
                            <div class="text-center">
                                <div class="radio text-right radio-inline mt-0">
                                    <label>
                                        <input value="1" name="userGender" type="radio" onclick="$('#usermaster-gender').val(this.value)">
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        <em style="font-style:normal;">Hombre</em>
                                    </label>
                                </div>
                                <div class="radio text-right radio-inline mt-0">
                                    <label>
                                        <input value="2" name="userGender" type="radio" onclick="$('#usermaster-gender').val(this.value)">
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        <em style="font-style:normal;">Mujer</em>
                                    </label>
                                </div>
                                <input type="hidden" name="UserMaster[gender]" id="usermaster-gender" value=""/>
                                <div class="help-block"></div>
                            </div>
                            <!--                            <div class="impu-form-N form-group">
                                                            <select name="fancy-select" class="fancy-select">
                                                                <option value="Pakistan">Pakistan</option>
                                                                <option value="Saudia">Saudia</option>
                                                                <option value="UAE">UAE</option>
                                                                <option value="Turkey">Turkey</option>
                                                                <option value="Palstin">Palstin</option>
                                                            </select>
                                                        </div>-->

                            <div class="form-group">
                                <input type="submit" value="Regístrate" name="Submit" class="btn-block submit-btn">
                            </div>
                        </form>
                        <div class="signup-detail">
                            <p>
                                <span>
                                    Al hacer clic en el botón “Conéctate con Facebook” o cuando te registras con tu correo electrónico, aceptas los <a href="<?= Url::toRoute(['site/terminos_y_condiciones']); ?>" class="greenlink" target="_blank">Términos y Condiciones</a> de uso y la <a href="<?= Url::toRoute(['site/preceptos_de_confidencialidad']); ?>" class="greenlink" target="_blank">Politica de Confidencialidad.</a>
                                </span>
                            </p>
                            <p>
                                <span>
                                    La información que solicitamos es obligatoria para ser miembro, es guardada por 123Vamos para crear tu cuenta. Para poner fin a tu suscripción por favor contáctanos a <a href="mailto:contact@123vamos.co" class="greenlink" target="_blank">contact@123vamos.co</a>.Tu tienes derecho a acceder, rectificar y retirar tu información.
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4 col-md-offset-1 col-sm-5 hidden-xs">
                <div class="img-wrap cast-img-warp" style="text-align: center;">
                    <?php if($device=="mobile"){ ?>
                    <div class="fb-page" data-href="<?= $this->context->getFacebookLink() ?>" data-tabs="timeline" data-width="220" data-height="140" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="<?= $this->context->getFacebookLink() ?>" class="fb-xfbml-parse-ignore"><a href="<?= $this->context->getFacebookLink() ?>">123Vamos</a></blockquote></div>
                    <?php }else{ ?>
                    <div class="fb-page" data-href="<?= $this->context->getFacebookLink() ?>" data-tabs="timeline" data-width="288" data-height="148" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="<?= $this->context->getFacebookLink() ?>" class="fb-xfbml-parse-ignore"><a href="<?= $this->context->getFacebookLink() ?>">123Vamos</a></blockquote></div>
                    <?php } ?>
                </div>
                <?php
                    if(count($media)>0 && isset($media->data)){ ?>
                <h3 class="insta-title text-center">INSTAGRAM</h3>
                <div class="img-wrap" style="text-align: center;">
                    <?php
                    foreach ($media->data as $k=>$row) {
                        if($k==$no_of_photo){
                            break;
                        }
                    ?>
                    <img src="<?= $row->images->thumbnail->url ?>" alt="" class="img-responsive" />
                    <?php }?>
                </div>
                    <?php } ?>
                <!--                <div class="sign-up-social">
                                    <ul class="social">
                                        <li class="insta"> <a href="javascript:;"><i class="fa fa-instagram"></i></a></li>
                                        <li class="fb"> <a href="javascript:;"><i class="fa fa-facebook"></i> </a></li>
                                    </ul>
                                </div>-->
                 <?php if($device=="desktop"){ ?>
                <h3 class="insta-title text-center"></h3>
                 <?php } ?>
                <div class="img-wrap como-img" style="text-align: center;">
                    <a href="<?= Url::toRoute(['site/como_funciona']); ?>" target="_blank">
                        <img src="<?= $this->context->getStaticImage("como-funciona-new-link.jpg") ?>" alt="" class="img-responsive center-block" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>



<div id="fb-root"></div>
<script>(function(d, s, id) {
 var js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id)) return;
 js = d.createElement(s); js.id = id;
// js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=1674014756173171";
 js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=1929815600569700";
 fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>