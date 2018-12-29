<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Группа-предмет';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th,
    .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td{
        font-size: 17px;
        text-align: center;
    }
    @media(max-width:993px) {
        .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th,
        .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
            font-size: 15px;
            text-align: center;
        }
    }
</style>
<div class="group-index">

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-lg btn-default']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{delete} < | >  {view}',
            ],
            [
                'attribute'=>'group_id',
                'value'=>function($data){

                    $return = \backend\models\AllGroup::find()->where(['id' => $data->group_id])->one();
                    return $return->name_group;

                },
                'filter'=>\backend\models\AllGroup::find()->select(['name_group'])->indexBy('id')->column(),
            ],


            [
                'attribute'=>'subject_id',
                'value'=>function($data){

                    $return = \backend\models\Subject::find()->where(['id' => $data->subject_id])->one();
                    return $return->name_subject;

                },
                'filter'=>\backend\models\Subject::find()->select(['name_subject'])->indexBy('id')->column(),
            ],
            'group_created_data',


        ],
    ]); ?>
</div>
