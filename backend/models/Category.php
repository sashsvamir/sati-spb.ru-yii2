<?php
namespace backend\models;


class Category extends \common\models\Category
{
	/**
	 * virtual attribute to save related Item
	 * @var int item id
	 */
	public $itemId;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['title'], 'required'],
			[['title', 'description'], 'string', 'max' => 255],
			[['visible'], 'boolean'],

			[['itemId'], 'exist', 'targetClass' => Item::class, 'targetAttribute' => 'id'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'image' => 'Картинка',
			'itemId' => 'Страница',
		];
	}

	/**
	 * @inheritdoc
	 */
	public function afterFind()
	{
		parent::afterFind();

		// set virtual attribute of item id
		if ($this->itemId === null) {
			$this->itemId = $this->item ? $this->item->id : null;
		}
	}

	/**
	 * @inheritdoc
	 */
	public function afterSave($insert, $changedAttributes)
	{
		parent::afterSave($insert, $changedAttributes);

		// set link to related Item model (or unlink if id not passed)
		$this->unlinkAll('item');
		if ($this->itemId) {
			$item = Item::findOne($this->itemId);
			$this->link('item', $item);
		}
	}

}