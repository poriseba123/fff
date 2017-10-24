<?php

namespace app\assets\frontend;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AutocompleteAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    //https://github.com/jaredreich/notie
    public $css = [
        'frontend/assets/easy_autocomplete/easy-autocomplete.min.css',
        'frontend/assets/easy_autocomplete/easy-autocomplete.themes.min.css',
    ];
    public $js = [
        'frontend/assets/easy_autocomplete/jquery.easy-autocomplete.min.js',
    ];
    public $depends = [
        'app\assets\common\JqueryAsset',
        'app\assets\frontend\BootstrapAsset',
    ];

}
