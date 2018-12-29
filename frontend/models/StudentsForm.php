<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 11.01.2018
 * Time: 13:50
 */

namespace frontend\models;

use backend\models\Students;
use backend\components\Customs;
use Yii;
use yii\base\Model;
use yii\base\NotSupportedException;


class StudentsForm extends Model
{
    public $password_hash;
    public $password_repeat;
    public $rememberMe = false;

    public function rules()
    {
        return [
            [['rememberMe','password_hash','password_repeat'], 'required','message' => 'Обязательно к заполнению!'],
            [['password_repeat','password_hash'],'string','min'=>8],
            [['password_repeat','password_hash'],'filter','filter'=>'trim'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password_hash'],
            ['rememberMe', 'boolean'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'password_hash' => 'Пароль',
            'password_repeat' => 'Проверка пароля',
            'rememberMe' => 'Согласен',
        ];
    }

    public function _SavePassword($id)
    {
        if ($this->validate()) {
            $find = Students::find()->where(['id'=>$id,'status'=>'inactive'])->one();
            $find->attributes = $this->attributes;
            $find->setPassword($this->password_hash);
            $find->generateResetStudentToken();
            $find->create_data = Customs::GetDate();
            $find->accountActivate();
            return $find->save();
        }
    }


}
