<?php

namespace app\assets\frontend;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class BootstrapAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'themes/frontend/css/bootstrap.css',
        'themes/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.es.css',
    ];
    public $js = [
        'themes/frontend/js/bootstrap.min.js',
        'themes/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.es.js',
    ];
    public $depends = [
        'app\assets\common\JqueryAsset',
    ];
}
