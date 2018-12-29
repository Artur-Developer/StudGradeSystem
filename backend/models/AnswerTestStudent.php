<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "answer_test_student".
 *
 * @property integer $id
 * @property integer $test_id
 * @property integer $student_id
 * @property integer $question_answers_id
 * @property integer $question_id
 * @property string $create_date
 *
 * @property QuestionAnswers $questionAnswers
 * @property Students $student
 * @property TestInGroup $test
 */
class AnswerTestStudent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $get_student;

    public static function tableName()
    {
        return 'answer_test_student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['test_id', 'student_id', 'question_answers_id', 'question_id', 'create_date'], 'required'],
            [['test_id', 'student_id', 'question_answers_id', 'question_id'], 'integer'],
            [['create_date'], 'safe'],
            [['get_student'], 'integer'],
            [['question_answers_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuestionAnswers::className(), 'targetAttribute' => ['question_answers_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['student_id' => 'id']],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => TestInGroup::className(), 'targetAttribute' => ['test_id' => 'id']],
            ['question_answers_id', 'unique', 'targetAttribute' => ['question_answers_id', 'student_id'],'message'=>'Ошибка проверки! Не мухлюйте!'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_id' => 'Test ID',
            'student_id' => 'Student ID',
            'question_answers_id' => 'Ответ : ',
            'question_id' => 'Question ID',
            'create_date' => 'Create Date',
            'get_student' => 'Студент',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionAnswers()
    {
        return $this->hasOne(QuestionAnswers::className(), ['id' => 'question_answers_id']);
    }

    public function getQuestions()
    {
        return $this->hasOne(Questions::className(), ['id' => 'question_id'])->via('questionAnswers');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Students::className(), ['id' => 'student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(TestInGroup::className(), ['id' => 'test_id']);
    }
}
