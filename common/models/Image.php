<?php
namespace common\models;

use yii\db\ActiveRecord;


class Image extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%image}}';
	}

}