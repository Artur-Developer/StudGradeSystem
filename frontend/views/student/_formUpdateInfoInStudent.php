<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


?>

<div class="site-activate-password container">
    <?= $this->title = 'Заполнение данных профиля';?>
    <hr>
    <div class="form-group  row">
        <?php $form = ActiveForm::begin(['id' => 'StudentsForm']); ?>
        <div class="col-md-6">
            <?= $form->field($info, 'last_name')->textInput(['maxlength' => true,'disabled'=>true]) ?>
            <?= $form->field($info, 'first_name')->textInput(['maxlength' => true,'disabled'=>true]) ?>
            <?= $form->field($info, 'middle_name')->textInput(['maxlength' => true,'disabled'=>true]) ?>
            <?= $form->field($info, 'traing')->textInput(['maxlength' => true,'disabled'=>true]) ?>
            <div class="col-md-12 row">
                <p>Согласен на обработку персональных данных согласно Федеральному Закону №152 РФ</p>
                <?= $form->field($model, 'rememberMe')->checkbox(['uncheck' => false]) ?>
                <?= Html::submitButton('Активация',[
                    'name' => 'SubmitStudentPassword',
                    'class' => 'btn btn-lg btn-danger'
                ]); ?>
            </div>
        </div>
        <div class="col-md-6">
            <?= $form->field($group, 'name_group')->textInput(['maxlength' => true,'disabled'=>true]) ?>
            <?= $form->field($info, 'email')->textInput(['maxlength' => true,'disabled'=>true]) ?>
            <?= $form->field($model, 'password_hash')->passwordInput(['autofocus' => true,]) ?>
            <?= $form->field($model, 'password_repeat')->passwordInput() ?>
        </div>
    </div>



        <?php ActiveForm::end(); ?>
    </div>