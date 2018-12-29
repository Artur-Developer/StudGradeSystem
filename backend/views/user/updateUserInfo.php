<?php
/**
 * Created by PhpStorm.
 * User: Artur
 * Date: 03.08.2018
 * Time: 10:11
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Themes */

$this->title = 'Обновление данных пользователя: ';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновление пользователя';
?>
<div class="user-update">
<!--    --><?//= Html::errorSummary($model)?>
    <div class="container-fuild">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'last_name') ?>
            <?= $form->field($model, 'first_name') ?>
            <?= $form->field($model, 'middle_name') ?>
            <?= $form->field($model, 'email') ?>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Редактировать'), ['class' => 'btn btn-lg btn-primary', 'name' => 'update-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>