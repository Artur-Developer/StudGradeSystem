<?php

namespace common\models\userForm;

use Yii;
use backend\models\User;;
use yii\base\Model;


class ChangePassword extends Model
{
    public $oldPassword;
    public $newPassword;
    public $retypePassword;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oldPassword', 'newPassword', 'retypePassword'], 'required','message'=>'Это поле должно быть заполненно!'],
            [['oldPassword'], 'validatePassword'],
            [['newPassword'], 'string', 'min' => 8,'max'=>255],
            [['retypePassword'], 'compare', 'compareAttribute' => 'newPassword','message'=>'Пароли не совподают'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'oldPassword' => 'Текущий пароль',
            'newPassword' => 'Новый пароль',
            'retypePassword' => 'Проверка нового пароля',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     */
    public function validatePassword()
    {
        /* @var $user User */
        $user = Yii::$app->user->identity;
        if (!$user || !$user->validatePassword($this->oldPassword)) {
            $this->addError('oldPassword', 'Неверный текущий пароль');
        }
    }

    /**
     * Change password.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function change()
    {
        if ($this->validate()) {
            /* @var $user User */
            $user = Yii::$app->user->identity;
            $user->setPassword($this->newPassword);
            $user->generateAuthKey();
            if ($user->save()) {
                return true;
            }
        }

        return false;
    }
}
