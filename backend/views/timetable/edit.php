<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use backend\components\Customs;
use backend\models\Timetable;


$this->title = 'Настройка расписания';
$this->params['breadcrumbs'][] = $this->title;


$this->registerJsFile('/backend/web/js/timeTable.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<link rel="stylesheet" type="text/css" href="/backend/web/css/modalPicker.css" />
<link rel="stylesheet" type="text/css" href="/backend/web/css/timetable.css" />


<div class="timetable-edit">


    <div class="modalUpdateInfoTimeTable add_modal_picker">

        <?
        Modal::begin([
            'header' => '<h2>Настройка занятия</h2>',
            'id'=>'modalUpdateInfoTimeTable',
        ]);
        ?>


            <?=
            $this->render('_form', [
                'findAuditories' => $findAuditories,
                'findSubject' => $findSubject,
                'model' => $model,
                'arrayTeachers' => $arrayTeachers = [],

            ])
            ?>

        <?php Modal::end();?>

</div>

    <div class="row">

        <!--    Панель опций    -->
        <div class="container section_options">
            <div class="type_week col-md-6">
                <h4><?= Customs::getChotnostyWeek();?> неделя</h4>
                <?= Html::a('Синяя неделя', ['edit','type_week'=>0,'kurs'=>$kurs], ['class' => 'btn btn-lg btn-primary']) ?>
                <?= Html::a('Зелёная неделя', ['edit','type_week'=>1,'kurs'=>$kurs], ['class' => 'btn btn-lg btn-success']) ?>
            </div>
            <div class="kurs col-md-6" kurs="<?=$kurs?>">
                <span>Курс: </span>
                <?= Html::a("все", ['edit','type_week'=>$type_week,'kurs'=>0],['class' => 'btn btn-lg btn-default']); ?>
                    <? for ($countKurs=1;$countKurs<=4;$countKurs++):?>
                        <?= Html::a("$countKurs", ['edit','type_week'=>$type_week,'kurs'=>$countKurs],['class' => 'btn btn-lg btn-default']); ?>
                    <? endfor;?>

            </div>
        </div>
        <!--  /// Панель опций    -->
        <? $date = new DateTime(); ?>
        <!--   Расписание    -->
        <?php Pjax::begin(['id'=>'blockTimeTable']); ?>
        <div class="timetable" type_week="<?= $type_week?>">
            <? foreach ($arrayDayWeek as $key => $day): ?>

                    <? $lessonsData = Timetable::find()->where(['type_week' => $type_week])->andWhere(['day_week' => $key])->all(); ?>
                    <? $checkTypeDay  = Timetable::find()->where(['type_week'=>$type_week])->andWhere(['day_week'=>$key])->andWhere(['type_day'=>1])->count()?>
                <div class="day_week" day_week="<?= $key ?>">
                    <div class="day_title">
                        <div>
                            <?= $day ?>
                        </div>
                       <div class="block_type_day">
                           <? if($checkTypeDay == 0):?>
                               <? $buttonSokrDay = Html::a("cокр. <i class=\"fa fa-scissors\" aria-hidden=\"true\"></i>", ['edit','type_week'=>$type_week,'kurs'=>$kurs,'sokr' => 1,'sork_day'=>$key],['type_day' => 0]);?>
                           <? endif;?>

                           <? if($checkTypeDay > 0):?>
                               <? $buttonSokrDay =  Html::a("сделать <br> полным", ['edit','type_week'=>$type_week,'kurs'=>$kurs,'sokr' => 2,'sork_day'=>$key],['type_day' => 1]); ?>
                           <? endif;?>

                           <? if($key == $sork_day):?>
                               <? if($sokr == 0):?>
                                   <?= $buttonSokrDay ?>
                               <? endif;?>
                               <? if($sokr == 1):?>
                                   <?= Html::a("сделать <br> полным", ['edit','type_week'=>$type_week,'kurs'=>$kurs,'sokr' => 2,'sork_day'=>$key],['type_day' => 1]); ?>
                               <? endif;?>
                               <? if($sokr == 2):?>
                                   <?= $buttonSokrDay ?>
                               <? endif;?>
                           <? else:?>
                               <?=  $buttonSokrDay?>
                           <? endif;?>

                       </div>
                    </div>

                    <!--  Если обычный день, выводим стандартное время звонков   -->
                    <? if($checkTypeDay == 0):?>
                        <div class="lesson_time">
                            <? foreach ($arrayLessonTime as $key => $time): ?>
                                <div class="time">
                                    <p><?= $time?></p>
                                </div>
                            <? endforeach;?>
                        </div>
                        <!--  ///////////////   -->
                        <!--  Если сокращёный день, выводим сохращённое время звонков   -->
                    <? elseif ($checkTypeDay > 0):?>
                        <div class="lesson_time">
                            <? foreach ($arrayLessonSokrTime as $key => $time): ?>
                                <div class="time">
                                    <p><?= $time?></p>
                                </div>
                            <? endforeach;?>
                        </div>
                    <? endif;?>
                    <? foreach($arrayGroups as $group):?>
                        <div class="lessons">
                            <div class="group_title" group_id="<?= $group['id']?>">
                                <p>
                                    <?= $group['name_group'] ?>
                                </p>
                            </div>
                            <div class="sub_title_lesson_info">
                                <span><?= $day?></span>
                                <span><?= $date->format('d-m-Y'); ?></span>
                            </div>
                            <? for ($PARA=1;$PARA<=7;$PARA++):?>
                                <? $count = true?>
                                <? foreach($lessonsData as $lessons):?>

                                    <? if($lessons->group_id == $group['id']):?>

                                        <? if($PARA==$lessons->number_lesson): ?>
                                            <? $count = false?>
                                            <div class="lesson"  lesson_id="<?= $lessons->id?>">
                                                <p class="number_lesson"><?= $PARA?></p>
                                                <div class="subject_teacher">
                                                    <span class="subject" title="<?= $lessons->subject->name_subject?>">
                                                        <?
                                                        if(strlen($lessons->subject->name_subject) > 27):
                                                            echo mb_substr($lessons->subject->name_subject,0,27);
                                                        else:
                                                            echo $lessons->subject->name_subject;
                                                        endif;
                                                        ?>
                                                    </span>
                                                    <span class="teacher" title="<?=$lessons->user->last_name . ' ' . $lessons->user->first_name . ' ' .$lessons->user->middle_name ?>">
                                                    <?= $lessons->user->last_name . ' ' .  Customs::resuctionInitials($lessons->user->first_name) . ' ' .  Customs::resuctionInitials($lessons->user->middle_name)?>
                                                    </span>
                                                </div>
                                                <p class="auditories" title="<?= $lessons->auditories->number . ' | ' . $lessons->auditories->description?>">
                                                    <? Customs::resuctionLongString($lessons->auditories->number,4) ?>
                                                </p>
                                            </div>
                                        <? break ?>
                                        <? endif;?>

                                    <? endif;?>
                            <? endforeach;?>
                                <? if ($count == true):?>
                                    <div class="lesson" lesson_id="0">
                                        <p class="number_lesson"><?= $PARA?></p>
                                        <div class="subject_teacher">
                                            <br>
                                            <br>
                                        </div>
                                    </div>

                                <? endif;?>
                            <? endfor;?>

                        </div>
                    <? endforeach;?>
                    <? $date->modify('+1 day'); ?>

                </div>

            <? endforeach;?>

        </div>
        <?php Pjax::end(); ?>
    <!--  /// Расписание    -->
    </div>

</div>
<?php
$this->registerJs("

");

?>