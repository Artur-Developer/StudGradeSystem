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

$this->title = Yii::t('app', 'Оценки');
$this->params['breadcrumbs'][] = $this->title;

?>
<?php $form = ActiveForm::begin(); ?>

<style>
    .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th,
    .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td,
    .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
        border: 1px solid #adaab6 !important;
    }
    .kv-merged-header{
        border-bottom: 1px solid #94929d !important;
    }

</style>

    <div class="group-form">
        <?php
        echo GridView::widget([
            'dataProvider'=> $dataProvider,
            'filterModel' => $searchModel,
            'summary' => false,
            'pjax' => true,
            'columns' => [
                [
                    'class'=> 'kartik\grid\ExpandRowColumn',
                    'value'=>  function ($model, $key, $index,$column) {
                        return GridView::ROW_COLLAPSED;
                    },
                    'detail'=>function($model, $key, $index, $column){
                        return Yii::$app->controller->renderPartial('rating/rating', [
                            'model'=> $model,
                        ]);
                    },
                ],
                [
                    'attribute' => 'subject_id',
                    'value' => 'subject.name_subject',
                ],
                [
                    'attribute' => 'user_id',
                    'label' => 'Преподаватель',
                    'value' => function($data){
                        return $data->user->last_name .' '. $data->user->first_name .' '. $data->user->middle_name;
                    }
                ],

                ],
            'responsive'=>true,
            'hover'=>true
        ]);
        ?>

    </div>


    <!-- #Функционал для предподавателя-->

<?php ActiveForm::end(); ?>
