<?php

namespace backend\models;
use Yii;
/**
 * This is the model class for table "allgroup".
 *
 * @property integer $id
 * @property string $name_group
 */
class AllGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'all_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_group'], 'required'],
            [['name_group'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_group' => 'Название группы',
        ];
    }
    
    public static function  getLastIdFromGroup()
    {
    	 $lastId = static::find()->orderBy('id DESC')->one();
    	 return $lastId->id;
    }

    public function findGroupAll()
    {
        return $this::find()->all();
    }

    public function getNamegroupToId($id)
    {
        $array = $this::find()->select('name_group')->where(['id' => $id])->one();
        return $array->name_group;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            Yii::$app->session->setFlash('success', 'Группа добавлена');
        } else {
            Yii::$app->session->setFlash('success', 'Группа обновлена');
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                Yii::$app->session->setFlash('success', 'Группа добавлена!');
            } else {
                Yii::$app->session->setFlash('success', 'Группа обновлена!');
            }
            return true;
        } else {
            return false;
        }
    }

    public function getUser()
    {
        return $this->hasMany(User::className(), ['user_id' => 'id']);
    }

    public function getStudents(){

        return $this->hasMany(Students::className(), ['group_id' => 'id']);
    }

    public  function getIdNameGroup()
    {
        return $this->hasOne(Group::className(), ['group_id' => 'id']);
    }

    public  function getIdImportFile()
    {
        return $this->hasOne(ImportExcelFile::className(), ['importFile_id' => 'id']);
    }

    public function getTimeTableId()
    {
        return $this->hasMany(Timetable::className(), ['group_id' => 'id']);
    }


}
