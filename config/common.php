<?php

return [
    'name' => 'Photo gallery',
    'sourceLanguage' => 'en',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(__DIR__) . '/vendor',
    'components' => [
        'cache' => [
            'class' => '\yii\caching\FileCache',
            'defaultDuration' => 604800 // one week
        ],
        'db' => [
            'class' => '\yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=dbmane',
            'username' => '',
            'password' => ''
        ]
    ],
     'container' => [
        'definitions' => [
            \App\Domain\Repository\AlbumRepositoryInterface::class => \App\Infrastructure\Persistence\Repository\AlbumRepository::class,
            \App\Application\Storage\PhotoStorageInterface::class => [
                'class' =>  \App\Infrastructure\Persistence\Storage\LocalPhotoStorage::class,
                    '__construct()' => [
                        Yii::getAlias('@uploads/photo'),
                    ],
                ]
               ,
        ],
     ]
];
