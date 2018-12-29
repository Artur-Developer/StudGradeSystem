<?php

namespace backend\controllers;

use backend\components\Customs;
use Yii;
use backend\models\Testing;
use backend\models\TestingSearch;
use yii\db\Query;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

class TestingController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['Prepod','Firste_admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new TestingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Testing();
        $getSubject = $getSubject = Customs::GetListSubjectUserId();

        if ($model->load(Yii::$app->request->post()) ) {
            if ($model->_save() && $model->save()) {
                return $this->redirect(['update', 'id' => $model->id]);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
                'getSubject' => $getSubject,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $getSubject = $getSubject = Customs::GetListSubjectUserId();
        $all_question = ArrayHelper::map(\backend\models\Questions::find()->where(['subject_id'=>$model->subject_id])->all(),'id','name_question');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'getSubject' => $getSubject,
                'all_question' => $all_question,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Testing::find()->with('questions')->andWhere(['id'=>$id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
