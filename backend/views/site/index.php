<?php

/* @var $this yii\web\View */
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;
use yii\helpers\ArrayHelper;
use backend\models\SelectRating;
use yii\bootstrap\Tabs;

$this->title = 'Приятной работы!';
$script = <<< JS
$(document).ready(function() {
    setInterval(function(){ $("#refreshButton").click(); }, 1000);
    function a(){ $("#refreshButton").click(); };
    a();
    
     
});
JS;

$this->registerJs("

");
$this->registerJsFile('/backend/web/js/test.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJsFile('/backend/web/js/mainPageDashBoard.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);


$this->registerCssFile('/backend/web/css/postBackend/allPost.css',
    ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerCssFile('/backend/web/css/modalPicker.css',
    ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('/backend/web/css/postBackend/raspisanie.css',
    ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<?php
$this->registerJsFile('/backend/web/js/ogranichenia_letter.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/backend/web/js/timeTableSelectLesson.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<?php
/* @var $limitPostIndex*/
/* @var $newGroup*/
/* @var $searchModel*/
/* @var $allGroup*/


function obrizanieTexta($posts, $simvolov)
{
    $posts = strip_tags($posts);
    $posts = substr($posts, 0, $simvolov);
    $posts = rtrim($posts, "!,.-");
    echo $posts . "… ";
}
?>

    <div class="site-index ">
        <div class="body-content ">
 
            <div class="col-md-12 index_post">
                <div class="row mg_l col-lg-4 col-md-12 col-sm-12" style="margin-left: -15px !important;">
                    <!-- Новости -->
                    <?= $this->render('widgets/post', [
                        'limitPostIndex' => $limitPostIndex,
                    ]) ?>
                    <!-- #Новости -->
                </div>
                    <!-- #################################### -->
                <?php Pjax::begin(); ?>
                    <!-- Расписание -->
                <div class="row index_col_8_blok_tablo col-lg-8 col-md-12 col-sm-12">

                    <?= $this->render('widgets/raspisanie', [
                        'FindTimeTableToUserId' => $FindTimeTableToUserId,
                        'dayWeek' => $dayWeek,

                    ]) ?>
                </div>
            </div>
            <?php Pjax::end();?>
            <?php Pjax::begin(); ?>
            <!--////////////////    <br />     /////////////////////-->
            <div class="col-md-12 index_post">
                <div class="row mg_l col-lg-4 col-md-12 col-sm-12 filter filter-select" style="margin-left: -15px !important;">
                    <!-- Элементы поиска -->
                        <?= $this->render('widgets/select_form', [
                            'newGroup'=> $newGroup,
                            'group'=> $group,
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,

                        ]) ?>
                    <!-- #Элементы поиска -->
                </div>
                    <!-- #################################### -->

                    <!-- График -->
                <div class="row graph col-lg-8 col-md-12 col-sm-12">

                    <?=

                    Tabs::widget([
                        'items' => [
                            [
                                'label'     =>  'Успеваемость в группе',
                                'content'   =>  $this->render('widgets/graf', [
                                    'Rating' => $Rating,
                                    'Dates' => $Dates,
                                    'group' => $group,

                                ]),

                            ],
                            [
                                'label'     => 'Количество оценок',
                                'content'   =>  $this->render('widgets/graf2', [
                                    'LimitDate3' => $LimitDate3,
                                    'CountRating2_5Last5Date' => $CountRating2_5Last5Date,
                                    'CountRating2_5AllTime' => $CountRating2_5AllTime,
                                ]),
                                'active' =>  true
                            ],
                            [
                                'label'     => 'Пропуски в группе',
                                'content'   =>  $this->render('widgets/graf3',[
                                'Rating' => $GetStudentsAdSkip,
                                ]),


                            ],

                        ]
                    ]);


                    ?>
                </div>
            </div>
            <?php Pjax::end();?>
        </div>

    </div>

