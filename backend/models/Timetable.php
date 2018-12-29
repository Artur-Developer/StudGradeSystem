<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "timetable".
 *
 * @property integer $id
 * @property integer $group_id
 * @property integer $subject_id
 * @property integer $auditoriy_id
 * @property integer $number_lesson
 * @property integer $type_week
 * @property integer $type_day
 * @property integer $day_week
 * @property string $save_time
 * @property string $description
 */
class Timetable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'timetable';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'subject_id', 'auditoriy_id'], 'required'],
            [['group_id', 'subject_id', 'auditoriy_id', 'user_id', 'number_lesson', 'type_week', 'type_day', 'day_week'], 'integer'],
            [['save_time'], 'safe'],
            ['auditoriy_id', 'unique', 'targetAttribute' => ['group_id', 'subject_id', 'auditoriy_id', 'user_id', 'number_lesson', 'type_week', 'day_week'],'message'=>'false'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Группа',
            'subject_id' => 'Дисциплина',
            'auditoriy_id' => 'Аудитория',
            'user_id' => 'Преподаватель',
            'number_lesson' => 'Номер занятия',
            'type_week' => 'Тип недели',
            'type_day' => 'Тип дня',
            'day_week' => 'День недели',
            'save_time' => 'Время сохранения',
            'description' => 'Описание',
        ];
    }

    public static function UpdateTypeDay($array,$params)
    {
        if(!empty($array)){
            $transaction = Yii::$app->db->beginTransaction();

            foreach ($array as $lesson){
                $find = self::findOne($lesson->id);
                $find->type_day = $params;
                $find->update();
            }
            if($find->update()){
                $transaction->commit();
            }
            else if(!$find->update()){
                $transaction->commit();
            }
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuditories()
    {
        return $this->hasOne(Auditories::className(), ['id' => 'auditoriy_id']);
    }

}
