<?php

namespace backend\controllers;

use backend\models\UserSubject;
use mdm\admin\models\User;
use Yii;
use backend\models\Subject;
use backend\models\SubjectSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;


class SubjectController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['Firste_admin'],
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
        $searchModel = new SubjectSearch();
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
            'getTeacherForSubject' => UserSubject::getTeacherForSubject($id),
        ]);
    }


    public function actionCreate()
    {
        $model = new Subject();

            if ($model->load(Yii::$app->request->post())) {
                $model->create_data = date('Y-m-d H:i:s');
            }
            if ($model->validate() && $model->save()) {
                return $this->redirect(['update','id'=>$model->id, 'model' => $this->findModel($model->id)]);
            }
         else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $prepods2 = ArrayHelper::index(\backend\models\User::find()->select('id')->addSelect('last_name')->addSelect('first_name')->addSelect('middle_name')->all(),
           'id');
        $prepods = ArrayHelper::getColumn($prepods2,
           function ($element) {
            return  $element['last_name'] . ' ' . $element['first_name'] . ' ' . $element['middle_name'];

        });

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'prepods' => $prepods,
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
        if (($model = Subject::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
