<?php

namespace common\models\userForm;

use backend\models\Students;
use Yii;
use backend\models\User;
use yii\base\InvalidParamException;
use yii\base\Model;

/**
 * Password reset form
 */
class ResetPassword extends Model
{
    public $password;
    public $password_d;
    /**
     * @var User
     */
    private $_user;

    /**
     * Creates a form model given a token.
     *
     * @param  string $token
     * @param  array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('Ключ не может быть пустым.');
        }
        $this->_user = User::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidParamException('Неверный ключ сброса пароля.');
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
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

    /**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        return $user->save(false);
    }
}
