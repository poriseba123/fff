$(function () {
    $('#search_states').change(function () {
//        loader_start();
        var state_id = $(this).val();
        var url = full_path + 'site/getsearchbarcities'
        $.post(url, {state_id: state_id}, function (data) {
            $('#search_cities').html(data.html);
            $("#search_cities").selectpicker('refresh');
//            loader_stop();
        }, 'json');
    });

});