<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PostbackendSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="postbackend-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить новость', ['create'], ['class' => 'btn btn-lg btn-default']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['width' => 'auto'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn'],
            'title',

            'text',
            [
                'attribute' => 'how_send',
                'value' => function($model) {
                    if($model->how_send == 0){
                        return 'Отображается всем';
                    }
                    elseif ($model->how_send == 1){
                        return 'Отображается только персоналу';
                    }
                    elseif ($model->how_send == 2){
                        return 'Отображается только студентам';
                    }
                    return '-';
                },
                'filter' => [
                    0 => 'Отображается всем',
                    1 => 'Отображается только персоналу',
                    2 => 'Отображается только студентам'
                ]
            ],
            [
                'attribute' => 'user_id',
                'value' => function($model) {
                    $user = \common\models\User::findIdentity($model);
                    return $user->last_name . ' ' . $user->first_name . ' ' . $user->middle_name;
                },
            ],
            'date',

        ],
    ]); ?>
</div>
