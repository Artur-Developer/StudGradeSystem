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

Pjax::begin(); ?>
<?php
/* @var $limitPostIndex*/
/* @var $newGroup*/
/* @var $searchModel*/
/* @var $allGroup*/

?>
    <div class="site-index ">
        <div class="body-content ">
        </div>

    </div>
<?php Pjax::end();

