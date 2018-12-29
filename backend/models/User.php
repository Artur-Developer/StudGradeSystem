<?php

namespace backend\models;

use backend\models\Group;
use backend\models\Postbackend;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use mdm\admin\components\Configs;

/**
 * extends User model
 *
*/
class User extends \common\models\User
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 10;

    public  function getUserId()
    {
        return $this->hasOne(Group::className(), ['user_id' => 'id']);
    }

    public  function getUserpostId()
    {
        return $this->hasMany(Postbackend::className(), ['user_id' => 'id']);
    }

    public  function getUserSubject()
    {
        return $this->hasMany(UserSubject::className(), ['user_id' => 'id']);
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }


    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
        ];
    }

}
