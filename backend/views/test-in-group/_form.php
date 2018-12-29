<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\TestInGroup */
/* @var $form yii\widgets\ActiveForm */
?>
<style>


</style>

<div class="test-in-group-form">

    <?php $form = ActiveForm::begin(); ?>



    <div class="col-md-8 col-sm-12">

        <?= $form->field($model,'test_id')->widget(\kartik\select2\Select2::className(),[
            'name' => 'test_id',
            'data' => ArrayHelper::map($findTest,'testing.id','testing.name_test','name_subject'),
            'language' => 'ru',
            'options' => [
                'placeholder' => 'Привязать тест...',
            ],
            'pluginOptions' => [
                'allowClear'=>true,
            ],
        ]);

        ?>
        <?= $form->field($model,'subject_group_id')->widget(\kartik\select2\Select2::className(),[
            'name' => 'subject_group_id',
            'data' => ArrayHelper::map($findSubjectGroup,'id','group.name_group','subject.name_subject'),

            'language' => 'ru',
            'options' => [
                'onchange'=>'
                $.post( "../group/list-date?id="+$(this).val(), function( data ) {
                  $( "select#testingroup-rating_data_id" ).html( data );
                });
                ',
                'placeholder' => 'Привязать группу...',
            ],
            'pluginOptions' => [

                'allowClear' => true
            ],
        ])
        ?>

        <?= $form->field($model, 'rating_data_id')->dropDownList($arrayDate,[
                'prompt'=>'Нет...',

        ]) ?>



        <?= $form->field($model, 'type')->widget(\kartik\select2\Select2::className(),[
            'name' => 'type',
            'hideSearch' => true,
            'data' => ['На оценку' => 'На оценку', 'Проверочный' => 'Проверочный', 'Контрольный'=>'Контрольный'],
            'options' => ['placeholder' => 'Выберите тип...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>

        <?= $form->field($model, 'start_date')->widget(kartik\datetime\DateTimePicker::className(),[
            'name' => 'start_date',
            'language'=>'ru',
            'type' => \kartik\datetime\DateTimePicker::TYPE_COMPONENT_PREPEND,
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd hh:i'
            ]
        ]);

        ?>

        <?= $form->field($model, 'end_date')->widget(kartik\datetime\DateTimePicker::className(),[
            'name' => 'end_date',
            'language'=>'ru',
            'type' => \kartik\datetime\DateTimePicker::TYPE_COMPONENT_PREPEND,
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd hh:i'
            ]
        ]) ?>

        <?= $form->field($model, 'required')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn  btn-lg btn-success' : 'btn btn-lg btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
