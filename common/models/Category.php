<?php
namespace common\models;

use paulzi\nestedsets\NestedSetsBehavior;
use paulzi\nestedsets\NestedSetsQueryTrait;
use yii\db\ActiveRecord;


/**
 * @property int $id
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property string $title
 * @property string $description
 * @property int $visible
 * @property int $image_id
 *
 * @property Item $item
 * @property ImageCategory $image
 *
 * @mixin NestedSetsBehavior
 * @mixin NestedSetsQueryTrait
 */
class Category extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%category}}';
	}

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			NestedSetsBehavior::class,
		];
	}

	/**
	 * NestedSetsBehavior required
	 */
	public function transactions()
	{
		return [
			self::SCENARIO_DEFAULT => self::OP_ALL,
		];
	}

	/**
	 * @inheritdoc
	 */
	public static function find() : CategoryQuery
	{
		return new CategoryQuery(get_called_class());
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getItem()
	{
		return $this->hasOne(Item::class, ['category_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getImage()
	{
		return $this->hasOne(ImageCategory::class, ['id' => 'image_id']);
	}

}
