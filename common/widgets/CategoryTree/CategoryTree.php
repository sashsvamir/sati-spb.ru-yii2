<?php
namespace common\widgets\CategoryTree;

use Yii;
use yii\base\Widget;
use frontend\assets\ColumnizerAsset\ColumnizerAsset;
use common\models\Category;
use common\models\Item;


class CategoryTree extends Widget
{
	/** @var string */
	public $cacheName = 'category-tree-cache';

	/** @var string name of rendered view */
	public $view = 'index';

	/** @var array html tag options */
	public $htmlOptions = [];

	/**
	 * @inheritdoc
	 */
	public function run()
	{
		$model = Yii::$app->cache->getOrSet($this->cacheName, function () {
			return Category::find()->visible()->with('image', 'item')->orderBy('lft')->andWhere('category.depth > 1')->all();
		}, Yii::$app->params['cacheTime']);

		Yii::$app->view->registerAssetBundle(ColumnizerAsset::className());

		return $this->render($this->view, [
			'model' => $model,
			'item' => $this->getCurrentItem(),
			'htmlOptions' => $this->htmlOptions,
		]);
	}

	private function getCurrentItem() : ?Item
	{
		return Yii::$app->controller->hasProperty('current_item') ? Yii::$app->controller->current_item : null;
	}

}