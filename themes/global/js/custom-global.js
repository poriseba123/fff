$('.title-tooltip').tooltip();
loader_start = function () {
    $('#processing').removeClass("noDisplay");
};
loader_stop = function () {
    $('#processing').addClass("noDisplay");
};
loader_startfront = function () {
    $('#loader').css("display", "block");
};
loader_stopfront = function () {
    $('#loader').css("display", "none");
};
function success_msg(message) {
    notie.alert('success', message, 5);
}

function error_msg(message) {
    notie.alert('error', message, 5);
}
function warning_msg(message) {
    notie.alert('warning', message, 5);
}
$(document).ready(function () {
//    $("#navbar").css("background-color", "transparent");
//    $(document).click(function (event) {
//        var clickover = $(event.target);
//        $("#navbar").toggleClass("main");
//    });
})
