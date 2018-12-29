<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 20.04.2018
 * Time: 20:49
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Testing */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .select2-container--krajee .select2-selection--multiple .select2-selection__choice{
        float: none !important;
        margin: 5px 32px 0 6px;
        padding: 3px 20px  3px 5px;
        overflow: auto;
        font-weight: 600;
    }
    .select2-container--krajee .select2-selection--multiple .select2-selection__choice__remove{
        right: 36px;
        position: absolute;
        margin-top: 1px;

    }
</style>
<div class="testing-form">

    <?php $form = ActiveForm::begin(); ?>

    <h3>Не забудьте привязать к тесту вопросы!</h3>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-lg btn-primary' : 'btn btn-lg btn-primary']) ?>
    </div>

    <div class="col-lg-5 col-md-12">
        <?= $form->field($model, 'name_test')->textarea(['maxlength' => true,'rows'=>3]) ?>

        <?
        $getSubjectAll = \yii\helpers\ArrayHelper::map($getSubject,'id','name_subject');
        $params = [
            'prompt' => 'По дисциплине'
        ];
        echo $form->field($model, 'subject_id')->dropDownList($getSubjectAll,$params);
        ?>

        <?= $form->field($model, 'description')->textarea(['maxlength' => true,'rows'=>4]) ?>

    </div>
    <div class="col-lg-7 col-md-12">
        <br>

        <?= $form->field($model,'question_array')->widget(\kartik\select2\Select2::className(),[
            //'name' => 'questions',
            'data' => $all_question,
            'options' => [
                'placeholder' => 'Добавить вопрос...',
                'multiple' => true
            ],
            'maintainOrder' => true,
            'toggleAllSettings' => [
                'selectLabel' => '<i class="glyphicon glyphicon-ok-circle"></i> Добавить всё',
                'unselectLabel' => '<i class="glyphicon glyphicon-remove-circle"></i> Удалить всё',
                'selectOptions' => ['class' => 'text-success'],
                'unselectOptions' => ['class' => 'text-danger'],
            ],
            'pluginOptions' => [
                'allowClear'=>true,
                'tags' => true,
                'maximumInputLength' => 10
            ],
        ])
        ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
