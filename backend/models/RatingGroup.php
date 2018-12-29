<?php


namespace backend\models;

use backend\components\Customs;
use backend\components\GetUserInfo;
use Yii;
use backend\models\Students;



class RatingGroup extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'rating';
    }

    public function InsertStudent($group_id, $table_id, $valueData)
    {
        $Custom = new Customs();
        $RatingData = new RatingData();
        $student = new Students();
        $col_rating_id  = RatingData::getLastIdFromRatingData();
        $insertIdStudent = $student->findInGroupStudent($group_id);

    }
    public function InsertStudentToRatingGroup($group_id, $table_id)
    {
        $Custom = new Customs();
        $student = new Students();
        $col_rating_id  = RatingData::getLastIdFromRatingData();
        $insertIdStudent = $student->findInGroupStudent($group_id);
        foreach ($insertIdStudent AS $item) {
            static::_oneSave($item);
//            Yii::$app->db->createCommand("INSERT INTO `rating`
//    (`id`,`student_id`,`col_rating_id`,`subject_group_id`) VALUES ('',$item,$col_rating_id,$table_id)")->execute();
        }
    }
     private function _oneSave($data)
     {
         $this->id = $data['id'];
         $this->student_id = $data['student_id'];
         $this->col_rating_id = $data['col_rating_id'];
         $this->subject_group_id = $data['subject_group_id'];
         $this->insert();
         unset($this);
     }

    public function getStudents()
    {
        return $this->hasOne(Students::className(), ['id' => 'student_id']);
    }

    public function getData()
    {
        return $this->hasOne(RatingData::className(), ['id' => 'col_rating_id']);
    }

    public function getTheme()
    {
        return $this->hasOne(Themes::className(), ['id' => 'theme_id'])->via('data');
    }

    public function getSG()
    {
        return $this->hasMany(Group::className(), ['id' => 'subject_group_id']);
    }

    public function UpdateRating($idRating, $value)
    {
        $find = $this::findOne($idRating);
        if ($value != 'null') {
            $find->rating = $value;
        } else {
            $find->rating = null;
        }
        $find->save();
    }

    public static function convertForDBDate($date){
        $date = date("Y-m-d", strtotime($date));
        return $date;
    }
    public static function findDropDateToId($subjectGroupId)
    {
        return self::findBySql("SELECT `rating_data`.`id`,`rating_data`.`data` FROM `rating` left join rating_data on rating.col_rating_id = rating_data.id WHERE subject_group_id = $subjectGroupId group by rating_data.data")->all();
    }

    public static function getAllGroup($subjectGroupId)
    {
        return self::findBySql("SELECT  * FROM `rating` left join rating_data on rating.col_rating_id = rating_data.id  right join students on rating.student_id = students.id WHERE subject_group_id = $subjectGroupId group by students.full_name")->all();
    }

    public static function getGroupDate($subjectGroupId,$order = 0)
    {
        if($order == 0){
            return self::findBySql("SELECT * FROM `rating` left join rating_data on rating.col_rating_id = rating_data.id WHERE subject_group_id = $subjectGroupId group by rating_data.data ")->all();
        }
        elseif ($order == 1){
            return self::findBySql("SELECT * FROM `rating` left join rating_data on rating.col_rating_id = rating_data.id WHERE subject_group_id = $subjectGroupId group by rating_data.data DESC")->all();
        }
        return false;
    }

    public static function getGroupDateLimit($subjectGroupId, $limit)
    {
        return self::findBySql("SELECT * FROM `rating` left join rating_data on rating.col_rating_id = rating_data.id WHERE subject_group_id = $subjectGroupId group by rating_data.data ORDER BY rating_data.data DESC LIMIT $limit")->all();
    }

    public static function getGroupToBetweenSelectDate($subjectGroupId, $date1,$date2,$limit)
    {
        $date1 = static::convertForDBDate($date1);
        $date2 = static::convertForDBDate($date2);
        return self::findBySql("SELECT * FROM `rating` left join rating_data on rating.col_rating_id = rating_data.id WHERE subject_group_id = $subjectGroupId and rating_data.data >= '$date1' and rating_data.data <= '$date2'  group by rating_data.data ORDER BY rating_data.data DESC LIMIT $limit")->all();
    }

    public static function getFindDateAnalitycs($subjectGroupId,$date1,$date2)
    {
        return self::findBySql("SELECT * FROM `rating` left join rating_data on rating.col_rating_id = rating_data.id WHERE subject_group_id = $subjectGroupId and  rating_data.data BETWEEN  '$date1' AND  '$date2' group by rating_data.data")->all();
    }

    public static function getRatingFromDate($studentId, $dateId, $subjectGroupId)
    {
        $rat = self::findBySql("SELECT id, rating FROM `rating`WHERE subject_group_id = $subjectGroupId and rating.student_id=$studentId and rating.col_rating_id=$dateId")->all();  //TODO query - стринга с одной оценкой по дате и студенту
        return $rat;
    }

    public static function getRatingAnalitycs($studentId, $subjectGroupId, $date1, $date2)
    {
        $date1 = static::convertForDBDate($date1);
        $date2 = static::convertForDBDate($date2);
        $rat = self::findBySql("SELECT * FROM `rating` left join rating_data on rating.col_rating_id = rating_data.id WHERE subject_group_id = $subjectGroupId and rating.student_id=$studentId and rating_data.data BETWEEN  '$date1' AND  '$date2'")->all();
        return $rat;
    }

    public static function getStudentsRatings($studentId, $sb_id)
    {
        return $ratings = RatingGroup::find()->select('rating')->where(['subject_group_id' => $sb_id])->andWhere(['student_id'=>$studentId])->andWhere(['rating' => "н"])->count('rating');
    }

    public static function getStudentsRatingsToDate($studentId, $sb_id, $date1, $date2)
    {
        $date1 = static::convertForDBDate($date1);
        $date2 = static::convertForDBDate($date2);
        return $ratings = RatingGroup::find()->select('rating')->leftJoin('rating_data', 'rating.col_rating_id = rating_data.id')->where(['subject_group_id' => $sb_id])->andWhere(['student_id'=>$studentId])->andWhere(['BETWEEN','data',$date1,$date2])->andWhere(['rating' => "н"])->limit(1)->count('rating');
    }

    public static function insertToArrayDates($sb_id,$dates){
        $ratingArray = [];
        foreach ($dates as $date) {
            $date = strval($date);
            $ratings = RatingGroup::find()->select('rating')->leftJoin('rating_data', 'rating.col_rating_id = rating_data.id')->where(['subject_group_id' => $sb_id,'rating_data.data' => $date])->andWhere('not rating in ("н")')->average('rating');
            array_push($ratingArray, round($ratings, 2));
        }
        return $ratingArray;
    }

    public static function getAvgStudentsRatingsToDate($sb_id,$date1 ='',$date2='', $trueDate = 0)
    {
        // запрос на выборку средней оценки всех студентов по дате
        $ratingArray = [];
        if($trueDate == 0){
            if(intval($sb_id) != 0) {
                $classSelect = new SelectRating;
                $dates = $classSelect->getGraphDate($sb_id);
                $ratingArray = static::insertToArrayDates($sb_id,$dates);
            }
        }
        else if($trueDate == 1){
            if(intval($sb_id) != 0) {
                $classSelect = new SelectRating;
                $dates = $classSelect->getGraphSelectDateBetween($sb_id,$date1,$date2);
                $ratingArray = static::insertToArrayDates($sb_id,$dates);
            }
        }
        return $ratingArray;
    }

    public static function getCount2_5_ratingStudentsRatingsToDate($sb_id,$date1='',$date2='',$trueDate = 0)
    {
        // запрос на подсчёт количества разных оценок за последние даты
        $ratingArray = [];
        if(intval($sb_id) != 0) {
            $classSelect = new SelectRating;
            if($trueDate == 0){
                $dates = $classSelect->getGraphDateLimit($sb_id, 5);
            }
            else if($trueDate == 1){
                $dates = $classSelect->getGraphSelectDateBetween($sb_id, $date1,$date2,30);
            }

            $Rating = 1;
            $array = [];
            for ($k = 0; $k <= 4; $k++) {
                $Rating += 1;
                foreach ($dates as $date) {
                    if ($Rating == 6) {
                        $Rating = 'н';
                        $ratings = static::findCountRatingToDate($Rating, $sb_id, $date);
                        array_push($array, intval($ratings));
                    } else {
                        $ratings = static::findCountRatingToDate($Rating, $sb_id, $date);
                        array_push($array, intval($ratings));

                    }
                }
                array_push($ratingArray, $array);

                $array = [];
            }
        }
        return $ratingArray;
    }

    public static function findCountRatingToDate($Rating, $sb_id, $date)
    {
        $date = strval($date);
        return RatingGroup::find()->select('rating')->leftJoin('rating_data', 'rating.col_rating_id = rating_data.id')->where(['subject_group_id' => $sb_id, 'rating_data.data' => $date])->andWhere(['rating' => "$Rating"])->count('rating');
    }
    public static function findCountRatingAllTime($Rating, $sb_id)
    {
        return RatingGroup::find()->select('rating')->where(['subject_group_id' => $sb_id])->andWhere(['rating' => "$Rating"])->count('rating');
    }

    public static function getCount2_5_ratingStudentsRatingsAllTime($sb_id)
    {
        // запрос на подсчёт количества разных оценок за все даты
        $ratingArray = [];
        if(intval($sb_id) != 0) {
            $Rating = 1;
            for ($k = 0; $k <= 4; $k++) {
                $Rating += 1;
                if ($Rating == 6) {
                    $Rating = 'н';
                    $ratings = static::findCountRatingAllTime($Rating, $sb_id);
                    array_push($ratingArray, intval($ratings));
                } else {
                    $ratings = static::findCountRatingAllTime($Rating, $sb_id);
                    array_push($ratingArray, intval($ratings));

                }
            }
        }
        return $ratingArray;
    }
}
