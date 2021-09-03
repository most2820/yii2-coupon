<?php

declare(strict_types=1);

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';

    public $baseUrl = '@web';

    public $css = [
        'css/app.css',
    ];

    public $js = [
        'js/app.js',
    ];

    public $depends = [
        YiiAsset::class,
        FontAwesomeAsset::class,
    ];
}
