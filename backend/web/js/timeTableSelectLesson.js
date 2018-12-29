/**
 * Created by vipma on 17.06.2018.
 */

function timeUpdateColorLesson() {
    var date = new Date();
    var options = {
        day: 'numeric',
        weekday: 'long',
        hour: 'numeric',
        minute: 'numeric',
    };
    dataInfo = date.toLocaleString("ru", options);
    var dayWeek =  dataInfo[0]+dataInfo[1];
    var dayWeek2 =  dataInfo[0]+dataInfo[2];
    if(dayWeek == 'во'){
        dayWeek = 'пн';
    }

    var day =  $(".viget_raspisanie .nav-tabs li a").attr('day');

    $('.viget_raspisanie .nav-tabs li:contains('+dayWeek+')').addClass("active");
    $('.viget_raspisanie .nav-tabs li:contains('+dayWeek2+')').addClass("active");

    day_week = date.getUTCDay();

    // $('.viget_raspisanie .tab-content div').removeClass("active");
    // $('.viget_raspisanie .tab-content div:nth-child('+day_week+')').addClass("active");
    // var idLEsson = $(".viget_raspisanie .tab-content  .tab-pane").attr('id');

    var time = dataInfo.substr(dataInfo.length - 5).trim();
    if(time.length < 5){
        time = 0+time.trim();
    }

    var stand,start_time,end_time,countChild;
    var divs = document.querySelectorAll('.tab-pane.active .blockTime li p');
    for (var i = 0; i < divs.length; i++){
        if(divs[i].innerHTML) {
            stand= divs[i].innerHTML;
            start_time = stand.substr(0,5);
            end_time = stand.substr(stand.length - 5);
            var isInInterval = time >= start_time && time <= end_time;
            if(isInInterval == true){
                countChild = i+1;
                break;
            }
        }
    }
    $('.viget_raspisanie .tab-content .lessons li').removeClass("active");
    $('.viget_raspisanie .tab-content .blockTime li').removeClass("active");

    $('.viget_raspisanie .tab-content .lessons li:nth-child('+countChild+')').addClass("active");
    $('.viget_raspisanie .tab-content .blockTime li:nth-child('+countChild+')').addClass("active");
}

timeUpdateColorLesson();

setInterval(function() {
    timeUpdateColorLesson();

}, 60000);