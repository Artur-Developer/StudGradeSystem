<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 22.12.2017
 * Time: 17:50
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

?>


<div class="all-group-form row">

    <?php $form = ActiveForm::begin(); ?>


    <form id="form_modal_date_add" name="form_modal_date_add" class="row">


        <div class="col-sm-6">
            <label class="control-label">Выберите период</label>
            <?= DatePicker::widget([
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
        <div class="col-md-4">
            <label class="control-label">Группа</label>
            <?= \kartik\select2\Select2::widget([
                'name' => 'toGroup',
                'data' => ArrayHelper::map($GetAllGroup,'id','name_group'),

                'language' => 'ru',
                'options' => [
                    'placeholder' => 'Выберите группу...',
                ],
                'pluginOptions' => [

                    'allowClear' => true
                ],
            ])
             ?>

        </div>
        <div class="col-sm-2">
            <?=  Html::a('Показать', ['analytics/index'],
                [
                    'class' => 'btn btn-lg btn-default',
                    'data' => [
                        'method' => 'post',
                        'params' => [
                            'analytincsToGroup' => 'toGroup',
                        ],
                    ],
                ]);?>
        </div>
    </form>





    <?php ActiveForm::end(); ?>

</div>