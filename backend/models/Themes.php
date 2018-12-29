<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "themes".
 *
 * @property integer $id
 * @property string $name_theme
 * @property integer $subject_id
 * @property integer $user_id
 * @property string $create_date
 *
 * @property Subject $subject
 * @property User $user
 */
class Themes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'themes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_theme', 'subject_id'], 'required'],
            [['subject_id', 'user_id'], 'integer'],
            [['create_date'], 'safe'],
            [['name_theme'], 'string', 'max' => 255],
            [['name_theme'], 'unique'],
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
            'name_theme' => 'Название темы',
            'subject_id' => 'По дисциплине',
            'user_id' => 'Создал',
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
    public function _save()
    {
        if($this->validate()){
            $this->user_id = Yii::$app->user->id;
            $this->create_date = date('Y-m-d H:i:s');
            return $this->insert();
        }
        else{
            return false;
        }
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
