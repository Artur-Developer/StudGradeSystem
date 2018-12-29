/**
 * Created by vipma on 11.12.2017.
 */

$('body').keydown(function(event) {
    if (event.keyCode == 27) {
        $(".sidebar-toggle").click();
    }
});