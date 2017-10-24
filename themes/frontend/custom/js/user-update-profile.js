updateProfilePicture = function (event) {
    var ext = $('#usermaster-userimage').val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
        $('#usermaster-userimage').parent().addClass('has-error');
        $('#usermaster-userimage').parent().find(".help-block").html("Sólo se aceptan archivos con las siguientes extensiones: png, jpg, jpeg, gif");
    } else {
        if($('#usermaster-userimage').parent().hasClass('has-error')){
            $('#usermaster-userimage').parent().removeClass('has-error')
        }
        $('#usermaster-userimage').parent().find(".help-block").html("");
        if (event.files && event.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#uploaded-image')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
            };
            reader.readAsDataURL(event.files[0]);
        }
    }
};

$('form#updatePersonalInfo').submit(function (e) {
    e.preventDefault();
    var _this = $(this);
    loader_start();
    if (!$('#userimg-error-container').hasClass('noDisplay')) {
        $('#userimg-error').html("");
        $('#userimg-error-container').addClass('noDisplay');
    }

    _this.find('.has-error').removeClass('has-error');
    _this.find('.help-block').html('');

    var url = full_path + "user/profile";

    $.ajax({
        url: url,
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        success: function (resp) {
            if (resp.flag == true) {
                success_msg(resp.msg);
                if (resp.imgError == true) {
                    loader_stop();
                    $('#userimg-error').html(resp.imgErrorMsg);
                    $('#userimg-error-container').removeClass('noDisplay');
                } else {
                    setTimeout(function () {
                        window.location.href = window.location.href;
                    }, "3000");
                }
            } else {
                loader_stop();
                $.each(resp.errors, function (item, value) {
                    $('#usermaster-' + item).parent("div").addClass("has-error");
                    $('#usermaster-' + item).parent("div").find('.help-block').html(value);
                });
            }
        },
        error: function () {}
    });
});

$('form#userChangePassword').submit(function (e) {
    e.preventDefault();
    var _this = $(this);
    loader_start();
    _this.find('.has-error').removeClass('has-error');
    _this.find('.help-block').html('');

    var data = _this.serialize();
    var url = full_path + 'user/changepassword';
    $.post(url, data,
            function (resp) {
                loader_stop();
                if (resp.flag == true) {
                    success_msg(resp.msg);
                    _this.find('input').val('');
                } else {
                    $.each(resp.error, function (item, value) {
                        _this.find('#passwordmodel-' + item).parent('div').addClass('has-error');
                        _this.find('#passwordmodel-' + item).parent('div').find('.help-block').html(value);
                    });
                }
            }, 'json');
});

sendEmailVerificationLink = function () {
    loader_start();
    var userId = $('#' + event.id).attr('data-userId');
    var url = full_path + "user/sendemailverificationlink";
    $.post(url,
            {
                userId: userId
            },
            function (resp) {
                loader_stop();
                if (resp.flag == true) {
                    success_msg(resp.msg);
                } else {
                    error_msg(resp.msg);
                }
            }, 'json');
};

sendforgotpassmail = function(){
    loader_start();
    var url = full_path+"user/sendforgotpassmail";
    $.post(url,{},function(resp){
        if(resp.flag == true){
            success_msg(resp.msg);
            loader_stop();
        }else{
            error_msg(resp.msg);
            loader_stop();
        }
    }, 'json');
    
}