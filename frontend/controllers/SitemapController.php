<?php
namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use common\models\Item;


/**
 * Sitemap controller
 */
class SitemapController extends Controller
{
	/** @var string cache name */
	public $cacheName = 'sitemap_cache';

	/**
	 * render /sitemap
	 */
	public function actionIndex()
	{
		return $this->render('sitemap', [
			'model' => $this->getSitemap(),
		]);
	}

	/**
	 * render /sitemap.xml
	 */
	public function actionXml()
	{
		$xml = $this->renderPartial('sitemap_xml', [
			'model' => $this->getSitemap(),
		]);

		if (!headers_sent()) {
			header("Content-type: text/xml; charset=utf-8");
		}
		echo trim($xml);
		exit();
	}

	/**
	 * @return array of all available site's pages
	 */
	private function getSitemap() : array
	{
		// check cached sitemap
		if (!$chunk = Yii::$app->cache->get($this->cacheName)) {
			// get all available pages
			$chunk = array_merge($this->getItems(), $this->getPages());
			// save cache on 15 min
			Yii::$app->cache->set($this->cacheName, $chunk, Yii::$app->params['cacheTime']);
		}
		return $chunk;
	}

	/**
	 * @return array of available categories and items
	 */
	private function getItems() : array
	{
		$model = Item::find()
			->select(['item.header', 'item.url', 'item.visible', 'item.priority', 'item.updated as updated_at', 'category.lft', 'img.menu_title'])
			->leftJoin('img', 'img.item_id = item.id')
			->leftJoin('category', 'category.id = item.category_id')
			->andWhere('item.url <> "" AND item.url IS NOT NULL')
			->orderBy(['IF (category.lft = "" OR category.lft IS NULL, 1, 0), category.lft' => SORT_ASC])
			->addOrderBy('item.visible DESC')
			->addOrderBy(['IF (item.priority = "" OR item.priority IS NULL, 1, 0), item.priority' => SORT_ASC])
			->asArray()
			->all();

		// create urls
		array_walk($model, function (&$arr) {
			$arr['url'] = Url::to(['catalog/view' , 'url' => $arr['url']], true);
		});

		return $model;
	}

	/**
	 * @return array of available another pages
	 */
	private function getPages() : array
	{
		return [
			[
				'header' => 'О компании',
				'url' => Url::to(['site/page', 'view' => 'about'], true),
			],
			[
				'header' => 'Контакты',
				'url' => Url::to(['site/page', 'view' => 'contacts'], true),
			],
			[
				'header' => 'Спец. предложение',
				'url' => Url::to(['site/page', 'view' => 'spec'], true),
			],
			[
				'header' => 'Карта сайта',
				'url' => Url::to(['sitemap/index'], true),
			],

		];
	}


}
