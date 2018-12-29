<?php
/**
 * Created by PhpStorm.
 * User: Artur
 * Date: 03.08.2018
 * Time: 11:13
 */

namespace common\models\userForm;


use backend\models\User;
use yii\base\Model;

class UpdateUserInfo extends Model
{
    public $username;
    public $last_name;
    public $first_name;
    public $middle_name;
    public $email;
    public $password;
    public $password_repeat;

    public $_user;

    public function __construct(User $user, $config = [])
    {
        $this->_user = $user;
        $this->username = $user->username;
        $this->last_name = $user->last_name;
        $this->first_name = $user->first_name;
        $this->middle_name = $user->middle_name;
        $this->email = $user->email;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['email','username','last_name','first_name','middle_name'], 'required'],
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            [
                'username',
                'unique',
                'targetClass' => User::className(),
                'message' => \Yii::t('app', 'Указанный логин уже используется!'),
                'filter' => ['<>', 'id', $this->_user->id],
            ],
            ['username', 'string', 'min' => 2, 'max' => 255],
            [['last_name','first_name','middle_name'], 'string', 'min' => 3, 'max' => 25],

            ['email', 'email'],
            [
                'email',
                'unique',
                'targetClass' => User::className(),
                'message' => \Yii::t('app', 'Указанный email уже используется!'),
                'filter' => ['<>', 'id', $this->_user->id],
            ],
            ['email', 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'last_name' => 'Фамилия',
            'first_name' => 'Имя',
            'middle_name' => 'Отчество',
            'Email' => 'Email',
            'password' => 'Пароль',
            'password_repeat' => 'Проверка пароля',
        ];
    }

    public function update()
    {
        if ($this->validate()) {
            $user = $this->_user;
            $user->username = $this->username;
            $user->last_name = $this->last_name;
            $user->first_name = $this->first_name;
            $user->middle_name = $this->middle_name;
            $user->email = $this->email;
            return $user->save();
        } else {
            return false;
        }
    }
}