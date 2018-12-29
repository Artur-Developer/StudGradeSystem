<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

//include(Yii::getAlias('/../../customScripts/CustomScripts.php'));

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PostbackendSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['allpost']] ;

$this->registerJsFile('/backend/web/js/ogranichenia_letter.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('/backend/web/css/postBackend/allPost.css',
    ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('/backend/web/css/postbackend/viewsPost.css',
    ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<?php Pjax::begin(); ?>

<div class="backend_post">

    <div class="col-md-0 col-sm-0 ">
        <img src="/gallery/info.png" width="65px"  alt="">
    </div>
    <div class="blok_post col-md-12 col-sm-12 ">
                <div class="post_header col-md-12">
                    <p  class="col-lg-12"><a href="<?= yii\helpers\Url::to(['postbackend/viewpost', 'id' => $model->id])?>"><?= $model->title ?></a></p>
                </div>
                <div class="post_body col-lg-12">
                    <p><?= $model->text ?></p>
                </div>
                <div class="post_footer col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <div class="post_footer_img col-md-1">

                    </div>
                    <div class="post_footer_text ">
                        <p>Автор: <span><?= $model->post->last_name . ' ' . $model->post->first_name; ?></span></p>
                        <p>Дата создания: <span><?= $model->date; ?></span></p>
                    </div>

                </div>
            </div>

</div>
<?php Pjax::end(); ?>






