<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


$this->title = ($model->group->name_group . '_' . $model->subject->name_subject . ' 
( ' . $model->user->last_name . ' '
    . $model->user->first_name. ' '
    . $model->user->middle_name. '
    )');
$this->params['breadcrumbs'][] = ['label' => 'Весь список', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-lg btn-danger',
            'data' => [
                'confirm' => 'Уверены, что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Оценки', ['rating', 'id'=>$model->id] ,['class' => 'btn btn-lg btn-default']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,

        'attributes' => [
            'id',
            [
                'label' => 'Группа',
                'value' => $model->group->name_group,
            ],
            [
                'label' => 'Дисциплина',
                'value' => $model->subject->name_subject,
            ],
            'group_created_data',
            'status',

        ],
    ]) ?>


</div>
