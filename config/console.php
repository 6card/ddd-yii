<?php

return [
    'id' => 'console',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'App\Presentation\Console\Controller',
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => '@ddd/Migrations',
        ],
    ],
    'runtimePath' => '@root/runtime/console'
];
