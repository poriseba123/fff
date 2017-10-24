<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title> <?= $this->context->getProjectName() ?></title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css"/>
    </head>
    <body>
        <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="background:#FFFFFF;height:100%!important;margin:0;padding:0;width:100%!important" bgcolor="#F3F3F3">
            <tbody>
                <tr>
                    <td align="center" valign="top" style="border-collapse:collapse">
                        <table border="0" cellpadding="0" cellspacing="0" width="700" style="background:#ffffff;border:1px solid #cccccc;margin-top:10px" bgcolor="#FFFFFF">
                            <tbody>
                                <tr>
                                    <td align="center" valign="top" style="border-collapse:collapse">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background:#ffffff;border-bottom-width:0" bgcolor="#FFFFFF">
                                            <tbody>
                                                <tr>
                                                    <td style="border-collapse:collapse;text-align:center;vertical-align:top ;background-color: #FFF;" align="left" valign="top">
                                                        <div style="margin: 15px 25px 10px; border-bottom: 2px solid #EEE;">
                                                            <a href="<?= Url::base(true); ?>" style="color:#FFF;font-weight:normal;text-decoration:none" target="_blank">
                                                            <!--<span style="font-size: 20px; font-weight: bold"> <?= $this->context->getProjectName() ?></span>-->
                                                                <img src="<?= Url::home(true) ?>themes/common-images/logo/logo.png" class="img-responsive" height="30"/>
                                                            </a>
                                                            <p style="text-align: center;color:#47c1c1;font-family:Verdana, Sans-serif;font-size:20px;">Una nueva Comunidad para Compartir tus Viajes en Colombia</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top" style="border-collapse:collapse">
                                        <table border="0" cellpadding="0" cellspacing="0" width="700">
                                            <tbody>
                                                <tr>
                                                    <td valign="top" style="background:#ffffff;border-collapse:collapse" bgcolor="#FFFFFF">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="700">
                                                            <tbody>
                                                                <tr>
                                                                    <td valign="top" style="background:#ffffff;border-collapse:collapse" bgcolor="#FFFFFF">
                                                                        <div style="margin: 0 25px 10px; padding: 0 0 10px; border-bottom: 2px solid #EEE;color:#808080;font-family:Verdana, Sans-serif;font-size:14px;line-height:150%;text-align:left" align="left">
                                                                            <?= $message; ?>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top" style="border-collapse:collapse">
                                        <table border="0" cellpadding="0" cellspacing="0" width="700" style="background:#ffffff;border-top-width:0" bgcolor="#FFFFFF">
                                            <tbody>
                                                <tr>
                                                    <td valign="top" style="border-collapse:collapse">
                                                        <div style="text-align:center; margin: 0 25px; border-bottom:2px solid #EEE; padding-bottom: 10px;">
                                                            <?php
                                                            Yii::$app->instagram->setAccessToken('5326775729.1677ed0.a2c9ef0fe3024c34a40e003c5dba14b6');
//                                                            Yii::$app->instagram->setAccessToken('5326775729.1677ed0.ad54acc2b33b4f82a4704ba859836b57');
                                                            $follower = Yii::$app->instagram->getUser();
                                                            $media = Yii::$app->instagram->getUserMedia();
                                                            if (count($media) > 0 && isset($media->data)) {?>
                                                            <a href="https://www.instagram.com/undostresvamos/"><div>
                                                               <?php foreach ($media->data as $k => $row) {
                                                                    if ($k == 5) {
                                                                        break;
                                                                    }
                                                                    if($k==0){
                                                                        $style="width: 122px;height: auto;margin: 0 2px 0 0;";
                                                                    }elseif($k==4){
                                                                        $style="width: 122px;height: auto;margin: 0 0 0 2px;";
                                                                    }else{
                                                                        $style="width: 122px;height: auto;margin: 0 2px;";
                                                                    }
                                                                    ?>
                                                            <img style="<?=$style?>" src="<?= $row->images->thumbnail->url ?>" alt="" class="img-responsive" /><?php
                                                                }?>
                                                                </div></a>
                                                            <?php
                                                            
                                                                    }
                                                            ?>
                                                            <div style="text-align: center">
                                                                <ul style="padding:0;display: inline-block; margin-bottom: 10px; margin-top: 15px;">
                                                                    <li style="display: inline-block; height: 35px; list-style-type: none;margin: 6px 7px 0 0;text-align: center;width: 35px;font-size: 18px; border-radius: 50px; line-height: 35px; transition: all .3s ease-in-out;"> 
                                                                        <a target="_blank" href="<?= $this->context->getFacebookLink() ?>" style="line-height: 40px; transition: all .3s ease-in-out;">
                                                                            <img src="<?= Url::home(true) ?>themes/common-images/images/e-facebook-icon.png" class="img-responsive"/>
                                                                        </a>
                                                                    </li>
                                                                    <li style="display: inline-block; height: 35px; list-style-type: none;margin: 6px 7px 0 0;text-align: center;width: 35px;font-size: 18px; border-radius: 50px; line-height: 40px; transition: all .3s ease-in-out;"> 
                                                                        <a target="_blank" href="<?= $this->context->getGoogleLink() ?>" style="line-height: 40px; transition: all .3s ease-in-out;"> 
                                                                            <img src="<?= Url::home(true) ?>themes/common-images/images/e-google-icon.png" class="img-responsive"/>
                                                                        </a>
                                                                    </li>
                                                                    <li style="display: inline-block; height: 35px; list-style-type: none;margin: 6px 7px 0 0;text-align: center;width: 35px;font-size: 18px; border-radius: 50px; line-height: 35px; transition: all .3s ease-in-out;"> 
                                                                        <a target="_blank" href="<?= $this->context->getInstagramLink() ?>" style="line-height: 40px; transition: all .3s ease-in-out;">
                                                                            <img src="<?= Url::home(true) ?>themes/common-images/images/e-instagram-icon.png" class="img-responsive"/>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table border="0" cellpadding="10" cellspacing="0" width="700" style="border-collapse:collapse">
                                            <tbody>
                                                <tr>
                                                    <td valign="top" style="border-collapse:collapse">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" valign="middle" style="border-collapse:collapse;color:#999;display:block;font-family:Verdana, Sans-serif;font-size:10px;font-weight:normal;line-height:130%">
                                                                        <div style="text-align: center; color: #999999">
                                                                            <p>Copyright &copy; <?= date('Y'); ?> <a href="<?= Url::base(true); ?>" style="color:#41c1c2;"><?= $this->context->getProjectName() ?></a>, All rights reserved.</p>
                                                                            <p>Puede contactar nuestro equipo : <a href="mailto:contact@123vamos.co" style="color:#41c1c2;">contact@123vamos.co</a></p>
                                                                            <!--<p><a href="%UNSUBSCRIBELINK%&ALL" style="color:#41c1c2;">Desincribirse</a></p>-->
                                                                            <!--<p>%SENDER-INFO-SINGLELINE%</p>-->
<!--                                                                            <font color="#999999">
                                                                                <center>
                                                                                    Copyright &copy; <?= date('Y'); ?> <a href="<?= Url::base(true); ?>" ><?= $this->context->getProjectName() ?></a>, All rights reserved.
                                                                                    <br/>Puede contactar nuestro equipo : <a href="mailto:contact@undostresvamos.com" >contact@undostresvamos.com</a>
                                                                                    <br/>
                                                                                    <br/>
                                                                                    <a href="%UNSUBSCRIBELINK%&ALL">Desincribirse</a>
                                                                                    <br/> %SENDER-INFO-SINGLELINE%
                                                                                </center>
                                                                            </font>-->
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br/>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
