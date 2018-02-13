<?php

$allow_ip = [
	'127.0.0.1',
	// add more ip4 and ip6 here to allow debug mode
];
if (in_array($_SERVER['REMOTE_ADDR'], $allow_ip)) {
	defined('YII_DEBUG') or define('YII_DEBUG', true);
	defined('YII_ENV') or define('YII_ENV', 'dev');
} else {
	// default:
	defined('YII_DEBUG') or define('YII_DEBUG', false);
	defined('YII_ENV') or define('YII_ENV', 'prod');
}

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../../common/config/bootstrap.php';
require __DIR__ . '/../config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../common/config/main.php',
    require __DIR__ . '/../../common/config/main-local.php',
    require __DIR__ . '/../config/main.php',
    require __DIR__ . '/../config/main-local.php'
);

(new yii\web\Application($config))->run();
