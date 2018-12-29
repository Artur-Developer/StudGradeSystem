<?php
namespace common\models\userForm;

use Yii;
use backend\models\User;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequest extends Model
{
    public $email;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['verifyCode', 'captcha'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => 'backend\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'Нет пользователя с таким адресом электронной почты.'
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
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if ($user) {
            if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
            }

            if ($user->save()) {
                return Yii::$app->mailer->compose(['html' => 'passwordResetTokenTeacher-html', 'text' => 'passwordResetTokenTeacher-text'], ['user' => $user])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                    ->setTo($this->email)
                    ->setSubject('Сброс пароля на сайте ' . Yii::$app->name)
                    ->send();
            }
        }

        return false;
    }
}
