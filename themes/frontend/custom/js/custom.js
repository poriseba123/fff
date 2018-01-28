$(document).ready(function () {
    $('#search_states').change(function () {
        var city_id=$('#hidden_city').val();
        loader_start();
        var state_id = $(this).val();
        var url = full_path + 'site/getsearchbarcities';
         console.log(url);
        $.post(url, {state_id: state_id,city_id:city_id}, function (data) {
            $('#search_cities').html(data.html);
            $("#search_cities").selectpicker('refresh');
            loader_stop();
        }, 'json');
    });

});