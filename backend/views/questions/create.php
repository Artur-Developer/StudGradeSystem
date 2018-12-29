<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Questions */

$this->title = 'Создание вопроса';
$this->params['breadcrumbs'][] = ['label' => 'Вопросы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-create">


    <?= $this->render('_form', [
        'model' => $model,
        'getSubject' => $getSubject,
        'modelsQuestionAnswer' => $modelsQuestionAnswer,
    ]) ?>

</div>
