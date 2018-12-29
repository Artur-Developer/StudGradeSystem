<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Questions */

$this->title = 'Редактирование вопроса: ' . $model->name_question;
$this->params['breadcrumbs'][] = ['label' => 'Вопросы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name_question, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="questions-update">

    <?= $this->render('_form', [
        'model' => $model,
        'getSubject' => $getSubject,
        'modelsQuestionAnswer' => $modelsQuestionAnswer,
    ]) ?>

</div>
