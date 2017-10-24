<?php

namespace app\components;

use Yii;
use Yii\base\Component;
use Yii\base\InvalidConfigException;
use Yii\base\ErrorException;
use Yii\helpers\ArrayHelper;
use Yii\helpers\Url;
use app\models\Settings;


class Nexmo extends Component {

    public $nexmo_api_key;
    public $nexmo_api_secret;
    public $from;

    public function __construct() {
        $this->nexmo_api_key = Settings::find()->where(['slug' => 'nexmo_api_key'])->one()->value;
        $this->nexmo_api_secret = Settings::find()->where(['slug' => 'nexmo_api_secret'])->one()->value;
        $this->from = Settings::find()->where(['slug' => 'nexmo_from_number'])->one()->value;
    }

    public function sendSms($to, $from = '', $msg) {
        
        $data = [];
        if ($from == '') {
            $from = $this->from;
        }
        $params = [
            'api_key' => $this->nexmo_api_key,
            'api_secret' => $this->nexmo_api_secret,
            'to' => '+' . $to,
            'from' => '+' . $from,
            'text' => $msg,
        ];

        $url = 'https://rest.nexmo.com/sms/json?' . http_build_query($params);


        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        $datas = json_decode($response);
        $data['status'] = $datas->messages[0]->status;
        if ($data['status'] == 0) {
            $data['type'] = 'success';
            $data['msg'] = 'send Successfully';
            $data['res'] = json_decode(json_encode($datas->messages[0]), True);
        } else {
            $data['type'] = 'error';
            $data['msg'] = json_decode(json_encode($datas->messages[0]), True)['error-text'];
            $data['res'] = '';
        }
        return $data;
    }

}

?>