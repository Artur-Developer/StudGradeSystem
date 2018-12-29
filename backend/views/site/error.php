<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<section class="content">
    <style>
        p{
            font-size: 17px;
        }
    </style>
    <div class="error-page">
        <h2 class="headline text-info"><i class="fa fa-warning text-yellow"></i></h2>

        <div class="error-content">
            <h3><?= $name ?></h3>

            <p>
                <?= nl2br(Html::encode($message)) ?>
            </p>

            <br>
            <p>
                Вышеуказанная ошибка произошла во время обработки вашего запроса.
                Пожалуйста, свяжитесь с нами, если вы думаете, что это ошибка сервера.
                Вы не знаете что происходит? В таком случае  <b>нажмите на зелёную кнопку!</b>
                <br />
                <br />
                <?= Html::a('Перейти на стартовую страницу', Yii::$app->homeUrl, ['class' => 'btn btn-lg btn-success']) ?>

            </p>

                <form class='search-form'>
                    <div class='input-group'>
                        <input type="text" name="search" class='form-control' placeholder="Search"/>

                        <div class="input-group-btn">
                            <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
        </div>
    </div>

</section>
