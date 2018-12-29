<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "test_in_group".
 *
 * @property integer $id
 * @property integer $required
 * @property string $type
 * @property integer $test_id
 * @property integer $subject_group_id
 * @property integer $rating_data_id
 * @property integer $user_id
 * @property string $end_date
 * @property string $create_date
 *
 * @property AnswerTestStudent[] $answerTestStudents
 * @property ResultTesting[] $resultTestings
 * @property RatingData $ratingData
 * @property SubjectGroup $subjectGroup
 * @property Testing $test
 * @property User $user
 */
class TestInGroup extends \yii\db\ActiveRecord
{
    public $required2 = true;
    public $student_array;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_in_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'required',  'test_id', 'subject_group_id', 'rating_data_id', 'user_id'], 'integer'],
            [['type','start_date',  'end_date', 'test_id', 'subject_group_id'], 'required'],
            [['start_date','end_date', 'create_date','student_array'], 'safe'],
            [['type'], 'string', 'max' => 25],
            ['test_id', 'unique', 'targetAttribute' => ['test_id', 'subject_group_id', 'rating_data_id'],'message'=>'Данный тест уже назначен на эту дату в группе по дисциплине'],
            [['rating_data_id'], 'exist', 'skipOnError' => true, 'targetClass' => RatingData::className(), 'targetAttribute' => ['rating_data_id' => 'id']],
            [['subject_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['subject_group_id' => 'id']],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Testing::className(), 'targetAttribute' => ['test_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            ['required', 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'required' => 'Обязательный ли тест',
            'type' => 'Тип',
            'test_id' => 'Название теста',
            'subject_group_id' => 'Привязка к группе с оценками',
            'rating_data_id' => 'Привязка к дате',
            'user_id' => 'Создал',
            'start_date' => 'Дата начала',
            'end_date' => 'Дата окончания',
            'create_date' => 'Дата создания',
        ];
    }

    public function _save()
    {
        if($this->validate()){
            $this->user_id = Yii::$app->user->id;
            $this->create_date = date('Y-m-d H:i:s');
            return $this->save();
        }
        else{
            return false;
        }
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                Yii::$app->session->setFlash('success', 'Запись добавлена');
            } else {
                Yii::$app->session->setFlash('success', 'Запись обновлена');
            }
            return true;
        } else {
            return false;
        }
    }

    public function afterFind()
    {
        $this->student_array = $this->nameGroup;
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
    public  static function findTestingToStudent()
    {
        foreach(\backend\models\Group::find()->where(['group_id'=>Yii::$app->user->identity->group_id])->all() as $subject_group_id){
            return TestInGroup::find()->andWhere(['subject_group_id'=>$subject_group_id]);
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

        $array = \yii\helpers\ArrayHelper::map($this->nameGroup,'id','id');
        if(!empty($this->student_array)){

            foreach ($this->student_array as $student){
                if(!in_array($student,$array)){
//                    $model = new Students();
//                    $model->generateTestStudentToken();
//                    $model->test_id = 1;
//                    $model->student_id = 1;
//                    $model->save();
//
////              Отправка приглашений студентам на Email
//                    Yii::$app->mailer->compose()
//                    ->setFrom(Yii::$app->user->identity->email)
//                    ->setTo($student)
//                    ->setSubject('Тема сообщения')
//                    ->setTextBody('Текст сообщения')
//                    ->setHtmlBody('<a href="http://studgradesystem.ru/frontend/web/student/activate-password?token='.  $student .'>http://studgradesystem.ru/backend/web/students/activate-password</a>')
//                    ->send();
                }
                if(isset($array[$student])){
                    unset($array[$student]);
                }
            }
//            Yii::$app->mailer->sendMultiple($messages);
            return TestingQuestions::deleteAll(['question_id'=>$array]);
        }
        else{
            TestingQuestions::deleteAll(['and',['testing_id'=>$this->id],['question_id'=>$array]]);
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswerTestStudents()
    {
        return $this->hasMany(AnswerTestStudent::className(), ['test_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResultTestings()
    {
        return $this->hasMany(ResultTesting::className(), ['test_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatingData()
    {
        return $this->hasOne(RatingData::className(), ['id' => 'rating_data_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubjectGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'subject_group_id']);
    }

    public function getNameGroup()
    {
        return $this->hasOne(AllGroup::className(), ['id' => 'group_id'])->via('subjectGroup');
    }

    public function getNameSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id'])->via('subjectGroup');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Testing::className(), ['id' => 'test_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
