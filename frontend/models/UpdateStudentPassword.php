<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 27.01.2018
 * Time: 20:25
 */

namespace frontend\models;


use backend\models\Students;
use yii\base\Model;
use Yii;

class UpdateStudentPassword extends Model
{
    public $currentPassword;
    public $newPassword;
    public $newPasswordRepeat;

    /**
     * @var Students
     */
    private $_students;

    /**
     * @param Students $students
     * @param array $config
     */
    public function __construct(Students $students, $config = [])
    {
        $this->_students = $students;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['currentPassword', 'newPassword', 'newPasswordRepeat'], 'required'],
            ['currentPassword', 'currentPassword'],
            ['newPassword', 'string', 'min' => 6],
            ['newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'newPassword' => Yii::t('app', 'Новый пароль'),
            'newPasswordRepeat' => Yii::t('app', 'Повторите новый пароль'),
            'currentPassword' => Yii::t('app', 'Старый пароль'),
        ];
    }

    /**
     * @param string $attribute
     * @param array $params
     */
    public function currentPassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (!$this->_students->validatePassword($this->$attribute)) {
                $this->addError($attribute, Yii::t('app', 'Неверный старый пароль!'));
            }
        }
    }

    /**
     * @return boolean
     */
    public function changePassword()
    {
        if ($this->validate()) {
            $students = $this->_students;
            $students->setPassword($this->newPassword);
            return $students->save();
        } else {
            return false;
        }
    }
}