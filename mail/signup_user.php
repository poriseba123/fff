<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>
<table border="0" cellpadding="0" cellspacing="0" width="560">
    <tbody><td>
            <td valign="top" style="background:#ffffff;border-collapse:collapse" bgcolor="#FFFFFF">

                <table border="0" cellpadding="23" cellspacing="0" width="100%">
                    <tbody><td>
                            <td valign="top" style="border-collapse:collapse">
                                <div style="color:#808080;font-family:Arial;font-size:14px;line-height:150%;text-align:left" align="left">
                                    <div style="color:#808080;font-family:Arial;font-size:14px;line-height:150%;margin:5px 2px;text-align:left" align="left">
                                    </div>
                                    <div style="color:#808080;font-family:Arial;font-size:14px;line-height:150%;margin:5px 2px;text-align:left" align="left">
                                        Hello <?php echo $name; ?>,
                                        <br>
                                        you have successfully registered as user to church.
                                        <br>
                                        click the below link to active your account.
                                        <br>
                                        <?php echo $link; ?>
                                    </div>
                                    <div style="color:#808080;font-family:Arial;font-size:14px;line-height:150%;margin:5px 2px;text-align:left" align="left">
                                    </div>
                                    <div style="color:#808080;font-family:Arial;font-size:14px;line-height:150%;margin:5px 2px;text-align:left" align="left">
                                        <div style="color:#808080;font-family:Arial;font-size:14px;line-height:150%;text-align:left" align="left">
                                            <br>
                                            <font><font>
                                            Thank you for your attention and your trust 
                                            </font><a href="<?= Url::base(true); ?>" style="color:#a30046;font-weight:normal;text-decoration:none" target="_blank"><strong><font>church.</font></strong></a></font><br>
                                            <br>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>

