<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'intro/index',
    'layout' => '_catalog',
    'components' => [
	    'assetManager' => [
	    	'class' => 'yii\web\AssetManager',
		    'linkAssets' => true,
		    'appendTimestamp' => true,
	    ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'frontend\models\User',
            'enableAutoLogin' => false,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
	        'class' => 'yii\web\UrlManager',
	        'enablePrettyUrl' => true,
            'showScriptName' => false,
            // 'enableStrictParsing' => true,
            // 'hostInfo' => 'http://sati-spb',
            'rules' => [
	            '' => 'intro/index',

            	[
		            'pattern' => 'catalog',
		            'route' => 'catalog/view',
		            'defaults' => ['url' => 'index'],
		            'mode' => \yii\web\UrlRule::CREATION_ONLY,
	            ],
	            'catalog/<url>' => 'catalog/view',
	            '<url:main.php>'=>'catalog/view', // redirect old urls

	            'page/<view>' => 'site/page',

	            'sitemap' => 'sitemap/index',
	            'sitemap.xml' => 'sitemap/xml',

	            'error' => 'site/error',

	            '<c:[\w\-]+>' => '<c>/index',
            ],
        ],
    ],
    'params' => $params,
];
