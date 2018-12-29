<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "questions".
 *
 * @property integer $id
 * @property string $name_question
 * @property integer $subject_id
 * @property integer $user_id
 * @property string $type
 * @property integer $rating
 * @property string $time
 * @property string $create_date
 *
 * @property QuestionAnswers[] $questionAnswers
 * @property Subject $subject
 * @property User $user
 */
class Questions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'questions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_question', 'subject_id', 'user_id', 'rating', 'time'], 'required'],
            [['subject_id', 'user_id', 'rating'], 'integer'],
            [['time', 'create_date'], 'safe'],
            [['name_question'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 35],
            [['name_question'], 'unique'],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_question' => 'Вопрос',
            'subject_id' => 'По дисциплине',
            'user_id' => 'Создал',
            'type' => 'Тип вопроса',
            'rating' => 'Оценка',
            'time' => 'Время на ответ',
            'create_date' => 'Дата создания',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            Yii::$app->session->setFlash('success', 'Запись добавлена');
        } else {
            Yii::$app->session->setFlash('success', 'Запись обновлена');
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                Yii::$app->session->setFlash('success', 'Запись добавлена!');
            } else {
                Yii::$app->session->setFlash('success', 'Запись обновлена!');
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionAnswers()
    {
        return $this->hasMany(QuestionAnswers::className(), ['question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestingQuestions()
    {
        return $this->hasMany(TestingQuestions::className(), ['question_id' => 'id']);
    }
}
