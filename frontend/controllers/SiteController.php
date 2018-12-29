<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 18.01.2018
 * Time: 14:46
 */

namespace frontend\controllers;


use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use yii\base\Controller;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use Yii;
use backend\models\User;
use common\models\userForm\PasswordResetRequest;
use common\models\userForm\ResetPassword;
use common\models\userForm\ChangePassword;

class SiteController extends Controller
{
    public $layout = 'site/site';
    /**
     * @inheritdoc
     */
    public function goHome()
    {
        return Yii::$app->getResponse()->redirect('index');
    }
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return Yii::$app->response->redirect('../student/login');
//        return $this->render('index');
    }

    public function actionStub()
    {
        return $this->render('stub');
    }

    public function actionTelegram()
    {

        return $this->render('telegram', [
        ]);

    }





}