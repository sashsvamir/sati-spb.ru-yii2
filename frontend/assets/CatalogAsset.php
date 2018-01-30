<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Catalog asset bundle.
 */
class CatalogAsset extends AssetBundle
{
	public $sourcePath = '@frontend/assets/dist';

	public $css = [
        'catalog.css',
        'menu.css',
    ];
    public $js = [
    	'catalog.min.js'
    ];
    public $depends = [
	    'yii\web\JqueryAsset',
	    'frontend\assets\AppAsset',
    ];
}
