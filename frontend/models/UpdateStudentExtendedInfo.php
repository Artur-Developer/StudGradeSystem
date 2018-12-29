<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 27.01.2018
 * Time: 22:41
 */

namespace frontend\models;


use backend\models\Students;
use yii\base\Model;
use Yii;

class UpdateStudentExtendedInfo extends Model
{

    public $about_me;
    public $goals;


    private $_students;

    public function __construct(Students $students, $config = [])
    {
        $this->_students = $students;
        $this->about_me = $students->about_me;
        $this->goals = $students->goals;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['about_me', 'goals'], 'string', 'max' => 535],
        ];
    }

    public function attributeLabels()
    {
        return [
            'about_me' => Yii::t('app', 'Кратко о себе, что нравиться, чем живёте'),
            'goals' => Yii::t('app', 'Основные цели жизни'),
        ];
    }


    /**
     * @return boolean
     */
    public function SaveInfo()
    {
        if ($this->validate()) {
            $students = $this->_students;
            $students->about_me = $this->about_me;
            $students->goals = $this->goals;
            return $students->save();
        } else {
            return false;
        }
    }
}