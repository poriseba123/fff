<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets\frontend;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'themes/global/plugins/bootstrap/css/bootstrap.min.css',
        'themes/global/plugins/font-awesome/css/font-awesome.min.css',
        'themes/global/css/custom-global.css',
        'themes/global/css/lobibox.css',
        'themes/global/css/lobibox.min.css',
        'themes/global/css/lobibox.min.css',
        'themes/frontend/custom/css/custom.css',
    ];
    public $js = [
        'themes/global/plugins/jquery.min.js',
        'themes/global/plugins/bootstrap/js/bootstrap.min.js',
        'themes/global/js/custom-global.js',
        'themes/global/js/lobibox.js',
        'themes/global/js/customAjaxNotifyFunctions.js',
        'themes/frontend/custom/js/registration-login.js',
        'themes/frontend/custom/js/facebook-login.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
