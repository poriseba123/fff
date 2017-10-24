<?php

namespace app\assets\common;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class LightboxAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    //https://github.com/jaredreich/notie
    public $css = [
         'frontend/custom/js/lightbox/lightbox.min.css',
    ];
    public $js = [
        'frontend/custom/js/lightbox/lightbox-plus-jquery.min.js',
    ];
    public $depends = [
        'app\assets\common\JqueryAsset',
    ];

}
