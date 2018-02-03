<?php
namespace common\widgets\ItemSlider;

use yii\base\Widget;
use common\models\Item;


/**
 *	Widget to render slider items
 */
class ItemSlider extends Widget
{
	/** @var array */
	public $htmlOptions = [];

	/**
	 * @inheritdoc
	 */
	public function run()
	{
		$model = Item::find()->visible()->orderBy('priority ASC')->all();

		if ($model === null) {
			return false;
		}

		return $this->render('index', [
			'model' => $model,
			'htmlOptions' => $this->htmlOptions,
		]);
	}

}
