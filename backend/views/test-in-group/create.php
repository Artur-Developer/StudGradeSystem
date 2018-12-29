<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TestInGroup */

$this->title = 'Привязка теста к группе';
$this->params['breadcrumbs'][] = ['label' => 'Привязка теста к группе', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-in-group-create">


    <?= $this->render('_form', [
        'model' => $model,
        'arrayDate' => $arrayDate,
        'findTest' => $findTest,
        'findSubjectGroup' => $findSubjectGroup,
    ]) ?>

</div>
