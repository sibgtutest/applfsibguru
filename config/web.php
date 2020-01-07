<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU', // <- здесь!
    'bootstrap' => ['log'],
    'modules' => [
        // administrators modules
        'administrator' => [
            'class' => 'app\modules\administrator\Module',
        ],
        'setting' => [
            'class' => 'app\modules\setting\Module',
        ],  
        'post' => [
            'class' => 'app\modules\post\Module',
        ],
        'manager' => [
            'class' => 'app\modules\manager\Module',
        ],
        'user' => [
            'class' => 'app\modules\user\Module',
        ],
        'rbac' => [
            'class' => 'app\modules\rbac\Module',
        ],  
        'eiee' => [
            'class' => 'app\modules\eiee\Module',
        ],
        'chat' => [
            'class' => 'app\modules\chat\Module',
        ],        
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles'    => ['guest'],
        ],          
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'VGYk5GQ6Dtc3saPnK_eYcvnwOCe-KT70',
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
        'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */    
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                '<section:\w+>' => 'post/page/index',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<section:\w+>' 
                    => '<module>/<controller>/<action>',
                
                //'<module:\w+>/' => '<module>/default/index',
                //'<module:\w+>/portfolio' => '<module>/default/profile',
                '<module:\w+>/academic/' => '<module>/academic/index',
                '<module:\w+>/paper/' => '<module>/paper/index',
                '<module:\w+>/scientific/' => '<module>/scientific/index',
                '<module:\w+>/public/' => '<module>/public/index',
                '<module:\w+>/sport/' => '<module>/sport/index',
                '/eiee/profile/' => '<module>/profile/index',

                //'<module:\w+>/<action:\w+>/' => '<module>/default/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>/' 
                    => '<module>/<controller>/<action>',
                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
                
                '<controller>/<action>/<id:\d+>' => '<controller>/<action>',
                '<controller>/<action>/<id:\w+>' => '<controller>/<action>',
                
                //['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
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
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
