<?php

namespace backend\controllers;

use backend\components\GetUserInfo;
use backend\components\Customs;
use backend\models\AllGroup;
use backend\models\getHasInfo;
use backend\models\Students;
use backend\models\Subject;
use backend\models\UserSubject;
use Yii;
use backend\models\RatingGroup;
use backend\models\RatingData;
use backend\models\Group;
use backend\models\GroupSearch;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;



class GroupController extends Controller
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

        $searchModel = new GroupSearch();

            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $data = new Group();

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'data' => $data,
            ]);
    }

    public function actionRating($id)
    {
        if($this->findModel($id)->user_id == Yii::$app->user->id || Yii::$app->user->can('Firste_admin'))
        {
            $RatingData = new RatingData();
            $rating = new RatingGroup;
            $getGroupDate = $rating->getGroupDate($id);

            if($RatingData->load(Yii::$app->request->post())){
                $transaction = Yii::$app->db->beginTransaction();
                $RatingData->checkDuplicateDate();
                if($RatingData->save()){
                    $modelRating = new RatingGroup();
                    $modelRating->InsertStudentToRatingGroup($this->findModel($id)->group_id,$id);
                    $transaction->commit();
                    return Yii::$app->response->refresh();
                }
                else{
                    $transaction->rollback();
                }
            }


        if(Yii::$app->request->isAjax) {

            $model = new RatingGroup();
            $request = Yii::$app->request;

            ////////////////////////////////////////
            ///// Обновление значений в ячейке
            if($request->post('idRating') && $request->post('value')){
                $idRating = $request->post('idRating');
                $value = $request->post('value');
                $model->UpdateRating($idRating, $value);
            }
            ////////////////////////////////////////
            ///// получение данных при удалении даты
            if($request->post('data_id') && $request->post('DeleteData')) {
                $id_data = $request->post('data_id');
                $RatingData->DropData($id_data);
            }
            ///// получение данных при удалении последней даты
            if($request->post('data_id') && $request->post('dropLastData')) {
                $id_data = $request->post('data_id');
                $RatingData->DropData($id_data);
            }
            /// получение данных при обновлении даты
            if($request->post('value_data') &&
                $request->post('id_data') && $request->post('updateData')
                && $request->post('theme_id')) {
                $id_data = $request->post('id_data');
                $value_data = $request->post('value_data');
                $RatingData->UpdateValueData($value_data, $id_data);
            }
        }

        $date = date('d.m.Y');

        return $this->render('rating',['varRating'=>$rating,
            'model' => $this->findModel($id),
            'RatingData' => $RatingData,
            'getGroupDate' => $getGroupDate,
            'getTableId' => $this->findModel($id),
            'popupDefaultDate' => $date]);
        }
        else{
            Yii::$app->session->setFlash('danger', 'У вас нет прав на редактирования этой группы');
            return $this->actionIndex();
        }
    }

    public function actionView($id)
    {
        if($this->findModel($id)->user_id == Yii::$app->user->id || Yii::$app->user->can('Firste_admin')) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
        else{
            Yii::$app->session->setFlash('danger', 'У вас нет прав на редактирования этой группы');
            return $this->actionIndex();
            }
    }

    public function actionListDate($id)
    {
        $countDate = RatingGroup::find()->where(['subject_group_id'=>$id])->count();
        $date = RatingGroup::find()->where(['subject_group_id'=>$id])->groupBy('col_rating_id')->all();
        if($countDate > 0){
            echo "<option value=''>Нет...</option>";
            foreach ($date as $oneDate){
                echo "<option value='".$oneDate->col_rating_id."'>".$oneDate->data->data ."</option>";
            }
        }
        else{
            echo "<option> - </option>";
        }
    }

    public function viborkaGroup()
    {
        //$model = new Group();
        $posts = Yii::$app->db->createCommand('SELECT username FROM user')->queryAll();
        return $posts;
    }
    public function actionCreate(){
        $user_full_name = new GetUserInfo();
        $modelRating = new RatingGroup();
        $model = new Group();
        $Custom = new Customs();
        $GetAllGroup = Customs::GetListAllGroup();
        $getSubject = Customs::GetListSubjectUserId();

        if ($model->load(Yii::$app->request->post())){

            $model->group_id  = $model->group->id;
            $model->subject_id   = $model->subject->id;
            $model->group_created_data = date('Y-m-d H:i:s');
            $model->user_id = Yii::$app->user->id;

            if ($model->validate() && $model->save()) {
                $table_id = Group::getLastId();
                // Запись id студентов в таблицу rating
                $modelRating->InsertStudent($model->group_id,$table_id, $user_full_name->date());
                // создание первой даты в таблице

                return $this->redirect(['index', ['model' => $model]]);
            }
            else{
                Yii::$app->session->setFlash('danger', 'У этой группы уже есть такая дисциплина!');
                return $this->redirect(['create', ['model' => $model]]);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
                'GetAllGroup' => $GetAllGroup,
                'getSubject' => $getSubject,
            ]);
        }
    }

    public function actionDelete($id)
    {
        if($this->findModel($id)->user_id == Yii::$app->user->id || Yii::$app->user->can('Firste_admin')) {
            $zapros = RatingGroup::findDropDateToId($id);
            foreach ($zapros as $result) {
                $find = RatingData::findOne($result->id);
                $find->delete();
            }
            $indef = $this->findModel($id);
            $indef->delete();

            return $this->redirect(['index']);
        }
        else{
            Yii::$app->session->setFlash('danger', 'У вас нет прав на редактирования этой группы');
            return $this->actionIndex();
        }
    }

    protected function findModel($id)
    {
        if (($model = Group::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function ogranichenia($prava,$id)
    {
        if ($prava == 'view') {
            $model = $this->findModel($id);
            if (!Yii::$app->user->can('updateOwnGroup', ['group_id' => $model])) {
                if (Yii::$app->user->identity->getAuthKey() == 'yNQuYNX7L-xVsnghu9EvVz4UHPmkK6qU') {
                    return $this->render("view", [
                        'model' => $model,
                    ]);
                }
                throw new ForbiddenHttpException("У вас нет прав на редактирования этой группы");
            }
        }
        if ($prava == 'rating') {
            $model = $this->findModel($id);
            if (!Yii::$app->user->can('updateOwnGroup', ['group_id' => $model])) {
                if (Yii::$app->user->identity->getAuthKey() == 'yNQuYNX7L-xVsnghu9EvVz4UHPmkK6qU') {
                    return $this->render("rating", [
                        'model' => $model,
                    ]);
                }
                throw new ForbiddenHttpException("У вас нет прав на редактирования этой группы");
            }
        }
    }
}
