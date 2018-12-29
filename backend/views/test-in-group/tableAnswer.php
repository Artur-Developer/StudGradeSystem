<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 28.04.2018
 * Time: 10:24
 */
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TestInGroup */

$this->title = 'Тест в группе: ' . $model->nameGroup->name_group .
    ' по дисциплине: '. $model->nameSubject->name_subject;
$this->params['breadcrumbs'][] = ['label' => 'Общий список', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nameGroup->name_group, 'url' => ['view-answer-student', 'id' => $model->id]];
?>
<style>
    .test-in-group-tableAnswer table thead tr:first-child{
        background-color: #2e3639;
    }
    .test-in-group-tableAnswer table thead tr:first-child td{
        padding: 13px;
        font-size: 19px;
    }
    .test-in-group-tableAnswer table thead tr:nth-of-type(2) th:first-child,
    .test-in-group-tableAnswer table thead tr:nth-of-type(2) th:nth-of-type(2){
        padding: 12px  0 12px 50px;
        text-decoration: underline;
    }
</style>
<div class="test-in-group-tableAnswer">
    <p>
        <?= Html::a('Детали теста', ['view', 'id' => $model->id], ['class' => 'btn btn-lg btn-primary']) ?>
        <?= Html::a('Выбрать другого студента ', ['view-answer-student', 'id' => $model->id], ['class' => 'btn btn-lg btn-success']) ?>
    </p>


    <table class="table table-striped table-bordered detail-view">
        <thead>
        <tr>
            <td style="text-align: center"><i class="fa fa-user-circle-o" aria-hidden="true"></i></td>
            <td>
                <b>Студент:</b>
                <? foreach ($student as $studentInfo) :?>
                       <?= $studentInfo?>
                <? endforeach;?>
            </td>
            <td>
                <b>Группа: </b>
               <?=  $model->nameGroup->name_group ?>
            </td>
        </tr>
        <tr>
            <th>№</th>
            <th>Вопрос:</th>
            <th>Ответ:</th>
            <th>Правильность:</th>
        </tr>
        </thead>
        <tbody>
        <? foreach ($findAnswer as $answer):?>
            <tr>
                <td style="text-align: center"><?= $countNumber += 1 ?></td>
                <td><?= $answer->questions->name_question?></td>
                <td><?= $answer->questionAnswers->name_answer?></td>
                <th width="10%">
                    <? if($answer->questionAnswers->bool == 1): ?>
                        <i  style="color:#17ff3e; font-size: 20px; vertical-align: middle;text-align: center;width: 100%;"
                            class="fa fa-check" aria-hidden="true"></i>
                    <? elseif($answer->questionAnswers->bool == 0): ?>
                        <i  style="color:#ff0b0b; font-size: 20px; vertical-align: middle;text-align: center;width: 100%;"
                            class="fa fa-check" aria-hidden="true"></i>
                    <? endif;?>
                </th>

            </tr>
        <? endforeach;?>

        </tbody>
    </table>
</div>
