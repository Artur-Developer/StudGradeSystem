/**
 * Created by vipma on 24.10.2017.
 */

// Фокус по нажатию на дату
$(document).on('click', 'td.rd', function(){
    $(this).addClass('editData');
    $('.modal').click().find('td.rd').removeClass('editData');
    var id = $(this).attr('id').split();
    var value = $(this).text();
    $('#form_update_modal_data').find("input[name*='modal_date_update']").attr("data-id", id);
    $('#form_update_modal_data').find("input[name*='modal_date_update']").val(value);

    var date_in_theme = $(this).attr('title');
    if(date_in_theme != ''){
        $('.date_in_theme').text('К дате привязана тема:');
        $(this).each('i').text(date_in_theme);
        $('.date_in_theme i').text(date_in_theme);
    }
    else{
        $('.date_in_theme').text('К дате тема не привязана!');
    }

});
$("body").click(function () {
    $('td.rd').removeClass('editData');
});
////////////// Удаление даты ////////////
$("#modal_date_delete").click(function () {
    var idData = $('#form_update_modal_data').find('input[data-id]').attr('data-id');
        if (confirm("Уверены, что хотите удалить дату на которую нажали мышью в таблице?")) {
            var i_url = location.href;
            $.ajax({
                type: "POST",
                url: i_url,
                data: 'data_id=' + idData + '&DeleteData=' + 1,
                success: function (data) {
                }
            });

            setTimeout(function() {window.location.reload();}, 100);
        }
    else{
        alert("Укажите пожалуйста дату");
    }
});
////////////// Обновление даты ////////////
$("#button_modal_date_update").click(function () {
        var value_data = $('#form_update_modal_data').find( 'input[name="name_modal_date_update"]' ).val();
        var theme_id = $('#form_update_modal_data').find('p.repo-name').text();
        var table_id =  $(".table_rating").attr('name');
    if(theme_id == ''){
        theme_id = 'null';
    }
    var idData = $('input[data-id]').attr('data-id');
    if(value_data != ''){
        var i_url = location.href;
        $.ajax({
            type: "POST",
            url: i_url,
            data: 'value_data='+value_data+
            '&id_data='+idData+'&updateData='+1+'&theme_id='+theme_id,
            success: function(data){
            }});
        setTimeout(function() {window.location.reload();}, 100);
    }
    else{
        alert("Укажите пожалуйста дату");
    }
});
// // Фокус по нажатию на дату
// $(document).on('click', 'td.rd', function(){
//     var id = $('td.rd').attr('class').split( " " );
//     $('.ajax').html($('.ajax'));
//     $('.ajax').removeClass('ajax');
//     $(this).addClass('ajax');
//     $(this).html('<input id="editData"  maxlength="10" size="'+ $(this).text().length+'" value="'+$(this).text().trim()+'" type="text">');
//     $('#editData').focus();
// });

// Обновление даты при нажатии вне поля
// if(event.which == 13 || event.which == 9 )
// $(document).on('blur', '#editData', function(){
//     var i_url = location.href;
//     var id_data = $("#editData").parent().attr('id');
//     $.ajax({
//         type: "POST",
//         url: i_url,
//         data: "value_data="+$('.ajax input').val()+"&id_data="+id_data+"&updateData="+1,
//         success: function(data){
//             $('.ajax').html($('.ajax input').val());
//             $('.ajax').removeClass('ajax');
//             setTimeout(function() {window.location.reload();}, 100);
//         }});
// });
//
// //определяем нажатие кнопки на клавиатуре
// $(document).on('keydown', '#editData',  function(event){
//     var id_data = $("#editData").parent().attr('id');
//     if(event.which == 13 || event.which == 9 )
//     {
//         var i_url = location.href;
//         $.ajax({ type: "POST",
//             url:i_url,
//             data: "value_data="+$('.ajax input').val()+"&id_data="+id_data+"&updateData="+1,
//             success: function(data){
//                 $('.ajax').html($('.ajax input').val());
//                 $('.ajax').removeClass('ajax');
//                 setTimeout(function() {window.location.reload();}, 100);
//             }});
//     }
// });
////////////// Добавление даты ////////////
$("#RatingData").submit(function(event) {
    setTimeout(function() {window.location.reload();}, 100);
});
$("#form_modal_date_add").submit(function(event) {
    /* отключение стандартной отправки формы */
    event.preventDefault();
    var $form = $( this ),
        // берём значение с input in modalPopup
        value_data = $form.find( 'input[name="modal_date_add"]' ).val();

    var group_id =  $(".table_rating").attr('group_id');
    var table_id =  $(".table_rating").attr('id');
    var theme_id = $('#form_modal_date_add').find('p.repo-name').text();
    // var table_id =  $(".table_rating").attr('name');
    // var idData = $(this).attr('id')[0];
    if(theme_id == ''){
        theme_id = 'null';
    }
    if(value_data != ''){
        var i_url = location.href;
        $.ajax({
            type: "POST",
            url: i_url,
            data: 'value_data='+value_data+
            '&group_id='+group_id+'&table_id='+table_id+'&theme_id='+theme_id,
            success: function(data){

            }});
        setTimeout(function() {window.location.reload();}, 100);
    }
    else{
        alert("Укажите пожалуйста дату");
    }
});
////////////// Удаление даты  ////////////////
$(".DropLastData").click(function (e) {
    e.preventDefault();

    if (confirm("Уверены, что хотите удалить дату?")) {

        var i_url = location.href;
        var last_td = $('.table_rating thead td:last-child');
        var data_id = last_td.attr('id');

        $.ajax({
            type: "POST",
            url: i_url,
            data: "data_id="+data_id+"&dropLastData="+1,
            success: function(data){
            }});
        setTimeout(function() {window.location.reload();}, 100);
    }
});

var last_td_text = $('.table_rating > thead:first-child > tr:first-child td:last-child').text();
var day_td = last_td_text.substring(1, 0);
last_td_text = last_td_text.slice(0, 1) + day_td + str.slice(2);

$('#form_modal_date_add').find("input[name*='modal_date_add']").val(last_td_text);

