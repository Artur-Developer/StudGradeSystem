<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 28.01.2018
 * Time: 14:51
 */

namespace frontend\models;


use backend\models\RatingGroup;

class GetRatingStudent extends RatingGroup
{

    public static function getAllGroupSubject($subjectGroupId,$student_id)
    {
        return self::findBySql("SELECT  * FROM `rating` left join rating_data on rating.col_rating_id = rating_data.id  
        right join students on rating.student_id = students.id WHERE subject_group_id = $subjectGroupId
        and student_id = $student_id")->all();
    }

}