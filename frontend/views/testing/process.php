<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 25.04.2018
 * Time: 15:08
 */

use yii\helpers\Html;
use yii\grid\GridView;
use \backend\models\QuestionAnswers;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TestInGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Прохождение теста: '. $model->test->name_test;
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .testing-process .main_block{
        border: 1px solid #fff;
        padding:30px;
        display: block;
        margin: 0 auto;
        width: 100%;
    }
    .testing-process .main_block table  td{
        vertical-align: middle;
        padding:10px;
    }
    .testing-process .main_block .name_question{
        padding:20px;
    }
    .testing-process .main_block .answer input{
       margin: 0 auto;
        display: block;
    }


</style>

<?php Pjax::begin(); ?>
<?php
?>


<?php $form = ActiveForm::begin(); ?>
<div class="testing-process">



    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 ">
        <div class="main_block">
            <table class="table table-striped table-bordered detail-view">
                <thead>
                <tr>
<!--                    <th width="50%">Вопрос</th>-->
<!--                    <td width="50%">Варианты ответов</td>-->
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="5%" id="time_question" class="time_question"><?= $time->question->time?></td>
                        <td  class="name_question"><?= $findTest[$countQuestions]->question->name_question?></td>
                    </tr>


                        <? foreach ($questionAnswers = \backend\models\QuestionAnswers::find()->where(['question_id'=>$findTest[$countQuestions]->question_id])->all() as $answer):?>

                                <tr class="answer">
                                    <td>
                                        #
                                    </td>
                                    <td>
                                        <label class="radio">
<!--                                            --><?//= $form->field($model2,'answer')->radio([$answer->id => $answer->id], ['unselect' => $answer->id])->label($answer->name_answer) ?>
                                            <?= Html::radio('answer', false,['class' => 'agreement','value'=> $answer->id,'label'=>$answer->name_answer]) ?>
                                        </label>
                                    </td>
                                </tr>

                        <? endforeach;?>

                    <tr><td colspan="2"><?= Html::submitButton($model2->isNewRecord ? 'Ответить' : 'Ответить', ['class' => 'btn btn-lg btn-success']) ?></td></tr>
<!--                    --><?// endforeach;?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>
