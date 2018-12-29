<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Testing */

$this->title = 'Создание теста';
$this->params['breadcrumbs'][] = ['label' => 'Тестирование', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testing-create">

    <?= $this->render('_form', [
        'model' => $model,
        'getSubject' => $getSubject,
    ]) ?>

</div>
