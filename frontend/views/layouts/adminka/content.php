<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

?>
<?php if (Yii::$app->user->isGuest) { ?>
    <style>
        .content-wrapper{
            margin-left: 0 !important;
        }
    </style>
<?php }?>
<style>

    .content-wrapper, .right-side  {
        background-color: #5f515f;
        background: -moz-radial-gradient(center, ellipse cover, rgb(127, 123, 150) 0%, rgb(128, 123, 150) 7%, rgb(28, 74, 88) 100%); /* ff3.6+ */
        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgb(127, 123, 150)), color-stop(7%, rgb(128, 123, 150)), color-stop(100%,  rgb(28, 74, 88))); /* safari4+,chrome */
        background:-webkit-radial-gradient(center, ellipse cover, rgb(127, 123, 150) 0%, rgb(128, 123, 150) 7%, rgb(28, 74, 88) 100%); /* safari5.1+,chrome10+ */
        background: -o-radial-gradient(center, ellipse cover, rgb(127, 123, 150) 0%, rgb(128, 123, 150) 7%, rgb(28, 74, 88) 100%); /* opera 11.10+ */
        background: -ms-radial-gradient(center, ellipse cover, rgb(127, 123, 150) 0%, rgb(128, 123, 150) 7%, rgb(28, 74, 88) 100%); /* ie10+ */
        background:radial-gradient(ellipse at center, rgb(127, 123, 150) 0%, rgb(128, 123, 150) 7%, rgb(28, 74, 88) 100%); /* w3c */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#968F7B', endColorstr='#222d32',GradientType=0 ); /* ie6-9 */
    }



    a{
        color: #ffdda2;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <?php if(!Yii::$app->user->isGuest){?>
            <h1></h1>

        <?php if (isset($this->blocks['content-header'])) { ?>
            <h1><?= $this->blocks['content-header'] ?></h1>
        <?php } else { ?>
            <h1>
                <?php
                if ($this->title !== null) {
                    echo \yii\helpers\Html::encode($this->title);
                } else {
                    echo \yii\helpers\Inflector::camel2words(
                        \yii\helpers\Inflector::id2camel($this->context->module->id)
                    );
                    echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                } ?>
            </h1>
        <?php } ?>
        <?php }?>

        <div class="row">
            <?php if (!Yii::$app->user->isGuest) { ?>
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
            <?php } ?>


        </div>
    </section>

    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
<!--        <div class="tab-pane" id="control-sidebar-home-tab">-->
        <h3 class="control-sidebar-heading">Данный блок будет разработан в будущем!</h3>

    </div>
</aside><!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>