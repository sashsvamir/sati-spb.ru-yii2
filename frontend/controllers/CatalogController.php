<?php
namespace frontend\controllers;

use yii\web\Controller;

/**
 * Catalog controller
 */
class CatalogController extends Controller
{

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
