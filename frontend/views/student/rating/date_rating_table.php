<?php

    use kartik\date\DatePicker;
    use yii\widgets\Pjax;
    use yii\helpers\Html;
    use yii\grid\GridView;
    use miloschuman\highcharts\Highcharts;
    use yii\helpers\ArrayHelper;
    use backend\models\SelectRating;
    use yii\widgets\ActiveForm;
    use backend\models\Group;
    use yii\bootstrap\Modal;

?>
<div class="add_modal_picker">

    <div class="buttonAdd" style="display: inline-block; margin: 0 5px">
        <form>
            <select name="ratingGraf" class="btn btn-danger">
                <option value="7">Успеваемость</option>
                <option value="6">Посещаемость</option>
            </select>
        </form>
    </div>

        <?
        Modal::begin([
            'header' => '<h2>Выбрать период</h2>',
            'toggleButton' => ['label' => 'По дате', 'class' => 'btn btn-md btn-success buttonGetIdTableData'],
        ]);
        ?>

    <form id="form_modal_date_add" name="form_modal_date_add" class="row">
        <div class="col-sm-9">
            <input hidden="hidden" type="text" id="input_get_sb_id" name="sb_id" value="0" />
            <?= DatePicker::widget([
            'name' => 'date1',
            'value' => date('d.m.Y'),
            'type' => DatePicker::TYPE_RANGE,
            'name2' => 'date2',
            'value2' => date('d.m.Y'),
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd-M-yyyy'
            ]
        ]);
            ?>

        </div>

        <div class="col-sm-3">
            <button type="submit" id="button_select_rating_by_data" class="btn btn-lg btn-default button_add_data">Выбрать</button>
        </div>
    </form>



    <?php Modal::end();?>
</div>
