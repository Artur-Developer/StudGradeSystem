<?php

namespace backend\controllers;


use backend\components\Customs;
use backend\models\Subject;
use Yii;
use backend\models\Themes;
use backend\models\ThemesSearch;
use yii\db\Query;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * ThemesController implements the CRUD actions for Themes model.
 */
class ThemesController extends Controller
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
        $searchModel = new ThemesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionSelectTheme($q = null,$subject=null)
    {
        $query = new Query();

        $query->select('name_theme')
            ->addSelect('id')
            ->from('themes')
            ->where(['subject_id'=>$subject])
            ->andWhere('name_theme LIKE "' . $q .'%"')
            ->orderBy('name_theme');
        $command = $query->createCommand();
        $data = $command->queryAll();
        $out = [];
        foreach ($data as $d) {
            $out[] = ['value' => $d['id'] . '_' . $d['name_theme']];
        }
        echo Json::encode($out);
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Themes();
        $getSubject = Customs::GetListSubjectUserId();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->_save() && $model->save()) {
                return $this->redirect(['index', 'model' => $model]);
            }
        }
         else {
            return $this->render('create', [
                'model' => $model,
                'getSubject' => $getSubject,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $getSubject = Customs::GetListSubjectUserId();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            if(Yii::$app->request->isAjax){
                return $this->render('_form', [
                    'model' => $model,
                    'getSubject' => $getSubject,
                ]);

            }
            else{
                return $this->render('update', [
                    'model' => $model,
                    'getSubject' => $getSubject,
                ]);
            }

        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Themes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
