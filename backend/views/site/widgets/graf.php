<?php
use miloschuman\highcharts\Highcharts;

/* @var $Rating  */
/* массив с оценками по всем студентам и дате  */
?>
<div class="graphBlock">

<?
echo Highcharts::widget([
    /* @var $categories */
    'options' => [
        'colors'=> ['#2f9bda','#DF5353','#7798BF','#aaeeee', '#90ee7e', '#f45b5b', '#7798BF', '#aaeeee', '#ff0066',
    '#eeaaee', '#55BF3B',   ],

        'chart'=> [
                'polar'=>'true',
                'type'=>'area',
//                'type'=>'pie',
            'backgroundColor'=> [
                'linearGradient' => [ 'x1'=> 0, 'y1' => 0, 'x2' => 1, 'y2' => 1 ],
                'stops' => [


                ],
            ],

            'plotBorderColor' => '#000000',
            'color'=>'#fff',
        ],

        'legend'=>[
            'layout'=> 'horizontal',
            'align' =>'center',
            'verticalAlign'=>'bottom',
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
        'series' => $Rating['data'],
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
                'color'=> 'rgba(0,0,0,0)'
            ]
        ],
        'title' => [
            'text' => 'Статистика средней оценки по всем студентам',
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
        'xAxis' => [
            'categories' => $Dates,
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
            'title' => ['text' => 'Ср. оценка',
                'style'=>[
                    'font-size'=>'14px',
                    'letter-spacing'=>'5px',
                    'color'=>'#ffffff'
                ],
            ],
            'labels'=>[
                'style'=>[
                    'font-size'=>'14px',
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

