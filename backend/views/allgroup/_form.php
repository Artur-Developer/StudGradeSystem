<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>

<div class="all-group-form ">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_group')->textInput(['maxlength' => true]) ?>

    <div class="form-group ">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-lg btn-primary' : 'btn btn-lg btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
