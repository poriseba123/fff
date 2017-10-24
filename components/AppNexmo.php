<?php

namespace app\components;

class AppNexmo {

    public $nexmo_api_key;
    public $nexmo_api_secret;
    public $from;

    public function __construct($key, $secret, $fromNumber) {
        $this->nexmo_api_key = $key;
        $this->nexmo_api_secret = $secret;
        $this->from = $fromNumber;
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