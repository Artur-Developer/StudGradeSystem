<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 08.09.2017
 * Time: 14:32
 */

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


class Students extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'students';
    }

    public $password_repeat;
    const SCENARIO_PROFILE = 'profile';
    const ERROR_EMAIL_EXISTS = 'Указанный email уже существует!';

    public function rules()
    {
        return [
            [['email','last_name','first_name','middle_name','group_id','traing','status_training'], 'required'],
            ['email', 'email'],
            [
                'email',
                'unique',
                'targetClass' => Students::className(),
                'message' => \Yii::t('app', 'Указанный email уже используется!'),
            ],
            ['email', 'string', 'max' => 255],
            ['status_training', 'integer', 'max' => 1],
            [['last_name','first_name','middle_name'], 'string', 'min' => 3, 'max' => 50],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => AllGroup::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'last_name' => 'Фамилия',
            'first_name' => 'Имя',
            'middle_name' => 'Отчество',
            'Email' => 'Email',
            'password_hash' => 'Пароль',
            'password_repeat' => 'Проверка пароля',
            'traing' => 'Тип обучения',
            'status_training' => 'Статус обучения',
            'group_id' => 'Группа',
            'about_me' => 'О студенте',
            'goals' => 'Цели на будущее',
            'create_data' => 'Дата активации аккаунта',
            'status' => 'Статус',
        ];
    }
    public function create()
    {
        $optionsCript = [ // настройки шифрования
            'cost' => 8,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        ];
        if ($this->validate()) {
            $user = new Students();
            $user->group_id = $this->group_id;
            $user->last_name = $this->last_name;
            $user->first_name = $this->first_name;
            $user->middle_name = $this->middle_name;
            $user->email = $this->email;
            $user->traing = $this->traing;
            $user->status_training = $this->status_training;
            $hash = password_hash(date('m-Y-d H:i:s' . $this->last_name), PASSWORD_BCRYPT,$optionsCript);
            $this->student_token = $hash;
            if($this->save()){
            	return static::sendEmailActivate($this->last_name,$this->first_name,$this->middle_name,$this->email,$hash);
            }
            return true;
        } else {
            return false;
        }
    }
    public static function sendEmailActivate($last_name,$first_name,$middle_name,$email,$token)
    {
			return	Yii::$app->mailer->compose()
			        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name ])
			        ->setTo($email)
			        ->setSubject('Вы зарегистрированы в системе ' . Yii::$app->name)
			        ->setHtmlBody('Доброго времени суток '. $last_name . ' ' . $first_name .  ' ' . $middle_name .
			        '<br> Ваш email для входа в систему '. $email . '<br> Перейдите по ссылке чтобы активировать свой личный аккаунт. <br><a href="'.
			        Yii::$app->request->hostInfo.'/frontend/web/student/activate-password?token='.$token.'">Перейти к системе StudGradeSystem</a>')
			        ->send();
    }

    public function getGroup()
    {
        return $this->hasOne(AllGroup::className(), ['id' => 'group_id']);
    }

    public function getStudentsInGroup()
    {
        return $this->hasMany(RatingGroup::className(), ['student_id' => 'id']);
    }

    public function findInGroupStudent($group_id)
    {
        $a = $this::find()->select('id')->where(['group_id'=>$group_id])->all();
        foreach ($a as $b){
            $id[] = $b->id;
        }
        return $id;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            Yii::$app->session->setFlash('success', 'Запись добавлена');
        } else {
            Yii::$app->session->setFlash('success', 'Запись обновлена');
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                Yii::$app->session->setFlash('success', 'Запись добавлена!');
            } else {
                Yii::$app->session->setFlash('success', 'Запись обновлена!');
            }
            return true;
        } else {
            return false;
        }
    }

    public static function findStudentsAll($group_id)
    {
        return static::find()->where(['group_id'=>$group_id])->all();
    }

    public static function CheckImportStudents($last_name,$first_name,$middle_name,$email)
    {
        return static::find()->where(['last_name'=>$last_name,'first_name'=>$first_name,
            'middle_name'=>$middle_name,'email'=>$email,'status'=>'inactive'])->one();
    }
    
    public static function CheckImportStudentEmail($email)
    {
        return static::find()->where(['email'=>$email])->one();
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->student_token;
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => 'active']);
    }

    public static function checkByEmailAndToken($email,$token)
    {
        return static::findOne(['email' => $email,'student_token'=>$token]);
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        if(!empty($this->password_hash))
        {
            return Yii::$app->security->validatePassword($password, $this->password_hash);
        }
        else{
            return false;
        }
    }

    public function setPassword($password)
    {
       return $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    
    public function accountActivate()
    {
       return $this->status = 'active';
    }

    public function generateAuthKey()
    {
        $this->student_token = Yii::$app->security->generateRandomString();
    }
    
    public function generateResetStudentToken()
    {
        $this->student_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => 'active',
        ]);
    }

    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['student.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }
}