<?php
namespace backend\models;


use yii\helpers\FileHelper;
use yii\web\UploadedFile;


class AttachFile extends \common\models\AttachFile
{
	/**
	 * @var UploadedFile uploading file
	 */
	public $file;

	/**
	 * @var int
	 */
	public $maxFileSize = 5000*1024; // 5MB or 5000KB

	/**
	 * scenarios
	 */
	const SCENARIO_INSERT = 'insert';
	const SCENARIO_UPDATE = 'update';

	/*public function scenarios()
	{
		$scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_INSERT] = ['file'];
        $scenarios[self::SCENARIO_UPDATE] = ['title', 'description'];
        return $scenarios;
	}*/

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['file'], 'file', 'maxSize' => $this->maxFileSize, 'skipOnEmpty' => false, 'on' => self::SCENARIO_INSERT],
			[['attach_id'], 'exist', 'targetClass' => Attach::class, 'targetAttribute' => 'id', 'on' => self::SCENARIO_INSERT],
			[['filename'], 'validateFilenameUnique', 'on' => self::SCENARIO_INSERT],

			[['alt', 'description'], 'string', 'max' => 255],

			// todo: check model with same attach_id for unique filename attribute
		];
	}

	/**
	 * Validate for filename is unique in current parent attach scope
	 */
	public function validateFilenameUnique($attribute, $params, $validator)
	{
		$exist = Attach::find()
			->leftJoin('attach_file', 'attach_file.attach_id = attach.id')
			->where(['attach.id' => $this->attach_id])
			->andWhere(['attach_file.filename' => $this->$attribute])
			->exists();

		if ($exist) {
			$this->addError($attribute, 'File with same name already exist.');
		}
	}

	/**
	 * @inheritdoc
	 */
	public function beforeValidate()
	{
		$isValid = parent::beforeValidate();

		// set filename if file uploading
		if ($this->scenario === self::SCENARIO_INSERT && $this->file instanceof UploadedFile) {
			$this->filename = $this->file->baseName . '.' . $this->file->extension;
		}

		return $isValid;
	}

	/**
	 * @inheritdoc
	 */
	public function afterDelete()
	{
		parent::afterDelete();

		@unlink($this->getDirAbsolute() . $this->filename);
		@rmdir($this->getDirAbsolute());
	}

	/**
	 * Uploading file
	 */
	public function upload() : bool
	{
		// create dir if needed
		FileHelper::createDirectory($this->getDirAbsolute());

		$this->file->saveAs($this->getDirAbsolute() . $this->file->baseName . '.' . $this->file->extension);
		return true;
	}

}