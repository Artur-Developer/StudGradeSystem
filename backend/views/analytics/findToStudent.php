<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 17.12.2017
 * Time: 20:34
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\typeahead;
use yii\helpers\Url;

?>

<div class="all-group-form row">

    <?php $form = ActiveForm::begin(); ?>


    <form id="form_modal_date_add" name="form_modal_date_add">


        <div class="col-sm-12 col-md-6">
            <label class="control-label">Выберите период</label>
            <?=
            DatePicker::widget([
                'name' => 'date1',
                'value' => date('d.m.Y'),
                'type' => DatePicker::TYPE_RANGE,
                'name2' => 'date2',
                'value2' => date('d.m.Y'),
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'dd.mm.yyyy'
                ]
            ]);
            ?>
        </div>

        <div class="col-sm-12 col-md-4">
            <label class="control-label">Выберите студента</label>

            <?= \kartik\select2\Select2::widget([
                'name' => 'StudentFindRating',
                'data' => ArrayHelper::map($GetAllStudent,'id',['last_name'],'group.name_group'),

                'language' => 'ru',
                'options' => [
                    'placeholder' => 'Выберите студента...',
                ],
                'pluginOptions' => [

                    'allowClear' => true
                ],
            ])
                        ?>

        </div>
        <div class="col-sm-6 col-md-2">
            <br>

            <?=  Html::a('Показать', ['analytics/index'],
                [
                    'class' => 'btn btn-lg btn-default',
                    'data' => [
                        'method' => 'post',
                        'params' => [
                            'analytincsToStudent' => 'toStudent',
                        ],
                    ],
                ]);?>
        </div>
    </form>

    <?php ActiveForm::end(); ?>

</div>
