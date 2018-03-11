<?php
namespace common\models;

use yii\db\ActiveRecord;


/**
 * @property int $id
 * @property string $title
 *
 * @property AttachFile[] $files
 */
class Attach extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%attach}}';
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getFiles()
	{
		return $this->hasMany(AttachFile::class, ['attach_id' => 'id']);
	}


}