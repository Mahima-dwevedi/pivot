<?php
############### Start DB configure here ######################
if($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "10.0.1.52")
{
	$arrConfig['dbHost'] = 'localhost';
	$arrConfig['dbName'] = 'pivot';
	$arrConfig['dbUser'] = 'pivot';
	$arrConfig['dbPass'] = 'pivot';
	$siteUrl = "http://localhost/pivot/";
	$rootURL = "http://localhost/pivot";
}
else {
	$arrConfig['dbHost'] = 'localhost';
	$arrConfig['dbName'] = 'pivot';
	$arrConfig['dbUser'] = 'pivot';
	$arrConfig['dbPass'] = 'pivot';
	$siteUrl = "http://test.example.com/";
	$rootURL = "http://test.example.com/";

}
############### End DB configure here ######################

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'America/New_York',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => 'false'
        ],

       'mail' => [
      'class' => 'yii\swiftmailer\Mailer',
       'viewPath' => '@common/mail',
        'useFileTransport' => false,

      'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'localhost',
        'username' => '',
        'password' => '',
        'port' => '25',

      ],

    ],
    ],
];

