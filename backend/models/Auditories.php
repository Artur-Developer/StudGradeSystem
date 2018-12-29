<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "auditories".
 *
 * @property integer $id
 * @property integer $capacity
 * @property string $number
 * @property string $type
 * @property string $description
 */
class Auditories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auditories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['capacity'], 'integer'],
            [['number'], 'required'],
            [['number'], 'string', 'max' => 30],
            [['type'], 'string', 'max' => 35],
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
            'capacity' => 'Вместительность',
            'number' => 'Номер',
            'type' => 'Тип',
            'description' => 'Описание',
        ];
    }
    public function findAuditories(){

        return $this::find()->all();
    }

    public function getAuditoriesId()
    {
        return $this->hasMany(Auditories::className(), ['auditoriy_id' => 'id']);
    }
}
