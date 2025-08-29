<?php

namespace front\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $sourcePath = '@front/assets';

    public $publishOptions = [
        'forceCopy' => YII_DEBUG ? true : false,  // Принудительно обновлять ресурсы из этого Asset
    ];

    public $js = [
        'js/script.js'
    ];

    public $css = [
        'css/bulma.min.css',
        'css/styles.css',
    ];

    // public $depends = [
    //    'yii\web\JqueryAsset',
    // ];
}
