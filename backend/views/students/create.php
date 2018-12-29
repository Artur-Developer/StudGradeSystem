<?php
/**
 * Created by PhpStorm.
 * User: Artur
 * Date: 03.08.2018
 * Time: 18:16
 */

use yii\helpers\Html;


$this->title = 'Добавить студента';
$this->params['breadcrumbs'][] = ['label' => 'Студенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавить студента';
?>
<div class="student-create">

    <?= $this->render('_form', [
        'model' => $model,
        'GetAllGroup' => $GetAllGroup
    ]) ?>

</div>