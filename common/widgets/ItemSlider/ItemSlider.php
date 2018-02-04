<?php
namespace common\widgets\ItemSlider;

use Yii;
use yii\base\Widget;
use common\models\Item;


/**
 *	Widget to render slider items
 */
class ItemSlider extends Widget
{
	/** @var string */
	public $cacheName = 'item-slider-cache';

	/** @var array */
	public $htmlOptions = [];

	/**
	 * @inheritdoc
	 */
	public function run()
	{
		$model = Yii::$app->cache->getOrSet($this->cacheName, function () {
			return Item::find()->visible()->with('image')->orderBy('priority ASC')->all();
		}, Yii::$app->params['cacheTime']);

		return $this->render('index', [
			'model' => $model,
			'htmlOptions' => $this->htmlOptions,
		]);
	}

}
