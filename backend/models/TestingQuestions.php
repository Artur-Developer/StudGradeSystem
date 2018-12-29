<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "testing_questions".
 *
 * @property integer $id
 * @property integer $question_id
 * @property integer $testing_id
 *
 * @property Questions $question
 * @property Testing $testing
 */
class TestingQuestions extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'testing_questions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question_id', 'testing_id'], 'required'],
            [['question_id', 'testing_id'], 'integer'],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::className(), 'targetAttribute' => ['question_id' => 'id']],
            [['testing_id'], 'exist', 'skipOnError' => true, 'targetClass' => Testing::className(), 'targetAttribute' => ['testing_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_id' => 'Вопрос',
            'testing_id' => 'Относится к тесту',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Questions::className(), ['id' => 'question_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTesting()
    {
        return $this->hasOne(Testing::className(), ['id' => 'testing_id']);
    }

}
