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

?>
<?php Pjax::begin(); ?>
<?php $form = ActiveForm::begin(); ?>

<style>
    .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th,
    .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td,
    .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
        border: 1px solid #94929d;
    }
    .kv-merged-header{
        border-bottom: 1px solid #94929d !important;
    }
</style>

<?php if (!Yii::$app->user->isGuest && Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()) ['Firste_admin']->name == 'Firste_admin') { ?>
    <!--Функционал для администратора-->
    <div class="group-form">
        <?php

        echo GridView::widget([
            'dataProvider'=> $dataProvider,
            'filterModel' => $searchModel,
            'summary' => false,
            'columns' => [
                [
                    'class'=> 'kartik\grid\ExpandRowColumn',
                    'value'=>  function ($model, $key, $index,$column) {
                        return GridView::ROW_COLLAPSED;
                    },
                    'detail'=>function($newGroup, $group, $SelectRating,  $column){

                        return Yii::$app->controller->renderPartial('widgets/date_rating_table', [
                            'newGroup'=> $newGroup,
                            'group'=> $group,
                            'SelectRating'=> $SelectRating,

                        ]);
                    },
                ],
                [
                    'attribute' => 'group_id',
                    'value' => 'group.name_group',
                ],
                [
                    'attribute' => 'subject_id',
                    'value' => 'subject.name_subject',

                ],


                ],
            'responsive'=>true,
            'hover'=>true
        ]);
        ?>

    </div>

    <!-- #Функционал для администратора-->
<?php }?>


<?php if (!Yii::$app->user->isGuest && Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()) ['Prepod']->name == 'Prepod') { ?>

    <!--Функционал для преподавателя-->
    <div class="group-form">
        <?php

        echo GridView::widget([
            'dataProvider'=> $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'class'=> 'kartik\grid\ExpandRowColumn',
                    'value'=>  function ($model, $key, $index,$column) {
                        return GridView::ROW_COLLAPSED;
                    },
                    'detail'=>function($newGroup, $group, $SelectRating,  $column){

                        return Yii::$app->controller->renderPartial('widgets/date_rating_table', [
                            'newGroup'=> $newGroup,
                            'group'=> $group,
                            'SelectRating'=> $SelectRating,

                        ]);
                    },
                ],
                [
                    'attribute' => 'group_id',
                    'value' => 'group.name_group',
                ],
                [
                    'attribute' => 'subject_id',
                    'value' => 'subject.name_subject',
                ],

            ],
            'responsive'=>true,
            'hover'=>true
        ]);
        ?>

    </div>
    <!-- #Функционал для предподавателя-->
<?php }?>

<?php ActiveForm::end(); ?>
<?php Pjax::end();?>
