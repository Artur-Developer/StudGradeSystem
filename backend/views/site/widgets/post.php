<div class="backend_post">
    <?php if(!empty($limitPostIndex)){
        foreach ($limitPostIndex as $posts) : ?>
            <? $viewPost = \yii\helpers\Html::a("<i class=\"glyphicon glyphicon-eye-open\"></i>", ['postbackend/viewpost','id'=>$posts->id]);?>
            <? if($posts->how_send != 2): ?>
                <div class="meto_blok index_info_table">

                    <div class="post_header">
                        <p  class="padding_text">
                            <a href="<?= yii\helpers\Url::to(['postbackend/viewpost',
                                'id' => $posts->id]) ?>">
                                <?= Yii::$app->formatter->asNtext((\yii\helpers\StringHelper::truncate($posts->title, 120))) ?></a>
                        </p>
                    </div>
                    <div class="post_body">
                        <p><?= Yii::$app->formatter->asNtext((\yii\helpers\StringHelper::truncate($posts->text, 400))) ?></p>
                    </div>
                    <div class="post_footer">
                        <div class="post_footer_img">
                            <img src="<? echo Yii::getAlias('/gallery/info.png') ?>" width="50px" alt="">
                        </div>
                        <div class="post_footer_text">
                            <p>Автор: <span><?=$posts->post->last_name . ' ' . $posts->post->first_name; ?></span></p>
                            <p>Дата создания: <span><?=$posts->date; ?></span></p>
                        </div>
                        <div class="post_footer_button">
                            <button type="button">
                                <?=$viewPost ?>
                            </button>
                        </div>
                    </div>
                </div>
            <? endif;?>

        <?php endforeach; ?>
    <?php }
    else{
        echo '<p class="container" style="font-size: 18px">Нет записей!</p>';
    }
    ?>

</div>