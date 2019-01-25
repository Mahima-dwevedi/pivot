<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => "mysql:host=localhost;dbname={$arrConfig['dbName']}",
             'emulatePrepare' => true,
            'username' => $arrConfig['dbUser'],
            'password' => $arrConfig['dbPass'],
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'CommonFunction' => [
                  'class' => 'common\components\CommonFunction'
        ],
        'user' => [
        'enableAutoLogin' => true,
        ],
        'session' => [
        'class' => 'yii\web\Session',
        'cookieParams' => ['httponly' => true, 'lifetime' => 3600 * 4],
        'timeout' => 3600*4, //session expire
        'useCookies' => true,
        ],
    ],
]; 
