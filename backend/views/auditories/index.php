<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AuditoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Аудитории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auditories-index">
<?php Pjax::begin() ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="modalUpdateInfoAuditories add_modal_picker">

        <?
        Modal::begin([
            'header' => '<h2>Редактироваие аудитории</h2>',
            'id'=>'modalUpdateInfoAuditories',
        ]);
        ?>

        <?php Modal::end();?>

    </div>


    <p>
        <?= Html::a('Добавить аудиторию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'capacity',
            'number',
            'type',
            'description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end() ?>
</div>
