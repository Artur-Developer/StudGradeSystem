<?php

namespace backend\controllers;

use backend\components\Customs;
use backend\models\RatingGroup;
use common\models\UpdateStudentInfo;
use common\models\userForm\UpdateUserInfo;
use Yii;
use backend\models\Students;
use backend\models\AllGroup;
use backend\models\StudentsSearch;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;

class StudentsController extends Controller
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

        $searchModel = new StudentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $data = new Students();

        $posts  = Students::find()->orderBy('id DESC');
        $pages = new Pagination(['totalCount'=> $posts->count(), 'pageSize'=> 20,
            'pageSizeParam' =>  false, 'forcePageParam' => false]);
        $allStudent  = $posts->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'data' => $data,
            'allStudent' => $allStudent,
            'pages' => $pages,
        ]);
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionSend(){
        return Yii::$app->mailer->compose()
            ->setFrom('123@mail.ru')
            ->setTo('Artur.Developer@yandex.ru')
            ->setSubject('Активация аккаунта')
            ->setTextBody('Здраствуйте! Вы были зарегистрированы в студенческой системе. Для активации аккаунта, перейти пожалуйста по ссылке, на странице, которой будет отображена информация о вас. ')
            ->setHtmlBody('<a href="http://studgradesystem.com/frontend/web/student/activate-password?token='. '#rfdrgtdhdthtdhtd' .'>http://studgradesystem.com/backend/web/students/activate-password</a>')
            ->send();
    }
    public function actionCreate()
    {
        $model = new Students();
        $GetAllGroup = Customs::GetListAllGroup();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->create()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'GetAllGroup' => $GetAllGroup,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = new UpdateStudentInfo($this->findModel($id));
        $GetAllGroup = Customs::GetListAllGroup();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->update()) {
                return $this->redirect(['view', 'id' => $id,
                    'GetAllGroup' => $GetAllGroup]);
            }
        }
        return $this->render('update', [
            'model' => $model,
            'GetAllGroup' => $GetAllGroup,
        ]);
    }




    protected function findModel($id)
    {
        if (($model = Students::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
