<?php

require(__DIR__ . '/constants.php'); // файл с кодами ошибок и другими константами

$params = require(__DIR__ . '/params.php');

$config = [
	'id' => 'basic',
	'basePath' => dirname(__DIR__),
	'bootstrap' => ['log'],
	'defaultRoute' => 'main/index',
	'components' => [
		'urlManager' => [
			'enablePrettyUrl' => true,
			'enableStrictParsing' => true,
			'showScriptName' => false,
			'rules' => [
				'main' => 'main',
				'<controller:\w+>/<action:\w+>' 		=> '<controller>/<action>'
			],
		],
		'request' => [
			// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
			'cookieValidationKey' => '12b62091ahjk',
			'parsers' => [
				'application/json' => 'yii\web\JsonParser',
			]
		],
		// 'cache' => [
		// 	'class' => 'yii\redis\Cache', // to speed up database requests you can use redis
		// ],
		'user' => [
			'class' => 'app\components\User',
			'identityClass' => 'app\models\Users',
			'enableAutoLogin' => false,
			'enableSession' => false,
			'loginUrl' => null
		],
		'errorHandler' => [
			'errorAction' => 'error',
		],
		'mailer' => [
			'class' => 'yii\swiftmailer\Mailer',
			// send all mails to a file by default. You have to set
			// 'useFileTransport' to false and configure a transport
			// for the mailer to send real emails.
			'useFileTransport' => true,
		],
		'log' => [
			// 'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				]
			],
		],
		'db' => require(__DIR__ . '/db.php'),
		// 'redis' => [
		// 	'class' => 'yii\redis\Connection', // sample redis setup
		// 	'hostname' => 'localhost',
		// 	'port' => 6379,
		// 	'database' => 0,
		// ],
		// 'mongodb' => [
		// 	'class' => 'yii\mongodb\Connection',
		// 	'dsn' => 'mongodb://localhost:27017/test', // sample mongo setup
		// ],
	],
	'params' => $params,
];

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][] = 'debug';
	$config['modules']['debug'] = 'yii\debug\Module';

	$config['bootstrap'][] = 'gii';
	$config['modules']['gii'] = [
		'class' => 'yii\gii\Module',
		'allowedIPs' => ['127.0.0.1']
	];

	$config['bootstrap'][] = 'log';
}

return $config;
