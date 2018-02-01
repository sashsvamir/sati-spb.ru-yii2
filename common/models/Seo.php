<?php
namespace common\models;

use yii\db\ActiveRecord;


class Seo extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%seo}}';
	}

}