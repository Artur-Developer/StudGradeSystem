function AjaxPostRating() {

    //setCaretToPos($("#editbox")[0], 2); // перемещение курсора в конец

    arr = $('#editbox').parent().attr('id');
    var i_url = location.href;
    if($('#editbox').val() != 'y'
        && $('#editbox').val() != 'Н'
        && $('#editbox').val() != 'Y'){

        if($('.ajax input').val() != ''){
            $.ajax({ type: "POST",
                url:i_url,
                data: "value="+$('.ajax input').val()+"&idRating="+arr,
                success: function(data){
                    average(); // расчёт среднего значения и подсчёт пропусков
                }});
        }
        else if ($('.ajax input').val() == ''){
            var val_td = null;
            $.ajax({ type: "POST",
                url:i_url,
                data: "value="+val_td+"&idRating="+arr,
                success: function(data){
                    average(); // расчёт среднего значения и подсчёт пропусков
                }});
        }
    }
    else{
        alert("Введите корректные данные(Возможно у вас включён русский язык! Или нажата клавиша CapsLock)");
        $('#editbox').val('');
        die();
    }

}

function setSelectionRange(input, selectionStart, selectionEnd) {
    if (input.setSelectionRange) {
        input.focus();
        input.setSelectionRange(selectionStart, selectionEnd);
    } else if (input.createTextRange) {
        var range = input.createTextRange();
        range.collapse(true);
        range.moveEnd('character', selectionEnd);
        range.moveStart('character', selectionStart);
        range.select();
    }
}

function setCaretToPos(input, pos) {
    setSelectionRange(input, pos, pos);
}

$('.table_rating tbody').keydown(function(e) {
    var td;
    switch (e.keyCode) {
        case 39: // right
            AjaxPostRating();
            $('td.rating.ajax').html($('input#editbox').val());
            $('#editbox').blur();
            $('td.ajax').next().addClass('ajax');
            $('td.ajax').prev().removeClass('ajax');
            $('td.rating.ajax').html('<input id="editbox"  maxlength="1" size="'
                + $('td.rating.ajax').html().length + '" value="' + $('td.rating.ajax').html()
                + '" type="text">');

            setCaretToPos($("#editbox")[0], 2); // перемещение курсора в конец
            $('#editbox').focus();
            break;

        case 37: // left
            AjaxPostRating();
            $('td.rating.ajax').html($('input#editbox').val());
            $('#editbox').blur();
            $('td.ajax').prev().addClass('ajax');
            $('td.ajax').next().removeClass('ajax');
            $('td.rating.ajax').html('<input id="editbox"  maxlength="1" size="'
                + $('td.rating.ajax').html().length + '" value="' + $('td.rating.ajax').html()
                + '" type="text">');
            setCaretToPos($("#editbox")[0], 5); // перемещение курсора в конец
            $('#editbox').focus();
            break;
        case 40: // down
            AjaxPostRating();
            var td = $('td.rating.ajax').index() + 1;
            $('td.rating.ajax').html($('input#editbox').val());
            $('#editbox').blur();
            $('td.rating.ajax').parent().next().children('td.rating:nth-child(' + td + ')').addClass('ajax');
            $('td.rating.ajax').parent().prev().children('td.ajax').removeClass('ajax');
            $('td.rating.ajax').html('<input id="editbox"  maxlength="1" size="'
                + $('td.rating.ajax').html().length + '" value="' + $('td.rating.ajax').html()
                + '" type="text">');
            setCaretToPos($("#editbox")[0], 3); // перемещение курсора в конец
            $('#editbox').focus();

            break;
        case 38: // up
            AjaxPostRating();
            var td = $('td.rating.ajax').index() + 1;
            $('td.rating.ajax').html($('input#editbox').val());
            $('#editbox').blur();
            $('td.rating.ajax').parent().prev().children('td.rating:nth-child(' + td + ')').addClass('ajax');
            $('td.rating.ajax').parent().next().children('td.ajax').removeClass('ajax');
            $('td.rating.ajax').html('<input id="editbox"  maxlength="1" size="'
                + $('td.rating.ajax').html().length + '" value="' + $('td.rating.ajax').html()
                + '" type="text">');
            setCaretToPos($("#editbox")[0], 2); // перемещение курсора в конец
            $('#editbox').focus();

            break;
        case 13: // up
            AjaxPostRating();
            var td = $('td.rating.ajax').index() + 1;
            $('td.rating.ajax').html($('input#editbox').val());
            $('#editbox').blur();
            $('td.rating.ajax').parent().next().children('td.rating:nth-child(' + td + ')').addClass('ajax');
            $('td.rating.ajax').parent().prev().children('td.ajax').removeClass('ajax');
            $('td.rating.ajax').html('<input id="editbox"  maxlength="1" size="'
                + $('td.rating.ajax').html().length + '" value="' + $('td.rating.ajax').html()
                + '" type="text">');
            setCaretToPos($("#editbox")[0], 2); // перемещение курсора в конец
            $('#editbox').focus();

            break;
    }
});


// //Сохранение при нажатии вне поля мышью
$(document).on('blur', '#editbox', function(){
    AjaxPostRating();
});

// function setSelect(idx) {
//     var tbl = document.getElementById(idx);
//     for (i=1; i<tbl.rows.length; i++) {
//         var row = tbl.rows[i];
//         for (j=0; j<row.cells.length; j++) {
//             var td = row.cells[i,j];
//             td.innerHTML = '<p tabindex="-1" contenteditable="true">' + td.innerHTML + '</p>';
//         }
//     }
// }