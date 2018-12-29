/**
 * Created by Artur on 25.07.2018.
 */

// var arr_class = ['range1','range2','range3'];
//
// function table_colorize(elements, array_class)
// {
//     elements.each(function(i, j){
//
//         var  num = i.innerText || i.textContent;
//
//         var  $class;
//         if(num > 1.5 && num < 5.5)
//             $class = array_class[0];
//         if(num > 5.4 && num <= 8.3)
//             $class = array_class[1];
//         if(num >= 9.0 || num <= 1)
//             $class = array_class[2];
//
//         i.addClassName($class);
//
//     });
//
// };
//
// var first = $('.table_rating tbody tr td.omissions');
//
// table_colorize(first, arr_class);


//
// $.fn.editableTableWidget = function (options) {
//     'use strict';
//     return $(this).each(function () {
//         var buildDefaultOptions = function () {
//                 var opts = $.extend({}, $.fn.editableTableWidget.defaultOptions);
//                 opts.editor = opts.editor.clone();
//                 return opts;
//             },
//             activeOptions = $.extend(buildDefaultOptions(), options),
//             ARROW_LEFT = 37, ARROW_UP = 38, ARROW_RIGHT = 39, ARROW_DOWN = 40, ENTER = 13, ESC = 27, TAB = 9,
//             element = $(this),
//             editor = activeOptions.editor.css('position', 'absolute').hide().appendTo(element.parent()),
//             active,
//             showEditor = function (select) {
//                 active = element.find('td:focus');
//                 if (active.length) {
//                     editor.val(active.text())
//                         .removeClass('error')
//                         .show()
//                         .offset(active.offset())
//                         .css(active.css(activeOptions.cloneProperties))
//                         .width(active.width())
//                         .height(active.height())
//                         .focus();
//                     if (select) {
//                         editor.select();
//                     }
//                 }
//             },
//             setActiveText = function () {
//                 var text = editor.val(),
//                     evt = $.Event('change'),
//                     originalContent;
//                 if (active.text() === text || editor.hasClass('error')) {
//                     return true;
//                 }
//                 originalContent = active.html();
//                 active.text(text).trigger(evt, text);
//                 if (evt.result === false) {
//                     active.html(originalContent);
//                 }
//             },
//             movement = function (element, keycode) {
//                 if (keycode === ARROW_RIGHT) {
//                     return element.next('td');
//                 } else if (keycode === ARROW_LEFT) {
//                     return element.prev('td');
//                 } else if (keycode === ARROW_UP) {
//                     return element.parent().prev().children().eq(element.index());
//                 } else if (keycode === ARROW_DOWN) {
//                     return element.parent().next().children().eq(element.index());
//                 }
//                 return [];
//             };
//         editor.blur(function () {
//             setActiveText();
//             editor.hide();
//         }).keydown(function (e) {
//             if (e.which === ENTER) {
//                 setActiveText();
//                 editor.hide();
//                 active.focus();
//                 e.preventDefault();
//                 e.stopPropagation();
//             } else if (e.which === ESC) {
//                 editor.val(active.text());
//                 e.preventDefault();
//                 e.stopPropagation();
//                 editor.hide();
//                 active.focus();
//             } else if (e.which === TAB) {
//                 active.focus();
//             } else if (this.selectionEnd - this.selectionStart === this.value.length) {
//                 var possibleMove = movement(active, e.which);
//                 if (possibleMove.length > 0) {
//                     possibleMove.focus();
//                     e.preventDefault();
//                     e.stopPropagation();
//                 }
//             }
//         })
//             .on('input paste', function () {
//                 var evt = $.Event('validate');
//                 active.trigger(evt, editor.val());
//                 if (evt.result === false) {
//                     editor.addClass('error');
//                 } else {
//                     editor.removeClass('error');
//                 }
//             });
//         element.on('click keypress dblclick', showEditor)
//             .css('cursor', 'pointer')
//             .keydown(function (e) {
//                 var prevent = true,
//                     possibleMove = movement($(e.target), e.which);
//                 if (possibleMove.length > 0) {
//                     possibleMove.focus();
//                 } else if (e.which === ENTER) {
//                     showEditor(false);
//                 } else if (e.which === 17 || e.which === 91 || e.which === 93) {
//                     showEditor(true);
//                     prevent = false;
//                 } else {
//                     prevent = false;
//                 }
//                 if (prevent) {
//                     e.stopPropagation();
//                     e.preventDefault();
//                 }
//             });
//
//         element.find('td').prop('tabindex', 1);
//
//         $(window).on('resize', function () {
//             if (editor.is(':visible')) {
//                 editor.offset(active.offset())
//                     .width(active.width())
//                     .height(active.height());
//             }
//         });
//     });
//
// };
// $.fn.editableTableWidget.defaultOptions = {
//     cloneProperties: ['padding', 'padding-top', 'padding-bottom', 'padding-left', 'padding-right',
//         'text-align', 'font', 'font-size', 'font-family', 'font-weight',
//         'border', 'border-top', 'border-bottom', 'border-left', 'border-right'],
//     editor: $('<input>')
// };



// $("td.rating").click(function(){
//     var idTR = $(this).attr('id');
//     var classLastTd = $("td:last-child.rating").attr('class').split( " " );
//     var  idLastTD =classLastTd[1].split("_")[1];
//
//
// var rating_ = ".rating_";
//     for(var i=1; i<idLastTD; i++){
//
//         var rating = $(rating_+i);
//         // var p = rating;
//         // rating.each(function(){
//         //         alert($(rating).text());
//         //     });
//
//
//         // $(".rating_"+ i).each(function(){
//         //     alert($(this).text());
//         // });
//         // alert(rating.html());
//     }
//
//
//
//     // alert(idLastTD);
// });


// $(".table_rating tbody tr:first-child").each(function () {
//     $("td", this).each(function () {
//         var mass;
//         mass +=  +$(this).text();
//         // sum += +mass[i]
//         // mass.push($(this).text());
//         // console.log(mass);
//         alert(mass);
//         // sa(mass);
//     });
//
// });
//
// $('.table_rating tbody tr:first-child').click(function(){
//     $(this, 'tr').each(function(index, tr) {
//         var lines = $('td', tr).map(function(index, td) {
//             var mass = [];
//             while($(td).text() == true){
//                 mass.push($(td).text());
//             }
//             console.log(mass);
//             // alert($(td).text());
//             // var s=[1,2,3,4,5,6];
//             // console.log(mass);
//             sa(mass)
//         });
//         // alert(mass);
//
//     })
// });


///main
// $(function () {
//     $(".table_rating tbody tr:first-child").each(function () {
//         var sum = 0;
//         // console.log(typeof());
//         $("td.rating",this).each(function() {
//             var arifm = $(this).length;
//             console.log(arifm);
//             var object2 = Number($(this).text());
//             sum += +object2;
//
//
//             //arifm(sum/arifm);
//             alert(arifm);
//
//             $(".table_rating tbody tr:first-child td.average").text(sum/2);
//         });
//     });
// })


// рабочий
// function sa() {
//     var rows = window.document.querySelectorAll(".table_rating tbody tr");
//
//     for (var i = 0; i < rows.length; i++) { // перебираем все строки
//         var cols = rows[i].querySelectorAll('td.rating'); // получаем столбцы
//         var avg = rows[i].querySelectorAll('td.average'); // получаем avg
//         var value=[];
//         var sum = 0;
//         //var td = rows[i].getElementsByClassName('average');
//
//
//         for (var j = 0; j < cols.length; j++) { // перебираем все столбцы
//             sum += +Number(cols[j].textContent);
//
//             value.push(cols[j].textContent);
//
//             //console.log(cols[j].textContent); // выводим текст из столбца
//         }
//         var count = value.length;
//         avg[i].textContent  = (sum/count);
//         //$('td.average').text(String(sum/count));
//         //var f = document.getElementsByClassName('average').textContent;
//         //var f = rows[i].document.querySelector('average');
//         //var  afr = f+= + (sum/count).textContent;
//
//         //console.log(sum/count);
//         //console.log(f);
//     }
// }
// sa();



//
// function sa(mass) {
//
// var len = mass.length;
// var sum = 0;
// for (var i = 0; i < len; i++) {
//     sum = mass[i];
//     // sum += +mass[i];
// }
//     console.log(mass);
// // $(".table_rating tbody tr:first-child td:first-child").html(sum / len);
// // alert(sum);
// }

// alert(sa([4,2,3,5,7,8,2,4]));
// alert(sa('4', '2', '3'));


// $(function () {
//     $(".table_rating tbody tr:first-child td.average").each(function (indx) {
//         var sum = 0;
//         $("td:nth-child(" + (indx + 1) + ")").each(function () {
//             console.log($(this).text());
//             sum += +$(this).text();
//
//         });
//         $(".table_rating tbody tr:first-child td.average").text(sum)
//     });
// })


// var rows = window.document.querySelectorAll(".table_rating tbody tr:first-child");
//
// for (var i = 0; i < rows.length; i++) { // перебираем все строки
//     var cols = rows[i].querySelectorAll('td'); // получаем столбцы
//     var value=[];
//     for (var j = 0; j < cols.length; j++) { // перебираем все столбцы
//         value.push(cols[j].textContent);
//         //console.log(cols[j].textContent); // выводим текст из столбца
//     }
//     var count = value.length;
//     console.log(count);
// // console.log(value);
// }


//
// var input = document.getElementsByTagName('input'), array = ['load', 'keyup'], i = array.length;
// while(i--){
//     window['on'+array[i]] = function() {
//         function $(i){
//             return ~~input[i].value;
//         }
//         input[2].value = ~~($(0) / $(1));
//         input[5].value = $(3) * $(4);
//         input[8].value = ~~($(6) / $(7));
//         document.getElementById('sum').value = $(2) + $(5) + $(8);
//     };
// }

