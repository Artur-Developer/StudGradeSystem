<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>

<div class="group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $getNameGroupAll = ArrayHelper::map($GetAllGroup,'id','name_group');
    $params2 = [
        'prompt' => 'Выберите группу'
    ];
    echo $form->field($model, 'group_id')->dropDownList($getNameGroupAll,$params2);

    ?>


    <?php
    // формируем массив, с ключем равным полю 'subject_id' и значением равным полю 'subject_name'
    $getSubjectAll = ArrayHelper::map($getSubject,'id','name_subject');
    $params = [
        'prompt' => 'Выберите дисциплину'
    ];
    echo $form->field($model, 'subject_id')->dropDownList($getSubjectAll,$params);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-lg btn-primary' : 'btn btn-lg btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
