<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\QuestionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вопросы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать Вопрос', ['create'], ['class' => 'btn btn-lg btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name_question',
            [
                'attribute'=>'subject_id',
                'value'=>function($data){

                    $return = \backend\models\Subject::find()->where(['id' => $data->subject_id])->one();
                    return $return->name_subject;

                },
                'filter'=>\backend\models\Subject::find()->select(['name_subject'])->indexBy('id')->column(),
            ],            [
                'attribute' => 'user_id',
                'value' => 'user.last_name',
            ],
            'type',
//             'rating',
//             'time',
             'create_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
