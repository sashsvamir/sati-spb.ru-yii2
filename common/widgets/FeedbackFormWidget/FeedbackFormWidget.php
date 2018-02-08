<?php
namespace common\widgets\FeedbackFormWidget;

use yii\base\Widget;
use yii\base\InvalidConfigException;
use yii\helpers\Html;


/**
 * FeedbackFormWidget
 */
class FeedbackFormWidget extends Widget
{
	/**
	 * @var string
	 */
	public $offsetTarget = '#nav';
	/**
	 * @var string url of requested feedback page for production mode
	 */
	public $urlProd;

	/**
	 * @var string url of requested feedback page for dev mode
	 */
	public $urlDev;

	/**
	 * @var string referer get param append to url of requested feedback page
	 */
	public $referer;

	/**
	 * @var string class name of wrapper
	 */
	public $className = 'modal-feedback-control';

	/** @var null */
	private $url;

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		if ($this->urlProd === null && $this->urlDev === null) {
			throw new InvalidConfigException('You must set either one or both "urlProd" or "urlDev" properties.');
		}

		if ($this->urlDev !== null && (YII_DEBUG || YII_ENV_DEV || YII_ENV_TEST)) {
			$this->url = $this->urlDev;
		} else {
			$this->url = $this->urlProd !== null ? $this->urlProd : $this->urlDev;
		}

		if ($this->referer !== null) {
			$this->url .= '?referer=' . $this->referer;
		}
	}

	/**
	 * @inheritdoc
	 */
	public function run()
	{
		$this->getView()->registerAssetBundle(FeedbackFormAsset::className());

		$result = Html::tag('span', 'Запрос', ['class' => 'button']);
		$result = Html::tag('div', $result, [
			'id' => 'feedback-form-widget',
			'class' => $this->className,
			'data-offset-target' => $this->offsetTarget,
			'data-url' => $this->url,
		]); // wrapper

		echo $result;
	}

}
