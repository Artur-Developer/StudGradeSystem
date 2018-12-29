<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 31.07.2018
 * Time: 15:42
 */
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Общие сведения');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">
    <div class="col-lg-9 col-md-12">
       <div class="blok_button">
           <?= Html::a(Yii::t('app', 'Изменить пароль'), ['/profile/change-password'], ['class' => 'btn btn-primary']) ?>
           <?= Html::a(Yii::t('app', 'Изменить email'), ['/profile/update-email'], ['class' => 'btn btn-danger']) ?>
           <?= Html::a(Yii::t('app', 'Дополнительная информация'), ['/profile/update-extended-info'], ['class' => 'btn btn-primary']) ?>
       </div>
        <br>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'last_name',
                'first_name',
                'middle_name',
                'email',
                'created_at:date',
            ],
        ]) ?>

        <br>
        <h3>Список преподаваемых дисциплин:</h3>
        <div class="userSubjectList">
            <ol>
                <? foreach ($userSubjectList as $subject):?>
                    <li style="font-size: 16px;letter-spacing: 0.5px">
                        <?= $subject->subject->name_subject; ?>;
                    </li>
                <? endforeach;?>
            </ol>
        </div>
    </div>
</div>