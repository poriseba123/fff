<?php

namespace app\assets\backend;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class MainAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'themes/global/plugins/font-awesome/css/font-awesome.min.css',
        'themes/global/plugins/simple-line-icons/simple-line-icons.min.css',
        'themes/global/plugins/bootstrap/css/bootstrap.min.css',
        'themes/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
        'themes/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css',
        'themes/backend/assets/css/components.min.css',
        'themes/backend/assets/css/plugins.min.css',
        'themes/global/plugins/fullcalendar/fullcalendar.min.css',
        'themes/backend/assets/css/profile.min.css',
        'themes/backend/assets/css/layout.min.css',
        'themes/backend/assets/css/themes/darkblue.min.css',
        'themes/backend/assets/css/custom.min.css',
        'themes/global/plugins/morris/morris.css',
        'themes/global/plugins/jqvmap/jqvmap/jqvmap.css',
        'themes/global/css/custom-global.css',
        'themes/global/css/bootstrap-datetimepicker.min.css',
//        ========= custom css files =============
        'themes/backend/custom/css/common.css',
        'themes/global/css/lobibox.min.css',
        'themes/global/css/loader.css',
        'themes/global/css/jquery-ui.css',
        'themes/backend/custom/css/profile.css',
        'themes/backend/custom/css/custom.css',
    ];
    public $js = [
        ['themes/global/plugins/jquery.min.js', 'position' => \yii\web\View::POS_HEAD],
        'themes/backend/assets/js/app.min.js',
        'themes/global/plugins/bootstrap/js/bootstrap.min.js',
        'themes/backend/assets/js/layout.min.js',
        'themes/global/plugins/js.cookie.min.js',
        'themes/global/plugins/js.cookie.min.js',
        'themes/global/plugins/ckeditor/ckeditor.js',
//        ============ custom js files ============
        'themes/backend/custom/js/common.js',
        'themes/global/js/lobibox.js',
        'themes/global/js/customAjaxNotifyFunctions.js',
        'themes/backend/custom/js/dashboard.js',
        'themes/global/js/custom-global.js',
        'themes/backend/custom/js/profile.js',
        'themes/backend/custom/js/custom.js',
        'themes/global/js/moment.js',
        'themes/global/js/bootstrap-datetimepicker.min.js',
        'themes/global/js/jquery-ui.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
