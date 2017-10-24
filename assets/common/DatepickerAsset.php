<?php

namespace app\assets\common;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class DatepickerAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'themes/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.es.css',
    ];
    public $js = [
        'themes/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.es.js',
    ];
    public $depends = [
        'app\assets\common\JqueryAsset',
    ];

}
