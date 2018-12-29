<?php

namespace backend\controllers;

use backend\models\Group;
use backend\models\GroupSearch;
use backend\models\RatingGroup;
use backend\models\SelectRating;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;

class StatisticsController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['Prepod','Firste_admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex($sb_id=0,$checkAllData=0,$date1=0,$date2=0)
    {

        ///////////////////////////////////
        // Вывод статистики
        ///////////////////////////////////
        $newGroup = new Group();
        $SelectRating = new SelectRating();
        $group = $SelectRating->selectAll();
        $searchModel = new GroupSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pageSize'=>8];



            if (intval($sb_id) != 0 && $checkAllData == 1) {
                if (Group::findOne($sb_id)->user_id == Yii::$app->user->id || Yii::$app->user->can('Firste_admin')) {
                    $Rating = $SelectRating->getGraphRating($sb_id);
                    $AllDates = $SelectRating->getGraphDate($sb_id);

                    $CountRating2_5ToDate = RatingGroup::getCount2_5_ratingStudentsRatingsToDate($sb_id);
                    $CountRating2_5AllTime = RatingGroup::getCount2_5_ratingStudentsRatingsAllTime($sb_id);
                    $LimitDate3 = array_reverse($SelectRating->getGraphDateLimit($sb_id, 5));

                    $StudentAllSkip = $SelectRating->GetGraphStudentsAdSkip($sb_id);

                } else {
                    Yii::$app->session->setFlash('danger', 'У вас нет прав на просмотр информации этой группы с оценками');
                }
            }
            else if (intval($sb_id) != 0 && $checkAllData == 0 &&
                !empty(strval($date1)) && !empty(strval($date2)) && strval($date1) != strval($date2))
            {
                if (Group::findOne($sb_id)->user_id == Yii::$app->user->id || Yii::$app->user->can('Firste_admin')) {
                    $Rating = $SelectRating->GetCountRating2_5GraphRating($sb_id, $date1, $date2);
                    $AllDates = array_reverse($SelectRating->getGraphSelectDateBetween($sb_id, $date1, $date2));

                    $CountRating2_5ToDate = RatingGroup::getCount2_5_ratingStudentsRatingsToDate($sb_id, $date1, $date2, 1);
                    $CountRating2_5AllTime = RatingGroup::getCount2_5_ratingStudentsRatingsAllTime($sb_id);
                    $LimitDate3 = array_reverse($SelectRating->getGraphSelectDateBetween($sb_id, $date1, $date2));

                    $StudentAllSkip = $SelectRating->GetGraphStudentsAdSkip($sb_id, $date1, $date2, 1);
                }
                else {
                    Yii::$app->session->setFlash('danger', 'У вас нет прав на просмотр информации этой группы с оценками');
                }
            }


            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'Rating' => $Rating,
                'Dates' => $AllDates,
                'LimitDate3' => $LimitDate3,
                'CountRating2_5Last5Date' => $CountRating2_5ToDate,
                'CountRating2_5AllTime' => $CountRating2_5AllTime,
                'GetStudentsAdSkip' => $StudentAllSkip,
                'group' => $group,
                'newGroup' => $newGroup,
            ]);



    }


}
