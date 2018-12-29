<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Testing */

$this->title = $model->name_test;
$this->params['breadcrumbs'][] = ['label' => 'Тестирование', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testing-view">

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-lg btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-lg btn-danger',
            'data' => [
                'confirm' => 'Действительно хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name_test',
            'subject.name_subject',
            'description',
            'user_create',
            'create_date',
            'questionsAsString',
        ],
    ]) ?>

</div>
