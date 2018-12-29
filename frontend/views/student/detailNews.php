<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 28.04.2018
 * Time: 19:51
 */

$this->title = $DetailNews->title;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['news']] ;

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
    .backend_post .post_body p{
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
    <?php if(!empty($DetailNews)):?>
            <?php if($DetailNews->how_send != 1): ?>
                <div class="meto_blok index_info_table">
                    <div class="post_footer_img">
                        <img src="<? echo Yii::getAlias('/gallery/info.png') ?>" width="50px" alt="">
                    </div>
                    <div class="post_header">
                        <p  class="padding_text"><a href="#"><?php echo $DetailNews->title?></a></p>
                    </div>
                    <div class="post_body">
                    	<p><?php echo $DetailNews->text ?></p>
                    </div>
                    <div class="post_footer">

                        <div class="post_footer_text">
                            <p>Автор: <span><?=$DetailNews->post->last_name . ' ' . $DetailNews->post->first_name; ?></span></p>
                            <p>Дата создания: <span><?=$DetailNews->date; ?></span></p>
                        </div>

                    </div>
                </div>

                <br>
                <hr>
                <br>
                <br>
            <?php endif;?>

        <?php endif;?>


</div>


