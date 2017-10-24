<?php

include_once 'config/db_conn.php';
include_once 'config/cron_define.php';

include_once '../components/AppNexmo.php';

//==== get user details ==============
$userId = 3;

$sql = "SELECT first_name, last_name, phone_code, phone FROM user_master WHERE id = $userId";

$result = mysqli_query($con, $sql); // get all created event record

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $userName = $row["first_name"] . ' ' . $row["last_name"];
//        $mobCode = $row["phone_code"];
//        $mobNo = $row["phone"];
        $mobCode = '91';
        $mobNo = '9547041421';
        $msg = 'Hola ' . $userName . '. Lorem Ipsum es simplemente un texto ficticio de la industria de impresión y composición.';
        sendClientSMS($mobCode, $mobNo, $msg);
    }
} else {
    exit("User Does Not Found");
}

//$nexmo_msg = 'Hola ' . $model->first_name . ' ' . $model->last_name . '. Tu codigo para confermar tu celular es ' . $otp . '.El equipo 123Vamos';
//$res = Yii::$app->nexmo->sendSms($code . $phone, 'Nexmo', $nexmo_msg);

function sendClientSMS($mobCode, $mobNo, $msg) {
    $nexmo = new \app\components\AppNexmo(NEXMO_API_KEY, NEXMO_API_SECRET, NEXMO_FROM_NUMBER);
    $res = $nexmo->sendSms($mobCode . $mobNo, 'Nexmo', $msg);
    echo "<pre>";
    print_r($res);
    echo "</pre>";
    exit;
}
