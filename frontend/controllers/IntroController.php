<?php
namespace frontend\controllers;

use yii\web\Controller;

/**
 * Intro controller
 */
class IntroController extends Controller
{
	public $layout = '_intro';

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
    	return $this->render('index');
    }

}
