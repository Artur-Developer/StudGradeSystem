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
        .breadcrumb{
            font-size: 11px !important;
        }
    }

</style>
<header class="main-header">

    <?= Html::a('<span class="logo-mini"><i class="fa fa-scribd"></i></span><span class="logo-lg">' . 'Приятной работы!' . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" title="Нажмите клавишу ESC для сворачивания боковой панели">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->
<!--                <li class="dropdown messages-menu">-->
<!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
<!--                        <i class="fa fa-envelope-o"></i>-->
<!--                        <span class="label label-success">4</span>-->
<!--                    </a>-->
<!--                    <ul class="dropdown-menu modal_message">-->
<!--                        <li class="header">У вас 4 сообщения</li>-->
<!--                        <li>-->
<!--                            <ul class="menu">-->
<!--                                    <a href="#">-->
<!--                                        <div class="pull-left">-->
<!--                                            <img src="--><?//= $directoryAsset ?><!--/img/user2-160x160.jpg" class="img-circle"-->
<!--                                                 alt="User Image"/>-->
<!--                                        </div>-->
<!--                                        <h4>-->
<!--                                            Support Team-->
<!--                                            <small><i class="fa fa-clock-o"></i> 5 мин</small>-->
<!--                                        </h4>-->
<!--                                        <p>Why not buy a new awesome theme?</p>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="#">-->
<!--                                        <div class="pull-left">-->
<!--                                            <img src="--><?//= $directoryAsset ?><!--/img/user3-128x128.jpg" class="img-circle"-->
<!--                                                 alt="user image"/>-->
<!--                                        </div>-->
<!--                                        <h4>-->
<!--                                            AdminLTE Design Team-->
<!--                                            <small><i class="fa fa-clock-o"></i> 2 дня</small>-->
<!--                                        </h4>-->
<!--                                        <p>Why not buy a new awesome theme?</p>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="#">-->
<!--                                        <div class="pull-left">-->
<!--                                            <img src="--><?//= $directoryAsset ?><!--/img/user4-128x128.jpg" class="img-circle"-->
<!--                                                 alt="user image"/>-->
<!--                                        </div>-->
<!--                                        <h4>-->
<!--                                            Developers-->
<!--                                            <small><i class="fa fa-clock-o"></i> Неделя</small>-->
<!--                                        </h4>-->
<!--                                        <p>Why not buy a new awesome theme?</p>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="#">-->
<!--                                        <div class="pull-left">-->
<!--                                            <img src="--><?//= $directoryAsset ?><!--/img/user3-128x128.jpg" class="img-circle"-->
<!--                                                 alt="user image"/>-->
<!--                                        </div>-->
<!--                                        <h4>-->
<!--                                            Sales Department-->
<!--                                            <small><i class="fa fa-clock-o"></i> Yesterday</small>-->
<!--                                        </h4>-->
<!--                                        <p>Why not buy a new awesome theme?</p>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="#">-->
<!--                                        <div class="pull-left">-->
<!--                                            <img src="--><?//= $directoryAsset ?><!--/img/user4-128x128.jpg" class="img-circle"-->
<!--                                                 alt="user image"/>-->
<!--                                        </div>-->
<!--                                        <h4>-->
<!--                                            Reviewers-->
<!--                                            <small><i class="fa fa-clock-o"></i> 2 days</small>-->
<!--                                        </h4>-->
<!--                                        <p>Why not buy a new awesome theme?</p>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </li>-->
<!--                        <li class="footer"><a href="#">Посмотреть всё</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                ***********************-->
<!--                <li class="dropdown notifications-menu">-->
<!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
<!--                        <i class="fa fa-bell-o"></i>-->
<!--                        <span class="label label-warning">10</span>-->
<!--                    </a>-->
<!--                    <ul class="dropdown-menu">-->
<!--                        <li class="header">You have 10 notifications</li>-->
<!--                        <li>-->
<!--                            <ul class="menu">-->
<!--                                <li>-->
<!--                                    <a href="#">-->
<!--                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="#">-->
<!--                                        <i class="fa fa-warning text-yellow"></i> Very long description here that may-->
<!--                                        not fit into the page and may cause design problems-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="#">-->
<!--                                        <i class="fa fa-users text-red"></i> 5 new members joined-->
<!--                                    </a>-->
<!--                                </li>-->
<!---->
<!--                                <li>-->
<!--                                    <a href="#">-->
<!--                                        <i class="fa fa-shopping-cart text-green"></i> 25 sales made-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="#">-->
<!--                                        <i class="fa fa-user text-red"></i> You changed your username-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </li>-->
<!--                        <li class="footer"><a href="#">View all</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
                <!-- Tasks: style can be found in dropdown.less -->
<!--                <li class="dropdown tasks-menu">-->
<!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
<!--                        <i class="fa fa-flag-o"></i>-->
<!--                        <span class="label label-danger">9</span>-->
<!--                    </a>-->
<!--                    <ul class="dropdown-menu">-->
<!--                        <li class="header">You have 9 tasks</li>-->
<!--                        <li>-->
<!--                            <ul class="menu">-->
<!--                                    <a href="#">-->
<!--                                        <h3>-->
<!--                                            Design some buttons-->
<!--                                            <small class="pull-right">20%</small>-->
<!--                                        </h3>-->
<!--                                        <div class="progress xs">-->
<!--                                            <div class="progress-bar progress-bar-aqua" style="width: 20%"-->
<!--                                                 role="progressbar" aria-valuenow="20" aria-valuemin="0"-->
<!--                                                 aria-valuemax="100">-->
<!--                                                <span class="sr-only">20% Complete</span>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                    <a href="#">-->
<!--                                        <h3>-->
<!--                                            Create a nice theme-->
<!--                                            <small class="pull-right">40%</small>-->
<!--                                        </h3>-->
<!--                                        <div class="progress xs">-->
<!--                                            <div class="progress-bar progress-bar-green" style="width: 40%"-->
<!--                                                 role="progressbar" aria-valuenow="20" aria-valuemin="0"-->
<!--                                                 aria-valuemax="100">-->
<!--                                                <span class="sr-only">40% Complete</span>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                    <a href="#">-->
<!--                                        <h3>-->
<!--                                            Some task I need to do-->
<!--                                            <small class="pull-right">60%</small>-->
<!--                                        </h3>-->
<!--                                        <div class="progress xs">-->
<!--                                            <div class="progress-bar progress-bar-red" style="width: 60%"-->
<!--                                                 role="progressbar" aria-valuenow="20" aria-valuemin="0"-->
<!--                                                 aria-valuemax="100">-->
<!--                                                <span class="sr-only">60% Complete</span>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                    <a href="#">-->
<!--                                        <h3>-->
<!--                                            Make beautiful transitions-->
<!--                                            <small class="pull-right">80%</small>-->
<!--                                        </h3>-->
<!--                                        <div class="progress xs">-->
<!--                                            <div class="progress-bar progress-bar-yellow" style="width: 80%"-->
<!--                                                 role="progressbar" aria-valuenow="20" aria-valuemin="0"-->
<!--                                                 aria-valuemax="100">-->
<!--                                                <span class="sr-only">80% Complete</span>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </li>-->
<!--                        <li class="footer">-->
<!--                            <a href="#">View all tasks</a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </li>-->
                <!-- User Account: style can be found in dropdown.less -->

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
                                <? if(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()) ['Firste_admin']->name == 'Firste_admin'):?>
                                <small>Администратор первого уровня</small>
                                <? elseif (Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()) ['Prepod']->name == 'Prepod'):?>
                                    <small>Преподаватель</small>
                                <? endif;?>
                            </p>
                        </li>
                        <!-- Menu Body -->
<!--                        <li class="user-body">-->
<!--                            <div class="col-xs-4 text-center">-->
<!--                                <a href="#">Followers</a>-->
<!--                            </div>-->
<!--                            <div class="col-xs-4 text-center">-->
<!--                                <a href="#">Sales</a>-->
<!--                            </div>-->
<!--                            <div class="col-xs-4 text-center">-->
<!--                                <a href="#">Friends</a>-->
<!--                            </div>-->
<!--                        </li>-->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?= Html::a(
                                    'Профиль',
                                    ['/profile/index'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                                </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Выйти',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
                <li>
                    <?= Html::a(
                        '<i class="fa fa-power-off"></i>',
                        ['/site/logout'],
                        ['data-method' => 'post']
                    ) ?>
                </li>
            </ul>
        </div>
    </nav>
</header>
