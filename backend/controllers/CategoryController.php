<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\base\ErrorException;
use yii\web\NotFoundHttpException;
use backend\models\Category;


class CategoryController extends Controller
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
     * @inheritdoc
     */
	public function actions()
	{
		$modelClass = 'backend\models\Category';

		return [
			'moveNode' => [
				'class' => 'voskobovich\tree\manager\actions\MoveNodeAction',
				'modelClass' => $modelClass,
			],
			'deleteNode' => [
				'class' => 'voskobovich\tree\manager\actions\DeleteNodeAction',
				'modelClass' => $modelClass,
			],
			'updateNode' => [
				'class' => 'voskobovich\tree\manager\actions\UpdateNodeAction',
				'modelClass' => $modelClass,
				'nameAttribute' => 'title',
			],
			'createNode' => [
				'class' => 'voskobovich\tree\manager\actions\CreateNodeAction',
				'modelClass' => $modelClass,
			],
		];
	}

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @return string
     */
    public function actionUpdate(int $id)
    {
    	$model = $this->findModel($id);
	    $request = Yii::$app->request;

	    if ($model->load($request->post())) {

		    $transaction = Yii::$app->db->beginTransaction();
		    try {
			    if ($model->update() !== false) {
				    $transaction->commit();
				    Yii::$app->session->setFlash('success', 'Категория сохранена.');
				    return $this->redirect(['update', 'id' => $model->id]);
			    }

			    Yii::$app->session->setFlash('danger', 'Необходимо исправить ошибки в форме.');
		    } catch (ErrorException $e) {
			    $transaction->rollBack();
			    throw new $e;
		    }
	    }

        return $this->render('update', [
        	'model' => $model,
        ]);
    }

	/**
	 * @throws NotFoundHttpException
	 */
	protected function findModel(int $id) : Category
	{
		if (($model = Category::findOne(['id' => $id])) !== null) {
			return $model;
		}
		throw new NotFoundHttpException('The requested page does not exist.');
	}

}
