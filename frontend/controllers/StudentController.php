<?php
namespace frontend\controllers;

use backend\components\Customs;
use backend\models\Group;
use backend\models\GroupSearch;
use backend\models\Postbackend;
use backend\models\Students;
use common\models\CheckStudentEmail;
use frontend\models\GetSubjectGroup;
use common\models\LoginForm;
use common\models\UpdateStudentEmail;
use frontend\models\GetRatingStudent;
use frontend\models\StudentsForm;
use frontend\models\UpdateStudentExtendedInfo;
use frontend\models\UpdateStudentPassword;
use Yii;
use yii\base\InvalidParamException;
use yii\data\Pagination;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginFormStudent;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;


class StudentController extends Controller
{
    const  TITLE_PROFILE = 'Профиль';
    /**
     * @inheritdoc
     */
    public function goMain()
    {
        return Yii::$app->getResponse()->redirect('news');
    }
       
    public function goHome()
    {
        return Yii::$app->getResponse()->redirect('news');
    }
    
    public function goLogin()
    {
        return Yii::$app->getResponse()->redirect('login');
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['*'],
                'rules' => [
                    [
                        'actions' => ['login','activate-password',
                            'request-password-reset','reset-password'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => [],
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
    public $layout = '@frontend/views/layouts/adminka/main.php';

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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionNews()
    {
        $posts  = Postbackend::find()->select('id, title, text, date,  user_id, how_send')->where(['not',['how_send'=>1]])->orderBy('id DESC');
        $pages = new Pagination(['totalCount'=> $posts->count(), 'pageSize'=> 3,
            'pageSizeParam' =>  false, 'forcePageParam' => false]);
        $allPost2  = $posts->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('news', [
            'allPost2' => $allPost2,
            'pages' => $pages,
        ]);
    }
    
    public function actionDetailNews($id)
    {
    	 $findPost  = Postbackend::findOne($id);
         return $this->render('detailNews', [
                'DetailNews' => $findPost,
            ]);
    }
    
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginFormStudent();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->redirect('news');
        }
          else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
        return false;
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goLogin();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }
    public function actionProfile()
    {
        return $this->render('profile/profile', [
            'model' => $this->findModel(),
        ]);
    }

    public function actionUpdateEmail()
    {
        $student = $this->findModel();
        $model = new UpdateStudentEmail($student);

        if ($model->load(Yii::$app->request->post()) && $model->update()) {
            Yii::$app->session->setFlash('success', 'Email успешно изменён!');
            return $this->redirect(['profile']);
        } else {
            return $this->render('profile/update_email', [
                'model' => $model,
            ]);
        }
    }
    public function actionUpdatePassword()
    {
        $student = $this->findModel();
        $model = new UpdateStudentPassword($student);

        if ($model->load(Yii::$app->request->post()) && $model->changePassword()) {
            Yii::$app->session->setFlash('success', 'Пароль успешно изменён!');
            return $this->redirect(['profile']);
        } else {
            return $this->render('profile/update_password', [
                'model' => $model,
            ]);
        }
    }
    public function actionUpdateExtendedInfo()
    {
        $student = $this->findModel();
        $model = new UpdateStudentExtendedInfo($student);

        if ($model->load(Yii::$app->request->post()) && $model->SaveInfo()) {
            Yii::$app->session->setFlash('success', 'Информация успешно сохранена!');
            return $this->redirect(['profile']);
        } else {
            return $this->render('profile/update_extended_info', [
                'model' => $model,
            ]);
        }
    }
    public function actionRating()
    {
        $student_id = Yii::$app->user->id;
        $searchModel = new GetSubjectGroup();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('rating/select_form', [
            'model' => $this->findSubjectGroup(Yii::$app->user->identity->group_id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionTimeTable()
    {
        $student_id = Yii::$app->user->identity->group_id;


        return $this->render('timeTable', [
            'dayWeek' => Customs::arrayDayWeek(),
        ]);

    }

    protected function findSubjectGroup($group_id)
    {
        if (($model = Group::find()->where(['group_id'=>$group_id])->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Проверьте ваш email, мы отправили письмо с инструкцией.');
                return $this->render('@frontend/views/site/stub');
            } else {
                Yii::$app->session->setFlash('error', 'К сожалению, мы не можем сбросить пароль, обратитесь к администратору.');
                return $this->actionLogin();
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }


        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->getFlash('success', 'Пароль успешно сохранён!.');
            return $this->redirect('login');
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    
    public function actionActivatePassword($token)
    {

       if(!empty($token)){
           $findStudent = Students::find()->where(['student_token'=>$token])->andWhere(['status'=>'inactive'])->one();
           if(!empty($findStudent)) {
               $StudentsForm = new StudentsForm();
               $group = \backend\models\AllGroup::find()->where(['id' => $findStudent->group_id])->one();
               $POST = Yii::$app->request->post();
               if ($StudentsForm->load($POST)) {
                   if ($StudentsForm->_SavePassword($findStudent->id)) {
                       return $this->redirect('login');
                   }
               }
               return $this->render('_formUpdateInfoInStudent', [
                   'model' => $StudentsForm,
                   'info' => $findStudent,
                   'group' => $group,
               ]);
           }
           else{
               throw new NotFoundHttpException('Неправильный ключ доступа!');
           }
       }
       else{
           throw new NotFoundHttpException('Ключ отсутствует!');
       }
    }

    private function findModel()
    {
        return Students::findOne(Yii::$app->user->identity->getId());
    }
}
