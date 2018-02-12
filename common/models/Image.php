<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\base\InvalidConfigException;
use Yii;


/**
 * @property int $id
 * @property string $filename
 * @property string $alt
 * @property string $title
 */
class Image extends ActiveRecord
{
	/** @var string path to uploading images (with slash at begin and end) */
	public $dirPath;

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

		if ($this->dirPath === null) {
			throw new InvalidConfigException('You must extend Image class and set "dirPath" property before using this class.');
		}
	}

	/**
	 *	Берем точный путь до директории хранения файлов
	 */
	public function getDirAbsolute()
	{
		return Yii::getAlias('@webroot') . $this->dirPath;
	}

	/**
	 *	Берем относительный путь до директории хранения картинок
	 */
	public function getDirRelative()
	{
		return Yii::getAlias('@web') . $this->dirPath;
	}

	/**
	 *	Берем url картинки
	 */
	public function getUrl() : ?string
	{
		if (!$this->isNewRecord) {
			return $this->getDirRelative() . $this->filename;
		}
		return null;
	}

}
