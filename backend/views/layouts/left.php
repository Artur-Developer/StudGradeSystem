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

        <?php if (!Yii::$app->user->isGuest && Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()) ['Firste_admin']->name == 'Firste_admin') {
            echo $this->render('./menuForRules/firste_admin');
        }?>

        <?php if (!Yii::$app->user->isGuest && Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()) ['Prepod']->name == 'Prepod') {
            echo $this->render('./menuForRules/prepod');
        }?>

        <?php if  (Yii::$app->user->isGuest)  { ?>
        <?= dmstr\widgets\Menu::widget(

            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Главная', 'icon' => 'home','url' => ['/site']],
                    ['label' => 'Войти', 'icon' => 'fa-lock','url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],

                ],
            ]
        ) ?>
<?php }?>



    </section>

</aside>
