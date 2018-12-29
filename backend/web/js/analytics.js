/**
 * Created by vipma on 26.12.2017.
 */


$('.average_active_col').on('click', function(){
    $('.color_rating_td > button').toggleClass('color_rating_td_bg2');
    $('.average_active_col').toggleClass('color_average_active_col');
    $('.table_rating tbody tr td.average:contains("5")').toggleClass('rating_5');
    $('.table_rating tbody tr td.average:contains("4")').toggleClass('rating_4');
    $('.table_rating tbody tr td.average:contains("3")').toggleClass('rating_3');
    $('.table_rating tbody tr td.average:contains("2")').toggleClass('rating_2');
});
$('.propusky_active').on('click', function(){
    $('.color_rating_td > button').toggleClass('color_rating_td_bg2');
    $('.propusky_active').toggleClass('color_propusky_active');
    //$('.table_rating tbody tr td:contains("н")').toggleClass('rating_n');
    //$('.table_rating tbody tr td.omissions:contains("2")').toggleClass('rating_2');

    $('.table_rating tbody tr td.omissions:contains("5")').toggleClass('rating_5');
    $('.table_rating tbody tr td.omissions:contains("4")').toggleClass('rating_4');
    $('.table_rating tbody tr td.omissions:contains("3")').toggleClass('rating_3');
    $('.table_rating tbody tr td.omissions:contains("2")').toggleClass('rating_2');
    //$('.table_rating tbody tr td.omissions:contains("н")').toggleClass('rating_n');

});


// Нумерация первой колонки в таблице
$('.table tbody tr').each(function(i) {
    var number = i + 1;
    $(this).find('th:first').text(number);
});

$('.table thead th:first-child').each(function() {
    var number = '№';
    $(this).find('thead td:first-child').text(number);
});


$('.sticky-col').each(function() {
    $(this).find('#responds td').css({'background-color':'rgb(162, 65, 73)'});
});


function  average()
{
    var rows = window.document.querySelectorAll(".table_rating tr");
    for (var i = 1; i < rows.length; i++)
    {
        $('.table_rating tbody tr td:contains("NaN")').text("0");
        var cols = rows[i].querySelectorAll('td.rating');
        var avg=[];
        var ommis=[];
        var sum = 0;

        for (var j = 0; j < cols.length; j++)
        {
            var sum_td = 0;
            var str_td = cols[j].innerText;
            for(var k = 0; k < str_td.length;k++){
                if(str_td[k] == '')
                {
                    continue;
                }
                if(str_td[k] == '2' || str_td[k] == '3'
                    || str_td[k] == '4' || str_td[k] == '5' )
                {
                    sum_td += +parseInt(str_td[k]);
                    avg.push(parseInt(str_td));
                }
                if(str_td[k] == 'y' ||
                    str_td[k] == 'н' )
                {
                    ommis.push(str_td[k]);
                }
            }
            sum += sum_td;
            var count = avg.length;
            var average  = sum/count;

            rows[i].cells[2].innerText = ommis.length;
            rows[i].cells[3].innerText = average.toPrecision(3);

        }
    }
}

average(); // расчёт среднего значения и подсчёт пропусков