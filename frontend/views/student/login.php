

<!-- *******************************************-->

<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Вход в систему';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='fa fa-user-circle-o form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>
<style>
.form-group button:hover{
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
.login-page, .register-page{
background-color: #5f515f;
        background: -moz-radial-gradient(center, ellipse cover, rgb(127, 123, 150) 0%, rgb(128, 123, 150) 7%, rgb(28, 74, 88) 100%) !important; /* ff3.6+ */
        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgb(127, 123, 150)), color-stop(7%, rgb(128, 123, 150)), color-stop(100%,  rgb(28, 74, 88))) !important; /* safari4+,chrome */
        background:-webkit-radial-gradient(center, ellipse cover, rgb(127, 123, 150) 0%, rgb(128, 123, 150) 7%, rgb(28, 74, 88) 100%) !important; /* safari5.1+,chrome10+ */
        background: -o-radial-gradient(center, ellipse cover, rgb(127, 123, 150) 0%, rgb(128, 123, 150) 7%, rgb(28, 74, 88) 100%) !important; /* opera 11.10+ */
        background: -ms-radial-gradient(center, ellipse cover, rgb(127, 123, 150) 0%, rgb(128, 123, 150) 7%, rgb(28, 74, 88) 100%) !important; /* ie10+ */
        background:radial-gradient(ellipse at center, rgb(127, 123, 150) 0%, rgb(128, 123, 150) 7%, rgb(28, 74, 88) 100%) !important; /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#968F7B', endColorstr='#222d32',GradientType=0 ); /* ie6-9 */
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
        <a href="<?= Yii::getAlias('/frontend/web/site/telegram')?>">
            <img src="/gallery/telegram.jpg" alt="">
            <input type="button"  value="Телеграм канал" class="btn btn-lg btn-default">
         </a>
        </div>
    </div>
</div>




<div class="login-box">
    <div class="login-logo">
        <a href="#">Вход для студента <i class="fa fa-graduation-cap" aria-hidden="true"></i></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label('Введите Email') ?>

        <?= $form->field($model, 'password')->passwordInput()->label('Введите пароль') ?>

        <?= $form->field($model, 'rememberMe')->checkbox()->label('Запомнить меня') ?>

        <div style="margin:1em 0" class="request_password_reset">
                Забыли пароль? | <?= Html::a('Восстановить пароль', ['student/request-password-reset']) ?>.
           </div>

        <div class="form-group">
            <?= Html::submitButton(' Войти ', ['class' => 'btn btn-lg btn-primary', 'name' => 'login-button', 'textButton'=>'Войти']) ?>
        </div>

        <?php ActiveForm::end(); ?>





</div><!-- /.login-box -->


