<?php
use yii\helpers\Html;


/* @var $this \yii\web\View */
/* @var $content string */


?>
<style>
    @media(max-width:348px) {
        .sidebar-toggle{
            padding: 15px 10px 14px !important;
        }
        .skin-blue .main-header .navbar .nav>li>a{
            font-size: 17px !important;
        }
        .navbar-nav > li > a{
            padding: 13px !important;
            line-height: 25px !important;
        }
        /*.breadcrumb{*/
            /*font-size: 11px !important;*/
        /*}*/
    }

</style>
<header class="main-header">

    <?= Html::a('<span class="logo-mini"><i class="fa fa-scribd"></i></span><span class="logo-lg">' . 'Успехов!' . '</span>', ['student/index',], ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" title="Нажмите клавишу ESC для сворачивания боковой панели">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">


                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src=" <? echo Yii::getAlias('/gallery/user.png') ?>" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?php echo Yii::$app->user->identity->last_name; echo '&nbsp'; echo Yii::$app->user->identity->first_name; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<? echo Yii::getAlias('/gallery/user.png') ?>" class="img-circle"
                                 alt="User Image"/>
                            <p>
                                <?php echo Yii::$app->user->identity->last_name; echo '&nbsp'; echo Yii::$app->user->identity->first_name;?>
                                <small>Студент группы <?= $student->group->name_group ?></small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <?= Html::a(
                                    'Профиль',
                                    ['/student/profile'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Выйти',
                                    ['/student/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
                <li>
                    <?= Html::a(
                        '<i class="fa fa-power-off"></i>',
                        ['/student/logout'],
                        ['data-method' => 'post']
                    ) ?>
                </li>
            </ul>
        </div>
    </nav>
</header>
