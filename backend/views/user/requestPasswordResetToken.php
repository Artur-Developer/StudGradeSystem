<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\PasswordResetRequest */

$this->title = 'Запросить сброс пароля для Сотрудника';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .alert-success,
    .alert-danger{
        text-align: center;
    }
.form_capcha_margin{
    margin-top: 15px;

}</style>
<div class="site-request-password-reset container">

    <h3 class="col-md-6 col-md-offset-3">Пожалуйста, заполните свой адрес электронной почты.
        Вам будет отправлена ​​ссылка на сброс пароля.</h3>

    <div class="row">

        <div class="col-lg-6 col-md-offset-3">
            <br>
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'verifyCode')->widget(\yii\captcha\Captcha::className(),['template' => '<div class="row"><div class="col-lg-12">{image}</div><div class="col-lg-12 form_capcha_margin">{input}</div></div>',]); ?>

            <div class="form-group">
                <?= Html::submitButton('Проверить', ['class' => 'btn  btn-lg btn-default']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
