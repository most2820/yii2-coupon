<?php

declare(strict_types=1);

namespace app\assets;

use Yii;
use yii\web\View;

class AutosizeTextareaAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@bower/autosize/dist';
    public $js = [
        'autosize.min.js',
    ];

    public function init()
    {
        $js = <<<SCRIPT
$(function() {
    $("textarea").each(function(){
        autosize($(this));
    });
});
SCRIPT;
        Yii::$app->view->registerJs($js, View::POS_READY);
        parent::init();
    }
}