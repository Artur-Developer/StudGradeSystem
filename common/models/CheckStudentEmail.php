<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 11.01.2018
 * Time: 23:08
 */

namespace common\models;


use backend\models\Students;
use yii\base\Model;

class CheckStudentEmail extends Model
{
    public $email;

    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'email'],
        ];
    }


    public function getStudentInfo($token)
    {
            if($this->validate()){
                $find = Students::checkByEmailAndToken($this->email,$token);
                if(!empty($find)){
                    foreach($find as $email){
                    }
                    if($email == 'active'){
                        $this->addError('email', 'Ваш аккаунт уже активирован!');
                        return false;
                    }
                    else if($email == 'inactive'){
                        return $find;
                    }
                    else{
                        $this->addError('email', 'Ошибка!');
                        return false;
                    }

                }
                else if(empty($find)){
                    $this->addError('email', 'Неправильный Email ! Проверьте правильность заполнения!');
                }
                else{
                    $this->addError('email', 'Ошибка!');
                }
            }
        }

}
