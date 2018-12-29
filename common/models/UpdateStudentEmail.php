<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 27.01.2018
 * Time: 20:15
 */

namespace common\models;


use backend\models\Students;
use yii\base\Model;

class UpdateStudentEmail extends Model
{
    public $email;

    /**
     * @var Students
     */
    private $_students;

    public function __construct(Students $user, $config = [])
    {
        $this->_students = $user;
        $this->email = $user->email;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            [
                'email',
                'unique',
                'targetClass' => Students::className(),
                'message' => \Yii::t('app', 'Указанный email уже используется!'),
                'filter' => ['<>', 'id', $this->_students->id],
            ],
            ['email', 'string', 'max' => 255],
        ];
    }

    public function update()
    {
        if ($this->validate()) {
            $user = $this->_students;
            $user->email = $this->email;
            return $user->save();
        } else {
            return false;
        }
    }
}