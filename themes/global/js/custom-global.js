$('.title-tooltip').tooltip();
loader_start = function () {
    $('#processing').removeClass("noDisplay");
};
loader_stop = function () {
    $('#processing').addClass("noDisplay");
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