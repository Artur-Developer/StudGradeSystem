<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 28.01.2018
 * Time: 14:31
 */
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */

//$this->title = Yii::t('app', 'Оценки');
//$this->params['breadcrumbs'][] = $this->title;
//$this->registerJsFile('/frontend/web/js/ratingColor.js',
//    ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/frontend/web/js/ratingColor.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<style>
    .table-hover > tbody > tr > td.info,
    .table-hover > tbody > tr > th.info,
    .table-hover > tbody > tr.info > td,
    .table-hover > tbody > tr > .info,
    .table-hover > tbody > tr.info > th{
        background-color: rgba(51, 122, 183, 0) !important;
    }
    .table .table{
        background-color: rgba(0, 0, 0, 0);
    }
    .tr_rating{
        margin: 5px 0 !important;
        display: inline-table;
    }
    
     
    @media(max-width:650px) {
	   .tr_rating td{
	    	width:50% !important;
	    	display:inline-block;
	    }
	    .tr_rating td.rating, td.rating_date{
	    	margin:0 !important;
	    }
    }
    
    td.rating{
        padding: 5px 10px;
        border: 1px solid rgba(255, 255, 255, 0.32);
        margin-right: 20px;
        display: inline-block;
        -webkit-box-shadow: 10px 3px 10px rgba(25, 25, 25, 0.32);
        -moz-box-shadow: 10px 3px 10px rgba(25, 25, 25, 0.32);
        box-shadow: 10px 3px 10px rgba(25, 25, 25, 0.32);
    }
    td.rating_date{
        font-weight: 300;
        padding: 5px 10px;
        border: 1px solid rgba(255, 255, 255, 0.32);

        -webkit-transition: all .25s;
        -moz-transition: all .25s ;
        -ms-transition: all .25s ;
        -o-transition: all .25s ;
        transition: all .25s ;

    }
    td.rating_date:hover{
        background-color: rgba(51, 122, 183, 0.65);
        -webkit-transition: all .25s;
        -moz-transition: all .25s ;
        -ms-transition: all .25s ;
        -o-transition: all .25s ;
        transition: all .25s ;
        cursor: pointer;
    }
    .rating_5{ background-color: #1c6346; }
    .rating_4{ background-color: rgb(42, 102, 153); }
    .rating_3{ background-color: #ab5744; }
    .rating_2{ background-color: #a34149; }
    .rating_n{ background-color: #222d32; }
</style>
<div class="student-rating">
    <div class="col-lg-10 col-md-12">
        <div class="blok_button">
        </div>
        <?
            $rating = new \backend\models\RatingGroup();
            $getGroupDate = $rating->getGroupDate($model->id,1)
            ?>

        <table>
            <tr class="tr_rating">
                <?php foreach($getGroupDate as $date):?>
                    <td class="rating_date">
                        <?= Yii::$app->formatter->asDate($date->data->data); ?>
                    </td>

                    <?php foreach( \backend\models\RatingGroup::getRatingFromDate(Yii::$app->user->id, $date->id, $model->id) as $rating):?>
                        <td class="rating" hidden title="<?= $date->theme->name_theme?>"><?php
                            if(!empty($rating->rating)){
                                echo $rating->rating;
                            }
                            else {
                                echo '-';
                            }
                            ?></td>
                    <?php endforeach;?>
                <?php endforeach;?>
            </tr>
        </table>

    </div>

</div>