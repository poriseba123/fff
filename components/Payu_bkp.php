<?php

namespace app\components;

use Yii;
use Yii\base\Component;
use Yii\base\InvalidConfigException;
use Yii\base\ErrorException;
use Yii\helpers\ArrayHelper;
use Yii\helpers\Url;
use OpenPayUBase;
use OpenPayU;
use OpenPayU_Order;
use OpenPayU_Configuration;
/**
 * Class Payu.
 *
 * @package Anish
 * @author Ainsh Madhu <anish.adm.madhu@gmail.com>
 */
class Payu extends Component {
    public function testDemo() {
//        echo 'hay this is test method';
//        OpenPayU_Configuration::setEnvironment('sandbox');
//        OpenPayU_Configuration::setMerchantPosId('145227');
//        OpenPayU_Configuration::setSignatureKey('13a980d4f851f3d9a1cfc792fb1f5e50');
        
        //set Environment
OpenPayU_Configuration::setEnvironment('sandbox');//sandbox//secure

//set POS ID and Second MD5 Key (from merchant admin panel)
OpenPayU_Configuration::setMerchantPosId('301953'); // POS ID (pos_id) / OAuth protocol - client_id-145227
OpenPayU_Configuration::setSignatureKey('0f0adf0761f0d7e170c0a2c824e28fbd'); // Second key (MD5)

//set Oauth Client Id and Oauth Client Secret (from merchant admin panel)
OpenPayU_Configuration::setOauthClientId('301953'); // OAuth protocol - client_id / POS ID (pos_id)
OpenPayU_Configuration::setOauthClientSecret('6e4e1af5b3d77a95058b9166e7c33ea9'); // Key (MD5) / OAuth protocol - client_secret 

        $openpay = new OpenPayU_Order();
        $order['continueUrl'] = Yii::$app->urlManager->createAbsoluteUrl('book/payureturn'); //customer will be redirected to this page after successfull payment
        $order['notifyUrl'] = 'http://localhost/';
        $order['customerIp'] = $_SERVER['REMOTE_ADDR'];
        $order['merchantPosId'] = OpenPayU_Configuration::getMerchantPosId();
        $order['description'] = 'New order';
        $order['currencyCode'] = 'PLN';
        $order['totalAmount'] = 3200;
        $order['extOrderId'] = time(); //must be unique!
        $order['products'][0]['name'] = 'Product1';
        $order['products'][0]['unitPrice'] = 1000;
        $order['products'][0]['quantity'] = 1;
        $order['products'][1]['name'] = 'Product2';
        $order['products'][1]['unitPrice'] = 2200;
        $order['products'][1]['quantity'] = 1;
//optional section buyer
        $order['buyer']['email'] = 'dd@ddd.pl';
        $order['buyer']['phone'] = '123123123';
        $order['buyer']['firstName'] = 'Jan';
        $order['buyer']['lastName'] = 'Kowalski';
        $response = $openpay->create($order);
        $res = $response->getResponse();
        if($res->status->statusCode == 'SUCCESS'){
            header('Location:' . $response->getResponse()->redirectUri);
        }else{
            return $res;
        }
            exit;
//        header('Location:' . $response->getResponse()->redirectUri);
//        $openpay->create($order);
    }
}
?>