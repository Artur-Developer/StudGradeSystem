<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "subject".
 *
 * @property integer $id
 * @property string $name_subject
 */
class Subject extends \yii\db\ActiveRecord
{

    public $users_array;
    public $usersAsString;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subject';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_subject'], 'required'],
            [['name_subject'], 'string', 'max' => 100],
            [['create_data'], 'safe'],
            [['users_array','usersAsString'],'safe'],
        ];
    }

    public function getNameSubjectToId($id)
    {
        $array = $this::find()->select('name_subject')->where(['id' => $id])->one();
        return $array->name_subject;
    }
    public function getIdSubjectToName($name)
    {
        $array = $this::find()->select('id')->where(['name_subject' => $name])->one();
        return $array->id;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_subject' => 'Название',
            'create_data' => 'Дата создания',
            'users_array' => 'Привязка преподавателей',
            'getTeacherForSubject' => 'Могут преподавать сотрудники в организации эту дисциплину',
        ];
    }

    public function findSubjectAll()
    {
        return $this::find()->all();
    }

    public static function findSubjectAllForTeacher($user_id)
    {
        return static::find()->leftJoin('user_subject','subject.id = user_subject.subject_id')->where(['user_subject.user_id'=>$user_id])->all();
    }

    public function afterFind()
    {
        $this->users_array = $this->users;
    }
    public function beforeDelete()
    {
        if(parent::beforeDelete()){
            UserSubject::deleteAll(['user_id'=>$this->id]);
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

        $array = \yii\helpers\ArrayHelper::map($this->users,'id','id');
        if(!empty($this->users_array)){

            foreach ($this->users_array as $user){
                if(!in_array($user,$array)){
                    $model = new UserSubject();
                    $model->subject_id = $this->id;
                    $model->user_id = $user;
                    $model->save();
                }
                if(isset($array[$user])){
                    unset($array[$user]);
                }
            }
            UserSubject::deleteAll(['user_id'=>$array]);
        }
        else{
            UserSubject::deleteAll(['and',['subject_id'=>$this->id],['user_id'=>$array]]);
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

    public  function getIdSubject(){

        return $this->hasOne(Group::className(), ['subject_id' => 'id']);
    }

    public  function getTesting(){

        return $this->hasOne(Testing::className(), ['subject_id' => 'id']);
    }

    public  function getUserSubject()
    {
        return $this->hasMany(UserSubject::className(), ['subject_id' => 'id']);
    }

    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->via('userSubject');
    }

    public  function getThemeSubjectId()
    {
        return $this->hasMany(Themes::className(), ['subject_id' => 'id']);
    }

    public function getTimeTableId()
    {
        return $this->hasMany(Timetable::className(), ['subject_id' => 'id']);
    }

}
