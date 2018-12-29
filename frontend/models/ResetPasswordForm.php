<?php
namespace frontend\models;

use backend\models\Students;
use yii\base\Model;
use yii\base\InvalidParamException;
use common\models\User;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $password_d;

    private $_students;


    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('Ключ сброса пароля не может быть пустым.');
        }
        $this->_students = Students::findByPasswordResetToken($token);
        if (!$this->_students) {
            throw new InvalidParamException('Неверный ключ сброса пароля.');
        }
        parent::__construct($config);
    }


    public function rules()
    {
        return [
            [['password','password_d', ],'required','message'=>'Это поле должно быть заполненно!'],
            [['password','password_d'],'string','min'=>8,'max'=>255],
            ['password_d','compare', 'compareAttribute' => 'password','message'=>'Пароли не совподают']
        ];
    }
    public function attributeLabels()
    {
        return [
            'password' => 'Пароль',
            'password_d' => 'Проверка пароля',
        ];
    }

    public function resetPassword()
    {
        $user = $this->_students;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        return $user->save(false);
    }
}
