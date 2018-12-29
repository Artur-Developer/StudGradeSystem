<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_subject".
 *
 * @property integer $user_id
 * @property integer $subject_id
 *
 * @property Subject $subject
 * @property User $user
 */
class UserSubject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_subject';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'subject_id'], 'required'],
            [['user_id', 'subject_id'], 'integer'],
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
            'user_id' => 'Преподаватель',
            'subject_id' => 'Преподаёт дисциплину',
        ];
    }

    public static function getTeacherForSubject($id)
    {
        return static::find()->leftJoin('subject','user_subject.subject_id = subject.id')->rightJoin('user','user_subject.user_id = user.id')->where(['subject_id'=>$id])->all();
//        return static::find()->leftJoin('user', 'user_id = user.id')->select('id')->addSelect('last_name')->addSelect('first_name')->addSelect('middle_name')->where(['subject_id'=>$id])->all();
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
}
