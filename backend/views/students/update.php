<?php

use yii\helpers\Html;


$this->title = 'Обновить информацию: ';
$this->params['breadcrumbs'][] = ['label' => 'Студенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->last_name . ' ' .
    $model->first_name . ' ' . $model->middle_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновление информации';
?>
<div class="all-group-update">

    <?= $this->render('_form', [
        'model' => $model,
        'GetAllGroup' => $GetAllGroup
    ]) ?>

</div>
