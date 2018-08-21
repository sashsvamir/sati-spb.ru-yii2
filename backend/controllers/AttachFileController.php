<?php
namespace backend\controllers;

use Yii;
use yii\base\ErrorException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use backend\models\AttachFile;
use yii\web\UploadedFile;


class AttachFileController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            // 'verbs' => [
            //     'class' => VerbFilter::class,
            //     'actions' => [
            //         'logout' => ['post'],
            //     ],
            // ],
        ];
    }

	/**
	 * Create model action
	 * @return string
	 */
	public function actionCreate(int $attach_id)
	{
		$model = new AttachFile(['scenario' => AttachFile::SCENARIO_INSERT]);
		$model->attach_id = $attach_id; // set parent id

		if ($model->load(Yii::$app->request->post())) {
			$transaction = Yii::$app->db->beginTransaction();
			try {

				$model->file = UploadedFile::getInstance($model, 'file');
				if ($model->save() && $model->upload()) {
					$transaction->commit();
					Yii::$app->session->setFlash('success', 'Файл сохранен.');
					return $this->redirect(['/attach/update', 'id' => $attach_id]);
				}

				Yii::$app->session->setFlash('danger', 'Необходимо исправить ошибки в форме.');
			} catch (ErrorException $e) {
				$transaction->rollBack();
				throw new $e;
			}
		}

		return $this->render(isset($id) ? 'update' : 'create', [
			'model' => $model,
		]);
	}

    /**
     * Update model action
     * @return string
     */
    public function actionUpdate(int $id)
    {
	    $model = $this->findModel($id);

	    if ($model->load(Yii::$app->request->post())) {

		    if ($model->save()) {
			    Yii::$app->session->setFlash('success', 'Файл сохранен.');
			    return $this->redirect(['/attach/update', 'id' => $model->attach_id]);
		    }

		    Yii::$app->session->setFlash('danger', 'Необходимо исправить ошибки в форме.');
	    }

        return $this->render(isset($id) ? 'update' : 'create', [
        	'model' => $model,
        ]);
    }

	/**
	 * Delete model
	 */
    public function actionDelete(int $id)
    {
    	$model = $this->findModel($id);
    	$model->delete();
	    Yii::$app->session->setFlash('success', 'Файл удален.');
    	return $this->redirect(['/attach/update', 'id' => $model->attach_id]);
    }

	/**
	 * @throws NotFoundHttpException
	 */
	protected function findModel(int $id) : AttachFile
	{
		if (($model = AttachFile::findOne(['id' => $id])) !== null) {
			return $model;
		}
		throw new NotFoundHttpException('The requested page does not exist.');
	}
}
