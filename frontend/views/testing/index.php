<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TestInGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Привязка теста к группе';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-in-group-index">

    <!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?php

        ?>

    <p>
        <?= Html::a('Провести тестирование', ['create'], ['class' => 'btn btn-lg btn-primary']) ?>
    </p>
    <?= \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'test_id',
                'value' => 'test.name_test',
            ],
            [
                'attribute'=>'subject_group_id',
                'value'=>'nameGroup.name_group',
            ],

            [
                'attribute'=>'type',
                'filter'=>array("На оценку"=>"На оценку","Проверочный"=>"Проверочный","Контрольный"=>"Контрольный"),
            ],
            'create_date',
            [
                'attribute'=>'start_date',
                'value'=>'start_date',
                'filterType'=>\kartik\grid\GridView::FILTER_DATE,
                'filterWidgetOptions' => [
                    'pluginOptions'=>[
                        'format' => 'yyyy-mm-dd hh:i',
                        'autoWidget' => true,
                        'autoclose' => true,
                        'todayBtn' => true,
                    ],
                    'options' => ['placeholder' => 'Дата начала ...'],
                ],
            ],
            [
                'attribute'=>'end_date',
                'value'=>'end_date',
                'filterType'=>\kartik\grid\GridView::FILTER_DATE,
                'filterWidgetOptions' => [
                    'pluginOptions'=>[
                        'format' => 'yyyy-mm-dd',
                        'autoWidget' => true,
                        'autoclose' => true,
                        'todayBtn' => true,
                    ],
                    'options' => ['placeholder' => 'Дата окончания ...'],
                ],
            ],

            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'required',
                'vAlign'=>'middle',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
