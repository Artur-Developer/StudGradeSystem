<?php
/**
 * Created by PhpStorm.
 * User: Artur
 * Date: 21.08.2018
 * Time: 14:48
 */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

?>

<div class="group-update_date">


    <form id="form_update_modal_data" name="form_update_modal_data" class="row ">
        <div class="col-sm-7">
            <?= DatePicker::widget(['name'=>'name_modal_date_update', 'value' => $popupDefaultDate,
                'options'=>['placeholder'=>'Выберите дату',],
                'pluginOptions'=>['autoclose'=>true]]); ?>
        </div>


        <div class="col-sm-2">
            <button type="button" id="modal_date_delete" class="btn btn-lg btn-danger modal_date_delete">Удалить</button>
        </div>
        <div class="col-sm-3">
            <button type="button" id="button_modal_date_update" class="btn btn-lg btn-default button_modal_date_update">Обновить</button>
        </div>

        <br>
        Привязка темы к дате
        <div class="col-md-12 theme">
            <h5 class="date_in_theme" >К дате привязана тема:<br><i style="padding: 0px 4px"></i></h5>
            <hr>
            <h5>Поле для привязки темы к дате</h5>

            <div class="input-group">
              <span class="input-group-btn">
                <button class="btn btn-default addThemeDate" type="button"><i class="fa fa-trash" style="font-size: 16px"></i></button>
              </span>

                <?= \kartik\select2\Select2::widget([
                    'name' => 'theme_id',
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\Themes::find()->where(['subject_id'=>$model->subject_id])->all(),'id','name_theme'),

                    'language' => 'ru',
                    'options' => [
                        'placeholder' => 'Выберите тему...',
                    ],
                    'pluginOptions' => [

                        'allowClear' => true
                    ],
                ])
//                ?>
            </div>
        </div>
    </form>
</div>

