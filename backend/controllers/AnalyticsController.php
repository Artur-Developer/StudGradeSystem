<?php

namespace backend\controllers;

use backend\components\GetUserInfo;
use backend\components\Customs;
use backend\models\AllGroup;
use backend\models\getHasInfo;
use backend\models\Students;
use backend\models\Subject;
use Yii;
use backend\models\RatingGroup;
use backend\models\RatingData;
use backend\models\Group;
use backend\models\GroupSearch;
use yii\db\Query;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class AnalyticsController extends Controller
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
                        'allow' => true,
                        'roles' => ['Firste_admin'],
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

    public function actionIndex()
    {
        $AllGroup = new AllGroup();
        $GetAllGroup = $AllGroup->findGroupAll();
        $GetAllStudent = Students::find()->all();
        $date = date('d.m.Y');
        $rating = new RatingGroup;
        $model = new Group();
        $request = Yii::$app->request;



        if($request->post('toGroup') && $request->post('date1') && $request->post('date2'))
        {
            $group_id = $request->post('toGroup');
            $date1 = $request->post('date1');
            $date2 = $request->post('date2');
        }

         if($request->post('StudentFindRating') &&  $request->post('analytincsToStudent')
            && $request->post('date1') && $request->post('date2'))
         {
            $StudentFindRating = $request->post('StudentFindRating');
            $date1 = $request->post('date1');
            $date2 = $request->post('date2');
             $studentGroup = Students::findOne($StudentFindRating);
        }


        return $this->render('index',[
                'varRating'=>$rating,
                'date1'=>$date1,
                'date2'=>$date2,
                'group_id'=>$group_id,
                'StudentFindRating'=>$StudentFindRating,
                'studentGroup'=>$studentGroup,
                'model' => $this->findModel($group_id),
                'modelStudentGroup' => $this->findModel($studentGroup->group_id),
                'GetAllGroup' => $GetAllGroup,
                'GetAllStudent' => $GetAllStudent,
                'getTableId' => $this->findModel($group_id),
                'popupDefaultDate' => $date
            ]
        );
    }
    public function actionInformedgroup()
    {
        return $this->render('informedgroup');
    }

    public function actionSelectStudent($q = null)
    {
        $query = new Query();
        $query->select('name_group')
            ->from('all_group')
            ->leftJoin('students', 'students.group_id = all_group.id')
            ->addSelect('students.id')
            ->addSelect('students.last_name')
            ->addSelect('students.first_name')
            ->addSelect('students.middle_name')
            ->where('students.last_name LIKE "' . $q .'%"');

        $command = $query->createCommand();
        $data = $command->queryAll();
        $out = [];
        foreach ($data as $d) {
            $out[] = [
                'full_name'=>$d['last_name']
                    . ' ' . $d['first_name']
                    . ' ' . $d['middle_name']
                    . ' ' . $d['id'],
                'group'=> $d['name_group'],
            ];
        }
        echo Json::encode($out);
    }

    protected function findModel($id)
    {
        if (($model = Group::find()->where(['group_id'=>$id])->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
