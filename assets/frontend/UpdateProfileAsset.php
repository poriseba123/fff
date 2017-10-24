<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets\frontentAsset;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'themes/css/bootstrap.min.css',
        'themes/font-awesome/css/font-awesome.min.css',
        'themes/css/owl.carousel.css',
        'themes/css/owl.theme.css',
        'themes/css/animate.css',
        'themes/css/my-stylesheet.css',
        'themes/css/responsive.css',
        'themes/global/css/custom-global.css',
        'themes/css/lobibox.css',
        'themes/css/lobibox.min.css',
    ];
    public $js = [
//        'themes/js/jquery.min.js',
        'themes/js/bootstrap.min.js',
        'themes/js/owl.carousel.min.js',
        'themes/js/owl.carousel.min.js',
        'themes/js/lobibox.js',
        'themes/global/js/custom-global.js',
        'themes/js/customAjaxNotifyFunctions.js',
        'themes/custom/common.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
