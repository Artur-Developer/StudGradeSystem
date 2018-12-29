<?php

namespace backend\controllers;

use backend\models\User;
use backend\models\UserSubject;
use common\models\userForm\UpdateUserEmail;
use common\models\userForm\ChangePassword;
use Yii;
use yii\web\NotFoundHttpException;

class ProfileController extends \yii\web\Controller
{

    public function actionIndex()
    {
        return $this->render('index', [
            'model' => $this->findModel(),
            'userSubjectList' => $this->findUserSubject(),
        ]);
    }

    public function actionUpdateEmail()
    {
        $user = $this->findModel();
        $model = new UpdateUserEmail($user);

        if ($model->load(Yii::$app->request->post()) && $model->update()) {
            Yii::$app->session->setFlash('success', 'Email успешно изменён!');
            return $this->redirect(['index']);
        } else {
            return $this->render('update_email', [
                'model' => $model,
            ]);
        }
    }

    public function actionChangePassword()
    {
        $model = new ChangePassword();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->change()) {
            return $this->goHome();
        }

        return $this->render('change-password', [
            'model' => $model,
        ]);
    }
    
    public function actionForTeacherDownload($key) 
    {
	    if ($key == 2031806) {
	    	return Yii::$app->response->sendFile(Yii::getAlias('@backend/web/uploads/documentation/documentationForTeacher.docx'));
	    }
	    else{
	    	throw new NotFoundHttpException('Файл не найден!');
	    }
	    
	}
    
    private function findModel()
    {
        return User::findOne(Yii::$app->user->identity->getId());
    }

    protected function findUserSubject()
    {
        if (($model = UserSubject::find()->where(['user_id'=>$this->findModel()])->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
