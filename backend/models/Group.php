<?php

namespace backend\models;

use backend\models\User;
use Yii;
use yii\helpers\ArrayHelper;


class Group extends \yii\db\ActiveRecord
{

    public static function tableName()
    {

        return 'subject_group';
    }



    public function rules()
    {
        return [
            [['group_id', 'subject_id', 'user_id','group_created_data'], 'required'],
            [['user_id','subject_id','group_created_data'], 'safe'],
            ['group_id', 'unique', 'targetAttribute' => ['group_id', 'subject_id'],'message'=>'false'],

            [['status'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Группа',
            'subject_id' => 'Дисциплина',
            'group_created_data' => 'Дата создания',
            'status' => 'Статус',
            'prepod' => 'Создал преподаватель',
            'rating_table' => 'Группа-предмет',
        ];
    }
    
      public static function  getLastId()
    {
    	 $lastId = static::find()->orderBy('id DESC')->one();
    	 return $lastId->id;
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

    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }

    public function getGroup()
    {
        return $this->hasOne(AllGroup::className(), ['id' => 'group_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getSGId()
    {
        return $this->hasMany(RatingGroup::className(), ['subject_group_id' => 'id']);
    }

    public function getTestSG()
    {
        return $this->hasMany(TestInGroup::className(), ['subject_group_id' => 'id']);
    }


}