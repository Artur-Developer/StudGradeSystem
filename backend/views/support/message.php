<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SendMessageSupportForm */
/* @var $form ActiveForm */
?>
<div class="support support-message">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'message') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- message -->
