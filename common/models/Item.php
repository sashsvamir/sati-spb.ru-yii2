<?php
namespace common\models;

use yii\db\ActiveRecord;


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
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['header, body'], 'required'],
			[['visible', 'boolean'], 'strict' => true],
			[['priority', 'numerical'], 'integer'],
			[['priority'], 'length', 'max' => 3],
			[['header, lider, body, visible, info_id'], 'safe'],
		];
	}



	public function getSeo()
	{
		return $this->hasOne(Seo::className(), ['item_id' => 'id']);
	}
	public function getLink()
	{
		return $this->hasOne(Link::className(), ['item_id' => 'id']);
	}
	// public function getImg()
	// {
	// 	return $this->hasOne('img', ['item_id']);
	// }
	// public function getInfo()
	// {
	// 	return $this->hasOne('info', ['item_id']);
	// }
	public function getCategory()
	{
		return $this->hasOne(Category::className(), ['id' => 'item_category.category_id'])
			->viaTable('item_category', ['item_id' => 'id']);
	}
	// public function getImage()
	// {
	// 	return $this->hasOne('image', ['image_id'])
	// 		->viaTable('item_image', ['item_id' => 'id']);
	// }





	public function attributeLabels() {
		return [
			'header'   => 'Header',
			'lider'    => 'Lider',
			'body'     => 'Body',
			'visible'  => 'Visible in Menu',
			'info_id'  => 'Info block Id',
			'priority' => 'Priority Index in menu',
		];
	}





	/**
	 *	After find
	 */
/*	protected function afterFind()
	{
		if(!$this->body_purified && $this->body)
		{
			$this->body_purified = $this->purify($this->body);
			// $this->body_purified = '';
			$this->updateByPk($this->id, array(
				'body_purified' => $this->body_purified,
			));
		}
		parent::afterFind();
	}*/






	/**
	 *	Before save
	 */
	/*protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			// Сохраним текущую дату
			$this->lastmod = time();

			// Сохраняем в таблицу вариант purified (голый текст без тэгов, стилей и тд)
			$this->body_purified = $this->purify($this->body);

			return true;
		}
		else
			return false;
	}*/





	/**
	 *	After save
	 */
	/*public function afterSave()
	{
		parent::afterSave();


		// Сохраняем связь между страницей и категорией

		// если странице присвоили категорию
		if(!empty($_POST['Item']['category']))
		{
			// если связи нет
			if(!$this->item_category){

				// если категории уже присвоена страница, присвоим ей новую страницу
				$category_model = Category::model()->findByPk($_POST['Item']['category']);
				if($category_model->item_category) {
					$category_model->item_category->item_id = $this->id;
					$category_model->item_category->save();
					// присвоим измененную связь текущей странице
					$this->item_category = $category_model->item_category;
				} else {
					// иначе (если у категории нет связи со страницей) создадим связь
					$this->item_category = new ItemCategory;
					$this->item_category->item_id = $this->id;
				}

			}
			// сохраним
			$this->item_category->category_id = $_POST['Item']['category'];
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
	 *	After delete
	 */
	/*public function afterDelete()
	{
		parent::afterDelete();

		// если есть связь с категорией, удалим связь
		if($this->item_category)
			$this->item_category->delete();

		// если есть связь с картинкой, удалим связь
		if($this->item_image)
			$this->item_image->delete();


	}*/







	/**
	 *	Purified: удаляем из текста теги, стили, скрипты и т.д. (оставляя голый текст)
	 */
	/*public function purify($text)
	{
		$p = new CHtmlPurifier;
		$p->options = array(
			'HTML.Allowed'=>'',
		);

		$out = $p->purify($text);
		$out = trim($out);

		$out = preg_replace('/[\n]+/', " ", $out);
		$out = preg_replace('/[ \t]+/', ' ', $out);

		return $out;
	}*/




}