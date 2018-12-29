<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = ($model->last_name . ' ' . $model->first_name . ' ' . $model->middle_name . ' | Группа: ' . $model->group->name_group);
$this->params['breadcrumbs'][] = ['label' => 'Студенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="all-group-view">

        <?= Html::a('Все студенты', ['index'], ['class' => 'btn btn-lg btn-success']) ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-lg btn-primary']) ?>
<!--        --><?//= Html::a('Удалить', ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-lg btn-danger',
//            'data' => [
//                'confirm' => 'Уверены, что хотите удалить?',
//                'method' => 'post',
//            ],
//        ]) ?>
    <br>
    <br>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'last_name',
            'first_name',
            'middle_name',
            'traing',
            [
                'attribute'=>'status_training',
                'value'=>function($data){

                    if ($data->status_training == 1){
                        return 'Обучается';
                    }
                    elseif ($data->status_training == 0){
                        return 'Уже не обучается';
                    }
                    return true;
                },
            ],
            'email',
            [
                'attribute'=>'group_id',
                'value'=>function($data){

                    $return = \backend\models\AllGroup::find()->where(['id' => $data->group_id])->one();
                    return $return->name_group;

                },
            ],
            'status',
        ],
    ]) ?>

</div>
