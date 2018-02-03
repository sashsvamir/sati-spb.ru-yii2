<?php
namespace frontend\controllers;

use yii\web\Controller;
use yii\web\ViewAction;


/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'page' => [
	        	'class' => ViewAction::className(),
		        'viewPrefix' => 'page',
	        ],
        ];
    }

}
