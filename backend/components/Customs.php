<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 30.10.2017
 * Time: 11:33
 */

namespace backend\components;

use backend\models\Auditories;
use backend\models\RatingGroup;
use backend\models\UserSubject;
use Yii;
use backend\models\Group;
use backend\models\AllGroup;
use backend\models\Subject;
use yii\helpers\Url;


class Customs
{
	public static function getDsnAttribute($name, $dsn)
    {
        if (preg_match('/' . $name . '=([^;]*)/', $dsn, $match)) {
            echo $match[1];
        } else {
            return false;
        }
    }
    
      public static function GetListSubject()
    {
        $subject = new Subject();
        return $subject->findSubjectAll();
    }

    public static function GetListSubjectUserId()
    {
        return Subject::findSubjectAllForTeacher(Yii::$app->user->id);
    }

    public static function GetListAllGroup(){
        $subject = new AllGroup();
        return $subject->findGroupAll();
    }

    public static function GetAuditories(){
        $subject = new Auditories();
        return $subject->findAuditories();
    }

    public static function GetDate(){
        return date('Y-m-d H:i:s');
    }

    public static function GetUserId(){
        return \Yii::$app->user->id;
    }

    public static function GetProjectName(){
        $url = Url::home('http');
        $url2  = substr($url,strpos($url, '//')+2);
        $url3  = substr($url2,0,(strpos($url2, '/')));
        return $url3;
    }

    public static function GetKeyMessage(){
        $url = Url::home('http');
        $url2  = substr($url,strpos($url, '//')+2);
        $url3  = substr($url2,0,(strpos($url2, '/')));
        return $url3;
    }

    public static function GetUserFullName(){
        $a = Yii::$app->user->identity->first_name;
        $b = Yii::$app->user->identity->last_name;
        $c = Yii::$app->user->identity->middle_name;
        return $b." ".$a." ".$c;
    }
    public static function  obrizanieTexta($posts, $simvolov){
        $posts = strip_tags($posts);
        $posts = substr($posts, 0, $simvolov);
        $posts = rtrim($posts, "!,.-");
        echo $posts . "… ";
    }

    public static function  resuctionInitials($string){
        $thisChar = mb_substr($string, 0, 1);
        $lastChar = $thisChar;
        return $lastChar . '. ';
    }

    public static function  resuctionLongString($string,$skolko_str){
        $arr = explode(' ',$string);
        foreach ($arr as $key=>$value)
        {
            mb_internal_encoding("UTF-8");
            $arr["$key"] = (mb_substr(trim($value),0,$skolko_str));
        }
        echo  implode('. ',$arr).'. ';
    }

    public static function arrayDayWeek(){
        return $day_week = ['ПН','ВТ','СР','ЧТ','ПТ','СБ'];
    }

    public static function arrayLessonTime(){
        return $lessonTime = ['08:00 - 09:30','09:50 - 11:20','11:30 - 13:00','13:30 - 15:00','13:20 - 14:50','15:00 — 16:30','16:40 — 18:10'];
    }

    public static function arrayLessonSokrTime(){
        return $lessonTime = ['08:00 - 09:00','09:10 - 10:10','10:20 - 11:20','11:30 - 12:40','12:40 - 13:40','14:40 — 15:40','17:00 — 17:50'];
    }

    public static function TodayNumberDayWeek(){

        $numberDayWeek = date("w", mktime(0,0,0,date("m"),date("d"),date("Y")));
        if($numberDayWeek == 0){
            return $numberDayWeek;
        }
        return $numberDayWeek -1;
    }
    public static function getBitChotnostyWeek(){
        $curr = date_create_from_format('d.m.Y', date('d.m.Y'));
        $base = date_create_from_format('d.m.Y', '01.09.2018');

        $weeks = date_format($curr, 'W') - date_format($base, 'W') ;

        $weeks = ( $weeks < 0 ) ? $weeks + 52 : $weeks ;
        $w = array(0,1);
        $week = $w[$weeks % 2];
        return $week;
    }
    public static function getChotnostyWeek()
    {
        if(static::getBitChotnostyWeek() == 0){
            return "Синяя";
        }
        else if(static::getBitChotnostyWeek() == 1){
            return "Зелёная";
        }
        return true;
    }

}