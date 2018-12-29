$(function main_js() {

    $('.navbar-nav  li a').each(function () {
        var location = window.location.href;
        var link = this.href;
        if(location == link) {
            $(this).addClass('active_nav_a');
        }
    });

    $('.rating').on('click', function(){
        $('input').val('');
    });

    $('#button_edit').on('click', function(){
        $('td:last-child .del_top_td').toggleClass("del_top_td2");
    });


    $("#button_edit").click(function(){
        $("#button_edit").popover('toggle')
    });
    $("#button_edit").popover({
        placement : 'bottom'
    });


    $(document).ready(function(){
        $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
            $(this).parent().siblings().removeClass('open');
            $(this).parent().toggleClass('open');
        });
    });

    $('.rating').keydown(function(e){
        var key = e.charCode || e.keyCode || 0;
        /*
         * Разрешаем: Backspace, Tab, Home, End, Insert, Delete, Ctrl+A,
         *           Ctrl+C, Ctrl+V, Ctrl+X, Ctrl+Z, Стрелки, Цифры, NumPad
         */
        return (
        key == 8 ||
        key == 9 ||
        key == 13 ||
        key == 46 ||
        key == 89 ||
        (key >= 37 && key <= 40) ||
        (key >= 50 && key <= 53) ||
        (key >= 96 && key <= 105));


    });
    $('.input_text, #content_new_student_id').keydown(function(e){
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

    // При клике на элемент с классом .disallow_ban мы фокус не приминяем
    $(document).on('click', '.disallow_ban', function(){
        $('.disallow_ban').removeClass(focus);
    });

    //при нажатии на ячейку таблицы с классом edit
    $(document).on('click', 'td.edit', function(){
        //находим input внутри элемента с классом ajax и вставляем вместо input его значение
        $('.ajax').html($('.ajax input').val());
        //удаляем все классы ajax
        $('.ajax').removeClass('ajax');
        //Нажатой ячейке присваиваем класс ajax
        $(this).addClass('ajax');
        //внутри ячейки создаём input и вставляем текст из ячейки в него
        $(this).html('<input id="editbox"  maxlength="1" size="'+ $(this).text().length+'" value="' + $(this).text() + '" type="text">');
        //устанавливаем фокус на созданном элементе
        $('#editbox').focus();
    });


    //определяем нажатие кнопки на клавиатуре
    $(document).on('keydown', 'td.edit', function(event){
        //получаем значение класса и разбиваем на массив
        //в итоге получаем такой массив - arr[0] = edit, arr[1] = наименование столбца, arr[2] = id строки
        arr = $(this).attr('class').split( " " );
        //проверяем какая была нажата клавиша и если была нажата клавиша Enter (код 13)
        if(event.which == 13 || event.which == 9)
        {
            //получаем наименование таблицы, в которую будем вносить изменения
            var table = $('table').attr('id');
            //выполняем ajax запрос методом POST
            $.ajax({ type: "POST",
                //в файл page_table.php
                url:"rating?",
                //создаём строку для отправки запроса
                //value = введенное значение
                //id = номер строки
                //field = название столбца
                //table = собственно название таблицы
                data: "value="+$('.ajax input').val()+"&id="+arr[2]+"&field="+arr[1]+"&table="+table,
                //при удачном выполнении скрипта, производим действия
                success: function(data){
                    //находим input внутри элемента с классом ajax и вставляем вместо input его значение
                    $('.ajax').html($('.ajax input').val());
                    //удаялем класс ajax
                    $('.ajax').removeClass('ajax');
                }});
        }
    });

    //Сохранение при нажатии вне поля
    $(document).on('blur', '#editbox', function(){

        var arr = $('.edit').attr('class').split( " " );
        //получаем наименование таблицы, в которую будем вносить изменения
        var table = $('table').attr('id');
        //выполняем ajax запрос методом POST
        $.ajax({ type: "POST",
            //в файл page_table.php
            url:"rating?",
            //создаём строку для отправки запроса
            //value = введенное значение
            //id = номер строки
            //field = название столбца
            //table = собственно название таблицы
            data: "value="+$('.ajax input').val()+"&id="+arr[2]+"&field="+arr[1]+"&table="+table,
            //при удачном выполнении скрипта, производим действия
            success: function(data){
                //находим input внутри элемента с классом ajax и вставляем вместо input его значение
                $('.ajax').html($('.ajax input').val());
                //удаялем класс ajax
                $('.ajax').removeClass('ajax');
            }});
    });

    // Увеличиваем ввод символов в поле где "Фамилия / имя" до 27
    $(document).on('click', '.input_text', function(){
        $("input").attr({maxLength:"27"});
    });


//    $(document).on('click', '.input_text', function(){
//        var MyRows = $('table#grade_in_the_group').find('tr');
//		for (var i = 1; i < MyRows.length; i++){
//		  for (var j = 3; j < 40; j++) {
//			console.log($(MyRows[i]).find('td:eq('+j+')').html());
//		  }
//        }
//    });


    // Добавляем новый столбец, когда произошел клик по кнопке
    $("#FormSubmit").click(function (e) {
        e.preventDefault();
        if($("#new_colum_table_id").val()==="") //simple validation
        {
            alert("Введите текст!");
            return false;
        }
        var myData = "new_colum_table="+ $("#new_colum_table_id").val(); //post variables
        jQuery.ajax({
            type: "POST", // HTTP метод  POST или GET
            url: "../include/editColum/addColum.php", //url-адрес, по которому будет отправлен запрос
            dataType:"text", // Тип данных,  которые пришлет сервер в ответ на запрос ,например, HTML, json
            data:myData, //данные, которые будут отправлены на сервер (post переменные)
            success:function(response){
                $("#responds").append(response);
                $("#new_colum_table_id").val(''); //очищаем текстовое поле после успешной вставки
            },
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //выводим ошибку
            }
        });
        setTimeout(function() {window.location.reload();}, 100);
    });

    //Удаляем запись при клике по крестику
    $("body").on("click", "#responds .del_button", function(e) {

        e.preventDefault();
        var clickedID = this.id.split("-"); //Разбиваем строку (Split работает аналогично PHP explode)
        var DbNumberID = clickedID[1]; //и получаем номер из массива
        var myData = 'recordToDelete='+ DbNumberID; //выстраиваем  данные для POST

        jQuery.ajax({
            type: "POST", // HTTP метод  POST или GET
            url: "../include/editColum/addColum.php", //url-адрес, по которому будет отправлен запрос
            dataType:"text", // Тип данных
            data:myData, //post переменные
            success:function(response){
                // в случае успеха, скрываем, выбранный пользователем для удаления, элемент
                $('#item_'+DbNumberID).fadeOut(80);
                //$('<td><span><a></a></span></td>').fadeOut(80);
            },
            error:function (xhr, ajaxOptions, thrownError){
                //выводим ошибку
                alert(thrownError);
            }
        });
        setTimeout(function() {window.location.reload();}, 100);
        $(".table tr:first-child td:last-child").remove();

    });


    // Добавляем нового студента
    $("#button_new_student").click(function (e) {

        e.preventDefault();

        if($("#content_new_student_id").val()==="") //simple validation
        {
            alert("Введите текст!");
            return false;
        }
        var myData = "content_new_student="+ $("#content_new_student_id").val(); //post variables

        jQuery.ajax({
            type: "POST",
            url: "../include/editColum/addStudent.php",
            dataType:"text",
            data:myData, //post переменные
            success:function(response){
                $("#responds").append(response);
                $("#content_new_student_id").val('');
            },
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError);
            }
        });
        location.reload();
    });
    // Удаляем выбраного студента
    $("#button_delete_student").click(function (e) {

        e.preventDefault();

        if($("#content_new_student_id").val()==="") //simple validation
        {
            alert("Введите текст!");
            return false;
        }
        var myData = "content_new_student="+ $("#content_new_student_id").val(); //post variables

        jQuery.ajax({
            type: "POST",
            url: "../include/editColum/deleteStudent.php",
            dataType:"text",
            data:myData, //post переменные
            success:function(response){
                $("#responds").append(response);
                $("#content_new_student_id").val('');
            },
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError);
            }
        });
        location.reload();
    });
    // Высчитываем среднее значение
    $("#average_button").click(function () {

        jQuery.ajax({
            type: "POST",
            url: "../include/editColum/credn-round.php",
            dataType:"text",
        });
        location.reload();
    });

    // Нумерация первой колонки в таблице
    $('.table  tr').each(function(i) {
        var number = i + 0;
        $(this).find('td:first').text(number);
    });
    $('.table  tr:first-child').each(function() {
        var number = '№';
        $(this).find('td:first').text(number);
    });






    // меняем цвет колонки стреднего значения в зависимсти от самого значения
    ///
    ///
    ///
    ///
    ///

//    $(document).ready(function () {
//		var MyRows = $('table#grade_in_the_group').find('tr');
//		for (var i = 1; i < MyRows.length; i++){
//		  for (var j = 3; j < 50; j++) {
//			console.log($(MyRows[i]).find('td:eq('+j+')').html());
//		  }
//        }
//    });




});
