<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Auditories */

$this->title = 'Редактировать аудиторию: ' . $model->number . ' | ' .  $model->description;
$this->params['breadcrumbs'][] = ['label' => 'Аудитории', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="auditories-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
