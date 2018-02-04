<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use common\models\Item;


/**
 * Catalog controller
 */
class CatalogController extends Controller
{
	/** @var Item */
	public $current_item;

    /**
     * @return mixed
     */
    public function actionIndex()
    {
	    $model = $this->findModel('index');

	    $this->current_item = $model;

	    return $this->render('index', [
		    'model' => $model,
	    ]);
    }

	/**
     * @return mixed
	 */
    public function actionView($url)
    {
    	if ($url === 'index') {
		    $this->action->id = 'index'; // change action id
    		return $this->actionIndex();
	    }

    	// проверим надо ли делать редирект со старого адреса
	    if ($redirect = $this->redirectOldLink()) {
	    	return $redirect;
	    }

	    $model = $this->findModel($url);

	    $this->current_item = $model;

	    return $this->render('view', array(
		    'model' => $model,
	    ));
    }

	/**
	 * если в адресе присутствует main.php (старая ссылка),
	 * вызвать 301 редирект для перенаправления на новую версию
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function redirectOldLink() : ?Response
	{
		$request = Yii::$app->request;

		if ($request->get('url') === 'main.php' && $b = $request->get('b')) {
			$model = $this->findModelOld($b);

			return $this->redirect(['catalog/view', 'url' => $model->url], 301);
		}

		return null;
	}

	/**
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel(string $url) : Item
	{
		if (($model = Item::findOne(['url' => $url])) !== null) {
			return $model;
		}
		throw new NotFoundHttpException('The requested page does not exist.');
	}

	/**
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModelOld(string $url_old) : Item
	{
		$model = Item::find()->leftJoin('item_url_old', 'item_url_old.item_id = item.id')->where(['item_url_old.url' => $url_old])->one();

		if ($model !== null) {
			return $model;
		}
		throw new NotFoundHttpException('The requested page does not exist.');
	}

}
