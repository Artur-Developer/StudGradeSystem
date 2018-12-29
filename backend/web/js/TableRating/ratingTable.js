/**
 * Created by vipma on 22.10.2017.
 */

// При клике на элемент с классом .disallow_ban мы фокус не приминяем
$(document).on('click', '.disallow_ban', function(){
    $('.disallow_ban').removeClass(focus);
});

//при нажатии на ячейку таблицы с классом edit
$(document).on('click', 'td.rating',  function(){
    //находим input внутри элемента с классом ajax и вставляем вместо input его значение
    $('.ajax').html($('.ajax input').val());
    //удаляем все классы ajax
    $('.ajax').removeClass('ajax');
    //Нажатой ячейке присваиваем класс ajax
    $(this).addClass('ajax');
    //внутри ячейки создаём input и вставляем текст из ячейки в него
    $(this).html('<input id="editbox"  maxlength="1" size="'+ $(this).text().length+'" value="' + $(this).text() + '" type="text">');
    setCaretToPos($("#editbox")[0], 2); // перемещение курсора в конец
    //устанавливаем фокус на созданном элементе
    $('#editbox').focus();

});
//$('.table_rating tbody tr td:contains("y")').text("н");


// //определяем нажатие кнопки на клавиатуре
// $(document).on('keydown', '#editbox',  function(event){
//     //получаем значение класса и разбиваем на массив
//     //в итоге получаем такой массив - arr[0] = edit, arr[1] = наименование столбца, arr[2] = id строки
//
//     var input = document.getElementById("editbox") ;
//     input.oninput = function() {
//         if(this.value[0]=='y') {//запрет на ввод символа
//             this.value = "" ;
//             alert("Введите корректные данные(Возможно у вас включён русский язык!)");
//         }
//     };
//
//     arr = $(this).parent().attr('id');
//     //проверяем какая была нажата клавиша и если была нажата клавиша Enter (код 13)
//     if(event.which == 13 || event.which == 9 )
//     {
//
//         var i_url = location.href;
//         //получаем наименование таблицы, в которую будем вносить изменения
//         //выполняем ajax запрос методом POST
//         $.ajax({ type: "POST",
//             url:i_url,
//             //id = id оценки
//             data: "value="+$('.ajax input').val()+"&idRating="+arr,
//             //при удачном выполнении скрипта, производим действия
//             success: function(data){
//                 //находим input внутри элемента с классом ajax и вставляем вместо input его значение
//                 $('.ajax').html($('.ajax input').val());
//                 //удаялем класс ajax
//                 $('.ajax').removeClass('ajax');
//                 average(); // расчёт среднего значения и подсчёт пропусков
//             }});
//     }
// });




///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////

$('.average_active').on('click', function(){
    $('.color_rating_td > button').toggleClass('color_rating_td_bg');
    $('.average_active').toggleClass('color_average_active');
    $('.table_rating tbody tr td.rating:contains("5")').toggleClass('rating_5');
    $('.table_rating tbody tr td.rating:contains("4")').toggleClass('rating_4');
    $('.table_rating tbody tr td.rating:contains("3")').toggleClass('rating_3');
    $('.table_rating tbody tr td.rating:contains("2")').toggleClass('rating_2');
});
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
    $('.table_rating tbody tr td:contains("н")').toggleClass('rating_n');
    //$('.table_rating tbody tr td.omissions:contains("2")').toggleClass('rating_2');

    $('.table_rating tbody tr td.omissions:contains("5")').toggleClass('rating_5');
    $('.table_rating tbody tr td.omissions:contains("4")').toggleClass('rating_4');
    $('.table_rating tbody tr td.omissions:contains("3")').toggleClass('rating_3');
    $('.table_rating tbody tr td.omissions:contains("2")').toggleClass('rating_2');
    $('.table_rating tbody tr td.omissions:contains("н")').toggleClass('rating_n');



});

$('.sticky-col').each(function() {
    $(this).find('#responds td').css({'background-color':'rgb(162, 65, 73)'});
});

//Кнопка удаление даты
$('.editButton').on('click', function(){
    $(this).popover('toggle');
    $('.addStudent_toggle').toggleClass("activeEdit");
});
$('#button_edit').on('click', function(){
    $('td:last-child .del_top_td').toggleClass("del_top_td2");
});


$("#button_edit").click(function(){
    $(this).popover('toggle');
});

$(function(){
    $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).parent().siblings().removeClass('open');
        $(this).parent().toggleClass('open');
    });
});

$('.rating input').on('click', function(){
    $('.rating input').val().selectionEnd = 1;
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

$('.table_rating thead>tr:first-child>td>div').each(function() {

    $(this).find('thead td:first-child').css(number);
});



$('.blok_table').each(function() {
    //var val = $(this).find('td:nth-last-child(2)').val();
    var number = '<i id="grop_data" class="addStudent_toggle glyphicon glyphicon-trash"></i>';
    $(this).find('.DropLastData').append(number);
});

$(".editButton").click(function(){
    $("#editButton").popover('toggle');
    $(".editButton").toggleClass('button_edit_visibility');
    $('.addStudent_toggle').toggleClass("activeEdit");
});


$('.table_rating thead tr:first-child td')
    .css({
        'height': $('.top_rating_data').width(),
        'width': $('.top_rating_data').height()
    });






$('.input_text input').keydown(function(e){
    var key = e.charCode || e.keyCode || 0;
    /*
     * Разрешаем: Backspace, Tab, Home, End, Insert, Delete, Ctrl+A,
     *           Ctrl+C, Ctrl+V, Ctrl+X, Ctrl+Z, Стрелки, Буквы, NumPad
     */
    return (
    key == 8 ||
    key == 9 ||
    key == 13 ||
    key == 46 ||
    key == 32 ||
    key == 188 ||
    key == 190 ||
    key == 219 ||
    key == 221 ||
    key == 192 ||
    (key >= 37 && key <= 40) ||
    (key >= 65 && key <= 90) ||
    (key >= 97 && key <= 122));
});
$('.rating').keydown(function(e){
    var key = e.charCode || e.keyCode || 0;
    /*
     * Разрешаем: Backspace, Tab, Home, End, Insert, Delete,
     *           Стрелки, Цифры, NumPad
     */
    return (
    key == 8 ||
    //key == 16 ||
    key == 13 ||
    key == 46 ||
    key == 89 ||
    (key >= 37 && key <= 40) ||
    (key >= 50 && key <= 53) ||
    (key >= 98 && key <= 101));

});


$('.raiting_data').keydown(function(e){
    var key = e.charCode || e.keyCode || 0;
    /*
     * Разрешаем: Backspace, Tab, Home, End, Insert, Delete,
     *            Стрелки, Цифры, NumPad
     */

    return (

    key == 8 ||
    key == 9 ||
    key == 13 ||
    key == 46 ||
    key == 32 ||
    key == 190 ||
    (key >= 37 && key <= 57));

});



