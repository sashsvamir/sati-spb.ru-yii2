<?php
namespace frontend\controllers;

use common\models\Search;
use Yii;
use yii\web\Controller;
use common\models\Item;


/**
 * Search controller
 */
class SearchController extends Controller
{
	public function actionIndex()
	{
		$model = new Search([
			'model' => Item::className(),
		]);

		// Если GET запрос
		if ($q = Yii::$app->request->get('query')) {
			$model->parse($q);
		}

		return $this->render('index', [
			'model' => $model,
		]);
	}

}
