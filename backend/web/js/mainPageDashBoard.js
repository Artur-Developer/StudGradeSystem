/**
 * Created by Artur on 26.07.2018.
 */

function windowSize(){
    // console.log($(window).width());
    var body_height = 450;
    if ($(window).width() >= '1200' && $(window).width() <= '1920'){
        $(".content-wrapper").css("height",body_height*2);
    }
    if ($(window).width() <= '1181'){
        $(".content-wrapper").css("height",body_height*3.5);
    }
    if ($(window).width() <= '581'){
        $(".content-wrapper").css("height",body_height*4);
    }
    if ($(window).width() <= '537'){
        $(".content-wrapper").css("height",body_height*5);
    }
    if ($(window).width() <= '462'){
        $(".content-wrapper").css("height",body_height*6.5);
    }
}
$(window).on('load resize',windowSize);