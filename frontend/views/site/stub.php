<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Операция прошла успешно!';
//$this->params['breadcrumbs'][] = $this->title;
?>

<?php
	$this->registerCssFile('/backend/web/css/globalEditStyle.css',
	['depends' => [\yii\web\JqueryAsset::className()]]);
	
	$this->registerCssFile('/frontend/web/css/login.css',
	['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<style>
    .alert-success,
    .alert-danger{
        text-align: center;
    }
.form_capcha_margin{
    margin-top: 15px;

}</style>

	<div class="section_elements_link_app">
		<div class="section_item section_item_1">
		    <div class="item_block">
		        <a href="<?= Yii::getAlias('/backend/site/login')?>">
		            <img src="/gallery/teachers.jpg" alt="">
		            <input type="button" value="Для преподавателей" class="btn btn-lg btn-success ">
		        </a>
		    </div>
		</div>
		<div class="section_item section_item_2">
	        <div class="item_block">
		        <a href="<?= Yii::getAlias('/frontend/web/student/login')?>">
		            <img src="/gallery/students.jpg" alt="">
		            <input type="button" value="Для студентов" class="btn btn-lg btn-danger ">
		
		         </a>
	        </div>
    	</div>
	</div>
