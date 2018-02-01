<?php
namespace common\models;

use yii\db\ActiveRecord;


class Link extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%link}}';
	}

}