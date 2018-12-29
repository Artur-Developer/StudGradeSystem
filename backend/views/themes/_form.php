<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Themes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="themes-form col-lg-8 col-md-10 col-sm-12">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_theme')->textarea(['maxlength' => true,'rows'=>4]) ?>

    <?php
    // формируем массив, с ключем равным полю 'subject_id' и значением равным полю 'subject_name'
    $getSubjectAll = \yii\helpers\ArrayHelper::map($getSubject,'id','name_subject');
    $params = [
        'prompt' => 'Выберите дисциплину'
    ];
    echo $form->field($model, 'subject_id')->dropDownList($getSubjectAll,$params);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-lg btn-primary' : 'btn btn-lg btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
