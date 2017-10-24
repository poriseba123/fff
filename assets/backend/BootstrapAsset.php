<?php

namespace app\assets\backend;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class BootstrapAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'global/plugins/bootstrap/css/bootstrap.min.css',
    ];
    public $js = [
        'global/plugins/bootstrap/js/bootstrap.min.js',
    ];
    public $depends = [
        'app\assets\common\JqueryAsset',
    ];

}
