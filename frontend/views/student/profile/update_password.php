<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 27.01.2018
 * Time: 20:30
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Изменение пароля');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Профиль'), 'url' => ['profile']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-update-password">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="student-form col-lg-6 col-md-8 row">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'currentPassword')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'newPasswordRepeat')->passwordInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Изменить'), ['class' => 'btn btn-lg btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>