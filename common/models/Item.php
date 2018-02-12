<?php
namespace common\models;

use yii\db\ActiveRecord;


/**
 * @property int $id
 * @property string $header
 * @property string $lider
 * @property string $body
 * @property string $body_purified
 * @property string $url
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $sitemap_title
 * @property int $visible
 * @property int $category_id
 * @property int $image_id
 * @property int $attach_id
 * @property int $priority
 * @property int $updated
 *
 * @property UrlOld $urlOld
 * @property Category $category
 * @property Attach $attach
 * @property ImageItem $image
 */
class Item extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%item}}';
	}

	/**
	 * @inheritdoc
	 */
	public static function find() : ItemQuery
	{
		return new ItemQuery(get_called_class());
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUrlOld()
	{
		return $this->hasOne(UrlOld::className(), ['item_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCategory()
	{
		return $this->hasOne(Category::className(), ['id' => 'category_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getAttach()
	{
		return $this->hasOne(Attach::className(), ['id' => 'attach_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getImage()
	{
		return $this->hasOne(ImageItem::className(), ['id' => 'image_id']);
	}


}