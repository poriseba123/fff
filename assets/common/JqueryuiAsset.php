<?php

namespace app\assets\common;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class JqueryuiAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        ['global/plugins/jquery-ui/jquery-ui.min.js', 'position' => \yii\web\View::POS_HEAD],
    ];
    public $css = [
        'global/plugins/jquery-ui/jquery-ui.min.css',
    ];
    public $depends = [
        'app\assets\common\JqueryAsset',
    ];

}
