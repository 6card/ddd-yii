<?php

namespace App\Presentation\Web\Assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $sourcePath = '@ddd/Presentation/Web/Assets';

    public $publishOptions = [
        'forceCopy' => YII_DEBUG ? true : false,  // Принудительно обновлять ресурсы из этого Asset
    ];

    public $js = [
        // 'js/jquery-3.1.1.min.js',
        'js/semantic.js'
    ];

    public $css = [
        'css/semantic.css',
        'css/styles.css',
    ];

    public $depends = [
       'yii\web\JqueryAsset',
    ];
}
