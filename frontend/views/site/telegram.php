<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 13.08.2018
 * Time: 23:47
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Телеграм канал';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='fa fa-user-circle-o form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>
<style>.form-group button:hover{
        background-color: rgba(0, 0, 0, 0.45);
        -webkit-transition: all .3s;
        -moz-transition: all .3s;
        -ms-transition: all .3s;
        -o-transition: all .3s;
        transition: all .3s;
    }
    .form-group button{
        background-color: rgba(0, 0, 0, 0.25);
        width: 100%;
        -webkit-transition: all .3s;
        -moz-transition: all .3s;
        -ms-transition: all .3s;
        -o-transition: all .3s;
        transition: all .3s;
        border:none;
    }input[type="radio"], input[type="checkbox"]{
         margin:8px 0 0;
         margin-left: -20px;
         width: 18px;
         height: 17px;
     }.form-group label{
          font-size: 20px;
          font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
      }.login-logo a, .register-logo a{
           color:#E4E4E4;
       }.login-box-body, .register-box-body{
            background: rgba(255, 255, 255, 0.09);
            padding: 35px;
            border-top: 0;
            color: #FFF;
        }
    .login-box{
        width:  450px;
        padding: 0px 0 120px;
    }
    /*background-image: -webkit-linear-gradient(top left, rgb(60, 113, 167) 0%, rgb(54, 71, 92) 100%);*/
    body{
        background-color: #3c71a7;
        background: -moz-radial-gradient(center, ellipse cover, rgb(60, 113, 167) 0%, rgb(60, 113, 167) 7%, rgb(54, 71, 92) 100%) !important; /* ff3.6+ */
        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgb(60, 113, 167)), color-stop(7%, rgb(60, 113, 167)), color-stop(100%,  rgb(54, 71, 92))) !important; /* safari4+,chrome */
        background:-webkit-radial-gradient(center, ellipse cover, rgb(60, 113, 167) 0%, rgb(60, 113, 167) 7%, rgb(54, 71, 92) 100%) !important; /* safari5.1+,chrome10+ */
        background: -o-radial-gradient(center, ellipse cover, rgb(60, 113, 167) 0%, rgb(60, 113, 167) 7%, rgb(54, 71, 92) 100%) !important; /* opera 11.10+ */
        background: -ms-radial-gradient(center, ellipse cover, rgb(60, 113, 167) 0%, rgb(60, 113, 167) 7%, rgb(54, 71, 92) 100%) !important; /* ie10+ */
        background:radial-gradient(ellipse at center, rgb(60, 113, 167) 0%, rgb(60, 113, 167) 7%, rgb(54, 71, 92) 100%) !important; /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#968F7B', endColorstr='#222d32',GradientType=0 ); /* ie6-9 */
    height: 150%;
    }
    .form-group.has-success label {
        color: #06da79;
    }
</style>
<?php
$this->registerCssFile('/backend/web/css/globalEditStyle.css',
    ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerCssFile('/frontend/web/css/login.css',
    ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="section_elements_link_app">
    <div class="section_item section_item_1">
        <div class="item_block">
            <a href="<?= Yii::getAlias('/backend/site/login')?>">
                <img src="/gallery/teachers.jpg" alt="">
                <input type="button" value="Для преподавателей" class="btn btn-lg btn-success ">
            </a>
        </div>
    </div>
    <div class="section_item section_item_2">
        <div class="item_block">
            <a href="<?= Yii::getAlias('/frontend/web/student/login')?>">
                <img src="/gallery/students.jpg" alt="">
                <input type="button"  value="Для студентов" class="btn btn-lg btn-danger">
            </a>
        </div>
    </div>
</div>

<div class="login-box">
    <div class="login-logo">
        <a href="#">Телеграм канал <i class="fa fa-telegram" aria-hidden="true"></i></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>


        <div class="form-group">
            <?= Html::submitButton(' Проверка ключа ', ['class' => 'btn btn-lg btn-primary', 'name' => 'login-button', 'textButton'=>'вход']) ?>
        </div>


        <?php ActiveForm::end(); ?>

    </div>

    <br>
    <br>


