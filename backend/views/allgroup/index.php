<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AllGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список всех групп';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="all-group-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить группу', ['create'], ['class' => 'btn btn-lg btn-default']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name_group',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
