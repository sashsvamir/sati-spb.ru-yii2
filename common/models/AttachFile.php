<?php
namespace common\models;

use yii\db\ActiveRecord;
use Yii;


/**
 * @property int $id
 * @property string $filename
 * @property string $alt
 * @property string $description
 * @property int $attach_id
 */
class AttachFile extends ActiveRecord
{
	/** @var string path to uploading images (with slash at end) */
	public $dirPath = '/download/';

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%attach_file}}';
	}

	/**
	 *	Берем точный путь до директории хранения файлов
	 */
	public function getDirAbsolute()
	{
		return Yii::getAlias('@webroot'). $this->dirPath . $this->attach_id . '/';
	}

	/**
	 *	Берем относительный путь до директории хранения файлов
	 */
	public function getDirRelative()
	{
		return Yii::getAlias('@web') . $this->dirPath . $this->attach_id . '/';
	}

	/**
	 *	Берем url файла
	 */
	public function getUrl() : ?string
	{
		if (!$this->isNewRecord) {
			return $this->getDirRelative() . $this->filename;
		}
		return null;
	}

}