<?php

namespace backend\models;

use backend\models\User;
use Yii;

/**
 * This is the model class for table "post_backend".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $author
 * @property string $date
 * @property integer $user_id
 */
class Postbackend extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_backend';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text','how_send'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['text'], 'string'],
            [['how_send','user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'date' => 'Дата',
            'user_id' => 'Автор',
            'how_send' => 'Отображать',
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

    public function getPost()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
