<?php

$config = [
    'id' => 'yii2-dashboard-web',
    'basePath' => dirname(__DIR__),
    'extensions' => require(VENDOR_DIR . '/yiisoft/extensions.php'),
    'aliases' => [
        '@vendor' => VENDOR_DIR,
        '@bower' => VENDOR_DIR . '/bower',
        '@cornernote/dashboard' => realpath(__DIR__ . '../../../../src'),
    ],
    'params' => [
        'supportEmail' => 'test@example.com',
    ],
    'components' => [
        'assetManager' => [
            'basePath' => __DIR__ . '/../web/assets',
        ],
        'cache' => null,
        'db' => require __DIR__ . '/db.php',
        'errorHandler' => [
            'class' => '\cornernote\dashboard\components\web\ErrorHandler',
            'errorAction' => 'site/error',
        ],
        'log' => [
            'traceLevel' => getenv('YII_TRACE_LEVEL'),
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                    'logVars' => ['_GET', '_POST', '_FILES', '_COOKIE', '_SESSION'],
                    'logFile' => '@app/runtime/logs/web.log',
                    'dirMode' => 0777
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true
        ],
        'request' => [
            'enableCsrfValidation' => false,
            'enableCookieValidation' => false
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
        ],
    ],
    'modules' => [
        'dashboard' => [
            'class' => 'cornernote\dashboard\Module',
        ],
    ],
];

if (defined('YII_APP_BASE_PATH')) {
    $config = Codeception\Configuration::mergeConfigs(
        $config,
        require YII_APP_BASE_PATH . '/tests/codeception/config/config.php'
    );
}

return $config;
