/**
 * Created by vipma on 28.01.2018.
 */

$('.kv-state-collapsed, .kv-expand-row').on('click', function() {
        $('td.rating:contains("5")').addClass('rating_5');
        $('td.rating:contains("4")').addClass('rating_4');
        $('td.rating:contains("3")').addClass('rating_3');
        $('td.rating:contains("2")').addClass('rating_2');
        $('td.rating:contains("н")').addClass('rating_n');
});

$('td.rating').on('click', function(){
    alert('Тема занятия: ' + $(this).attr('title'));
});

$('td.rating_date').on('click', function(){
        alert('Тема занятия: ' + $(this).next().attr('title'));
});
