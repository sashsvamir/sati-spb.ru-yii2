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
	 * @return $this
	 */
	public function visible()
	{
		return $this->andWhere([Item::tableName() . '.visible' => 1]);
	}

}
