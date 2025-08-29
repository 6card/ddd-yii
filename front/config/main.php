<?php

$config = [
    'id' => 'app',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'front\controllers',
     'components' => [
        'request' => [
            'cookieValidationKey' => '',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', 'localhost'],
    ];
}

return $config;
