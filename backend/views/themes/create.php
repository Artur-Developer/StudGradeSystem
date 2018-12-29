<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Themes */

$this->title = 'Создание темы';
$this->params['breadcrumbs'][] = ['label' => 'Темы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="themes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'getSubject' => $getSubject,
    ]) ?>

</div>
