/**
 * Created by vipma on 10.06.2018.
 */
$('#modalUpdateInfoTimeTable').removeClass( "fade" );
$(".lesson").click(function () {

    var id_lesson,number_lesson,kurs,group_id,day_week,type_day,type_week = 0;

     id_lesson = $(this).attr('lesson_id');

     number_lesson = $(this).find(".number_lesson").text();
     kurs = $(".section_options").find(".kurs").attr('kurs');

     group_id = $(this).parent().children('.group_title').attr('group_id');
     day_week = $(this).parent().parent().attr('day_week');
     type_day = $(this).parent().parent().children('.day_title').children('.block_type_day').children('a').attr('type_day');
     type_week = $(this).parent().parent().parent().attr('type_week');

    $("#number_lesson").val(number_lesson);
    $("#group_id").val(group_id);
    $("#day_week").val(day_week);
    $("#type_week").val(type_week);
    $("#type_day").val(type_day);

    $('#modalUpdateInfoTimeTable').modal('show');


	$(".delete_lesson_data").attr("href", "backend/web/timetable/delete-lesson-data?id="+id_lesson);
	
    if(id_lesson != ''){

        id_lesson = $(this).attr('lesson_id');
        $("#id_lesson").val(id_lesson);
        $("#modalUpdateInfoTimeTable").find(".modal-body").load('edit-lesson?id='+id_lesson+'&type_week='+type_week+'&kurs='+kurs);
        
        
 //       $(".delete_lesson_data").click(function () {
	// 	alert(id_lesson);
	// 	var i_url = location.href;
 //           $.ajax({
 //               type: "POST",
 //               url: '/backend/web/timetable/delete-lesson-data?id='+id_lesson,
 //               //url: i_url,
 //               //data: 'id='+id_lesson,
 //               success: function (data) {
 //               }
 //           });

 //           //setTimeout(function() {window.location.reload();}, 100);
	// });
        
    	
    }
    if(id_lesson ==''){
        $("#modalUpdateInfoTimeTable").find(".modal-body").load('save-new-lesson?type_week='+type_week+'&kurs='+kurs);
    }

});
