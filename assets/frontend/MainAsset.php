<?php

namespace app\assets\frontend;

use yii\web\AssetBundle;


class MainAsset extends AssetBundle {
    
      
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'themes/frontend/css/bootstrap.min.css',
        'themes/frontend/css/jasny-bootstrap.min.css',
        'themes/frontend/css/jasny-bootstrap.min.css',
        'themes/frontend/css/material-kit.css',
        'themes/frontend/css/font-awesome.min.css',
        'themes/frontend/fonts/line-icons/line-icons.css',
        'themes/frontend/css/main.css',
        'themes/frontend/extras/animate.css',
        'themes/frontend/extras/owl.carousel.css',
        'themes/frontend/extras/owl.theme.css',
        'themes/frontend/css/responsive.css',
        'themes/frontend/css/slicknav.css',
        'themes/frontend/css/bootstrap-select.min.css',
        'themes/frontend/custom/css/custom.css',
    ];
    public $js = [
        ['themes/global/plugins/jquery.min.js','position' => \yii\web\View::POS_HEAD],
        'themes/frontend/js/bootstrap.min.js',
        'themes/frontend/js/material.min.js',
        'themes/frontend/js/material-kit.js',
        'themes/frontend/js/jquery.parallax.js',
        'themes/frontend/js/owl.carousel.min.js',
        'themes/frontend/js/wow.js',
        'themes/frontend/js/main.js',
        'themes/frontend/js/jquery.counterup.min.js',
        'themes/frontend/js/waypoints.min.js',
        'themes/frontend/js/jasny-bootstrap.min.js',
        'themes/frontend/js/form-validator.min.js',
        'themes/frontend/js/contact-form-script.js',
        'themes/frontend/js/jquery.themepunch.revolution.min.js',
        'themes/frontend/js/jquery.themepunch.tools.min.js',
        'themes/frontend/js/bootstrap-select.min.js',
        'themes/frontend/js/loginmodal.js',
        'themes/frontend/custom/js/search.js'
    ];
//    public $depends = [
//        'app\assets\common\JqueryAsset',
//        'app\assets\frontend\BootstrapAsset',
//    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
