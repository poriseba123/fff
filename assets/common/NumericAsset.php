<?php

namespace app\assets\common;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class NumericAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    //https://github.com/jaredreich/notie
    public $css = [
        
    ];
    public $js = [
        'frontend/js/jquery-numeric.js',
    ];
    public $depends = [
        'app\assets\common\JqueryAsset',
    ];

}
