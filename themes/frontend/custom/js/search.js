$(document).ready(function () {
    //$('#loader').css("display", "block");
    setTimeout(function () {
        $('#loader').css("display", "block");
        $('#search_states').trigger('change');
    }, '10');
    $('#search_states').change(function () {
        var city_id = $('#hidden_city').val();
        var state_id = $(this).val();
        var url = full_path + 'site/getsearchbarcities';
        $.post(url, {state_id: state_id, city_id: city_id}, function (data) {
            $("#search_cities").html(data.html, function () {
                $("#search_cities").selectpicker('refresh');
            }).callsearch()


        }, 'json');
    });

});
(function ($) {
    // create a reference to the old `.html()` function
    var htmlOriginal = $.fn.html;

    // redefine the `.html()` function to accept a callback
    $.fn.html = function (html, callback) {
        // run the old `.html()` function with the first parameter
        var ret = htmlOriginal.apply(this, arguments);
        // run the callback (if it is defined)
        if (typeof callback == "function") {
            callback();
        }
        // make sure chaining is not broken
        return ret;
    }
})(jQuery);
$.fn.bar = function () {
    $('#loader').css("display", "none");
    return this; //The magic statement
}
$.fn.callsearch = function () {
   search();
    return this; //The magic statement
}
function search() {
    var formData = $('#searchForm').serialize();
    //console.log(formData);
    var url = full_path + 'search/getsearch';
    $.post(url, formData, function (data) {
        //alert(data);
        if (data.res == 1) {
            $("#search-result").html(data.html, function () {
            }).bar();
        }
    }, 'json');
}