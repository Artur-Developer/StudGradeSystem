<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;


class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_d;

    public function rules()
    {
        return [
            [['email','login','password','password_d'],'required','message'=>'Это поле должно быть заполненно!'],
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Такой username уже зарегистрирован!.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Такой Email уже зарегистрирован!.'],

            ['password', 'required'],
            ['password_d', 'required'],
            [['password','password_d'],'string','min'=>5,'max'=>255],
            ['password_d','compare', 'compareAttribute' => 'password','message'=>'Пароли не совподают']
        ];
    }
    public function signup()
    {

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}
