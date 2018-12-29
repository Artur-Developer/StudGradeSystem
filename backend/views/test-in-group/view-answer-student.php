<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 27.04.2018
 * Time: 18:28
 */

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TestInGroup */

$this->title = 'Тест в группе: ' . $model->nameGroup->name_group .
    ' по дисциплине: '. $model->nameSubject->name_subject;
$this->params['breadcrumbs'][] = ['label' => 'Общий список', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nameGroup->name_group, 'url' => ['view-answer-student', 'id' => $model->id]];
?>
<div class="test-in-group-view">
    <?php $form = ActiveForm::begin(); ?>

    <p>
        <?= Html::a('Детали теста', ['view', 'id' => $model->id], ['class' => 'btn btn-lg btn-primary']) ?>
        <?= Html::submitButton($modelAnswer->isNewRecord ? 'Показать результаты' : 'Показать результаты', ['class' => $modelAnswer->isNewRecord ? 'btn  btn-lg btn-success' : 'btn btn-lg btn-primary']) ?>

    </p>


   <div class="col-lg-4 col-md-4">
       <br>
       <?= $form->field($modelAnswer,'get_student')->widget(\kartik\select2\Select2::className(),[
           'name' => 'get_student',
           'data' => \yii\helpers\ArrayHelper::map(\backend\models\AnswerTestStudent::find()->where(['test_id'=>$model->id])->groupBy('student_id')->all(),'student_id','student.last_name','student.first_name'),

           'language' => 'ru',
           'options' => [
               'onchange'=>'
                $.post( "../group/list-date?id="+$(this).val(), function( data ) {
                  $( "select#testingroup-rating_data_id" ).html( data );
                });
                ',
               'placeholder' => 'Студент...',
           ],
           'pluginOptions' => [

               'allowClear' => true
           ],
       ])
       ?>



   </div>

    <?php ActiveForm::end(); ?>

</div>
