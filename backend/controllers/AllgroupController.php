<?php

namespace backend\controllers;

use Yii;
use backend\models\ImportExcelFile;
use backend\models\Students;
use backend\models\AllGroup;
use backend\models\AllGroupSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use backend\components\GetUserInfo;
use yii\swiftmailer\Mailer;
use mdm\admin\models\User;


class AllgroupController extends Controller
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
        $searchModel = new AllGroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionCreate()
    {
        $group = new AllGroup();
        $model = new ImportExcelFile();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                $inputFile = 'uploads/'.$model->imageFile->baseName.'.xlsx';
                try{
                    $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
                    $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFile);
                }
                catch(Exception $e){
                    die('Ошибка');
                }

                $sheet = $objPHPExcel->getSheet(0);
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                $count = 0;
                $arrayErrorCheckEmail = [];
                for($row = 0; $row<=$highestRow; $row++) {
                    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, Null, True, False);
                    if ($row == 0) {
                        continue;
                    }
                    for ($i=0;$i<=4;$i++){

                        if(empty($rowData[0][$i])){ // Проверка на пустое значение обязательных полей
                            throw new ForbiddenHttpException('При импорте файла возникла ошибка. Скорее всего в файле присутсвуют пустые ячейки. Заполните их!');
                        }
                        else if(!empty($rowData[0][$i])){
                            continue;
                        }
                    }
                    
                    // проверка на совпадение в базе Email адресов
                    $checkEmail = Students::CheckImportStudentEmail($rowData[0][4]);
						if(!empty($checkEmail)){
	                    	throw new ForbiddenHttpException('При импорте файла возникла ошибка. При сохранении данных (' .
	                    	$rowData[0][0] . ' ' . $rowData[0][1] . ' ' . $rowData[0][2] . 
	                    	') Email: ' . $rowData[0][4] . ' уже привязан к ' .
	                    	$checkEmail->last_name . ' ' . $checkEmail->first_name . ' ' . $checkEmail->middle_name) ;
	                    }
	                    else{
	                        continue;
	                    }
	                ////////////////////////////////////////////////////////////////////////////////////////////////
					
                    $z = Students::CheckImportStudents($rowData[0][0],$rowData[0][1],$rowData[0][2],$rowData[0][4]);
                    
                    // проверка на совпадение в базе импортируемых студентов
                    if(!empty($z)){
                        $count += 1; // считаем совпадения
                    }
                    else{
                        continue;
                    }
                }
                if($count < 1) { // если нет сопадений по студентам
                    $checkPostImportFile = $model->CheckImportFile($model->imageFile->baseName);
                    if (empty($checkPostImportFile)) { //проверка дубликата файла импорта

                        $transaction = Yii::$app->db->beginTransaction(); // объявление транзакции

                        $model->InsertData(); // создаём запись импортируемого файла
                        $model->CreateGroupData(); // создаём запись группы

                        $optionsCript = [ // настройки шифрования
                            'cost' => 8,
                            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
                        ];
                        $emailStudents = [];

                        for ($row = 0; $row <= $highestRow; $row++) {
                            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, Null, True, False);
                            if ($row == 0) {
                                continue;
                            }
                            $hash = password_hash(date('m-Y-d H:i:s' . $rowData[0][0]), PASSWORD_BCRYPT,$optionsCript);
                            // считывание с файла и записываем в базу
                            $student = new Students();
                            $GetUserInfo = new GetUserInfo();
                            $student->last_name = $rowData[0][0];
                            $student->first_name = $rowData[0][1];
                            $student->middle_name = $rowData[0][2];
                            $student->traing = $rowData[0][3];
                            $student->email = $rowData[0][4];
                            $student->status_training = 1;
                            $student->student_token = $hash;
                            $student->group_id = AllGroup::getLastIdFromGroup();
                            if($student->save()){
                            	array_push($emailStudents, [
                            		'last_name'=>$rowData[0][0],
                            		'first_name'=>$rowData[0][1],
                            		'middle_name'=>$rowData[0][2],
                            		'email'=>$rowData[0][4],
                            		'token'=>$hash]); // сохраняем email
                            }
                            else{
                            	throw new ForbiddenHttpException('При импорте файла возникла ошибка. Скорее всего в файле Email: ' . $rowData[0][4] . ' несколько раз  повторяется или уже существует в базе!');
                            }

                        }
                        if ($student->save()) {
                        	
                        	$messages = [];
							foreach ($emailStudents as $student) {
							    $messages[] = 
							        Yii::$app->mailer->compose()
				                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name ])
				                    ->setTo($student['email'])
				                    ->setSubject('Вы зарегистрированы в системе ' . Yii::$app->name)
				                    ->setHtmlBody('Доброго времени суток '. $student['last_name'] . ' ' . $student['first_name'] .  ' ' . $student['middle_name'] .
				                    '<br> Ваш email для входа в систему '. $student['email'] . '<br> Перейдите по ссылке чтобы активировать свой личный аккаунт. <br><a href="'.
				                    Yii::$app->request->hostInfo.'/frontend/web/student/activate-password?token='.$student['token'].'">Перейти к системе StudGradeSystem</a>');
							}
							Yii::$app->mailer->sendMultiple($messages);

                            // если сохранение и отправка писем прошла без ошибок, то коммитим транзакцию
                            $transaction->commit(); // выполняем транзакцию
                            return $this->redirect(['create']);
                        }
                        else
                            {
                            // если хоть одно из сохранений не удалось, то откатываемся
                            $transaction->rollback();
                            throw new ForbiddenHttpException('При импорте файла возникла ошибка. Скорее всего данные с файла не удалось записать в базу');
                        }
                    }
                    else {
                        throw new ForbiddenHttpException('При импорте файла возникла ошибка. Скорее всего файл с таким именем уже импортирован ранее!');
                    }
                }
                else{
                    throw new ForbiddenHttpException("При импорте студентов возникла ошибка!
                    Скорее всего вы импортируете дублирующие данные. 
                    Были найдены совпадения данных а базе. Найдено совпадений($count)");
                }
            }

            else{
                throw new ForbiddenHttpException('При импорте файла возникла ошибка. Скорее всего файл с таким именем уже импортирован ранее!');
            }
        }
        return $this->render('create', ['model' => $model]);
    }





    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    public function actionDelete($id)
    {
    	$deleteFileId = $this->findModel($id);
        $find = ImportExcelFile::findOne($deleteFileId->importFile_id);
        $file = 'uploads/group/' . $find->fileName . $find->fileExtensions;
        if(file_exists($file)){
            unlink($file);
        }
        $find->delete();

        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = AllGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
