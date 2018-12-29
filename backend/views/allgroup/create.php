<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\AllGroup */

$this->title = 'Импорт группы со списком студентов';
$this->params['breadcrumbs'][] = ['label' => 'Список групп', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="all-group-create">
    <style>
        .ruleImportGroup{
            max-width: 475px;
            max-height: 100px;
        }
        .ruleImportGroup2{
            max-width: 800px;
            max-height: 460px;
        }
        .clear{
            clear: both;
        }
        .all-group-create p{font-size: 17px}
    </style>
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <button class="btn btn-lg btn-primary">Импортировать группу</button>

    <?php ActiveForm::end() ?>
    <br>
    <hr>
    <h3>Требование к файлу</h3>
    <hr>
    <p>Перечисленные поля должны быть обязательно заполнены!</p>
    <ol>
        <li><p>Имя</p></li>
        <li><p>Фамилия</p></li>
        <li><p>Отчество</p></li>
        <li><p>Указано (бюджет или коммерция)</p></li>
        <li><p>Email</p></li>
    </ol>
    <h4>Обязательно указывать в имени файла сокращённое название группы латиницей!</h4>
    <div class="col-md-4" style="overflow: auto;">
        <img src="/backend/web/img/ruleImportGroup2.PNG" alt="" class="ruleImportGroup">
    </div>
    <div class="clear"></div>
    <hr>
<h3>Пример правильно заполненного документа</h3>
    <div class="col-md-6 col-sm-12" style="overflow: auto;">

        <img src="/backend/web/img/ruleImportGroup.PNG" alt="" class="ruleImportGroup2">
    </div>
</div>
