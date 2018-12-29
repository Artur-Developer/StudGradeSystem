<?php

namespace backend\controllers;

use backend\components\Customs;
use backend\models\QuestionAnswers;
use backend\models\Subject;
use mdm\admin\components\AccessControl;
use Yii;
use backend\models\Questions;
use backend\models\QuestionsSearch;
use yii\base\Exception;
use backend\models\Model;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;



class QuestionsController extends Controller
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
        $searchModel = new QuestionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $questionAnswers = $model->questionAnswers;
        $questionAnswers = QuestionAnswers::find()->where(['question_id'=>$id])->all();

        return $this->render('view', [
            'model' => $model,
            'questionAnswers' => $questionAnswers,
        ]);
    }

    /**
     * Creates a new Questions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Questions();
        $getSubject = Customs::GetListSubjectUserId();
        $modelsQuestionAnswer = [new QuestionAnswers()];

        if ($model->load(Yii::$app->request->post())) {

            $modelsQuestionAnswer = Model::createMultiple(QuestionAnswers::classname());
            Model::loadMultiple($modelsQuestionAnswer, Yii::$app->request->post());

            $model->create_date = date('Y-m-d H:i:s');
            $model->user_id = Yii::$app->user->id;

            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsQuestionAnswer) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsQuestionAnswer as $modelQuestionAnswer) {
                            $modelQuestionAnswer->question_id = $model->id;
                            if (! ($flag = $modelQuestionAnswer->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {

                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
            return $this->render('create', [
                'model' => $model,
                'getSubject' => $getSubject,
                'modelsQuestionAnswer' => (empty($modelsQuestionAnswer)) ? [new QuestionAnswers()] : $modelsQuestionAnswer
            ]);


    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $getSubject = $getSubject = Customs::GetListSubjectUserId();

        $modelsQuestionAnswer = $model->questionAnswers;

        if ($model->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsQuestionAnswer, 'id', 'id');
            $modelsQuestionAnswer = Model::createMultiple(QuestionAnswers::classname(), $modelsQuestionAnswer);
            Model::loadMultiple($modelsQuestionAnswer, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsQuestionAnswer, 'id', 'id')));

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsQuestionAnswer) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            QuestionAnswers::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsQuestionAnswer as $modelAddress) {
                            $modelAddress->question_id = $model->id;
                            if (! ($flag = $modelAddress->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'getSubject' => $getSubject,
            'modelsQuestionAnswer' => (empty($modelsQuestionAnswer)) ? [new QuestionAnswers()] : $modelsQuestionAnswer
        ]);
    }
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Questions::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
