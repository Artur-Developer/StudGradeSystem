<?php
namespace frontend\models;

use backend\models\Students;
use Yii;
use yii\base\Model;


/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;
    public $verifyCode;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['verifyCode', 'captcha'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\backend\models\Students',
                'filter' => ['status' => 'active'],
                'message' => 'Ваш аккаунт до сих пор не активирован или такого адреса электронной почты нет в базе!'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Подтвердите, что вы не робот',
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        $user = Students::findOne([
            'email' => $this->email,
            'status' => 'active',
        ]);

        if (!$user) {
            return false;
        }

        if (!Students::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetTokenStudent-html', 'text' => 'passwordResetTokenStudent-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Сброс пароля на сайте  ' . Yii::$app->name)
            ->send();
    }
}
