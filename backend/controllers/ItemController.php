<?php
namespace backend\controllers;

use Yii;
use yii\base\ErrorException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use backend\models\Item;
use backend\models\ItemSearch;


class ItemController extends Controller
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
     * @return string
     */
    public function actionIndex()
    {
	    $searchModel = new ItemSearch();
	    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
	        'searchModel' => $searchModel,
	        'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Create or Update model action
     * @return string
     */
    public function actionUpdate(?int $id = null)
    {
	    $model = isset($id) ? $this->findModel($id) : new Item();

	    if ($model->load(Yii::$app->request->post())) {

		    $transaction = Yii::$app->db->beginTransaction();
		    try {
			    if ($model->save()) {
				    $transaction->commit();
				    Yii::$app->session->setFlash('success', 'Страница сохранена.');
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
	 * @throws NotFoundHttpException
	 */
	protected function findModel(int $id) : Item
	{
		if (($model = Item::findOne(['id' => $id])) !== null) {
			return $model;
		}
		throw new NotFoundHttpException('The requested page does not exist.');
	}
}
