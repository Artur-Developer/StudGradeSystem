<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 27.01.2018
 * Time: 22:11
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Изменение дополнительной информации ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Профиль'), 'url' => ['profile']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-update-extended-info">

    <h1><i class="fa fa-address-card" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h1>

    <div class="student-form col-lg-6 col-md-8 row">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'about_me')->textarea(['maxlength' => true,'rows' => '6']) ?>
        <?= $form->field($model, 'goals')->textarea(['maxlength' => true,'rows' => '6']) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Изменить'), ['class' => 'btn btn-lg btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>