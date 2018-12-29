<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 13.10.2017
 * Time: 19:17
 */

namespace backend\models;
use Yii;

class SelectRating extends \yii\db\ActiveRecord
{
    public function GetGraphRating($sb_id)
    {
        //Выводит Среднее значение по всем студентам по каждой дате и по sb_id
        $Rating = ['id'=>['name' => [],
            'data' => []
        ]];
        if(intval($sb_id) != 0){
            $getGroupId = Group::findOne($sb_id);
            $Rating ['data'][] =
                ['name' => $getGroupId->group->name_group . ' - ' . $getGroupId->subject->name_subject,
                'data' => RatingGroup::getAvgStudentsRatingsToDate($sb_id),
            ];
        }
        return $Rating;
    }
    public function GetCountRating2_5GraphRating($sb_id,$date1,$date2)
    {
        //Выводит количество всех оценоки и пропусков по дате и по sb_id
        $Rating = ['id'=>['name' => [],
            'data' => []
        ]];
        if(intval($sb_id) != 0){
            $getGroupId = Group::findOne($sb_id);
            $Rating ['data'][] =
                ['name' => $getGroupId->group->name_group . ' - ' . $getGroupId->subject->name_subject,
                'data' => RatingGroup::getAvgStudentsRatingsToDate($sb_id,$date1,$date2,1),
            ];
        }
        return $Rating;
    }
    //SELECT AVG(`rating`) FROM `rating` left join rating_data on rating.col_rating_id = rating_data.id WHERE subject_group_id = 9  and rating_data.data = '2018.04.25' and  not rating in ('н')
    public function GetGraphStudentsAdSkip($sb_id,$date1='',$date2='',$trueDate = 0)
    {
        //Выводит количество пропусков каждого студента за всё время по sb_id
        $Rating = [];
        if(intval($sb_id) != 0) {
            $getGroupId = Group::findOne($sb_id);
            $findStudentsRating = Students::findStudentsAll($getGroupId->group_id);
            if($trueDate == 0) {
                foreach ($findStudentsRating as $student) {
                    $Rating ['data'][] =
                        [$student['last_name'] . ' ' . $student['first_name'],
                            intval(RatingGroup::getStudentsRatings($student['id'], $sb_id)),
                        ];
                }
            }

            else if($trueDate == 1){
                foreach ($findStudentsRating as $student) {
                    $Rating ['data'][] =
                        [$student['last_name'] . ' ' . $student['first_name'],
                            intval(RatingGroup::getStudentsRatingsToDate($student['id'], $sb_id,$date1,$date2)),
                        ];
                }
            }
        }
        return $Rating;
    }

    public function insertToArrayDate($dates)
    {
        // Запись выбранных даты в массив
        $datesArray = [];
        if($dates && !empty($dates)){
            if($dates) {
                foreach ($dates as $data) {
                    array_push($datesArray, $data->data->data);
                }
            }
        }
        return $datesArray;
    }

    public function getGraphDate($sb_id)
    {
        // Выборка всех доступных дат
        $datesArray =[];
        $dates = RatingGroup::getGroupDate($sb_id);
        if($dates && !empty($dates)){
            $datesArray = $this->insertToArrayDate($dates);
        }
        return $datesArray;
    }

    public function getGraphDateLimit($sb_id,$limit)
    {
        // Выборка определённого колличества последних дат
        $dates = RatingGroup::getGroupDateLimit($sb_id,$limit);
                $datesArray = $this->insertToArrayDate($dates);
        return $datesArray;
    }
    public function getGraphSelectDateBetween($sb_id,$date1,$date2,$limit = 30)
    {
        // Выборка по выбранному диапазону дат
        $dates = RatingGroup::getGroupToBetweenSelectDate($sb_id,$date1,$date2,$limit);
        $datesArray = $this->insertToArrayDate($dates);
        return $datesArray;
    }

    public function selectAll()
    {
        if (!Yii::$app->user->isGuest &&
            Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())
            ['Firste_admin']->name == 'Firste_admin')
        {
            $query = Group::find()->all();
            return $query;
        }

        else if (!Yii::$app->user->isGuest &&
            Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())
            ['Prepod']->name == 'Prepod'){
            $a = Yii::$app->user->id;
            $query = Group::find()->where(['user_id' => $a ])->all();
            return $query;
        }

    }
}