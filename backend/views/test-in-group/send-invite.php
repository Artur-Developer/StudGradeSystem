<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 22.04.2018
 * Time: 18:19
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Тест в группе: ' . $model->nameGroup->name_group .
    ' по дисциплине: '. $model->nameSubject->name_subject;
$this->params['breadcrumbs'][] = ['label' => 'Общий список', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nameGroup->name_group, 'url' => ['update', 'id' => $model->id]];
?>
<div class="test-in-group-send-invite">

    <?php $form = ActiveForm::begin(); ?>
        <div class="form-group">
            <?= Html::submitButton('Отправить приглашения', ['class' => 'btn btn-lg btn-success']) ?>
        </div>
    <div class="col-lg-7 col-md-12">
        <br>

        <?= $form->field($model,'student_array')->widget(\kartik\select2\Select2::className(),[
            //'name' => 'questions',
            'data' => $all_students,
            'options' => [
                'placeholder' => 'Добавить студента...',
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