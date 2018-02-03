<?php
namespace common\models;

use yii\db\ActiveQuery;
use paulzi\nestedsets\NestedSetsQueryTrait;


/**
 * @method Category[]|array all()
 * @method Category|array|null one()
 */
class CategoryQuery extends ActiveQuery
{
	// NestedSet Trait
	use NestedSetsQueryTrait;

	public function visible()
	{
		return $this->andWhere([Category::tableName() . '.visible' => 1]);
	}

}
