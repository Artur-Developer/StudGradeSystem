<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['teatcher/reset-password', 'token' => $user->password_reset_token]);
?>
Привет! <?= $user->last_name . ' ' . $user->first_name . ' ' . $user->middle_name . '.' ?>

Для сброса пароля перейдите по ссылке ниже:

<?= $resetLink ?>
