<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'layout' => 'column1',
    'basePath' => dirname(__DIR__),
//    'language' => 'es',
    'language' => 'en',
//    'timeZone' => 'America/Bogota',
    'timeZone' => 'Asia/Kolkata',
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\AdminModule',
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
    ],
    'components' => [
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => []
                ],
            ],
        ],
        'userCounter' => [
            'class' => 'app\components\UserCounter',
            // You can setup these options:
            'tableUsers' => 'pcounter_users',
            'tableSave' => 'pcounter_save',
            'autoInstallTables' => true,
            'onlineTime' => 10, // min
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                    'on missingTranslation' => ['app\components\TranslationEventHandler', 'handleMissingTranslation']
                ],
            ],
        ],
        'nexmo' => [
            'class' => 'app\components\Nexmo',
        ],
        'instagram' => [
            'class' => 'app\components\Instagram',
        ],
        'request' => [
// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'enter your secret key here',
            'enableCsrfValidation' => false,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\UserMaster',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_porisebaFrontendUser', // unique for frontend
                'httpOnly' => true,
            ],
            'loginUrl' => ['site/login'],
        ],
        'paypal' => [
            'class' => 'app\components\Paypal',
            'apiClientId' => 'AbUHZgSGEb4BLkXXOP6WMwInwZqnusleUM2kkbBjZ5iz-oodk99LOsfZAZRUIKAgau4vSUqZ_nH54YwV', //Client id
            'apiSecretKey' => 'EESLSq23iPazvciiDY8w__VJjVOOmuqxKO8atSQatnkpgXTl5AgJUiiKK6nIqqMU-nXZWdNGpTisU_RL', //secret key
            'apiCurrency' => 'USD'
        ],
        'payu' => [
            'class' => 'app\components\Payu'
        ],
        'sportradar' => [
            'class' => 'app\components\Sportradar',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
//        'mailer' => [
//            'class' => 'yii\swiftmailer\Mailer',
//            'transport' => [
//                'class' => 'Swift_SmtpTransport',
//                'host' => 'email-smtp.us-east-1.amazonaws.com', // e.g. smtp.mandrillapp.com or smtp.gmail.com
//                'username' => 'poriseba.com@gmail.com',
//                'password' => 'Password!@3',
//                'port' => '25', // Port 25 is a very common port too
//                'encryption' => 'tls', // It is often used, check your provider or mail server specs
//            ],
//            // send all mails to a file by default. You have to set
//// 'useFileTransport' to false and configure a transport
//// for the mailer to send real emails.
//            'useFileTransport' => false,
//        ],
        'mail' => [
            'class' => 'yashop\ses\Mailer',
            'access_key' => 'AKIAJSNACDPWRHTNISTA',
            'secret_key' => 'Alih89gKNRT2zExyA8amVe7OLlLmBmqKQldQ/CcTEpbq',
            'host' => 'email-smtp.us-east-1.amazonaws.com' // not required
        // send all mails to a file by default. You have to set
// 'useFileTransport' to false and configure a transport
// for the mailer to send real emails.
        //'useFileTransport' => false,
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
        /* 'urlManager' => [
          'enablePrettyUrl' => true,
          'showScriptName' => false,
          'rules' => include_once 'routes.php',
          ], */
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
        /* 'rules' => array(

          ), */
        ],
        'cdn' => [
            'class' => '\yii2cdn\Cdn',
            'baseUrl' => '/cdn',
            'basePath' => dirname(dirname(__DIR__)) . '/cdn',
            'components' => [
                'script' => [
                    'js' => [
                        [
                            '@cdn' => 'https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js', // online version
                        ]
                    ]
                ]
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
// configuration adjustments for 'dev' environment
//    $config['bootstrap'][] = 'debug';
//    $config['modules']['debug'] = [
//        'class' => 'yii\debug\Module',
//    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
    ];
}

return $config;
