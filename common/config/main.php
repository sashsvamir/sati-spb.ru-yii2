<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],

    'params' => [
    	'phones' => [
    		'+7 (812) 702-70-91',
		    '+7 (812) 702-70-92',
	    ],
	    'feedback' => 'https://intermehanika.ru/feedback',
    ],
];
