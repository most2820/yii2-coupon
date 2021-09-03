<?php

declare(strict_types=1);

return [
    'id' => 'basic',
    'name' => 'Coupons',
    'basePath' => dirname(__DIR__, 2),
    'defaultRoute' => 'dashboard/index',
    'controllerNamespace' => 'app\controllers',
    'components' => [
        'request' => [
            'cookieValidationKey' => '-nIlExE4_1jgB33Rv8VV6__AfVE4q_iI',
        ],
        'user' => [
            'identityClass' => \app\security\UserIdentity::class,
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'view' => [
            'class' => \app\components\View::class,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [],
        ],
    ],
];
