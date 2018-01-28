$(document).ready(function () {
    setTimeout(function(){
        $('#search_states').trigger('change');
    },'5000');
    $('#search_states').change(function () {
        var city_id=$('#hidden_city').val();
//        loader_start();
        var state_id = $(this).val();
        var url = full_path + 'site/getsearchbarcities';
        console.log(url);
        $.post(url, {state_id: state_id,city_id:city_id}, function (data) {
            $('#search_cities').html(data.html);
            $("#search_cities").selectpicker('refresh');
            search();
//            loader_stop();
        }, 'json');
    });

});

function search() {
//    alert('sss');
    loader_start();
    var formData = $('#searchForm').serialize();
    var url = full_path + 'search/getsearch';
    $.post(url, formData, function (data) {
        if (data.res == 1) {
//            window.history.pushState('obj', 'newtitle', data.url);
            $('#search-result').html(data.html);
        }
        loader_stop();
    }, 'json');
}