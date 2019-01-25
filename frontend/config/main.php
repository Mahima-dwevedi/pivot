<?php

$params = array_merge(
	require(__DIR__ . '/../../common/config/params.php'),
	require(__DIR__ . '/../../common/config/params-local.php'),
	require(__DIR__ . '/params.php'),
	require(__DIR__ . '/params-local.php')
);

use yii\web\Request;

require(__DIR__ . '/messages.php');
$baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());

return [
	'id' => 'app-frontend',
	'basePath' => dirname(__DIR__),
	'bootstrap' => ['log'],
	'controllerNamespace' => 'frontend\controllers',
	'components' => [

		'authClientCollection' => [
			'class' => 'yii\authclient\Collection',
			'clients' => [
				'google' => [
					'class' => 'yii\authclient\clients\GoogleOAuth',
					'clientId' => '744467832327-srahqqgt5q7tn6f7ounb1oiq94ig0hct.apps.googleusercontent.com',
					'clientSecret' => 'b8WD8e7KJpiED9CjDdQZ0BYa',
				],
				'facebook' => [
					'class' => 'yii\authclient\clients\Facebook',
					'clientId' => '687905994606111',
					'clientSecret' => '32191f4bfa53dec2ac4c8cb8d04057b9',
				],
			],
		],

		'request' => [
			'baseUrl' => $baseUrl,
		],
		'user' => [
			'identityClass' => 'common\models\User',
			'enableAutoLogin' => true,
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
		'errorHandler' => [
			'errorAction' => 'site/error',
		],

		'urlManager' => [
			'baseUrl' => $baseUrl,
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules' => [
				'<alias:index|faq|searchfaq|contact|about|support|features>' => 'site/<alias>',
				'<alias:index>' => 'site/<alias>',
				'page/<slug:[a-zA-Z0-9-_\/]+>' => 'site/view',
				'<alias:bluesky-terms>' => 'site/terms',
				'<alias:privacy-policy>' => 'site/privacy',
				'<alias:get-started>' => 'site/transplantservices',
				'<alias:pricing-plans>' => 'site/refundpolicy',
				'<alias:topup-locations>' => 'site/support',
				'<alias:getin-touch>' => 'site/features',
				'product/<categoryid:[0-9]+>/' => 'product',
				'combo/<categoryid:[a-zA-Z0-9-_\/]+>' => 'combo',
				'product/<argCategoryName:[a-zA-Z0-9-_]+?>/<categoryid:[0-9]+/?>' => 'product',
				'product/<argCategoryName:[a-zA-Z0-9-_]+?>/<argProductName:[a-zA-Z0-9-_]+?>/<id:[0-9]+/?>' => 'product/details',
				'product-details/<id:[0-9]+>/' => 'product/details',
				'combo-details/<id:[0-9]+>/' => 'combo/details',
			],
		],


	],
	'params' => $params,
	'modules' => [
		'gii' => [
			'class' => 'yii\gii\Module',
			'allowedIPs' => ['127.0.0.1', '::1', '192.168.1.101'],
			'password' => '123456'
		],
	],
];
