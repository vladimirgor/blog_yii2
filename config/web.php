<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'post/index',
    'language' => 'ru',
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'defaultRoute' => 'post/index',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'EoZk3jjzaReu1yvCjm6AXrjGbmt_b5Fn',
            'baseURL' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['post/login'],
        ],
        'errorHandler' => [
            //'errorAction' => 'site/error',
            'errorAction' => 'post/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'post/<id:\d+>/<page:\d+>' => 'post/view',
                'post/comment/<id:\d+>/<page:\d+>' => 'post/comment',
                'page/<page:\d+>' => 'post/index',
                '/' => 'post/index',
                'admin/post/<page:\d+>' => 'admin/post/index',
                'admin/view/<id:\d+>'=> 'admin/post/view',
                'admin/update/<id:\d+>'=> 'admin/post/update',
                'admin/delete/<id:\d+>'=> 'admin/post/delete',
                'admin/addimage/<id:\d+>'=> 'admin/post/addimage',
                'admin/comment/<id:\d+>' => 'admin/comment/view',
                'admin/user/<id:\d+>' => 'admin/user/view',
                'signing' => 'post/signing',
                'login' => 'post/login'
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
