<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 17.06.2018
 * Time: 12:15
 */

use backend\components\Customs;

$this->registerCssFile('/backend/web/css/postBackend/raspisanie.css',
    ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJsFile('/backend/web/js/timeTableSelectLesson.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->title = 'Ваше расписание ';
?>
<div class="col-md-12 index_info_table">
<!--    <p>Расписание на сегодня</p>-->
    <style>
        .index_info_table .type_week{
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #FFE2B0;
            font-size: 16px;
            margin-left: 5px;
        }
    </style>
    <br>
    <div class="row viget_raspisanie">
        <p class="type_week"><?= Customs::getChotnostyWeek() ?> неделя</p>
        <div class="">


            <? function findLesson($day_week)
            {
                return $FindTimeTableToUserId = \backend\models\Timetable::find()->where(['group_id' => Yii::$app->user->identity->group_id])
                    ->andWhere(['day_week' => $day_week])->andWhere(['type_week'=>Customs::getBitChotnostyWeek()])->all();
            }
            ?>

            <div class="tab-content">
                <? $idDay= -1; $statusTab = '';?>
                <? foreach ($dayWeek as $day):?>
                    <? $idDay+=1?>
                    <? if($idDay == Customs::TodayNumberDayWeek()):?>
                        <? $statusTab = 'active'; ?>
                    <? endif;?>


                    <div id="panel<?=$idDay ?>" class="tab-pane fade in <?=$statusTab ?>">
                        <ul class="blockTime">
                            <? foreach (Customs::arrayLessonTime() as $key => $time): ?>
                                <li class="time">
                                    <p><?= $time?></p>
                                </li>
                            <? endforeach;?>
                        </ul>
                        <ol class="lessons">

                            <? $fistCountDay = 0 ?>
                            <? for ($PARA=1;$PARA<=7;$PARA++):?>
                                <? $count = true;?>
                                <? foreach (findLesson($idDay) as $post):?>
                                    <? if($PARA == $post->number_lesson):?>
                                        <? $count = false;?>
                                        <li>
                                            <span><?= $post->number_lesson; ?>.</span>
                                            <span title="<?= $post->subject->name_subject?>"><?= mb_substr($post->subject->name_subject,0,21); ?></span>
                                            <span class="teacher" title="<?=$post->user->last_name . ' ' . $post->user->first_name . ' ' .$post->user->middle_name ?>">
                                                    <?= $post->user->last_name . ' ' .  Customs::resuctionInitials($post->user->first_name) . ' ' .  Customs::resuctionInitials($post->user->middle_name)?>
                                                    </span>
                                            <span title="<?= $post->auditories->number . ' | ' . $post->auditories->description?>">
                                                    <? Customs::resuctionLongString($post->auditories->number,4) ?>
                                            </span>
                                        </li>
                                        <? break; ?>
                                    <? endif;?>

                                <? endforeach;?>
                                <? if ($count == true):?>
                                    <li>
                                        <span><?=$PARA; ?>.</span>
                                    </li>

                                <? endif;?>
                            <? endfor;?>
                        </ol>
                    </div>
                    <? $statusTab = ''?>
                <? endforeach;?>
                <ul class="nav nav-tabs">
                    <li><a data-toggle="tab" href="#panel0" day="по">пн</a></li>
                    <li><a data-toggle="tab" href="#panel1" day="вт">вт</a></li>
                    <li><a data-toggle="tab" href="#panel2" day="ср">ср</a></li>
                    <li><a data-toggle="tab" href="#panel3" day="че">чт</a></li>
                    <li><a data-toggle="tab" href="#panel4" day="пя">пт</a></li>
                    <li><a data-toggle="tab" href="#panel5" day="су">сб</a></li>
                </ul>
            </div>


        </div>

    </div>
</div>

