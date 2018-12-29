<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ThemesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Темы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="themes-index">

<!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создание темы', ['create'], ['class' => 'btn btn-lg btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name_theme',
            [
                'attribute'=>'subject_id',
                'value'=>function($data){

                    $return = \backend\models\Subject::find()->where(['id' => $data->subject_id])->one();
                    return $return->name_subject;

                },
                'filter'=>\backend\models\Subject::find()->select(['name_subject'])->indexBy('id')->column(),
            ],
            'create_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
