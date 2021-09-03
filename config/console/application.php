<?php

declare(strict_types=1);

return [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__, 2),
    'controllerNamespace' => 'app\commands',
    'controllerMap' => [
        'fixture' => [
            'class' => \yii\console\controllers\FixtureController::class,
            'namespace' => 'app\fixtures',
        ],
    ],
];