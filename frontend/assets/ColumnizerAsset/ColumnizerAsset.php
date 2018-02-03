<?php
namespace frontend\assets\ColumnizerAsset;

use yii\web\AssetBundle;


class ColumnizerAsset extends AssetBundle
{
	public $sourcePath = '@frontend/assets/ColumnizerAsset/dist';

    public $js = [
        'jquery.columnizer.min.js',
    ];

    public $depends = [
	    'yii\web\JqueryAsset',
    ];
}
