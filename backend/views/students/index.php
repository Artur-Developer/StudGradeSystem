<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AllGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список всех студентов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-index">

    <?= Html::a('Добавить студента', ['create', 'id' => $model->id], ['class' => 'btn btn-lg btn-success']) ?>
    <br>
    <br>

    <?php Pjax::begin(); ?>
    <?= \yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
    <?= GridView::widget([

    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,

    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
            'last_name',
            'first_name',
            'middle_name',
        [
            'attribute'=>'traing',
            'filter'=>array("Бюджет"=>"Бюджет","Коммерция"=>"Коммерция"),
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
            'attribute'=>'status',
            'filter'=>array("active"=>"active","inactive"=>"inactive"),
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'Действия',
            'headerOptions' => ['width' => '80'],
            'template' => '{view} {update}{link}',
        ],
    ],


    ]); ?>
</div>
<?php Pjax::end(); ?>
