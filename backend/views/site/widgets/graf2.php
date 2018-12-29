<?php
use miloschuman\highcharts\Highcharts;

/* @var $Rating  */
/* массив с оценками по студнету и дате  */
?>
<div class="graphBlock">

    <?= Highcharts::widget([
        /* @var $categories */
        'options' => [
            'colors'=> ['#B65162','#b69251', '#2b908f', '#517eb6',
                '#353535','#ff3f62','#000'],

            'chart'=> [
                'polar'=>'true',
//                'type'=>'area',

                'type'=>'column',
//                'condition'=> [
//                    'Size'=> '1000px',
//                ],
                'backgroundColor'=> [
                    'linearGradient' => [ 'x1'=> 0, 'y1' => 0, 'x2' => 1, 'y2' => 1 ],
                    'stops' => [


//                    [1, 'rgba(255,255,255,.9)']
//                    [1, '#222d32']
                    ],
                ],

                'plotBorderColor' => '#000000',
                'color'=>'#fff',
            ],

            'legend'=>[

                'itemStyle'=> [
                    'color'=> '#ffffff'
                ],
                'itemHoverStyle'=> [
                    'color'=> '#ffffff'
                ],
                'itemHiddenStyle'=> [
                    'color'=> '#ffffff'
                ]
            ],
//            'series' => $Rating['data'],
            'series'=> [[
        'type'=>'column',
        'name'=> 'Оценка 2',
        'data'=> $CountRating2_5Last5Date[0],
    ], [
        'type'=>'column',
        'name'=> 'Оценка 3',
        'data'=> $CountRating2_5Last5Date[1],
    ],  [
        'type'=>'column',
        'name'=> 'Оценка 4',
        'data'=> $CountRating2_5Last5Date[2],
    ], [
        'type'=>'column',
        'name'=> 'Оценка 5',
        'data'=> $CountRating2_5Last5Date[3],
    ],[
        'type'=>'column',
        'name'=> 'Пропуски',
        'data'=> $CountRating2_5Last5Date[4],
    ],
            [
                'type'=>'spline',
                'name'=> 'Оценка 2',
                'data'=> $CountRating2_5Last5Date[0]
            ],
            [
                'type'=>'spline',
                'name'=> 'Пропуски',
                'data'=> $CountRating2_5Last5Date[4]
            ],
            [
                'type'=>'spline',
                'name'=> 'Оценка 5',
                'data'=> $CountRating2_5Last5Date[3],
                'color'=> '#517eb6',
            ],
                [
                    'type'=> 'pie',
                    'name'=> 'Количество',

                    'data'=> [[
                        'name'=> 'Оценка 2',
                        'y'=> $CountRating2_5AllTime[0],
                        'color'=> '#B65162',
                    ], [
                        'name'=> 'Оценка 3',
                        'y'=> $CountRating2_5AllTime[1],
                        'color'=> '#b69251 ',
                    ], [
                        'name'=> 'Оценка 4',
                        'y'=> $CountRating2_5AllTime[2],
                        'color'=> '#2b908f ',
                    ], [
                        'name'=> 'Оценка 5',
                        'y'=> $CountRating2_5AllTime[3],
                        'color'=> '#517eb6 ',
                    ], [
                        'name'=> 'Пропуски',
                        'y'=> $CountRating2_5AllTime[4],
                        'color'=>  '#353535',
                    ]],
                    'center'=> [190, 0],
                    'size'=> 120,
                    'keys'=> ['name', 'y', 'selected', 'sliced'],
                    'dataLabels'=> [
                        'enabled'=> false
                    ],
                    'allowPointSelect'=> true,
                ],

            ],

            'responsive'=> [
                'rules'=> [

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
                    'color'=> 'rgba(0,0,0,0)'
                ]
            ],
            'title' => [
                'text' => 'Статистика успеваемости в группе по последним датам',
                'style'=>[
                    'color'=>'#ffffff'
                ]
            ],
            'subtitle'=> [
                'text' => 'На диаграмме общие подсчёты за всё время',
                'style'=> [
                    'color'=> '#ffffff',
                    'textTransform'=> 'uppercase'
                ]
            ],
            'xAxis' => [
                'categories' => $LimitDate3,
                'labels'=>[
                    'style'=>[
                        'color'=>'#ffffff'
                    ],
                ],
                'lineColor'=> '#ffffff',
                'minorGridLineColor'=> '#ffffff',
                'tickColor'=> '#ffffff',
            ],
            'yAxis' => [
                'title' => ['text' => 'Количество',
                    'style'=>[
                        'color'=>'#ffffff'
                    ],
                ],
                'labels'=>[
                    'style'=>[
                        'color'=>'#ffffff'
                    ],
                ],

            ],
            'tooltip'=> [
                'backgroundColor'=> 'rgba(0, 0, 0, 0.75)',
                'style'=> [
                    'color'=> '#ffffff'
                ]
            ],
            'plotOptions'=> [
                'series'=> [
                    'dataLabels' =>[
                    ],
                    'marker' =>[
                        'lineColor' => '#ffffff'
                    ]
                ],
                'boxplot'=> [
                    'fillColor'=> '#ffffff'
                ],
                'candlestick'=> [
                    'lineColor'=> 'white'
                ],
                'errorbar' =>[
                    'color' => 'white'
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