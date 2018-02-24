<?php

namespace app\assets\backend;

use yii\web\AssetBundle;

class DashboardAssets extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'themes/global/plugins/font-awesome/css/font-awesome.min.css',
        'themes/global/plugins/simple-line-icons/simple-line-icons.min.css',
        'themes/global/plugins/bootstrap/css/bootstrap.min.css',
        'themes/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
        'themes/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css',
        'themes/global/plugins/morris/morris.css',
        'themes/global/plugins/fullcalendar/fullcalendar.min.css',
        'themes/global/plugins/jqvmap/jqvmap/jqvmap.css',
        'themes/backend/assets/css/components.min.css',
        'themes/backend/assets/css/plugins.min.css',
        'themes/backend/assets/css/layout.min.css',
        'themes/backend/assets/css/themes/darkblue.min.css',
        'themes/backend/assets/css/custom.min.css',
        'themes/global/css/custom-global.css',
//        ========= custom css files =============
        'themes/global/css/lobibox.min.css',
        'themes/global/css/loader.css',
        'themes/backend/custom/css/dashboard.css',
        'themes/global/css/AdminLTE.min.css',
        'themes/backend/custom/css/common.css',
    ];
    public $js = [
        'themes/global/plugins/jquery.min.js',
        'themes/global/plugins/bootstrap/js/bootstrap.min.js',
        'themes/global/plugins/js.cookie.min.js',
        'themes/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
        'themes/global/plugins/jquery.blockui.min.js',
        'themes/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
        'themes/global/plugins/moment.min.js',
        'themes/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js',
        'themes/global/plugins/morris/morris.min.js',
        'themes/global/plugins/morris/raphael-min.js',
        'themes/global/plugins/counterup/jquery.waypoints.min.js',
        'themes/global/plugins/counterup/jquery.counterup.min.js',
        'themes/global/plugins/amcharts/amcharts/amcharts.js',
        'themes/global/plugins/amcharts/amcharts/serial.js',
        'themes/global/plugins/amcharts/amcharts/pie.js',
        'themes/global/plugins/amcharts/amcharts/radar.js',
        'themes/global/plugins/amcharts/amcharts/themes/light.js',
        'themes/global/plugins/amcharts/amcharts/themes/patterns.js',
        'themes/global/plugins/amcharts/amcharts/themes/chalk.js',
        'themes/global/plugins/amcharts/ammap/ammap.js',
        'themes/global/plugins/amcharts/ammap/maps/js/worldLow.js',
        'themes/global/plugins/amcharts/amstockcharts/amstock.js',
        'themes/global/plugins/fullcalendar/fullcalendar.min.js',
        'themes/global/plugins/horizontal-timeline/horizontal-timeline.js',
        'themes/global/plugins/flot/jquery.flot.min.js',
        'themes/global/plugins/flot/jquery.flot.resize.min.js',
        'themes/global/plugins/flot/jquery.flot.categories.min.js',
        'themes/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js',
        'themes/global/plugins/jquery.sparkline.min.js',
        'themes/global/plugins/jqvmap/jqvmap/jquery.vmap.js',
        'themes/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js',
        'themes/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js',
        'themes/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js',
        'themes/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js',
        'themes/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js',
        'themes/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js',
        
        'themes/backend/assets/js/app.min.js',
        'themes/backend/assets/js/dashboard.min.js',
        'themes/backend/assets/js/layout.min.js',
        'themes/backend/assets/js/demo.min.js',
        'themes/backend/assets/js/quick-sidebar.min.js',
        'themes/backend/assets/js/quick-nav.min.js',
        'themes/global/js/custom-global.js',
//        ============ custom js files ============
        'themes/global/js/lobibox.js',
        'themes/global/js/customAjaxNotifyFunctions.js',
        'themes/backend/custom/js/common.js',
        'themes/backend/custom/js/dashboard.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
