<?php

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'App\Presentation\Web\Controller',
    'viewPath' => '@ddd/Presentation/Web/View/',
     'components' => [
        'request' => [
            'cookieValidationKey' => '',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'user' => [
            'identityClass' => 'App\Infrastructure\Auth\Identity',
            'enableAutoLogin' => true,
            'loginUrl' => ['auth/sign-in'],
        ],
    ],
    'runtimePath' => '@root/runtime/front',
    'as access' => [
        'class' => '\yii\filters\AccessControl',
        'except' => ['site/login', 'site/error'],
        'rules' => [
            [
                'allow' => true,
                'roles' => ['@']
            ],
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
