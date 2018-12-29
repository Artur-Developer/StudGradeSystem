<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 09.09.2017
 * Time: 15:25
 */

namespace backend\components;
use Yii;

class GetUserInfo
{
    public function getFullName()
    {
        $a = Yii::$app->user->identity->first_name;
        $b = Yii::$app->user->identity->last_name;
        $c = Yii::$app->user->identity->middle_name;
        return $b." ".$a." ".$c;
    }
    public function userId()
    {
       return  Yii::$app->user->id;
    }
    public function dataTime()
    {
        return date('Y-m-d>H:i:s');
    }
    public function date()
    {
        return date("d.m.Y");
    }
    public function infoIdGroup($class){
        $table = $class->tableName();
        $lastId = Yii::$app->db->createCommand("SELECT `id` FROM `$table` ORDER BY `id` DESC LIMIT 1")->queryScalar();
        return $lastId;
    }

}
