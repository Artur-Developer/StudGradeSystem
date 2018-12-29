<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Auditories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auditories-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'capacity')->textInput() ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([
        'Стандартная' => 'Стандартная',
        'Для подгруппы' => 'Для подгруппы',
        'Несколько групп'=>'Несколько групп',
        'Компьютерная'=>'Компьютерная'
    ]); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
