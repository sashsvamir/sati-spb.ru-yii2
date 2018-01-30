<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Intro asset bundle.
 */
class IntroAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/intro.css',
    ];
    public $js = [
    	'js/intro.js'
    ];
    public $depends = [
	    'yii\web\JqueryAsset',
    ];
}
