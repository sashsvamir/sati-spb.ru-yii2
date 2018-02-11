<?php
namespace common\models;

use yii\db\ActiveRecord;


/**
 * @property int $id
 * @property string $url
 * @property int $item_id
 */
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