<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Postbackend */

$this->title = 'Добавить новость';
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="postbackend-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
