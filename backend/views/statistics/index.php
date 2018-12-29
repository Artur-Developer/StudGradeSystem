<?php
/* @var $this yii\web\View */
use yii\widgets\Pjax;

$this->title = 'Чтобы посмотреть статистику необходимо выбрать параметры по которым она будет построена';

$this->registerCssFile('/backend/web/css/modalPicker.css',
    ['depends' => [\yii\web\JqueryAsset::className()]]);

$script = <<< JS
$(".buttonGetIdTableData").click(function () {
    var check_table = $(this).parents('tr').attr('data-key');

    $("input#input_get_sb_id").val(check_table);
    $(".buttonGetIdTableData").click(function () {
        var check_table = $(this).parents('tr').attr('data-key');
        // alert(check_table);
        $("input#input_get_sb_id").val(check_table);
    });
});
JS;

$script2HiddenSelectForm = <<< JS
$(".buttonGetIdTableData").click(function () {
    var check_table = $(this).parents('tr').attr('data-key');

    $("input#input_get_sb_id").val(check_table);
    $(".buttonGetIdTableData").click(function () {
        var check_table = $(this).parents('tr').attr('data-key');
        // alert(check_table);
        $("input#input_get_sb_id").val(check_table);
    });
});
JS;

$this->registerJs($script, yii\web\View::POS_READY);

?>

<?php Pjax::begin(); ?>
    <div class="statistics-index ">
        <div class="col-md-12">
            <?= $this->render('select_form', [
                'newGroup'=> $newGroup,
                'group'=> $group,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,

            ]) ?>
        </div>
       <div class="row2">
           <style>
               .highcharts-container{
                   padding: 10px 0 !important;
               }
           </style>
           <?= $this->render('@backend/views/site/widgets/graf2', [
               'LimitDate3' => $LimitDate3,
               'CountRating2_5Last5Date' => $CountRating2_5Last5Date,
               'CountRating2_5AllTime' => $CountRating2_5AllTime,

           ]) ?>
            <?= $this->render('@backend/views/site/widgets/graf', [
               'Rating' => $Rating,
               'Dates' => $Dates,
               'group' => $group,

           ]) ?>
           <?= $this->render('@backend/views/site/widgets/graf3', [
               'Rating' => $GetStudentsAdSkip,

           ]) ?>
          
       </div>

    </div>
<?php Pjax::end();