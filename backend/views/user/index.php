<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel mdm\admin\models\searchs\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Пользователи');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <?= Html::a('Добавить нового', ['signup',], ['class' => 'btn btn-lg btn-primary']) ?>
    <br>
    <br>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            'last_name',
            'first_name',
            'middle_name',
            'email:email',
            'created_at:date',
            [
                'attribute' => 'status',
                'value' => function($model) {
                    return $model->status == 0 ? 'Неактивный' : 'Активный';
                },
                'filter' => [
                    0 => 'Неактивный',
                    10 => 'Активный'
                ]
            ],
            ['class' => 'yii\grid\ActionColumn'],

            ],
        ]);
        ?>
</div>
