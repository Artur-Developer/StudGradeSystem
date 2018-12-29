<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Auditories */

$this->title = $model->number . ' | ' .  $model->description;
$this->params['breadcrumbs'][] = ['label' => 'Аудитории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auditories-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'capacity',
            'number',
            'type',
            'description',
        ],
    ]) ?>

</div>
