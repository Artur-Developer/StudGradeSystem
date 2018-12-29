<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "question_answers".
 *
 * @property integer $id
 * @property string $name_answer
 * @property integer $bool
 * @property integer $question_id
 *
 * @property AnswerTestStudent[] $answerTestStudents
 * @property Questions $question
 * @property Testing[] $testings
 */
class QuestionAnswers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
//    public $bool = false;

    public static function tableName()
    {
        return 'question_answers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_answer'], 'required'],
            [['question_id','bool'], 'integer'],
            [['name_answer'], 'string', 'max' => 255],
//            ['bool', 'boolean'],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::className(), 'targetAttribute' => ['question_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_answer' => 'Ответ',
            'bool' => 'Правильный',
            'question_id' => 'Вопрос',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswerTestStudents()
    {
        return $this->hasMany(AnswerTestStudent::className(), ['question_answers_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Questions::className(), ['id' => 'question_id']);
    }

}
