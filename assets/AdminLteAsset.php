<?php

declare(strict_types=1);

namespace app\assets;

use yii\bootstrap4\BootstrapAsset;
use yii\bootstrap4\BootstrapPluginAsset;
use yii\web\AssetBundle;

class AdminLteAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower-asset/adminlte/dist';
    public $css = [
        'css/adminlte.min.css',
    ];
    public $js = [
        'js/adminlte.min.js'
    ];
    public $depends = [
        BootstrapAsset::class,
        BootstrapPluginAsset::class,
    ];
}