<?php
namespace common\widgets\ItemAttach;

use yii\base\InvalidConfigException;
use yii\base\Widget;
use common\models\Attach;


class ItemAttach extends Widget
{
	/**
	 * @var Attach
	 */
	public $attach;

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		if (!isset($this->attach)) {
			return;
		}

		if (!$this->attach instanceof Attach) {
			throw new InvalidConfigException('attach must be Model extended from Attach model');
		}
	}

	/**
	 * @inheritdoc
	 */
	public function run()
	{
		return $this->render('index', [
			'model' => $this->attach,
		]);
	}

}