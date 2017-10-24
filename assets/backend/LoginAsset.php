<?php

namespace app\assets\backend;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'themes/global/plugins/font-awesome/css/font-awesome.min.css',
        'themes/global/plugins/simple-line-icons/simple-line-icons.min.css',
        'themes/global/plugins/bootstrap/css/bootstrap.min.css',
        'themes/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
        'themes/global/plugins/select2/css/select2.min.css',
        'themes/global/plugins/select2/css/select2-bootstrap.min.css',
        'themes/backend/assets/css/components.min.css',
        'themes/backend/assets/css/plugins.min.css',
        'themes/backend/assets/css/login.min.css',
        'themes/global/css/lobibox.min.css',
        'themes/global/css/loader.css',
        'themes/global/css/custom-global.css',
//        ======== custom css files =============
        'themes/backend/custom/css/login.css',
        
    ];
    public $js = [
        'themes/global/plugins/jquery.min.js',
        'themes/global/plugins/bootstrap/js/bootstrap.min.js',
        'themes/global/plugins/js.cookie.min.js',
        'themes/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
        'themes/global/plugins/jquery.blockui.min.js',
        'themes/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
        'themes/global/plugins/jquery-validation/js/jquery.validate.min.js',
        'themes/global/plugins/jquery-validation/js/additional-methods.min.js',
        'themes/global/plugins/select2/js/select2.full.min.js',
        'themes/global/plugins/backstretch/jquery.backstretch.min.js',
        'themes/backend/assets/js/app.min.js',
        'themes/global/js/custom-global.js',
        'themes/global/js/lobibox.js',
        'themes/global/js/customAjaxNotifyFunctions.js',
//        ============ custom js files ============
        'themes/backend/custom/js/login.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
