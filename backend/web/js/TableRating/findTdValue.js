/**
 * Created by Марина on 30.10.2017.
 */
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
            var str_td = cols[j].innerText;
            if(str_td == '')
            {
                continue;
            }
            if(str_td == '2' || str_td == '3'
                || str_td == '4' || str_td == '5' )
            {
                sum += +parseInt(str_td);
                avg.push(parseInt(str_td));
            }
            if(str_td == 'y' ||
                str_td == 'н' )
            {
                ommis.push(str_td);
            }
        }

        var count = avg.length;
        var average  = sum/count;

        rows[i].cells[2].innerText = ommis.length;
        rows[i].cells[3].innerText = average.toPrecision(3);

    }
}

average(); // расчёт среднего значения и подсчёт пропусков