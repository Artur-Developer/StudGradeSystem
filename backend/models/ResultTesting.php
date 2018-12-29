<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "result_testing".
 *
 * @property integer $id
 * @property integer $test_id
 * @property integer $student_id
 * @property string $test_token
 * @property integer $result
 * @property string $comment
 *
 * @property Students $student
 * @property TestInGroup $test
 */
class ResultTesting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'result_testing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['test_id', 'student_id', 'result'], 'required'],
            [['test_id', 'student_id', 'result'], 'integer'],
            [['test_token', 'comment'], 'string', 'max' => 255],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => TestInGroup::className(), 'targetAttribute' => ['test_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_id' => 'Название теста',
            'student_id' => 'Студент',
            'test_token' => 'Ключ доступа',
            'result' => 'Результат',
            'comment' => 'Комментарий',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(TestInGroup::className(), ['id' => 'test_id']);
    }
}
