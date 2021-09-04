<?php

declare(strict_types=1);

namespace app\widgets;

use yii\bootstrap4\InputWidget;
use yii\helpers\Html;

class ImageInput extends InputWidget
{
    public $value;

    public $options;

    public function init()
    {

    }

    public function run(): string
    {
        return Html::img($this->value, $this->options) . Html::fileInput($this->attribute);
    }
}