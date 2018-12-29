<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 29.12.2017
 * Time: 16:45
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Активация аккаунта | Идентификация студента';
?>
<div class="all-group-form col-md-4">
<h5>Пожалуйста укажите свой Email для подтверждения</h5>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <div class="form-group ">
        <?= Html::submitButton($model->isNewRecord ? 'Активация' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-lg btn-primary' : 'btn btn-lg btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>