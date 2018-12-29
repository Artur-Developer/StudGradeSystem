<?php

namespace backend\controllers;

use backend\components\Customs;
use backend\models\AllGroup;
use backend\models\AnswerTestStudent;
use backend\models\Group;
use backend\models\QuestionAnswers;
use backend\models\RatingGroup;
use backend\models\Subject;
use backend\models\TestingQuestions;
use Yii;
use backend\models\TestInGroup;
use backend\models\TestInGroupSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Students;


class TestInGroupController extends Controller
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
        $searchModel = new TestInGroupSearch();
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
        $model = new TestInGroup();

        $findTest = Subject::find()
            ->leftJoin('testing','testing.subject_id = subject.id')
            ->rightJoin('user_subject','user_subject.subject_id = subject.id')
            ->where(['user_subject.user_id'=>Yii::$app->user->id])->andWhere('not testing.name_test in ("")')->all();

        $findSubjectGroup = Group::find()->where(['user_id'=>Yii::$app->user->id])->all();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->_save() && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'findTest' => $findTest,
                'findSubjectGroup' => $findSubjectGroup,
                'arrayDate' => [],
            ]);
        }
    }

    public function actionViewAnswerStudent($id){
        $modelAnswer = new AnswerTestStudent();
        if ($modelAnswer->load(Yii::$app->request->post())) {
           if(!empty($modelAnswer->get_student)){
               $findAnswer = AnswerTestStudent::find()->where(['test_id'=>$id,'student_id'=>$modelAnswer->get_student])->all();
               $student = Students::find()->select('last_name')->addSelect('first_name')->addSelect('middle_name')->where(['id'=>$modelAnswer->get_student])->one();
               return $this->render('tableAnswer', [
                   'model' => $this->findModel($id),
                   'modelAnswer' => $modelAnswer,
                   'findAnswer' => $findAnswer,
                   'student' => $student,
               ]);
           }
           else{
               Yii::$app->session->setFlash('danger', 'Укажите пожалуйста студента!');
           }
        }
        return $this->render('view-answer-student', [
            'model' => $this->findModel($id),
            'modelAnswer' => $modelAnswer,
        ]);
    }
    public function actionSendInvite($id)
    {
        $model = $this->findModel($id);
        $all_students = [];
        $find = Students::find()->where(['group_id'=>$model->subjectGroup->group_id])->all();
        foreach ($find as $student){

            $all_students[$student->email] = $student->last_name  . ' ' . $student->first_name
                . ' ' . $student->middle_name . ' | ' . $student->email;

//            array_push($all_students, ['last_name'=>$student->last_name,
//                'first_name'=>$student->first_name,'middle_name'=>$student->middle_name,'email'=>$student->email]); // сохраняем email


        }

//        foreach ($find as $email){
//
//            // Отправка сообщений студентам на Email
//            Yii::$app->mailer->compose()
//                ->setFrom(Yii::$app->user->identity->email)
//                ->setTo($find['email'])
//                ->setSubject('Тема сообщения')
//                ->setTextBody('Текст сообщения')
//                ->setHtmlBody('<a href="http://studgradesystem.ru/frontend/web/student/activate-password?token='.  $email['email'] .'>http://studgradesystem.ru/backend/web/students/activate-password</a>')
//                ->send();
//        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('send-invite', [
                'model' => $model,
                'all_students' => $all_students,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $findTest = Subject::find()
            ->leftJoin('testing','testing.subject_id = subject.id')
            ->rightJoin('user_subject','user_subject.subject_id = subject.id')
            ->where(['user_subject.user_id'=>Yii::$app->user->id])->andWhere('not testing.name_test in ("")')->all();

        $findSubjectGroup = Group::find()->where(['user_id'=>Yii::$app->user->id])->all();

        $find = \backend\models\RatingGroup::find()
            ->where(['subject_group_id'=>$model->subject_group_id])->groupBy('col_rating_id')
            ->all();
        foreach ($find as $value){
            $arrayDate[$value->col_rating_id]=$value->data->data;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'arrayDate' => $arrayDate,
                'findTest' => $findTest,
                'findSubjectGroup' => $findSubjectGroup,
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
        if (($model = TestInGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
