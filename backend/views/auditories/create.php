<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Auditories */

$this->title = 'Добавить аудиторию';
$this->params['breadcrumbs'][] = ['label' => 'Аудитории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auditories-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
