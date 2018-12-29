<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 27.01.2018
 * Time: 18:46
 */
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Профиль');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-profile">
    <div class="col-lg-10 col-md-12">
       <div class="blok_button">
           <?= Html::a(Yii::t('app', 'Изменить пароль'), ['/student/update-password'], ['class' => 'btn btn-primary']) ?>
           <?= Html::a(Yii::t('app', 'Изменить email'), ['/student/update-email'], ['class' => 'btn btn-danger']) ?>
           <?= Html::a(Yii::t('app', 'Дополнительная информация'), ['/student/update-extended-info'], ['class' => 'btn btn-primary']) ?>
       </div>
        <h1><?= Html::encode($this->title) ?></h1>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'last_name',
                'first_name',
                'middle_name',
                [
                    'attribute'=>'group_id',
                    'value'=>function($data){

                        $return = \backend\models\AllGroup::find()->where(['id' => $data->group_id])->one();
                        return $return->name_group;

                    },
                ],
                'email',
                'traing',
                'create_data',
            ],
        ]) ?>
        <br>
        <h2><?= Html::encode('Дополнительная информация') ?></h2>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'label'  => 'О себе',
                    'attribute'=>'about_me',
                    'value'=> $model->about_me
                ],
                'goals',
            ],
        ]) ?>
    </div>

</div>