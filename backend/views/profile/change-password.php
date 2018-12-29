<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\ChangePassword */

$this->title = Yii::t('app', 'Изменение пароля');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-signup">

    <div class="blok_button">
        <?= Html::a(Yii::t('app', 'Общие сведения'), ['/profile/index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a(Yii::t('app', 'Изменить пароль'), ['/profile/change-password'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Изменить email'), ['/profile/update-email'], ['class' => 'btn btn-danger']) ?>
        <?= Html::a(Yii::t('app', 'Дополнительная информация'), ['/profile/update-extended-info'], ['class' => 'btn btn-primary']) ?>
    </div>
    <br>
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'form-change']); ?>
                <?= $form->field($model, 'oldPassword')->passwordInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'newPassword')->passwordInput() ?>
                <?= $form->field($model, 'retypePassword')->passwordInput() ?>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Изменить'), ['class' => 'btn btn-lg btn-primary', 'name' => 'change-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
