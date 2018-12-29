<?php

namespace frontend\controllers;

use common\models\userForm\PasswordResetRequest;
use common\models\userForm\ResetPassword;
use yii\web\Controller;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use Yii;

class TeatcherController extends Controller
{
	
	 public $layout = '@frontend/views/layouts/adminka/main';

    public function goHome()
    {
        return Yii::$app->getResponse()->redirect('index');
    }

    /**
     * Request reset password
     * @return string
     */

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequest();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Проверьте электронную почту для получения дальнейших инструкций.');
                return $this->render('@frontend/views/site/stub');
            } else {
                Yii::$app->getSession()->setFlash('error', 'Извините, мы не можем сбросить пароль для отправки по электронной почте.');
            }
        }

        return $this->render('@backend/views/user/requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {

        try {
            $model = new ResetPassword($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }


        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->getFlash('success', 'Пароль успешно сохранён!.');
            return Yii::$app->response->redirect(['../backend/web/site/login']);
        }

        return $this->render('@backend/views/user/resetPassword', [
            'model' => $model,
        ]);
    }

}
