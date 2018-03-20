<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
	    'i18n' => [
		    'translations' => [
			    'vendor*' => [
				    'class' => 'yii\i18n\PhpMessageSource',
				    'sourceLanguage' => 'en-US',
				    'basePath' => '@backend/translates',
				    'fileMap' => [
					    'vendor/voskobovich/yii2-tree-manager/widgets/nestable' => 'yii2-tree-manager.php',
				    ],
			    ],
		    ],
	    ],
	    'assetManager' => [
		    'class' => 'yii\web\AssetManager',
		    'linkAssets' => true,
		    'appendTimestamp' => true,
		    'bundles' => [
			    'yii\web\JqueryAsset' => [
				    'js' => [YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js'], // use minify version
			    ],
		    ],
	    ],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'backend\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
	            '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
	            '<_c:[\w\-]+>' => '<_c>/index',
	            '<_c:[\w\-]+>/<_a:[\w\-]+>/<id:\d+>' => '<_c>/<_a>',
            ],
        ],
    ],
    'params' => $params,
];
