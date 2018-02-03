<?php
namespace common\widgets\CategoryTree;

use frontend\assets\ColumnizerAsset\ColumnizerAsset;
use Yii;
use yii\base\Widget;
use common\models\Category;
use common\models\Item;


class CategoryTree extends Widget
{
	/** @var string name of rendered view */
	public $view = 'index';

	/** @var array html tag options */
	public $htmlOptions = [];

	/**
	 * @inheritdoc
	 */
	public function run()
	{
		// todo: сделать кэширование

		$model = Category::find()->visible()->orderBy('lft')->all();

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