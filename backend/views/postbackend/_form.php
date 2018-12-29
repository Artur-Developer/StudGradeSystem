<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Postbackend */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="postbackend-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-lg-8 col-md-12">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-lg btn-primary' : 'btn btn-lg btn-primary']) ?>
        </div>
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'text')->textarea(['maxlength' => true,'rows'=>4]) ?>

        <?= $form->field($model, 'how_send')->dropDownList([
            '0' => 'Отображать всем',
            '1' => 'Отображать только персоналу',
            '2'=>'Отображать только студентам'
        ]); ?>

    </div>




    <?php ActiveForm::end(); ?>

</div>
