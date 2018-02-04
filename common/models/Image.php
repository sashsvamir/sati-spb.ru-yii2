<?php
namespace common\models;

use yii\db\ActiveRecord;


/**
 * // todo: make Image as behavior for Category and Item. Also this behavior should be store parent filepath to uploading images
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
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%image}}';
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCategory()
	{
		return $this->hasOne(Category::className(), ['image_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getItem()
	{
		return $this->hasOne(Item::className(), ['image_id' => 'id']);
	}

	/**
	 *	Берем относительный путь до директории хранения картинок
	 */
	public function getFilePathRelative($relationModel = null)
	{
		if($relationModel === 'Category' || $this->category) {
			$filepath = '/../img/category/';
		} elseif($relationModel === 'Item' || $this->item) {
			$filepath = '/../img/item/';
		} else {
			$filepath = '/../upload/';
		}

		return $filepath;
	}

}