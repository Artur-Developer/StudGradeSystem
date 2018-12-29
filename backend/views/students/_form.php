<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Заполнение данных профиля';
?>

<div class="students-form ">

    <div class="col-md-5 col-sm-12">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'traing')->dropDownList([
            'бюджет' => 'бюджет',
            'коммерция'=>'коммерция'
        ]); ?>
        <?= $form->field($model,'group_id')->widget(\kartik\select2\Select2::className(),[
            'name' => 'group_id',
            'data' => ArrayHelper::map($GetAllGroup,'id','name_group'),
            'language' => 'ru',
            'options' => [
                'placeholder' => 'Группа...',
            ],
            'pluginOptions' => [
                'allowClear'=>true,
            ],
        ]);
        ?>
        <?= $form->field($model, 'status_training')->dropDownList([
            '1' => 'Обучается',
            '0'=>'Уже не обучается'
        ]); ?>

        <div class="form-group ">
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-lg btn-primary', 'name' => 'update-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
