<?php

namespace app\assets\common;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class JqueryAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        ['frontend/js/jquery-2.2.4.min.js', 'position' => \yii\web\View::POS_HEAD],
    ];

}
