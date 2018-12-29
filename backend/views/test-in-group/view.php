<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TestInGroup */

$this->title = 'Тест в группе: ' . $model->nameGroup->name_group .
    ' по дисциплине: '. $model->nameSubject->name_subject;
$this->params['breadcrumbs'][] = ['label' => 'Общий список', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nameGroup->name_group, 'url' => ['update', 'id' => $model->id]];
?>
<div class="test-in-group-view">


    <p>

        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-lg btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-lg  btn-danger',
        'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
        ],
        ]) ?>
        <?= Html::a('Посмотреть ответы студентов', ['view-answer-student','id'=>$model->id], ['class' => 'btn btn-lg btn-success']) ?>
        <?= Html::a('Отправить приглашения по почте студентам', ['send-invite','id'=>$model->id], ['class' => 'btn btn-lg btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'test.name_test',
            'nameGroup.name_group',
            'rating_data_id',
//            [
//                'attribute'=>'user_id',
//                'value'=>'user.last_name',
//            ],
            'user.last_name',

            'end_date',
            'create_date',
            'required',
        ],
    ]) ?>

</div>
