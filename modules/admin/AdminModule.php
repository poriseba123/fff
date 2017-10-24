<?php

namespace app\modules\admin;

use Yii;

/**
 * admin module definition class
 */
class AdminModule extends \yii\base\Module {

    /**
     * @inheritdoc
     */
    public $defaultRoute = 'auth/login';
    public $controllerNamespace = 'app\modules\admin\controllers';
//    public $layout = 'column1';

    public function init() {
        parent::init();

        // custom initialization code goes here

        \Yii::$app->set('user', [
            'class' => 'yii\web\User',
            'identityClass' => 'app\models\UserMaster',
            'loginUrl' => ['admin/'],
            'enableAutoLogin' => true,
//            'enableSession'=>true,
            'identityCookie' => ['name' => 'sportsNotionAdminUser', 'httpOnly' => true],
//            'idParam' => 'admin_id', //this is important !
        ]);
        \Yii::$app->set('session', [
            'class' => 'yii\web\Session',
            'name' => '_sportsNotionSessionId', // unique for backend
            'savePath' => sys_get_temp_dir(), // a temporary folder on backend
        ]);
    }

    public function beforeAction($action) {

        // your custom code here, if you want the code to run before action filters,
        // which are triggered on the [[EVENT_BEFORE_ACTION]] event, e.g. PageCache or AccessControl
        $route = $action->controller->id . '/' . $action->id;
        $publicPages = array(
            'auth/login',
            'auth/forgotpass',
            'auth/resetpassword',
        );
        if (Yii::$app->user->isGuest && !in_array($route, $publicPages)) {
            Yii::$app->response->redirect(['admin/']);
//            Yii::$app->user->loginRequired();
        }
        // other custom code here

        return true; // or false to not run the action
    }

}
