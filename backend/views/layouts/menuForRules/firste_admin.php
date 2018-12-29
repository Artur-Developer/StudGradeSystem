<?
/**
 * Created by PhpStorm.
 * User: Artur
 * Date: 01.08.2018
 * Time: 11:13
 */
?>
<?=
         dmstr\widgets\Menu::widget(

            [
                'options' => ['class' => 'sidebar-menu', 'data-widget'=>'tree'],
                'items' => [

                    ['label' => 'Главная','icon' => 'home', 'url' => ['/site']],
                    [
                        'label' => 'Пользователи',
                        'icon' => 'users',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Управление', 'icon' => 'edit (alias)', 'url' => ['/admin']],
                            ['label' => 'Все пользователи', 'icon' => 'list', 'url' => ['/user/index']],
                            ['label' => 'Добавить пользователя', 'icon' => 'plus', 'url' => ['/user/signup']],

                        ],
                    ],
                    ['label' => 'Расписание', 'icon' => 'table','url' => ['/timetable/edit']],
                    [
                        'label' => 'Новости',
                        'icon' => 'newspaper-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Добавить новость', 'icon' => 'file-o', 'url' => ['/postbackend/create']],
                            ['label' => 'Все новости', 'icon' => 'pencil-square-o', 'url' => ['/postbackend/index']],
                            ['label' => 'В публикации', 'icon' => 'list-alt', 'url' => ['/postbackend/allpost']],

                        ],
                    ],
                    [
                        'label' => 'Тестирование',
                        'icon' => 'newspaper-o',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Тесты',
                                'icon' => 'balance-scale',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'База тестов', 'icon' => 'database', 'url' => ['/testing/index']],
                                    ['label' => 'Создать тест', 'icon' => 'flask', 'url' => ['/testing/create']],

                                ],
                            ],['label' => 'Провести тестирование', 'icon' => 'clock-o', 'url' => ['/test-in-group/index']],
                            [
                                'label' => 'Вопросы',
                                'icon' => 'question',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'База вопросов', 'icon' => 'book', 'url' => ['/questions/index']],
                                    ['label' => 'Создать вопрос', 'icon' => 'pencil', 'url' => ['/questions/create']],

                                ],
                            ],


                        ],
                    ],

                    ['label' => 'Оценки групп','icon' => 'edit (alias)', 'url' => ['/group']],
                    ['label' => 'Отчётность','icon' => 'edit fa-bar-chart', 'url' => ['/analytics']],
                    ['label' => 'Статистика','icon' => 'edit fa-line-chart', 'url' => ['/statistics']],
                    ['label' => 'Группы', 'icon' => 'building-o','url' => ['/allgroup']],
                    ['label' => 'Студенты', 'icon' => 'user','url' => ['/students']],
                    ['label' => 'Дисциплины', 'icon' => 'briefcase','url' => ['/subject']],
                    ['label' => 'Аудитории', 'icon' => 'braille','url' => ['/auditories']],
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
                    ['label' => 'Служба поддержки', 'icon' => 'life-ring', 'url' => ['/support/index']],


                ],
            ]
        ) ?>
