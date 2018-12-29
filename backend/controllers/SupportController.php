<?php

namespace backend\controllers;


use backend\components\Customs;
use common\models\SendMessageSupportForm;
use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class SupportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $SendForm = new SendMessageSupportForm();

        if($SendForm->load(Yii::$app->request->post()) && $SendForm->validate()){
            $user = $this->findModel();
            $fullName = $user->last_name.' ' .$user->first_name.' ' .$user->middle_name;
            if($SendForm->SendMessageError($fullName,$user->auth_key,'Преподаватель'))
            {
                Yii::$app->session->setFlash('success', 'Ваша заявка успешно отправлена');
                return $this->render('index');
            }
            else{
                Yii::$app->session->setFlash('danger', 'При отправке возникла ошибка');

            }
        }

        return $this->render('message', ['model'=>$SendForm]);
    }

    public function actionSendError()
    {
        return $this->render('index');
    }

    private function findModel()
    {
        return User::findOne(Yii::$app->user->identity->getId());
    }



}
