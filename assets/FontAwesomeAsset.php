<?php

declare(strict_types=1);

namespace app\assets;

use yii\web\AssetBundle;

class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower-asset/fontawesome';
    public $css = [
        'css/all.min.css',
    ];
    public $js = [
        'js/all.min.js'
    ];
}