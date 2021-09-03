<?php

declare(strict_types=1);

namespace app\components;

use app\services\ImageManager;

class View extends \yii\web\View
{
    public ImageManager $imageManager;

    public function __construct(
        ImageManager $imageManager,
                     $config = []
    )
    {
        parent::__construct($config);
        $this->imageManager = $imageManager;
    }
}