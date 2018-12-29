<?php


use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use kartik\typeahead;
use yii\helpers\Url;

/*
 * SELECT * FROM `rating` left join rating_data on rating.col_rating_id= rating_data.id WHERE subject_group_id = 6 group by rating_data.data - 1 foreach
 * */

$this->title = ($model->group->name_group .'_'. strtr($model->subject->name_subject," ","_"));
$this->params['breadcrumbs'][] = ['label' => 'Весь список групп', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$this->registerJsFile('/backend/web/js/TableRating/ratingTable.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/backend/web/js/TableRating/editData.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/backend/web/libs/tableCloneColumn/clone_column.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/backend/web/libs/tableCloneColumn/jquery.stickyheader.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/backend/web/js/TableRating/findTdValue.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJsFile('/backend/web/js/td.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerCssFile('/backend/web/libs/component.css', ['depends' => ['backend\assets\AppAsset']]);
$this->registerCssFile('/backend/web/css/modalPicker.css');
$this->registerCssFile('/backend/web/css/RatingTable.css');
?>

<?php Pjax::begin(); ?>

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
        <li><button class="btn btn-prymary average_active">Оценки</button></li>
        <li><button class="btn btn-prymary propusky_active">Пропуски</button></li>
    </ul>
</div>

<div class="add_modal_picker">
    <?
        Modal::begin([
            'header' => '<h2>Добавление даты</h2> Сегодня: ' . $popupDefaultDate,
            'toggleButton' => ['label' => 'Добавление даты', 'class' => 'btn btn-lg btn-default'],
        ]);

     echo $this->render('create_date',[
         'model'=>$model,
         'RatingData'=>$RatingData,
        'popupDefaultDate' => $popupDefaultDate,
     ]);

    ?>
<?php Modal::end();?>

</div>

<div class="add_modal_picker">
    <?
        Modal::begin([
            'header' => '<h2>Обновление даты</h2> Сегодня: ' . $popupDefaultDate,
            'id'=>'modal_date_update',
        ]);

    echo $this->render('update_date',[
        'model'=>$model,
        'RatingData'=>$RatingData,
        'popupDefaultDate' => $popupDefaultDate,
    ]);
    ?>






<?php Modal::end();?>

</div>


<!--// Кнопка удаление последней даты-->
<div id="DropLastData" class="DropLastData" title="Удаление последнего столбца с оценками"></div>

<table id="<?= $getTableId->id ?>" group_id="<?= $getTableId->group_id?>" name="<?= $getTableId->id ?>" class="table table_rating table_center_text table-striped table-bordered">
    <thead>
        <tr id="responds">
            <td>№</td>
            <td>Студент</td>
            <td><div class="top_rating_data">Пропуски</div></td>
            <td><div class="top_rating_data">СР. БАЛЛ</div></td>
            <?php foreach($getGroupDate as $TopDate):?>
                    <td id="<?=$TopDate->data->id ?>"
                        class="edit raiting_data rd <?= $TopDate->col_rating_id->id ?>
                        " data-target="#modal_date_update" data-toggle="modal"
                        title="<?=$TopDate->data->themes->name_theme ?>">
                        <div class="top_rating_data"><?= date("d.m.Y", strtotime($TopDate->data->data)) ?></div>
                    </td>
            <?php endforeach;?>
        </tr>
    </thead>

<tbody>

<? foreach(\backend\models\Students::find()->where(['group_id'=>$model->group->id])->all() as $student):?>
    <tr>
        <th class="number disallow_ban"></th>
        <th><?php echo $student->last_name .
                ' ' .  $student->first_name
            ?></th>
        <td class="omissions disallow_ban"></td>
        <td class="average disallow_ban"></td>
          <?php foreach($getGroupDate as $date):?>
              <?php foreach( \backend\models\RatingGroup::getRatingFromDate($student->id, $date->id, $model->id) as $rating):?>
                  <td id="<?= $rating->id ?>" class="edit rating"><?php echo $rating->rating?></td>
              <?php endforeach;?>
          <?php endforeach;?>
    </tr>
<?php endforeach;?>
<tr class="addStudent_toggle"></tr>
</tbody>

</table>
</div>
</div>


<?php Pjax::end(); ?>
