<?php
namespace backend\models;


use yii\behaviors\TimestampBehavior;


class Item extends \common\models\Item
{
	/**
	 * virtual attribute to save value in related urlOld
	 * @var string urlOld
	 */
	public $urlOldValue;

	public function behaviors()
	{
		return [
			[
				'class' => TimestampBehavior::className(),
				'createdAtAttribute' => false,
				'updatedAtAttribute' => 'updated',
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['header'], 'required'],
			[['header', 'lider', 'meta_title', 'meta_description', 'meta_keywords'], 'string', 'max' => 255],
			[['body'], 'string'],
			[['url', 'urlOldValue'], 'match', 'pattern' => '/^[a-z0-9_\-]*$/i'],
			[['url', 'urlOldValue'], 'string', 'max' => 255],
			[['url'], 'unique'],
			[['visible'], 'boolean'],
			[['priority'], 'integer'],

			[['category_id'], 'exist', 'targetClass' => Category::className(), 'targetAttribute' => 'id'],
			[['attach_id'], 'exist', 'targetClass' => Attach::className(), 'targetAttribute' => 'id'],
			// [['image_id'], 'exist', 'targetClass' => Image::className(), 'targetAttribute' => 'id'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'category_id' => 'Категория',
			'image' => 'Картинка',
			'attach_id' => 'Вложение',
			'urlOldId' => 'Url (old)',
		];
	}

	/**
	 * @inheritdoc
	 */
	public function afterFind()
	{
		parent::afterFind();

		// set virtual attribute of urlOld id
		if (!isset($this->urlOldValue)) {
			$this->urlOldValue = $this->urlOld ? $this->urlOld->url : null;
		}
	}

	/**
	 * @inheritdoc
	 */
	public function afterSave($insert, $changedAttributes)
	{
		parent::afterSave($insert, $changedAttributes);

		// create/update related record of old url
		if ($this->urlOldValue) {
			if (!$oldUrl = $this->urlOld) {
				$oldUrl = new UrlOld();
				$this->link('urlOld', $oldUrl);
			}
			$oldUrl->url = $this->urlOldValue;
			$oldUrl->save();
		} else {
			$this->unlinkAll('urlOld', true);
		}
	}

}