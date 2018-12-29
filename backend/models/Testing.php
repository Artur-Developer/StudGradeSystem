<?php

namespace backend\models;

use backend\components\Customs;
use backend\components\GetUserInfo;
use Yii;

/**
 * This is the model class for table "testing".
 *
 * @property integer $id
 * @property string $name_test
 * @property integer $question_answers_id
 * @property integer $subject_id
 * @property string $description
 * @property string $user_create
 * @property string $create_date
 *
 * @property TestInGroup[] $testInGroups
 * @property QuestionAnswers $questionAnswers
 * @property Subject $subject
 */
class Testing extends \yii\db\ActiveRecord
{
    public $question_array;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'testing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_test', 'subject_id'], 'required'],
            [['subject_id'], 'integer'],
            [['create_date'], 'safe'],
            [['name_test', 'description'], 'string', 'max' => 255],
            [['user_create'], 'string', 'max' => 100],
            [['name_test'], 'unique'],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'id']],
            [['question_array'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_test' => 'Название теста',
            'subject_id' => 'Дисциплина',
            'user_create' => 'Автор',
            'create_date' => 'Дата создания',
            'description' => 'Описание',
            'question_array' => 'Привязка вопросов',
        ];
    }



    public function _save()
    {
        if($this->validate()){
            $this->user_create = Customs::GetUserFullName();
            $this->create_date = date('Y-m-d H:i:s');
            return $this->insert();
        }
        else{
            return false;
        }
    }
    public function getQuestionsAsString(){
        $array = \yii\helpers\ArrayHelper::map($this->questions,'id','name_question');
        return implode(", | ",$array);
    }

    public function afterFind()
    {
        $this->question_array = $this->questions;
    }
    public function beforeDelete()
    {
        if(parent::beforeDelete()){
            TestingQuestions::deleteAll(['testing_id'=>$this->id]);
            return true;
        }
        else{
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            Yii::$app->session->setFlash('success', 'Запись добавлена');
        } else {
            Yii::$app->session->setFlash('success', 'Запись обновлена');
        }

        parent::afterSave($insert, $changedAttributes);

        $array = \yii\helpers\ArrayHelper::map($this->questions,'id','id');
        if(!empty($this->question_array)){

            foreach ($this->question_array as $question){
                if(!in_array($question,$array)){
                    $model = new TestingQuestions();
                    $model->testing_id = $this->id;
                    $model->question_id = $question;
                    $model->save();
                }
                if(isset($array[$question])){
                    unset($array[$question]);
                }
            }
            TestingQuestions::deleteAll(['question_id'=>$array]);
        }
        else{
            TestingQuestions::deleteAll(['and',['testing_id'=>$this->id],['question_id'=>$array]]);
        }
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
    public function getTestInGroups()
    {
        return $this->hasMany(TestInGroup::className(), ['test_id' => 'id']);
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
    public function getTestingQuestions()
    {
        return $this->hasMany(TestingQuestions::className(), ['testing_id' => 'id']);
    }

    public function getQuestions()
    {
        return $this->hasMany(Questions::className(), ['id' => 'question_id'])->via('testingQuestions');
    }


}
