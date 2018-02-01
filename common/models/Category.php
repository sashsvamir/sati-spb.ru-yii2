<?php
namespace common\models;

use paulzi\nestedsets\NestedSetsBehavior;
use yii\db\ActiveRecord;


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
			NestedSetsBehavior::className(),
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
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['title', 'required'],
			['visible', 'numerical', 'integer' => true],
			['description', 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'title'      => 'Название',
			'visible'    => 'Видимый',
			'description'=> 'Описание',
		];
	}

	// 'item_category' => [self::HAS_ONE, 'ItemCategory', 'category_id'],
	// public function getItem() {
	// 	return $this->hasOne('ItemCategory', ['category_id']);
	// }

	// 'item'          => [self::HAS_ONE, 'Item', 'item_id', 'through' =>'item_category'],
	// public function getItemCategory() {
	// 	return $this->hasOne('Item', ['item_id']);
	// }

	// 'category_image' => [self::HAS_ONE, 'CategoryImage', 'category_id'],
	// public function getCategoryImage() {
	// 	return $this->hasOne('CategoryImage', ['category_id']);
	// }

	// 'image'          => [self::HAS_ONE, 'Image', 'image_id', 'through' =>'category_image'],
	// public function getImage() {
	// 	return $this->hasOne('Image', ['image_id']);
	// }

	/**
	 * @inheritdoc
	 */
	/*public function afterSave($insert, $changedAttributes)
	{
		parent::afterSave($insert, $changedAttributes);

		// Сохраняем связь между категорией и страницей
		// если категории присвоили страницу
		if(!empty($_POST['Category']['item']))
		{
			// если связи нет, создадим ее
			if(!$this->item_category){
				$this->item_category = new ItemCategory;
				$this->item_category->category_id = $this->id;
			}
			// сохраним
			$this->item_category->item_id = $_POST['Category']['item'];
			$this->item_category->save();
		}
		else // иначе
		{
			// если есть связь, удалим ее
			if($this->item_category)
				$this->item_category->delete();
		}

	}*/

	/**
	 * @inheritdoc
	 */
	/*public function afterDelete()
	{
		parent::afterDelete();

		// если есть связь с картинкой, удалим связь
		if ($this->category_image) {
			$this->category_image->delete();
		}

		// если есть связь со страницей, удалим связь
		if ($this->item_category) {
			$this->item_category->delete();
		}
	}*/

}
