<?php

namespace backend\controllers;

use backend\components\GetUserInfo;
use Yii;
use backend\models\Postbackend;
use backend\models\PostbackendSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;


class PostbackendController extends Controller
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
        $searchModel = new PostbackendSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionAllpost()
    {
        $posts  = Postbackend::find()->select('id, title, text, date, user_id')->where(['not',['how_send'=>2]])->orderBy('id DESC');
        $pages = new Pagination(['totalCount'=> $posts->count(), 'pageSize'=> 3,
            'pageSizeParam' =>  false, 'forcePageParam' => false]);
        $allPost2  = $posts->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('allpost', compact('allPost2', 'pages'));
    }



    public function actionView($id)
    {

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionViewpost($id)
    {
        return $this->render('viewpost', [
            'model' => $this->findModel($id)]);
    }


    public function actionCreate()
    {
        $model = new Postbackend();
        $user_full_name = new GetUserInfo();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            $model->date = date('Y-m-d H:i:s');
        }
        if ($model->validate() && $model->save()) {
            return $this->redirect(['index', 'model' => $model]);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
    	if($this->findModel($id)->user_id == Yii::$app->user->id || Yii::$app->user->can('Firste_admin'))
        {
        	if($this->findModel($id)->delete()){
        		return $this->redirect(['index']);
        	}
        }
        else{
        	throw new ForbiddenHttpException("У вас нет прав на редактирования этой записи");
        }

        
    }

    protected function findModel($id)
    {
        if (($model = Postbackend::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function findAll()
    {
            $allPost = Postbackend::find()->select('id, title, text, date, user_id')->all();
            return $allPost;
    }
    protected function findMAll()
    {
        if (($model2 = Postbackend::find()->all()) !== null) {

            return $model2;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function ogranichenia($id,$whot)
    {
        $model = $this->findModel($id);
        if (!Yii::$app->user->can('updateOwnGroup',['group_id'=>$model])) {
            if (!Yii::$app->user->isGuest &&
                Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())
                ['Firste_admin']->name == 'Firste_admin') {
                return $this->render("$whot", [
                    'model' => $model,
                ]);
            }
            throw new ForbiddenHttpException("У вас нет прав на редактирования этой статьи");
        }
    }
}
