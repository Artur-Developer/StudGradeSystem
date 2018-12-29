<?php

namespace backend\controllers;

use backend\components\Customs;
use backend\models\Timetable;
use backend\models\User;
use backend\models\UserSubject;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
use yii\web\NotFoundHttpException;

class TimetableController extends \yii\web\Controller
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
                        'roles' => ['editor_timeTable','Firste_admin'],
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

//    public function actionIndex()
//    {
//        return $this->render('index', [
//        ]);
//    }

    public function actionEdit($type_week = 0, $kurs = 0,$sokr = 0,$sork_day = 0)
    {
        if($kurs == 0) {
            $groups = \backend\models\AllGroup::find()->all();
        }
        else{
            $groups = \backend\models\AllGroup::find()->andWhere(['like', 'name_group', $kurs.'%', false])->andWhere(['status'=>'active'])->all();
        }

        $arrayGroups = [];
        foreach ($groups as $group) {
            array_push($arrayGroups, ['id' => $group->id, 'name_group' => $group->name_group]);
        }
        $findSokrDay =  Timetable::find()->where(['type_week'=>$type_week])->andWhere(['day_week'=>$sork_day])->all();

            $model = new Timetable();
            if ($model->load(Yii::$app->request->post())) {
                if(!empty(Yii::$app->request->post('id_lesson'))){
                    $this->actionEditLesson(Yii::$app->request->post('id_lesson'),$type_week,$kurs);
                }
                else if(empty(Yii::$app->request->post('id_lesson'))){
                    $this->actionSaveNewLesson($type_week,$kurs);
                }
            }

        if($sokr == 1){
            Timetable::UpdateTypeDay($findSokrDay,1);
        }
        else if($sokr == 2){
            Timetable::UpdateTypeDay($findSokrDay,0);

        }

        return $this->render('edit', [
            'arrayDayWeek'=>Customs::arrayDayWeek(),
            'arrayLessonTime'=>Customs::arrayLessonTime(),
            'arrayLessonSokrTime'=>Customs::arrayLessonSokrTime(),
            'type_week'=>$type_week,
            'groups'=>$groups,
            'arrayGroups'=>$arrayGroups,
            'sokr'=>$sokr,
            'sork_day'=>$sork_day,
            'kurs'=>$kurs,
            'model'=> new Timetable(),
            'findSubject'=> Customs::GetListSubject(),
            'findAuditories'=> Customs::GetAuditories(),
        ]);
    }
    public function actionDeleteLessonData($id)
    {
    	return $this->findModel($id)->delete();
    }

    public function actionEditLesson($id,$type_week,$kurs)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->save_time = Customs::GetDate();
            $model->type_day = Yii::$app->request->post('type_day');
            if($model->save()) {
                return $this->redirect(['edit','type_week' => $type_week,'kurs' => $kurs]);
            }
        }
        else{

            if (Yii::$app->request->isAjax) {
                $arrayTeachers = [];
                $find = \backend\models\UserSubject::find()
                    ->where(['subject_id' => $model->subject_id])
                    ->all();
                foreach ($find as $value) {
                    $arrayTeachers[$value->user_id] = $value->user->last_name . ' ' . $value->user->first_name . ' ' . $value->user->middle_name;;
                }

                return $this->renderAjax('_form', [
                    'model' => $model,
                    'arrayTeachers' => $arrayTeachers,
                    'findSubject' => Customs::GetListSubject(),
                    'findAuditories' => Customs::GetAuditories(),
                ]);
            } else {
                return $this->redirect(['edit','type_week' => $type_week,'kurs' => $kurs]);
            }
        }

    }

    public function actionSaveNewLesson($type_week,$kurs)
    {

            $model = new Timetable();
            $request = Yii::$app->request;

            if ($model->load($request->post())) {
                $model->group_id = $request->post('group_id');
                $model->type_week = $request->post('type_week');
                $model->type_day = $request->post('type_day');
                $model->day_week = $request->post('day_week');
                $model->number_lesson = $request->post('number_lesson');
                $model->save_time = Customs::GetDate();
                if ($model->save()) {
                    return $this->redirect(['edit','type_week' => $type_week,'kurs' => $kurs]);
                }
            }

            if(Yii::$app->request->isAjax){
                return $this->renderAjax('_form', [
                    'model' => $model,
                    'arrayTeachers' => $arrayTeachers = [],
                    'findSubject' => Customs::GetListSubject(),
                    'findAuditories' => Customs::GetAuditories(),
                ]);
            } else {
                return $this->redirect(['edit','type_week' => $type_week,'kurs' => $kurs]);
            }

    }

    public function actionFindUserToSubject($id)
    {
        $countUserSubject = UserSubject::find()->where(['subject_id'=>$id])->count();
        if($countUserSubject > 0){
            $user = UserSubject::find()->where(['subject_id'=>$id])->all();
            echo "<option value=''>Нет...</option>";
            foreach ($user as $oneuser){
                $full_name = $oneuser->user->last_name . ' ' . $oneuser->user->first_name  . ' ' . $oneuser->user->middle_name;
                echo "<option value='".$oneuser->user_id."'>".$full_name."</option>";
            }
        }
        else{
            echo "<option> - </option>";
        }
    }

    protected function findModel($id)
    {
        if (($model = Timetable::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
