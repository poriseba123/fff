<?php

namespace app\components;

use Yii;
use yii\filters\AccessControl;
use app\models\UrlRules;
use yii\web\CUrlManager;

class UrlManager extends CUrlManager {

    public $dbTable = 'url_rules';

//
    protected function processRules() {

//        $urlRules = Yii::app()->db->createCommand("
//         SELECT `pattern`, `route` FROM `{$this->dbTable}`
//      ")->queryAll();
        $urlRules = UrlRules::find('pattern, route')->all();
//        echo "<pre>";
//        print_r($urlRules);
//        echo "</pre>";
//        exit;

        foreach ($urlRules as $route) {
            $this->rules[$route['pattern']] = $route['route'];
        }

        $this->rules['sns-auth/<service:(google|google-oauth|facebook|linkedin|twitter)>'] = 'site/socialSiteLogin';
        $this->rules['<id>/group-chat'] = 'chat/Index';
        $this->rules['instagram-login'] = 'site/InstagramLogin';

        $this->rules['<controller:\w+>/<id:\d+>'] = '<controller>/view';
        $this->rules['<controller:\w+>/<action:\w+>/<id:\d+>'] = '<controller>/<action>';
//        $this->rules['<controller:\w+>/<action:\w+>/<slug:\d+>'] = '<controller>/<action>';
        $this->rules['<controller:\w+>/<action:\w+>/<role:\w+>'] = '<controller>/<action>';
        $this->rules['<controller:\w+>/<action:\w+>'] = '<controller>/<action>';
        parent::processRules();
    }

}
