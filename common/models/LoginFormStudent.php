<?php
namespace common\models;

use backend\models\Students;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginFormStudent extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
        ];
    }

    public function validatePassword($attribute, $params)
    {

        if (!$this->hasErrors()) {
            $user = $this->getUser();
            // проверка email на статус активации
            if(!$user){
                $this->addError($attribute, 'Ваш аккаунт есть в базе, но он не активирован!
                     Письмо активации было выслано вам на email.
                     Если письма нет, обратитесь к администратору!');
            }
            else if (!$user->validatePassword($this->password))
            {
                $this->addError($attribute, 'Неправильно введены данные! Повторите попытку');
            }

        }
    }

    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Students::findByEmail($this->email);
        }

        return $this->_user;
    }



}
