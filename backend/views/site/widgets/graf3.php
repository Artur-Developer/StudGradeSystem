<?php
use miloschuman\highcharts\Highcharts;

/* @var $Rating  */
/* массив с оценками по студнету и дате  */

?>
<style>
    .highcharts-container {
        margin: 10px auto;
        padding: 10px 25px;
    ]
</style>

<div class="graphBlock">

    <?

    echo Highcharts::widget([
        /* @var $categories */
        'options' => [
            'colors'=> ['#B65162','#b69251', '#2b908f', '#517eb6',
                '#353535','#7798BF','#aaeeee', '#90ee7e', '#f45b5b', '#7798BF', '#aaeeee', '#ff0066',
                '#eeaaee', '#55BF3B', ],

            'chart'=> [
                'polar'=>'true',
                'type'=>'pie',
//                'type'=>'column',
                'backgroundColor'=> [
                    'linearGradient' => [ 'x1'=> 0, 'y1' => 0, 'x2' => 1, 'y2' => 1 ],
                    'stops' => [

//                        [1, 'rgba(0, 0, 0, 0.07'],
//                        [0, 'rgb(67, 88, 112)'],

//                    [1, 'rgba(255,255,255,.9)']
//                    [1, '#222d32']
                    ],
                ],

                'plotBorderColor' => '#000000',
                'color'=>'#fff',
            ],
            'font-size'=>'15px',


            'legend'=>[
                'layout'=> 'vertical',
                'align' =>'right',
                'verticalAlign'=>'middle',
                'itemStyle'=> [
                    'color'=> '#ffffffed'
                ],
                'itemHoverStyle'=> [
                    'color'=> '#ffffffed'
                ],
                'itemHiddenStyle'=> [
                    'color'=> '#ffffffed'
                ]
            ],
            
            'series'=> [[
                'type'=> 'pie',
                'allowPointSelect'=> true,
                'keys'=> ['name', 'y', 'selected', 'sliced'],
                'name'=> 'Пропуски',
                'data'=> $Rating['data'],
                'showInLegend'=> true
            ]],

            'responsive'=> [
                'rules'=> [
                    'condition'=> [
                        'maxWidth'=> '1000',
                    ],
                    'chartOptions'=> [
                        'legend'=> [
                            'layout'=> 'horizontal',
                            'align' =>'center',
                            'verticalAlign'=> 'bottom'
                        ]
                    ]
                ]
            ],
            'credits'=> [
                'style'=> [
                    'color'=> 'rgba(0,0,0,0)',
                    'font-size'=>'15px'
                ]
            ],
            'title' => [
                'text' => 'Статистика пропусков по каждому студенту',
                'style'=>[
                    'color'=>'#ffffff'
                ]
            ],
            'subtitle'=> [
                'style'=> [
                    'color'=> '#ffffff',
                    'textTransform'=> 'uppercase'
                ]
            ],

            'tooltip' =>[
                'backgroundColor' => 'rgba(0, 0, 0, 0.75)',
                'style'=> [
                    'color'=> '#ffffff',
                    'font-size'=>'15px'
                ]
            ],
            'plotOptions'=> [
                    'style'=>[
                        'font-size'=>'15px'
                    ],
                'pie'=> [
                    'allowPointSelect'=> true,
                    'cursor'=> 'pointer',
                    'dataLabels'=> [
                        'enabled'=> true,
                        'style'=> [
                            'color'=> '#fff',
                            'font-size'=>'15px'
                        ]
                    ],
                    'marker'=>[
                        'lineColor'=> '#333'
                    ],
                    'boxplot'=>[
                        'fillColor'=> '#505053'
                    ]
                ]
            ],
            'drilldown'=> [
                'activeAxisLabelStyle'=> [
                    'color'=> '#ffffff'
                ],
                'activeDataLabelStyle'=> [
                    'color'=> '#ffffff'
                ]
            ],

        ],

    ]);

    ?>

</div>
