<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 08.06.2018
 * Time: 17:27
 */
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Html;


$this->registerJsFile('/backend/web/js/timeTable.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="timetable-form">

<? $form = ActiveForm::begin(['id'=>'form_update_modal_data']); ?>
    <!--    Настройка занятия-->
    <div class="col-md-12 lessonModalSettings">
    <div class="input-group" >

        <?= $form->field($model,'auditoriy_id')->widget(\kartik\select2\Select2::className(),[
            'name' => 'auditoriy_id',
            'data' => ArrayHelper::map($findAuditories,'id','number'),
            'language' => 'ru',
            'options' => [
                'placeholder' => 'Привязать аудиторию...',
            ],
            'pluginOptions' => [
                'allowClear'=>true,
            ],
        ]);

        ?>

        <?= $form->field($model,'subject_id')->widget(\kartik\select2\Select2::className(),[
            'name' => 'subject_id',
            'data' => ArrayHelper::map($findSubject,'id','name_subject'),

            'language' => 'ru',
            'options' => [
                'onchange'=>'
                    $.post( "find-user-to-subject?id="+$(this).val(), function( data ) {
                      $( "select#timetable-user_id" ).html( data );
                    });
                    ',
                'placeholder' => 'Привязать дисциплину...',
            ],
            'pluginOptions' => [

                'allowClear' => true
            ],
        ])
        ?>

        <?= $form->field($model, 'user_id')->dropDownList($arrayTeachers ,[
            'prompt'=>'Нет...',

        ]) ?>

        <?= $form->field($model, 'description')->textarea(['row'=>3]); ?>


        <br>
        <br>
        <style>
            .dop_inputs input{
                display: none;
            }
        </style>
        <script>
        </script>
        <div class="dop_inputs">
            <input id="number_lesson" class="btn btn-md btn-default " name="number_lesson" type="text" value="">
            <input id="group_id" class="btn btn-md btn-default " name="group_id" type="text" value="">
            <input id="type_week" class="btn btn-md btn-default " name="type_week" type="text" value="">
            <input id="day_week" class="btn btn-md btn-default " name="day_week" type="text" value="">
            <input id="id_lesson" class="btn btn-md btn-default " name="id_lesson" type="text" value="">
            <input id="type_day" class="btn btn-md btn-default " name="type_day" type="text" value="">
            <input id="wf4G3F21Frt3vb" class="btn btn-md btn-default " name="wf4G3F21Frt3vb" type="text" value="wf4G3F21Ftt3vb">
        </div>

        <div class="col-sm-3">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn  btn-lg btn-success' : 'btn btn-lg btn-primary']) ?>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
            	<?= Html::a('Очистить', ['delete-lesson-data','id'=>''], ['class' => 'btn btn-lg btn-danger delete_lesson_data']) ?>
                
            </div>
        </div>
    </div>
    </div>
<?php ActiveForm::end(); ?>
</div>
