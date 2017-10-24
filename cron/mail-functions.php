<?php

function shoot_email($to_email, $subject, $mailContent) {
    //---------- start for define the web mail header -----------//

    $headers = "MIME-Version: 1.0" . "\n";

    $headers .= "Content-type: text/html; charset=iso-8859-1" . "\n";

    $headers .= "Content-transfer-encoding: 8bit" . "\n";

    $headers .= "Date: " . date("r", time()) . "\n";

    $headers .= "X-Priority: 1" . "\n";

    $headers .= "X-MSMail-Priority: High" . "\n";

    $headers .= "X-Mailer: PHP/" . PHP_VERSION . "\n";

    $headers .= "X-MimeOLE: Produced by cardverify.net" . "\n";

    $headers .= "From: " . FROM_NAME . " <" . FROM_EMAIL . ">" . "\n";

    $headers .= "Message-ID: <" . md5(uniqid(time())) . "@" . $_SERVER["HTTP_HOST"] . ">" . "\n";

    //---------- end for define the web mail header -----------//
    //------------- start for sending the email ---------------------// 
    @mail($to_email, $subject, $mailContent, $headers);

    //------------ end for sending the email --------------------//
}

function getHeader() {
    $header = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>' . PROJECT_NAME . '</title>
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
                                                                <img src="' . HOME_URL . 'themes/common-images/logo/logo.png" class="img-responsive" height="30"/>
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
                                                                        <div style="margin: 0 25px 10px; padding: 0 0 10px; border-bottom: 2px solid #EEE;color:#808080;font-family:Verdana, Sans-serif;font-size:14px;line-height:150%;text-align:left" align="left">';
    return $header;
}

function getFooter() {
    $footer = '</div>' .
            '</td>' .
            '</tr>' .
            '</tbody>' .
            '</table>' .
            '</td>' .
            '</tr>' .
            '</tbody>' .
            '</table>' .
            '</td>' .
            '</tr>' .
            '<tr>' .
            '<td align="center" valign="top" style="border-collapse:collapse">' .
            '<table border="0" cellpadding="0" cellspacing="0" width="700" style="background:#ffffff;border-top-width:0" bgcolor="#FFFFFF">' .
            '<tbody>' .
            '<tr>' .
            '<td valign="top" style="border-collapse:collapse">' .
            '<div style="text-align:center; margin: 0 25px; border-bottom:2px solid #EEE; padding-bottom: 10px;">' .
            getInstagramImage() .
            '<div style="text-align: center">' .
            '<ul style="padding:0;display: inline-block; margin-bottom: 10px; margin-top: 15px;">' .
            '<li style="display: inline-block; height: 35px; list-style-type: none;margin: 6px 7px 0 0;text-align: center;width: 35px;font-size: 18px; border-radius: 50px; line-height: 35px; transition: all .3s ease-in-out;"> ' .
            '<a target="_blank" href="' . FACEBOOK_URL . '" style="line-height: 40px; transition: all .3s ease-in-out;">' .
            '<img src="' . HOME_URL . 'themes/common-images/images/e-facebook-icon.png" class="img-responsive"/>' .
            '</a>' .
            '</li>' .
            '<li style="display: inline-block; height: 35px; list-style-type: none;margin: 6px 7px 0 0;text-align: center;width: 35px;font-size: 18px; border-radius: 50px; line-height: 40px; transition: all .3s ease-in-out;"> ' .
            '<a target="_blank" href="' . GOOGLE_PLUS_URL . '" style="line-height: 40px; transition: all .3s ease-in-out;"> ' .
            '<img src="' . HOME_URL . 'themes/common-images/images/e-google-icon.png" class="img-responsive"/>' .
            '</a>' .
            '</li>' .
            '<li style="display: inline-block; height: 35px; list-style-type: none;margin: 6px 7px 0 0;text-align: center;width: 35px;font-size: 18px; border-radius: 50px; line-height: 35px; transition: all .3s ease-in-out;"> ' .
            '<a target="_blank" href="' . INSTAGRAM_URL . '" style="line-height: 40px; transition: all .3s ease-in-out;">' .
            '<img src="' . HOME_URL . 'themes/common-images/images/e-instagram-icon.png" class="img-responsive"/>' .
            '</a>' .
            '</li>' .
            '</ul>' .
            '</div>' .
            '</div>' .
            '</td>' .
            '</tr>' .
            '</tbody>' .
            '</table>' .
            '</td>' .
            '</tr>' .
            '<tr>' .
            '<td>' .
            '<table border="0" cellpadding="10" cellspacing="0" width="700" style="border-collapse:collapse">' .
            '<tbody>' .
            '<tr>' .
            '<td valign="top" style="border-collapse:collapse">' .
            '<table border="0" cellpadding="0" cellspacing="0" width="100%">' .
            '<tbody>' .
            '<tr>' .
            '<td align="center" valign="middle" style="border-collapse:collapse;color:#999;display:block;font-family:Verdana, Sans-serif;font-size:10px;font-weight:normal;line-height:130%">' .
            '<div style="text-align: center; color: #999999">' .
            '<p>Copyright &copy; ' . date("Y") . ' <a href="' . HOME_URL . '" style="color:#41c1c2;">' . PROJECT_NAME . '</a>, All rights reserved.</p>' .
            '<p>Puede contactar nuestro equipo : <a href="mailto:' . CONTACT_EMAIL . '" style="color:#41c1c2;">' . CONTACT_EMAIL . '</a></p>' .
            '</div>' .
            '</td>' .
            '</tr>' .
            '</tbody>' .
            '</table>' .
            '</td>' .
            '</tr>' .
            '</tbody>' .
            '</table>' .
            '</td>' .
            '</tr>' .
            '</tbody>' .
            '</table>' .
            '<br/>' .
            '</td>' .
            '</tr>' .
            '</tbody>' .
            '</table>' .
            '</body>' .
            '</html>';
    return $footer;
}

function getBody($type, $followerName, $userName, $typeName, $detailsLink) {
    if ($type == 'event') {
        $body = '<p>Hi <strong>' . ucwords($followerName) . '</strong>,</p>' .
                '<p>&nbsp;</p>' .
                '<p><strong>' . ucwords($userName) . '</strong> created an event (<strong>' . ucwords($typeName) . '</strong>) on today. You can be a part of this event. You can check the details by click on below button.</p>' .
                '<p style="margin-top: 20px;">&nbsp;<a href="' . $detailsLink . '" style="text-decoration: none; background-color: #00887a; border: #00887A; padding: 10px 15px; border-radius: 4px; font-size: 14px; color: #FFF">VIEW DETAILS</a></p>' .
                '<p>&nbsp;</p>' .
                '<p>Thanks,</p>' .
                '<p>Champion Clubhouse</p>';
    } elseif ($type == 'explore') {
        $body = '<p>Hi <strong>' . ucwords($followerName) . '</strong>,</p>' .
                '<p>&nbsp;</p>' .
                '<p><strong>' . ucwords($userName) . '</strong> just explored (<strong>' . ucwords($typeName) . '</strong>), you can get interesting information through his/her post. To check the details click on below "<strong>VIEW DETAILS</strong>" button.</p>' .
                '<p style="margin-top: 20px;">&nbsp;<a href="' . $detailsLink . '" style="text-decoration: none; background-color: #00887a; border: #00887A; padding: 10px 15px; border-radius: 4px; font-size: 14px; color: #FFF">VIEW DETAILS</a></p>' .
                '<p>&nbsp;</p>' .
                '<p>Thanks,</p>' .
                '<p>Champion Clubhouse</p>';
    } elseif ($type == 'advice') {
        $body = '<p>Hi <strong>' . ucwords($followerName) . '</strong>,</p>' .
                '<p>&nbsp;</p>' .
                '<p><strong>' . ucwords($userName) . '</strong> want to know something about&nbsp;&nbsp;below topic. You can&nbsp;help me to find the solution by sharing your thoughts.</p>' .
                '<p>Topic: ' . $typeName . '</p>' .
                '<p>&nbsp;</p>' .
                '<p style="margin-top: 20px;">&nbsp;<a href="' . $detailsLink . '" style="text-decoration: none; background-color: #00887a; border: #00887A; padding: 10px 15px; border-radius: 4px; font-size: 14px; color: #FFF">VIEW DETAILS</a></p>' .
                '<p>&nbsp;</p>' .
                '<p>Thanks,</p>' .
                '<p>Champion Clubhouse</p>';
    }
    return $body;
}

function getInstagramImage() {
    
    require_once '../components/AppInstagram.php';

    $instagram = new \app\components\Instagram();

    $instagram->setAccessToken(INSTAGRAM_ACCESS_TOKEN);
    $media = $instagram->getUserMedia();

    $html = '<a href="' . INSTAGRAM_URL . '"><div>';

    if (count($media) > 0 && isset($media->data)) {
        foreach ($media->data as $k => $row) {
            if ($k == 5) {
                break;
            }
            if ($k == 0) {
                $style = "width: 126px;height: auto;margin: 0 2px 0 0;";
            } elseif ($k == 4) {
                $style = "width: 126px;height: auto;margin: 0 0 0 2px;";
            } else {
                $style = "width: 126px;height: auto;margin: 0 2px;";
            }
            $html .= '<img style="' . $style . '" src="' . $row->images->thumbnail->url . '" alt="" class="img-responsive" />';
        }
    }
    $html .= '</div></a>';
    return $html;
}
