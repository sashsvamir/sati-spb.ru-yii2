<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\base\InvalidConfigException;


/**
 * @property int $id
 * @property string $filename
 * @property string $alt
 * @property string $title
 *
 * @property Category $category
 * @property Item $item
 */
class Image extends ActiveRecord
{
	/** @var string path to uploading images */
	public $filepath = null;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%image}}';
	}

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		if ($this->filepath === null) {
			throw new InvalidConfigException('You must extend Image class and set "filepath" property before using this class.');
		}
	}

	/**
	 *	Берем относительный путь до директории хранения картинок
	 */
	public function getFilePathRelative()
	{
		return $this->filepath;
	}

}
