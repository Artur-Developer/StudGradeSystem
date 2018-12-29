<?php
/**
 * Created by PhpStorm.
 * User: Artur
 * Date: 27.07.2018
 * Time: 12:43
 */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

?>
<div class="group-create_date">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-sm-9">
        <?= $form->field($RatingData, 'data')->widget(DatePicker::className(),[
            'name'=>'modal_date_add', 'value' => $popupDefaultDate,
            'options'=>['placeholder'=>'Выберите дату',],
            'pluginOptions'=>['autoclose'=>true],
        ]);
        ?>
    </div>

    <div class="col-sm-3">
        <br>
        <?= Html::submitButton($RatingData->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $RatingData->isNewRecord ? 'btn btn-lg btn-primary' : 'btn btn-lg btn-primary']) ?>
    </div>
    <br>
    <!--    Привязка темы к дате-->
    <div class="col-md-12 theme">
        <div class="input-group">
            <?= $form->field($RatingData, 'theme_id')->widget(\kartik\select2\Select2::className(),[
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
            ?>
            <?= $form->field($RatingData,'subject_group_id')->textInput()->hiddenInput(['value'=>$model->id])->label(false); ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
