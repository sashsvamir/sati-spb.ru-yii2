<?php
namespace common\models;

use yii\db\ActiveRecord;


class UrlOld extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%item_url_old}}';
	}

}