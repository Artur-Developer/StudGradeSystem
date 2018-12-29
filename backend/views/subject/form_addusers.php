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
<div class="subject-form">

    <?php $form = ActiveForm::begin(); ?>

    <h3>Не забудьте привязать преподавателей к дисциплинам</h3>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-lg btn-primary' : 'btn btn-lg btn-primary']) ?>
    </div>

    <div class="col-lg-6 col-md-12">
        <?= $form->field($model, 'name_subject')->textarea(['maxlength' => true,'rows'=>2]) ?>
    </div>
    <div class="col-lg-6 col-md-12">
        <br>

        <?= $form->field($model,'users_array')->widget(\kartik\select2\Select2::className(),[
            //'name' => 'questions',
            'data' => $prepods,
            'options' => [
                'placeholder' => 'Добавить преподавателей...',
                'multiple' => true
            ],
            'maintainOrder' => true,
            'toggleAllSettings' => [
                'selectLabel' => '<i class="glyphicon glyphicon-ok-circle"></i> Добавить всех',
                'unselectLabel' => '<i class="glyphicon glyphicon-remove-circle"></i> Удалить всех',
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
