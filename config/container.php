<?php

declare(strict_types=1);

use app\services\ImageManager;
use yii\mail\MailerInterface;

return [
    'singletons' => [
        MailerInterface::class => function () {
            return Yii::$app->mailer;
        },
        ImageManager::class => function () {
            return new ImageManager(
                Yii::getAlias('@webroot/images/'),
                Yii::getAlias('@web/images'),
                Yii::getAlias('@web/no-image.png'),
            );
        },
    ],
];