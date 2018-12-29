<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 27.03.2018
 * Time: 18:06
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\time\TimePicker;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model backend\models\Questions */
/* @var $form yii\widgets\ActiveForm */

$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Вариант ответа: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Вариант ответа: " + (index + 1))
    });
});
';

$this->registerJs($js);

?>
<style>
    .panel-default > .panel-heading{
        color: #fff !important;
        background-color: rgba(245, 245, 245, 0.05);
        border-radius: 0;
    }
    .panel{
        background-color: rgba(245, 245, 245, 0.05) !important;
        border-radius: 0;
    }
    .panel-body{
        padding: 25px !important;
    }
</style>
<div class="questions-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <h3>Не забудьте отметить хотя бы один правильный ответ!</h3>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => 'btn btn-lg btn-danger']) ?>
    </div>
    <div class="col-md-7">
        <?= $form->field($model, 'name_question')->textarea(['maxlength' => true]) ?>
        <?php
        $getSubjectAll = \yii\helpers\ArrayHelper::map($getSubject,'id','name_subject');
        $params = [
            'prompt' => 'По дисциплине'
        ];
        echo $form->field($model, 'subject_id')->dropDownList($getSubjectAll,$params);
        ?>


        <?= $form->field($model, 'type')->dropDownList([
            'Стандартный' => 'Стандартный',
            'Контрольный' => 'Контрольный',
            'Дополнительный'=>'Дополнительный'
        ]); ?>


        <?= $form->field($model, 'rating')->textInput() ?>

        <?= $form->field($model, 'time')->widget(TimePicker::classname(), [
            'addonOptions' => [
                'asButton' => true,
                'buttonOptions' => ['class' => 'btn btn-info']
            ],
            'pluginOptions' => [
                'showMeridian' => false,
                'secondStep' => 5,
                'minuteStep'=> 2,
                'defaultTime'=>'00:30'
            ]]);

        ?>
    </div>
    <br>
    <div class="col-md-5">
        <div class="padding-v-md">
            <div class="line line-dashed"></div>
        </div>
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items', // required: css class selector
            'widgetItem' => '.item', // required: css class
            'limit' => 10, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class
            'model' => $modelsQuestionAnswer[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'name_answer',
                'bool',
//                'question_id',

            ],
        ]); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-check-square" aria-hidden="true"></i> Добавить варианты ответов
                <button type="button" class="pull-right add-item btn btn-success btn-md"><i class="fa fa-plus"></i> Добавить</button>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body container-items"><!-- widgetContainer -->
                <?php foreach ($modelsQuestionAnswer as $index => $modelQuestionAnswer): ?>
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">
                            <span class="panel-title-address">Вариант ответа: <?= ($index + 1) ?></span>
                            <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (!$modelQuestionAnswer->isNewRecord) {
                                echo Html::activeHiddenInput($modelQuestionAnswer, "[{$index}]id");
                            }
                            ?>
                            <div class="row">
                                <div class="col-sm-8">
                                    <?= $form->field($modelQuestionAnswer, "[{$index}]name_answer")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-4">
                                    <br>
                                    <?= $form->field($modelQuestionAnswer, "[{$index}]bool")->checkbox() ?>
                                </div>
                            </div><!-- end:row -->

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php DynamicFormWidget::end(); ?>


    </div>


    <?php ActiveForm::end(); ?>

</div>

