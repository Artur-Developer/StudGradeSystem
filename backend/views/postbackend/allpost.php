<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

//include(Yii::getAlias('/../../customScripts/CustomScripts.php'));

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PostbackendSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('/backend/web/css/postBackend/allPost.css',
    ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<?php Pjax::begin(); ?>
<?= \yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
<div class="backend_post">

<?php

if(!empty($allPost2)){
    foreach ($allPost2 as $posts) : ?>
    <div class="blok_post col-lg-4 col-md-6">
        <div class="post_header col-md-12">
            <p  class="col-lg-10 col-md-9"><a href="<?= yii\helpers\Url::to(['postbackend/viewpost', 'id' => $posts->id])?>"><?= Yii::$app->formatter->asNtext((\yii\helpers\StringHelper::truncate($posts->title, 50))) ?></a></p>
        </div>
        <div class="post_body col-lg-12">
            <p><?= Yii::$app->formatter->asNtext((\yii\helpers\StringHelper::truncate($posts->text, 250))) ?></p>
        </div>
        <div class="post_footer col-lg-12 col-md-12 col-sm-12">
            <div class="post_footer_img col-md-1">
                <img src="../../../gallery/info.png" width="40px" alt="">
            </div>
            <div class="post_footer_text col-md-10">
                <p>Автор: <span><?=$model->post->last_name . ' ' . $model->post->first_name; ?></span></p>
                <p>Дата создания: <span><?=$posts->date; ?></span></p>
            </div>
            <div class="post_footer_button col-md-1">
                <button type="button"><a href="<?= yii\helpers\Url::to(['postbackend/viewpost', 'id' => $posts->id])?>"><i class="glyphicon glyphicon-eye-open"></i></a></button>
            </div>
        </div>
    </div>

    <?php endforeach; ?>

    <?php }
    else{
        echo '<p style="font-size: 18px">Нет записей!</p>';
    }?>
</div>
<?php Pjax::end(); ?>






