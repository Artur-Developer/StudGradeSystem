<?php
namespace backend\controllers;

use backend\components\Customs;
use backend\models\AllGroup;
use backend\models\RatingGroup;
use backend\models\SelectRating;
use backend\models\Group;
use backend\models\Students;
use backend\models\Subject;
use backend\models\Timetable;
use backend\models\User;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\GroupSearch;
use backend\models\Postbackend;

class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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

    public function actionIndex($day_week=0,$sb_id=0,$checkAllData=0,$date1=0,$date2=0)
    {
        $newGroup = new Group;
        $SelectRating = new SelectRating;
        ////////////////////////////////////////

        $limitPostIndex = Postbackend::find()->
        select('id, title, text, date, user_id,how_send')->
        orderBy('id DESC')->where(['not',['how_send'=>2]])->limit(1)->all();

        if (intval($sb_id) > 0) {
            if (Group::findOne($sb_id)->user_id == Yii::$app->user->id || Yii::$app->user->can('Firste_admin')) {
                ///////////////////////////////////////////////
                /////////////     Statistics     //////////////

                // Условие на проверку того, если стоит checkbox по умолчанию при выборке
                if (intval($sb_id) != 0 && $checkAllData == 1) {
                    $Rating = $SelectRating->getGraphRating($sb_id);
                    $AllDates = $SelectRating->getGraphDate($sb_id);

                    $CountRating2_5ToDate = RatingGroup::getCount2_5_ratingStudentsRatingsToDate($sb_id);
                    $CountRating2_5AllTime = RatingGroup::getCount2_5_ratingStudentsRatingsAllTime($sb_id);
                    $LimitDate3 = array_reverse($SelectRating->getGraphDateLimit($sb_id, 5));

                    $StudentAllSkip = $SelectRating->GetGraphStudentsAdSkip($sb_id);
                } else if (intval($sb_id) != 0 && $checkAllData == 0 &&
                    !empty(strval($date1)) && !empty(strval($date2)) && strval($date1) != strval($date2)
                ) {
                    $Rating = $SelectRating->GetCountRating2_5GraphRating($sb_id, $date1, $date2);
                    $AllDates = array_reverse($SelectRating->getGraphSelectDateBetween($sb_id, $date1, $date2));

                    $CountRating2_5ToDate = RatingGroup::getCount2_5_ratingStudentsRatingsToDate($sb_id, $date1, $date2, 1);
                    $CountRating2_5AllTime = RatingGroup::getCount2_5_ratingStudentsRatingsAllTime($sb_id);
                    $LimitDate3 = array_reverse($SelectRating->getGraphSelectDateBetween($sb_id, $date1, $date2));

                    $StudentAllSkip = $SelectRating->GetGraphStudentsAdSkip($sb_id, $date1, $date2, 1);

                }

                ////////////    #Statistics   ////////////////
                //////////////////////////////////////////////
            } else {
                Yii::$app->session->setFlash('danger', 'У вас нет прав на просмотр информации этой группы с оценками');
            }
        }


        $group = $SelectRating->selectAll();

//        SELECT  avg(`rating`), *  FROM `rating` left join rating_data on rating.col_rating_id = rating_data.id WHERE subject_group_id in(9,10,11) and rating.student_id=2 and rating_data.data BETWEEN  '2018.04.27' AND  '2018.04.28'

        $searchModel = new GroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pageSize'=>8];
        $time = date('H:i:s');

        return $this->render('index', ['time' => $time,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'limitPostIndex' => $limitPostIndex,
            'Rating' => $Rating,
            'Dates' => $AllDates,
            'LimitDate3' => $LimitDate3,
            'CountRating2_5Last5Date' => $CountRating2_5ToDate,
            'CountRating2_5AllTime' => $CountRating2_5AllTime,
            'GetStudentsAdSkip' => $StudentAllSkip,
            'group' => $group,
            'newGroup' => $newGroup,
            'dayWeek' => Customs::arrayDayWeek(),
        ]);
    }

    public function actionPrintTimeTable()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}