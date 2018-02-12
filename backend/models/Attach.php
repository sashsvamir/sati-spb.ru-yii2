<?php
namespace backend\models;


use yii\db\ActiveRecord;


class Attach extends \common\models\Attach
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['title'], 'string', 'max' => 255],
		];
	}

	public function afterDelete()
	{
		parent::afterDelete();

		// remove all child attachments
		$models = AttachFile::find()->where(['attach_id' => $this->id])->all();
		foreach ($models as $model) {
			$model->delete();
		}
	}

}
