<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 30.03.2018
 * Time: 18:15
 */

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\QuestionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'База тестов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testing-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить Тест', ['create'], ['class' => 'btn btn-lg btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn'],

            'name_test',
            [
                'attribute'=>'subject_id',
                'value'=>function($data){

                    $return = \backend\models\Subject::find()->where(['id' => $data->subject_id])->one();
                    return $return->name_subject;

                },
                'filter'=>\backend\models\Subject::find()->select(['name_subject'])->indexBy('id')->column(),
            ],
            'create_date',
            'user_create',
            'description',

        ],
    ]); ?>
</div>
