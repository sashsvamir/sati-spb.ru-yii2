<?php
namespace common\models;

use yii\db\ActiveRecord;


/**
 * @property int $id
 * @property string $filename
 * @property string $alt
 * @property string $description
 */
class AttachFile extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%attach_file}}';
	}

}