<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 17.12.2017
 * Time: 20:09
 */

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;

$this->registerJsFile('/backend/web/libs/tableCloneColumn/clone_column.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/backend/web/libs/tableCloneColumn/jquery.stickyheader.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/backend/web/js/analytics.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);


?>

<link rel="stylesheet" type="text/css" href="/backend/web/libs/component.css" />
<link rel="stylesheet" type="text/css" href="/backend/web/css/RatingTable.css" />

<style>
    .table > thead:first-child > tr:first-child > td{
        height: 350px !important;
    }
    .table_rating{
        min-width: 100% !important;
    }
    .color_rating_td{
        margin: 0;
    }
    .color_rating_td:first-child{
        display: block;
    }
    .add_modal_picker{
        margin: 0 10px 0 0 !important;
    }
    .findAnalytics{
        padding-bottom: 15px;
        border-bottom: 1px solid #9f9f9f;
    }
    .rating {
    	overflow: auto;
    }
</style>

<?php Pjax::begin(); ?>
<?
$this->title = 'Аналитика оценок: ' . $model->group->name_group;
$this->params['breadcrumbs'][] = ['label' => 'Аналитика оценок', 'url' => ['index']];
?>
<h3>В данном разделе представлены две возможности: <br>
Показать результаты всей группы или только по одному студенту.
</h3>
<div class="findAnalytics">
    <?= $this->render('informedgroup', [
        'out' => $out,
        'GetAllGroup' => $GetAllGroup,
        'GetAllStudent' => $GetAllStudent,
    ]) ?>
</div>

<? if(!empty($studentGroup)): ?>
<div class="blok_table">
    <div class="table-responsiv">
        <div class="dropup color_rating_td">
            <button type="button" data-toggle="dropdown" class="btn btn-lg btn-primary dropdown-toggle">
                Подсветка таблицы
                <span class="caret"></span>
            </button>
            <!-- Выпадающее меню -->
            <ul class="dropdown-menu">
                <!-- Пункты меню -->
                <li><button class="btn btn-prymary average_active_col ">Среднее значение</button></li>
                <li><button class="btn btn-prymary propusky_active">Пропуски</button></li>
            </ul>
        </div>
        <table id="<?= $getTableId->id ?>" group_id="<?= $getTableId->group_id?>" name="<?= $getTableId->id ?>" class="table table_rating table_center_text table-striped table-bordered">
            <thead>
            <tr id="responds">
                <td>№</td>
                <td>Студент</td>
                <td><div class="top_rating_data">Пропуски</div></td>
                <td><div class="top_rating_data">СР. БАЛЛ</div></td>
                <?php foreach($modelStudentGroup as $subject):?>
                    <td id="<?=$subject->subject->id ?>">
                        <div class="top_rating_data"><?= $subject->subject->name_subject ?></div>
                    </td>
                <?php endforeach;?>
            </tr>
            </thead>

            <tbody>
                <tr>
                    <th class="number disallow_ban"></th>
                    <th><?php echo $studentGroup->last_name .
                            ' ' . $studentGroup->first_name .
                            ' ' . $studentGroup->middle_name?></th>
                    <td class="omissions disallow_ban"></td>
                    <td class="average disallow_ban"></td>

                    <?php foreach(\backend\models\Group::find()->where(['group_id'=>$studentGroup->group_id])->all() as $subject):?>
                        <td id="<?= $subject->id ?>" class="edit rating" >
                            <?php foreach( \backend\models\RatingGroup::getRatingAnalitycs($studentGroup->id,   $subject->id, $date1,$date2) as $rating):?>
                                <?= $rating->rating; ?>
                            <?php endforeach;?>
                        </td>
                    <?php endforeach;?>
                </tr>
            <tr class="addStudent_toggle">

            </tr>


            </tbody>

        </table>
    </div>
</div>

<? endif; ?>
<!--****************************************************************-->
<? if($group_id != null): ?>
<div class="blok_table">
    <div class="table-responsiv">
        <div class="dropup color_rating_td">
            <button type="button" data-toggle="dropdown" class="btn btn-lg btn-primary dropdown-toggle">
                Подсветка таблицы
                <span class="caret"></span>
            </button>
            <!-- Выпадающее меню -->
            <ul class="dropdown-menu">
                <!-- Пункты меню -->
                <li><button class="btn btn-prymary average_active_col ">Среднее значение</button></li>
                <li><button class="btn btn-prymary propusky_active">Пропуски</button></li>
            </ul>
        <table id="<?= $getTableId->id ?>" group_id="<?= $getTableId->group_id?>" name="<?= $getTableId->id ?>" class="table table_rating table_center_text table-striped table-bordered">
            <thead>
            <tr id="responds">
                <td>№</td>
                <td>Студент</td>
                <td><div class="top_rating_data">Пропуски</div></td>
                <td><div class="top_rating_data">СР. БАЛЛ</div></td>
                <?php foreach($model as $subject):?>
                    <td id="<?=$subject->subject->id ?>">
                        <div class="top_rating_data" title="<?= $subject->subject->name_subject ?>"><?= $subject->subject->name_subject ?></div>
                    </td>
                <?php endforeach;?>
            </tr>
            </thead>

            <tbody>

            <? foreach(\backend\models\Students::find()->where(['group_id'=>$group_id])->all() as $student):?>
                <tr>
                    <th class="number disallow_ban"></th>
                    <th><?php echo $student->last_name .
                            ' ' . $student->first_name .
                            ' ' . $student->middle_name?></th>
                    <td class="omissions disallow_ban"></td>
                    <td class="average disallow_ban"></td>

                    <?php foreach($model as $subject):?>
                        <td id="<?= $subject->id ?>" class="edit rating" >
                            <?php foreach( \backend\models\RatingGroup::getRatingAnalitycs($student->id,  $subject->id, $date1,$date2) as $rating):?>
                                <?= $rating->rating; ?>
                            <?php endforeach;?>
                        </td>
                    <?php endforeach;?>
                </tr>
            <?php endforeach;?>
            <tr class="addStudent_toggle">

            </tr>

            </tbody>

        </table>
    </div>
</div>
<? endif; ?>

<br />
<br />




<?php Pjax::end(); ?>

