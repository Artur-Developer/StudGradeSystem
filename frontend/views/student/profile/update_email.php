<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 27.01.2018
 * Time: 19:37
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Изменение email адреса');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Профиль'), 'url' => ['profile']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-update-email">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="student-form col-lg-6 col-md-8 row">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Изменить'), ['class' => 'btn btn-lg btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>