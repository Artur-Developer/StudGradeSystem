<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 17.12.2017
 * Time: 20:03
 */
use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use yii\bootstrap\Modal;

?>
    <link rel="stylesheet" type="text/css" href="/backend/web/css/modalPicker.css" />
    <style>
        .modal-dialog{
            width: 65% !important;

        }
    </style>
<br>
<br>

<?php Pjax::begin(); ?>
    <!-- поиск по группе -->
    <div class="add_modal_picker">
        <?
        Modal::begin([
            'header' => '<h2>Поиск по группе</h2>',
            'toggleButton' => ['label' => 'Поск по группе', 'class' => 'btn btn-lg btn-default'],
        ]);
        ?>
        <?= $this->render('findToGroup', [
            //'model' => $model,
            'GetAllGroup' => $GetAllGroup,
        ]) ?>

        <?php Modal::end();?>

    </div>
<!-- поиск по студенту -->
    <div class="add_modal_picker">
        <?
        Modal::begin([
            'header' => '<h2>Поиск по студенту</h2>',
            'toggleButton' => ['label' => 'Поиск по студенту', 'class' => 'btn btn-lg btn-default'],
        ]);
        ?>
        <?= $this->render('findToStudent', [
            'out' => $out,
            'GetAllStudent' => $GetAllStudent,
        ]) ?>

        <?php Modal::end();?>

    </div>

<?php Pjax::end(); ?>