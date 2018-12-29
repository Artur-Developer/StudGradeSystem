<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TestInGroup */

$this->title = 'Редактировать тест в группе: ' . $model->nameGroup->name_group .
   ' по дисциплине: '. $model->nameSubject->name_subject;
$this->params['breadcrumbs'][] = ['label' => 'Тестирование в группе', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nameGroup->name_group, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="test-in-group-update">


    <?= $this->render('_form', [
        'model' => $model,
        'arrayDate' => $arrayDate,
        'findTest' => $findTest,
        'findSubjectGroup' => $findSubjectGroup,
    ]) ?>

</div>
