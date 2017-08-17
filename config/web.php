<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name'=>'ПОРТАЛ LibGDX ИГР',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'homeUrl' => '//libgdxgames.ru',
    'components' => [
        'formatter' => [
            'dateFormat' => 'dd.MM.yyyy',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'EUR',
        ],
        'view' => [
            'class' => '\ogheo\htmlcompress\View',
            'compress' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'bf9ynzkENx61ndi9EnYq6YFtxLZ52YsL',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'gp' => [
            'class' => 'app\components\gp\Gp'
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            //'suffix'=>'/',
            'rules' => [
                'news' => 'news/index',
                'news/<id:[a-z0-9-]+>' => 'news/index',
                'inside/news' => 'inside/news/index',
                'inside' =>'inside/inside/index',
                'profile/<id:\d+>' => 'profile/index',
                'game/<id:\d+>/<id_game:\d+>' => 'game/index',
                'delgame/<id:\d+>/<id_game:\d+>' => 'game/delgame',
                ''=>'site/index',
                '<action>'=>'site/<action>',
            ],
        ],
    ],
    'modules' => [
//        'yii2images' => [
//            'class' => 'rico\yii2images\Module',
//            //be sure, that permissions ok
//            //if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
//            'imagesStorePath' => 'upload/store', //path to origin images
//            'imagesCachePath' => 'uoload/cache', //path to resized copies
//            'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
//            'placeHolderPath' => '@webroot/upload/stores/no-image.jpg', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
//            'imageCompressionQuality' => 100, // Optional. Default value is 85.
//        ],
        'inside' => [
            'class' => 'app\modules\inside\Module',
            'layout'=> 'layout',
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];
}

return $config;
