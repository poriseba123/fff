<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Cookie;
use app\components\FrontendController;

class LanguageController extends FrontendController {

    public function actionChangelang() {
        if (Yii::$app->request->isAjax) {
            $reqLang = $_POST['lang'];


            $cookies = Yii::$app->response->cookies;
            $cookies->add(new \yii\web\Cookie([
                'name' => '123vamos_language',
                'value' => $reqLang,
                'expire'=> time() + (60 * 60 * 24)
            ]));
            
            Yii::$app->language = $reqLang;

            return json_encode(Yii::$app->language);
        }
    }

}
