<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Item;
use common\models\Category;
use yii\web\Response;


/**
 * todo: add pages, main page to links (сделать стр. Приводная техника пунктом меню Главная, переименовать главная в "приводн техн", см. страницу где url=default)
 * Sitemap controller
 */
class SitemapController extends Controller
{

	/**
	 * todo: add Pages, all Items and categories
	 * render /sitemap
	 */
	public function actionIndex()
	{
		$model = Item::find()->select(['item.header', 'item.url', 'item.meta_title', 'img.menu_title', 'item.category_id'])
			->leftJoin('img', 'img.item_id = item.id')
			->orderBy('item.visible DESC')
			->addOrderBy('item.priority')
			->where('item.url <> ""')
			->where('item.url IS NOT NULL')
			->asArray()
			->all();

		return $this->render('sitemap', [
			'model' => $model,
		]);
	}

	/**
	 * todo: add Pages, all Items and categories
	 * render /sitemap.xml
	 */
	public function actionXml()
	{
		$cacheName = 'sitemap-xml';

		// проверяем есть ли закэшированная версия sitemap
		if (!$xml = Yii::$app->cache->get($cacheName)) {

			$model = Category::find()->select(['category.id', 'category.lft', 'item.url', 'item.updated'])
				->leftJoin('item', 'item.category_id = category.id')
				->where(['category.visible' => 1])
				->orderBy('category.lft')
				->asArray()
				->all();

			$xml = $this->renderPartial('sitemap_xml', [
				'model' => $model,
			]);

			// кэшируем результат
			Yii::$app->cache->set($cacheName, $xml, 60*5);
		}

		Yii::$app->response->format = Response::FORMAT_XML;
		echo $xml;
	}


}
