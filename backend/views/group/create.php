<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Group */

$this->title = 'Добавить группу';
$this->params['breadcrumbs'][] = ['label' => 'Группы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'GetAllGroup' => $GetAllGroup,
        'getSubject' => $getSubject,
    ]) ?>

</div>
