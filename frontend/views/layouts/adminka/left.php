<?php
//use backend\assets\AppAsset;
//use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
//use yii\widgets\Breadcrumbs;
//use common\widgets\Alert;

$this->registerCssFile('/backend/web/css/left_menu.css',
    ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<aside class="main-sidebar">
    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
<!--                --><?//= $directoryAsset ?>
                <img src=" <? echo Yii::getAlias('/gallery/user.png') ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?php echo Yii::$app->user->identity->last_name; ?></p>
                <p><?php echo Yii::$app->user->identity->first_name; ?></p>
                <p><?php echo Yii::$app->user->identity->middle_name; ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Поиск..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?php if (!Yii::$app->user->isGuest){ ?>
        <?= dmstr\widgets\Menu::widget(

            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [

//                    ['label' => 'Страница колледжа','icon' => 'building-o', 'url' => ['/site/index']],
//                    ['label' => 'Главная','icon' => 'home', 'url' => ['/student/index']],
                    ['label' => 'Новости','icon' => 'newspaper-o', 'url' => ['/student/news']],
                    ['label' => 'Оценки','icon' => 'edit (alias)', 'url' => ['/student/rating']],
                    ['label' => 'Расписание','icon' => 'calendar', 'url' => ['/student/time-table']],
                    ['label' => 'Тестирование','icon' => 'edit fa-bar-chart', 'url' => ['/testing/index']],
                    [
                        'label' => 'Профиль',
                        'icon' => 'user',
                        'url' => '/student/profile',
                        'items' => [
                            ['label' => 'Профиль', 'icon' => 'user', 'url' => ['/student/profile']],
                            ['label' => 'Изменить пароль', 'icon' => 'expeditedssl', 'url' => ['/student/update-password']],
                            ['label' => 'Изменить email', 'icon' => 'envelope-open-o', 'url' => ['/student/update-email']],
                            ['label' => 'Доп. информация', 'icon' => 'address-card-o', 'url' => ['/student/update-extended-info']],

                        ],
                    ],
                    ['label' => 'Изменить пароль', 'icon' => 'expeditedssl', 'url' => ['/student/update-password']],
                    ['label' => 'Изменить email', 'icon' => 'envelope-open-o', 'url' => ['/student/update-email']],
                    ['label' => 'Доп. информация', 'icon' => 'address-card-o', 'url' => ['/student/update-extended-info']],
                    ['label' => 'Служба поддержки', 'icon' => 'life-ring', 'url' => ['/support/index']],


                ],
            ]
        ) ?>
<?php }?>

        <?php if  (Yii::$app->user->isGuest)  { ?>
        <?= dmstr\widgets\Menu::widget(

            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Главная', 'icon' => 'home','url' => ['/site/index']],
                    ['label' => 'Войти', 'icon' => 'fa-lock','url' => ['/student/login'], 'visible' => Yii::$app->user->isGuest],

                ],
            ]
        ) ?>
<?php }?>



    </section>

</aside>
