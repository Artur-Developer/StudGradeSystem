<?
/**
 * Created by PhpStorm.
 * User: Artur
 * Date: 01.08.2018
 * Time: 11:13
 */
?>
<?= dmstr\widgets\Menu::widget(

    [
        'options' => ['class' => 'sidebar-menu','data-widget'=>'tree'],
        'items' => [

            ['label' => 'Главная','icon' => 'home', 'url' => ['/site']],
            [
                'label' => 'Новости',
                'icon' => 'newspaper-o',
                'url' => '#',
                'items' => [
                    ['label' => 'Добавить новость', 'icon' => 'file-o', 'url' => ['/postbackend/create'],],
                    ['label' => 'Все новости', 'icon' => 'list-alt', 'url' => ['/postbackend/allpost'],],
                    ['label' => 'Мои новости', 'icon' => 'pencil-square-o', 'url' => ['/postbackend/index'],],

                ],
            ],
            [
                'label' => 'Тесты',
                'icon' => 'balance-scale',
                'url' => '#',
                'items' => [
                    ['label' => 'База тестов', 'icon' => 'database', 'url' => ['/testing/index']],
                    ['label' => 'Создать тест', 'icon' => 'flask', 'url' => ['/testing/create']],

                ],
            ],
            ['label' => 'Провести тестирование', 'icon' => 'clock-o', 'url' => ['/test-in-group/index']],
            [
                'label' => 'Вопросы',
                'icon' => 'question',
                'url' => '#',
                'items' => [
                    ['label' => 'База вопросов', 'icon' => 'book', 'url' => ['/questions/index']],
                    ['label' => 'Создать вопрос', 'icon' => 'pencil', 'url' => ['/questions/create']],

                ],
            ],
            ['label' => 'Статистика','icon' => 'edit fa-line-chart', 'url' => ['/statistics']],
            ['label' => 'Оценки групп', 'icon' => 'building-o','url' => ['/group']],
            ['label' => 'Темы занятий', 'icon' => 'briefcase','url' => ['/themes']],
            [
                'label' => 'Профиль',
                'icon' => 'user',
                'url' => '/profile',
                'items' => [
                    ['label' => 'Профиль', 'icon' => 'user', 'url' => ['/profile/index']],
                    ['label' => 'Изменить пароль', 'icon' => 'expeditedssl', 'url' => ['/profile/change-password']],
                    ['label' => 'Изменить email', 'icon' => 'envelope-open-o', 'url' => ['/profile/update-email']],
                     ['label' => 'Доп. информация', 'icon' => 'address-card-o', 'url' => ['/profile/update-extended-info']],

                ],
            ],
            [
                'label' => 'Инструкция для работы',
                'icon' => 'cogs',
                'url' => '#',
                'items' => [
                    ['label' => 'Скачать', 'icon' => 'cloud-download','url' => ['/profile/for-teacher-download?key=2031806']],
                ],
            ],
            ['label' => 'Служба поддержки', 'icon' => 'life-ring', 'url' => ['/support/index']],
            

            ['label' => 'Вход', 'icon' => 'fa-lock','url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],

        ],
    ]
) ?>
