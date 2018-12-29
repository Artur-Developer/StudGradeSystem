<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 31.07.2018
 * Time: 15:42
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Изменение email адреса');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Профиль'), 'url' => ['profile']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-update-email">
    <div class="blok_button">
        <?= Html::a(Yii::t('app', 'Общие сведения'), ['/profile/index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a(Yii::t('app', 'Изменить пароль'), ['/profile/change-password'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Изменить email'), ['/profile/update-email'], ['class' => 'btn btn-danger']) ?>
        <?= Html::a(Yii::t('app', 'Дополнительная информация'), ['/profile/update-extended-info'], ['class' => 'btn btn-primary']) ?>
    </div>
    <br>

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="student-form col-lg-6 col-md-8 ">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Изменить'), ['class' => 'btn btn-lg btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>