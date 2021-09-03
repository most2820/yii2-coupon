<?php

declare(strict_types=1);

return [
    'id' => 'basic-tests',
    'language' => 'en-US',
    'basePath' => dirname(__DIR__, 2),
    'components' => [
        'urlManager' => [
            'showScriptName' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
        ],
        'db' => require dirname(__DIR__) . '/db.php',
    ]
];