<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Testing */

$this->title = 'Редактировать тест: ' . $model->name_test;
$this->params['breadcrumbs'][] = ['label' => 'Тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name_test, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="testing-update">

    <?= $this->render('form_questions', [
        'model' => $model,
        'getSubject' => $getSubject,
        'all_question' => $all_question,
    ]) ?>
</div>
