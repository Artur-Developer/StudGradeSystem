<?php

namespace frontend\models;

use backend\models\AnswerTestStudent;
use backend\models\Group;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TestInGroup;

/**
 * TestInGroupSearch represents the model behind the search form about `backend\models\TestInGroup`.
 */
class TestInGroupProcess extends AnswerTestStudent
{
    public $answer;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'answer','question_id',  'test_id' ], 'integer'],
        ];
    }

    public function SaveAnswer($testId,$student_id,$question_id){

        if ($this->validate()){
            $this->student_id = $student_id;
            $this->question_id = $question_id;
            $this->question_answers_id = Yii::$app->request->post('answer');
            $this->test_id = $testId;
            $this->create_date = date('Y-m-d H:i:s');
            $this->save();

        }

    }
    public function countTestResult($test_id,$student_id){
        $findAnswer = AnswerTestStudent::find()->where(['test_id'=>$test_id,'student_id'=>$student_id])->all();
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            Yii::$app->session->setFlash('success', 'Ответ отправлен!');
        } else {
            Yii::$app->session->setFlash('success', 'Ответ отправлен!');
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                Yii::$app->session->setFlash('success', 'Ответ отправлен!');
            } else {
                Yii::$app->session->setFlash('success', 'Ответ отправлен!');
            }
            return true;
        } else {
            return false;
        }
    }



}
