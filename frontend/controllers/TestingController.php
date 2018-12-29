<?php

namespace frontend\controllers;


use backend\models\AnswerTestStudent;
use backend\models\Group;
use backend\models\GroupSearch;
use backend\models\QuestionAnswers;
use backend\models\ResultTesting;
use backend\models\Students;
use backend\models\TestingQuestions;
use backend\models\TestInGroup;
use backend\models\TestInGroupSearch;
use common\models\CheckStudentEmail;
use frontend\models\GetSubjectGroup;
use common\models\LoginForm;
use common\models\UpdateStudentEmail;
use frontend\models\GetRatingStudent;
use frontend\models\StudentsForm;
use frontend\models\TestInGroupProcess;
use frontend\models\UpdateStudentExtendedInfo;
use frontend\models\UpdateStudentPassword;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginFormStudent;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;


class TestingController extends \yii\web\Controller
{
    public $layout = '@frontend/views/layouts/adminka/main.php';

    public function goMain()
    {
        return Yii::$app->getResponse()->redirect('index');
    }

    public function actionIndex()
    {
        $findSG = Group::find()->andWhere(['group_id'=>Yii::$app->user->identity->group_id])->all();

        return $this->render('select_form', [
            'model' => $this->findSubjectGroup(Yii::$app->user->identity->group_id),
            'findSG' => $findSG,
        ]);
    }
    public function actionProcess($testId){

        $student_id = Yii::$app->user->identity->getId();

        $checkResultStudent = ResultTesting::find()->where(['test_id'=>$testId,'student_id'=>$student_id])->one();
        if(empty($checkResultStudent)){
            $checkTestProgress = AnswerTestStudent::find()->where(['test_id'=>$testId,'student_id'=>$student_id])->all();
            $countQuestions = AnswerTestStudent::find()->where(['test_id'=>$testId,'student_id'=>$student_id])->count('*');



            $model = $this->findModel($testId);
            $findTest = TestingQuestions::find()->where(['testing_id'=>$model->test_id])->all();
            foreach ($findTest as $time);
            $data = new TestInGroupProcess();

            if(!empty($checkTestProgress)){

                if(empty($findTest[$countQuestions])){
                    Yii::$app->session->setFlash('success', 'Вы уже прошли этот тест!');
                    return $this->redirect('index');
                }
                if (Yii::$app->request->post()) {

                    // Сохранение ответа
                    $data->SaveAnswer($testId,$student_id,$findTest[$countQuestions]->question_id);

                    if(empty($findTest[$countQuestions + 1])){
                        return $this->redirect('index');
                    }

                    return $this->render('process', [
                        'model' => $model,
                        'findTest' => $findTest,
                        'countQuestions' => $countQuestions + 1,
                        'checkTestProgress' => $checkTestProgress,
                        'model2' => $data,
                        'time' => $time,
                    ]);
                }

                return $this->render('process', [
                    'model' => $model,
                    'findTest' => $findTest,
                    'countQuestions' => $countQuestions,
                    'checkTestProgress' => $checkTestProgress,
                    'model2' => $data,
                    'time' => $time,
                ]);
            }

            else if(empty($checkTestProgress)){
                if(empty($findTest[$countQuestions])){
                    Yii::$app->session->setFlash('success', 'К тестированию не привязаны вопросы, подождите или сообщите преподавателю');
                    return $this->redirect('index');
                }
                if (Yii::$app->request->post()) {
                    // Сохранение ответа
                    $data->SaveAnswer($testId,$student_id,$findTest[$countQuestions]->question_id);

                    return $this->render('process', [
                        'model' => $model,
                        'findTest' => $findTest,
                        'countQuestions' => $countQuestions + 1,
                        'checkTestProgress' => $checkTestProgress,
                        'model2' => $data,
                        'time' => $time,
                    ]);
                }
            }
            else{
                return $this->redirect('index');
            }
            return $this->render('process', [
                'model' => $model,
                'findTest' => $findTest,
                'countQuestions' => $countQuestions,
                'checkTestProgress' => $checkTestProgress,
                'model2' => $data,
                'time' => $time,
            ]);
        }
        else{
            throw new NotFoundHttpException('Вы уже прошли данный тест, результаты записаны!');
        }

    }

    protected function findSubjectGroup($group_id)
    {
        if (($model1 = Group::find()->with('testSG')->where(['group_id'=>$group_id])->all()) !== null) {
            return $model1;
        }
        else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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
