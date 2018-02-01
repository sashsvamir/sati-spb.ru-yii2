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

    /**
     * @return mixed
     */
    public function actionIndex()
    {
	    $model = $this->findModel('default');

	    // $this->current_item = $model->id;

	    return $this->render('index', [
		    'model' => $model,
	    ]);
    }

	/**
     * @return mixed
	 */
    public function actionView($url)
    {
    	// проверим надо ли делать редирект со старого адреса
	    if ($redirect = $this->redirectOldLink()) {
	    	return $redirect;
	    }

	    $model = $this->findModel($url);

	    // $this->current_item = $model->id;

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

			return $this->redirect('/catalog/' . $model->link->link, 301);
		}

		return null;
	}

	/**
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel(string $url) : Item
	{
		$model = Item::find()->leftJoin('link', 'link.item_id = item.id')->where(['link.link' => $url])->one();

		if ($model === null) {
			throw new NotFoundHttpException('The requested page does not exist.');
		}

		return $model;
	}

	/**
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModelOld(string $url_old) : Item
	{
		$model = Item::find()->leftJoin('link', 'link.item_id = item.id')->where(['link.link_old' => $url_old])->one();

		if ($model === null) {
			throw new NotFoundHttpException('The requested page does not exist.');
		}

		return $model;
	}

}
