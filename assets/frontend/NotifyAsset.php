<?php

namespace app\assets\frontend;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class NotifyAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    //https://github.com/jaredreich/notie
    public $css = [
        'themes/frontend/js/noty/notie.css',
    ];
    public $js = [
        'themes/frontend/js/noty/notie.min.js',
    ];
//    public $depends = [
//        'app\assets\common\JqueryAsset',
//    ];

}
