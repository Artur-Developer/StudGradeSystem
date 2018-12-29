<?php
    use yii\helpers\ArrayHelper;
    use yii\widgets\ActiveForm;
    use backend\models\SelectRating;
    use backend\models\Group;
    use kartik\grid\GridView;
    use kartik\grid\DataColumn;
    use yii\grid\SerialColumn;
    use yii\grid\RadioButtonColumn;
    use yii\helpers\Html;
    use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Тестирование');
$this->params['breadcrumbs'][] = $this->title;

?>
<?php $form = ActiveForm::begin(); ?>

<style>
    .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th,
    .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td,
    .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
        border: 1px solid #adaab6 !important;
        padding: 10px 20px;
        vertical-align: middle;
    }
    .kv-merged-header{
        border-bottom: 1px solid #94929d !important;
    }
    .testing_list_table{
        vertical-align: middle;
        text-align: center;
        overflow: auto;
    }
    .testing_list_table thead tr{
        background-color: rgba(0, 0, 0, 0.4);
    }
    .testing_list_table .start_date{
        background-color: rgba(57, 111, 142, 0.49);
    }
    .testing_list_table .end_date{
        background-color: rgba(142, 57, 73, 0.49);
    }
    .testing-index{
    	overflow:auto;
    }


</style>

    <div class="testing-index">
        <table class="table table-striped table-bordered detail-view testing_list_table">
            <thead>
                <tr>
                    <td>Тест</td>
                    <td>Дисциплина</td>
                    <td>Статус</td>
                    <td>Начинается</td>
                    <td>Заканчивается</td>
                    <td>Преподаватель</td>
                    <td>Тип теста</td>
                    <td>Обязательность</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($findSG as $subject_group_id):?>

                    <?php 
                    foreach(\backend\models\TestInGroup::find()->where(['subject_group_id'=>$subject_group_id->id])->all() as $test):
//                    foreach($findTestList as $test):
                        ?>
                        <tr class="tr_rating">
                            <td class="test" style="text-align: center">
                                <?= Html::a('Начать', ['process', 'testId' => $test->id], ['class' => 'btn btn-success']) ?>
                            </td>
                            <td class="test">
                                <?= $test->nameSubject->name_subject; ?>
                            </td>
                            <td width="5%">
                                <? if($test->required == 1): ?>
                                    <i  style="color:#17ff3e; font-size: 20px; vertical-align: middle;text-align: center;width: 100%;"
                                        class="fa fa-check" aria-hidden="true"></i>
                                <? elseif($test->required == 0): ?>
                                    <i  style="color:#ff0b0b; font-size: 20px; vertical-align: middle;text-align: center;width: 100%;"
                                        class="fa fa-check" aria-hidden="true"></i>
                                <? endif;?>
                            </td>
                            <td class="start_date">
                                <?= $test->start_date; ?>
                            </td>
                            <td class="end_date">
                                <?= $test->end_date; ?>
                            </td>
                            <td class="test">
                                <?= $test->user->last_name .
                                ' ' . $test->user->first_name.
                                ' ' . $test->user->middle_name; ?>
                            </td>
                            <td class="test">
                                <?= $test->type; ?>
                            </td>
                            <td width="5%">
                                <? if($test->required == 1): ?>
                                    <i  style="color:#17ff3e; font-size: 20px; vertical-align: middle;text-align: center;width: 100%;"
                                        class="fa fa-check" aria-hidden="true"></i>
                                <? elseif($test->required == 0): ?>
                                    <i  style="color:#ff0b0b; font-size: 20px; vertical-align: middle;text-align: center;width: 100%;"
                                        class="fa fa-check" aria-hidden="true"></i>
                                <? endif;?>
                            </td>

                        </tr>

                    <?php endforeach;?>

                <?php endforeach;?>
            </tbody>
        </table>
    </div>

<?php ActiveForm::end(); ?>
