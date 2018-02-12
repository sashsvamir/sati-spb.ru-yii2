<?php
namespace backend\controllers;

use Yii;
use yii\base\ErrorException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use backend\models\Attach;
use backend\models\AttachSearch;


class AttachController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            // 'verbs' => [
            //     'class' => VerbFilter::className(),
            //     'actions' => [
            //         'logout' => ['post'],
            //     ],
            // ],
        ];
    }

    /**
     * List models
     */
    public function actionIndex()
    {
	    $searchModel = new AttachSearch();
	    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
	        'searchModel' => $searchModel,
	        'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Create or Update model
     */
    public function actionUpdate(?int $id = null)
    {
	    $model = isset($id) ? $this->findModel($id) : new Attach();

	    if ($model->load(Yii::$app->request->post())) {

		    $transaction = Yii::$app->db->beginTransaction();
		    try {
			    if ($model->save()) {
				    $transaction->commit();
				    Yii::$app->session->setFlash('success', 'Вложение сохранено.');
				    return $this->redirect(['update', 'id' => $model->id]);
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
	 * Delete model
	 */
    public function actionDelete(int $id)
    {
	    $model = $this->findModel($id);

	    $transaction = Yii::$app->db->beginTransaction();
	    try {
		    if ($model->delete() !== false) {
			    $transaction->commit();
		        Yii::$app->session->addFlash('success', 'Вложение удалено.');
		    } else {
	            Yii::$app->session->addFlash('success', 'Произошла неизвестная ошибка.');
		    }
	    } catch (ErrorException $e) {
		    $transaction->rollBack();
		    throw new $e;
	    }

	    return $this->redirect(['index']);
    }

	/**
	 * @throws NotFoundHttpException
	 */
	protected function findModel(int $id) : Attach
	{
		if (($model = Attach::findOne($id)) !== null) {
			return $model;
		}
		throw new NotFoundHttpException('The requested page does not exist.');
	}
}
