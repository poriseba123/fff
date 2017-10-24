$('#usermaster-newimage').change(function (e) {
    if (typeof (FileReader) != "undefined") {

        var image_holder = $("#preview-img-holder");
        image_holder.empty();

        var reader = new FileReader();
        reader.onload = function (e) {
            $("<img />", {
                "src": e.target.result,
                "class": "thumb-image",
                "height": "80px"
            }).appendTo(image_holder);

        };
        image_holder.show();
        reader.readAsDataURL($(this)[0].files[0]);
    } else {
        alert("This browser does not support FileReader.");
    }
});
$('body').on('submit', '#admin-pro-update', function(e){
//$('#admin-pro-update').submit(function (e) {
    e.preventDefault();
    loader_start();
    var _this = $(this);
    var url = full_path + 'myprofile/index';
    _this.find('.has-error').removeClass('has-error');
    _this.find('.help-block').html('');
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (data)   // A function to be called if request succeeds
        {
            if (data.flag == true) {
                window.location.href = window.location.href;
            } else {
                loader_stop();
                if (data.imgErr == true) {
                    $('#usermaster-newimage').parent('div').addClass('has-error');
                    $('#usermaster-newimage').parent('div').find('.help-block').html(data.msg);
                } else {
                    $.each(data.error, function (item, value) {
                        $('#usermaster-' + item).parent('div').addClass('has-error');
                        $('#usermaster-' + item).parent('div').find('.help-block').html(value);
                    });
                }
            }
        }
    });
});

$('form#admin-change-pass').submit(function (e) {
    e.preventDefault();
    var _this = $(this);
    loader_start();
    _this.find('.has-error').removeClass('has-error');
    _this.find('.help-block').html('');

    var data = _this.serialize();
    var url = full_path + 'myprofile/index';
    $.post(url, data,
            function (resp) {
                loader_stop();
                if (resp.flag == true) {
                    notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                    _this.find('input').val('');
                } else {
                    $.each(resp.error, function (item, value) {
                        _this.find('#passwordmodel-' + item).parent('div').addClass('has-error');
                        _this.find('#passwordmodel-' + item).parent('div').find('.help-block').html(value);
                    });
                }
            }, 'json');
});