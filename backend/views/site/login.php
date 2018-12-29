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
    padding: 40px 0 120px;
}
.login-page, .register-page{
        background-color: #5f515f;
        /* IE9, iOS 3.2+ */
        background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIHZpZXdCb3g9IjAgMCAxIDEiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxsaW5lYXJHcmFkaWVudCBpZD0idnNnZyIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSIwJSIgeTE9IjAlIiB4Mj0iMTAwJSIgeTI9IjEwMCUiPjxzdG9wIHN0b3AtY29sb3I9IiM0ZTUzNzAiIHN0b3Atb3BhY2l0eT0iMSIgb2Zmc2V0PSIwIi8+PHN0b3Agc3RvcC1jb2xvcj0iIzcwNGU0ZSIgc3RvcC1vcGFjaXR5PSIxIiBvZmZzZXQ9IjEiLz48L2xpbmVhckdyYWRpZW50PjxyZWN0IHg9IjAiIHk9IjAiIHdpZHRoPSIxIiBoZWlnaHQ9IjEiIGZpbGw9InVybCgjdnNnZykiIC8+PC9zdmc+);
        background-image: -webkit-gradient(linear, 0% 0%, 100% 100%,color-stop(0, rgb(78, 83, 112)),color-stop(1, rgb(112, 78, 78)));
        /* Android 2.3 */
        background-image: -webkit-linear-gradient(top left, rgb(112, 83, 89) 0%, rgb(67, 88, 112) 100%);
        /* IE10+ */
        background-image: linear-gradient(bottom right,rgb(78, 83, 112) 0%,rgb(112, 78, 78) 100%);
        background-image: -ms-linear-gradient(top left,rgb(78, 83, 112) 0%,rgb(112, 78, 78) 100%);
    }
.request_password_reset > a{
        color: #ffdda2 !important;
    }
    </style>

<? $this->registerCssFile('/backend/web/css/globalEditStyle.css',
    ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerCssFile('/frontend/web/css/login.css',
['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="section_elements_link_app">
    <div class="section_item section_item_1">
        <div class="item_block">
            <a href="<?= Yii::getAlias('/frontend/web/site/telegram')?>">
                <img src="/gallery/telegram.jpg" alt="">
                <input type="button"  value="Телеграм канал" class="btn btn-lg btn-default">
            </a>
        </div>
    </div>
    <div class="section_item section_item_2">
        <div class="item_block">
        <a href="<?= Yii::getAlias('/frontend/web/student/login')?>">
            <img src="/gallery/students.jpg" alt="">
            <input type="button" value="Для студентов" class="btn btn-lg btn-danger ">

         </a>
        </div>
    </div>
</div>

<div class="login-box">
    <div class="login-logo">
        <a href="#">Вход для преподавателя <i class="fa fa-book" aria-hidden="true"></i></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label('Введите Email') ?>

        <?= $form->field($model, 'password')->passwordInput()->label('Введите пароль') ?>

        <?= $form->field($model, 'rememberMe')->checkbox()->label('Запомнить меня') ?>

        <div style="margin:1em 0" class="request_password_reset">
            Забыли пароль? | <?= Html::a('Восстановить пароль', ['../../frontend/web/teatcher/request-password-reset']) ?>.
        </div>

        <div class="form-group">

            <?= Html::submitButton(' Войти ', ['class' => 'btn btn-lg btn-primary', 'name' => 'login-button', 'textButton'=>'Войти']) ?>
        </div>

        <?php ActiveForm::end(); ?>





</div><!-- /.login-box -->
