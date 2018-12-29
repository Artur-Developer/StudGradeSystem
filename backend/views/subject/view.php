<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Subject */

$this->title = $model->name_subject;
$this->params['breadcrumbs'][] = ['label' => 'Дисциплины', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-lg btn-default']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-lg btn-danger',
            'data' => [
                'confirm' => 'Уверены, что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name_subject',
            'create_data',
//            'usersAsString',
        ],
    ]) ?>

    <table class="table table-striped table-bordered detail-view">

        <thead>
        <tr>
            <th width="5%">№ <?= $sum?></th>
            <td width="95%">ФИО  Преподавателей</td>
        </tr>
        </thead>
        <tbody>
        <? foreach ($getTeacherForSubject as $user):?>
            <tr>

                <th width="5%">
                    <?= $n += 1?>
                </th>
                <td width="95%"><?= $user->user->last_name . ' '  . $user->user->first_name. ' '  . $user->user->middle_name;?></td>
            </tr>
        <? endforeach;?>


        </tbody>
    </table>


</div>
