<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Questions */

$this->title = $model->name_question;
$this->params['breadcrumbs'][] = ['label' => 'Вопросы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-view">


    <p>
        <?= Html::a('Добавить новый', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить этот вопрос?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'name_question',
                [
                    'label' => 'Дисциплина',
                    'value' => $model->subject->name_subject,
                ],
                [
                    'label' => 'Автор',
                    'value' => $model->user->last_name . ' '
                        . $model->user->first_name. ' '
                        . $model->user->middle_name,
                ],
                'type',
                'rating',
                'time',
                'create_date',
            ],
        ]) ?>
        <table class="table table-striped table-bordered detail-view">
            <thead>
            <tr>
                <th width="5%">Правильность</th>
                <td width="95%">Варианты ответов</td>
            </tr>
            </thead>
            <tbody>
            <? foreach ($questionAnswers as $answer):?>
                <tr>

                    <th width="5%">
                        <? if($answer->bool == 1): ?>
                            <i  style="color:#17ff3e; font-size: 20px; vertical-align: middle;text-align: center;width: 100%;"
                                class="fa fa-check" aria-hidden="true"></i>
                        <? elseif($answer->bool == 0): ?>
                            <i  style="color:#ff0b0b; font-size: 20px; vertical-align: middle;text-align: center;width: 100%;"
                                class="fa fa-check" aria-hidden="true"></i>
                        <? endif;?>
                    </th>
                    <td width="95%"><?= $answer->name_answer?></td>
                </tr>
            <? endforeach;?>

            </tbody>
        </table>







</div>
