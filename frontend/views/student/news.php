<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 28.04.2018
 * Time: 19:51
 */

$this->title = 'Новости ';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('/backend/web/css/postBackend/viewsPost.css',
    ['depends' => [\yii\web\JqueryAsset::className()]]);



?>
<?php \yii\widgets\Pjax::begin(); ?>

<style>
    .post_footer_img{
        text-align: center;
        padding: 8px;
    }
    .post_header{
        font-size: 18px;
    }
    .student-news .post_body p{
        text-align: center;
    }
	@media(max-width:998px) {
		.student-news .post_header p{
			padding: 10px 5px;
		}
	}
	@media(max-width:480px) {
		.student-news .post_footer_text{
			font-size:15px !important;
		}
		
	}
	
</style>
<div class="student student-news backend_post">
    <?php if(!empty($allPost2)){
        foreach ($allPost2 as $posts) : ?>
            <? if($posts->how_send != 1): ?>
                <div class="meto_blok index_info_table">
                    <div class="post_footer_img">
                        <img src="<? echo Yii::getAlias('/gallery/info.png') ?>" width="50px" alt="">
                    </div>
                    <div class="post_header">
                        <p  class="padding_text"><a href="<?= yii\helpers\Url::to(['student/detail-news',
                                'id' => $posts->id]) ?>"><?= Yii::$app->formatter->asNtext((\yii\helpers\StringHelper::truncate($posts->title, 100))) ?></a></p>
                    </div>
                    <div class="post_body">
                        <p><?= Yii::$app->formatter->asNtext((\yii\helpers\StringHelper::truncate($posts->text, 320))) ?></p>
                    </div>
                    <div class="post_footer">

                        <div class="post_footer_text">
                            <p>Автор: <span><?=$posts->post->last_name . ' ' . $posts->post->first_name; ?></span></p>
                            <p>Дата создания: <span><?=$posts->date; ?></span></p>
                        </div>

                    </div>
                </div>
                <br>
                <hr>
                <br>
                <br>
            <? endif;?>

        <?php endforeach; ?>
    <?php }
    else{
        echo '<p class="container" style="font-size: 18px">Нет записей!</p>';
    }
    ?>

</div>
<?= \yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
<?php \yii\widgets\Pjax::end(); ?>

