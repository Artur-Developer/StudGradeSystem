<?php
/**
 * Created by PhpStorm.
 * User: Artur
 * Date: 03.08.2018
 * Time: 15:23
 */

namespace common\models;

use backend\models\AllGroup;
use backend\models\Students;
use yii\base\Model;
use Yii;

class UpdateStudentInfo extends Model
{

    public $id;
    public $group_id;
    public $last_name;
    public $first_name;
    public $middle_name;
    public $email;
    public $traing;
    public $status_training;
    public $password;
    public $password_repeat;

    public $_student;

    public function __construct(Students $user, $config = [])
    {
        $this->_student = $user;
        $this->last_name = $user->last_name;
        $this->first_name = $user->first_name;
        $this->middle_name = $user->middle_name;
        $this->email = $user->email;
        $this->group_id = $user->group_id;
        $this->traing = $user->traing;
        $this->status_training = $user->status_training;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['email','last_name','first_name','middle_name','group_id','traing','status_training'], 'required'],
            [['last_name','first_name','middle_name'], 'string', 'min' => 3, 'max' => 50],

            ['email', 'email'],
            [
                'email',
                'unique',
                'targetClass' => Students::className(),
                'message' => \Yii::t('app', 'Указанный email уже используется!'),
                'filter' => ['<>', 'id', $this->_student->id],
            ],
            ['email', 'string', 'max' => 255],
            ['status_training', 'integer', 'max' => 1],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => AllGroup::className(), 'targetAttribute' => ['group_id' => 'id']],

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
            'traing' => 'Тип обучения',
            'status_training' => 'Статус обучения',
            'group_id' => 'Группа',
            'password' => 'Пароль',
            'password_repeat' => 'Проверка пароля',
        ];
    }

    public function update()
    {
        $optionsCript = [ // настройки шифрования
            'cost' => 8,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        ];
        if ($this->validate()) {
            $user = $this->_student;
            $user->group_id = $this->group_id;
            $user->last_name = $this->last_name;
            $user->first_name = $this->first_name;
            $user->middle_name = $this->middle_name;
            $user->email = $this->email;
            $user->traing = $this->traing;
            $user->status_training = $this->status_training;
            $hash = password_hash(date('m-Y-d H:i:s' . $this->last_name), PASSWORD_BCRYPT,$optionsCript);
//            $user->student_token = $hash;
//            $this->sendEmailActivate($this->email,$hash);
            return $user->save();
        } else {
            return false;
        }
    }
    public function sendEmailActivate($email,$token){
        return Yii::$app->mailer->compose()
            ->setFrom($email)
            ->setTo($email)
            ->setSubject('Тема сообщения')
            ->setTextBody('Текст сообщения')
            ->setHtmlBody('<a href="http://studgradesystem.com/frontend/web/student/activate-password?token='. $token .'>http://studgradesystem.com/backend/web/students/activate-password</a>')
            ->send();
    }
}