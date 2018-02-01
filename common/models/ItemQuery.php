<?php
namespace common\models;

use yii\db\ActiveQuery;


/**
 * @method Item[]|array all()
 * @method Item|array|null one()
 */
class ItemQuery extends ActiveQuery
{
	/**
	 * @inheritdoc
	 */
	/*public function visible()
	{
		return $this->andWhere([Item::tableName() . '.visible' => 1]);
	}

	public function attached()
	{
		return $this->with('category')->andWhere([Category::tableName() . '.id' => 'IS NOT NULL']);
	}

	public function noattached()
	{
		return $this->with('category')->andWhere([Category::tableName() . '.id' => 'IS NULL']);
	}*/

}
