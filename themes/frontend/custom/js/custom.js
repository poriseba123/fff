$('form#user_signup').submit(function (e) {
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find('.has-error').removeClass('has-error');
    _this.find('.help-block').html('');

    var data = _this.serialize();
    var url = full_path + 'registration/registration';
    $.post(url, data,
            function (resp) {
                if (resp.flag == true) {
                    success_msg(resp.msg);
                    setTimeout(function () {
                        window.location.href = resp.redirectUrl;
                    }, '3000');
                } else {
                    $.each(resp.error, function (item, value) {
                        _this.find('#usermaster-' + item).parent('div').addClass('has-error');
                        _this.find('#usermaster-' + item).parent('div').find('.help-block').html(value);
                    });
                    loader_stop();
                }
            }, 'json');
});

$('form#userloginForm').submit(function (e) {
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find('.has-error').removeClass('has-error');
    _this.find('.help-block').html('');

    var data = _this.serialize();
    var url = full_path + 'site/ajaxlogin';
    $.post(url, data,
            function (resp) {
                if (resp.flag == true) {
                    success_msg(resp.msg);
                    setTimeout(function () {
                        window.location.href = resp.redirectUrl;
                    }, 3000);
                } else {
                    $.each(resp.error, function (item, value) {
                        _this.find('#loginform-' + item).parent('div').addClass('has-error');
                        _this.find('#loginform-' + item).parent('div').find('.help-block').html(value);
                    });
                    loader_stop();
                }
            }, 'json');
});

showForgotPassModal = function () {
    $('#forgotpassemail').val("");
    $('#forgotPassModal').modal();
};

$('form#forget_password_form').submit(function (e) {
    e.preventDefault();
    var _this = $(this);
    loader_start();
    _this.find('.has-error').removeClass('has-error');
    _this.find('.help-block').html('');

    var data = _this.serialize();
    var url = full_path + 'site/sentforgotpassmail';
    $.post(url, data,
            function (resp) {
                loader_stop();
                if (resp.flag == true) {
                    _this.find('input').val('');
                    $('#forgotPassModal').modal('hide');
                    success_msg(resp.msg);
                } else {
                    _this.find('#forgotpassemail').parent('div').addClass('has-error');
                    _this.find('#UserMaster-for-email').parent('div').find('.help-block').html(resp.msg);

                }
            }, 'json');
});

$('#userchangeforgotpassword').submit(function (e) {
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find('.has-error').removeClass("has-error");
    _this.find('.help-block').html('');

    var data = _this.serialize();

    var url = full_path + "site/changepass";

    $.post(url, data,
            function (resp) {
                if (resp.flag == true) {
                    success_msg(resp.msg);
                    setTimeout(function () {
                        window.location.href = resp.redirectUrl
                    });
                } else {
                    loader_stop();
                    $.each(resp.error, function (item, value) {
                        _this.find('#usermaster-' + item).parent('div').addClass('has-error');
                        _this.find('#usermaster-' + item).parent('div').find('.help-block').html(value);
                    });
                }
            }, 'json');
});

function toggleFn(divid) {
    var x = document.getElementById(divid);
    if (x.style.display === 'none') {
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
//    $("#editsubmit").click();
}
function phoneVerify() {
    var url = full_path + 'user/verifyphone';
    loader_start();
    $.post(url, '',
            function (resp) {
                if (resp.type == 'success') {
                    $('#verfyModal').modal('show');
                    success_msg(resp.msg);
                } else {
                    error_msg(resp.msg);
                }
                loader_stop();
            }, 'json');
}

$('form#verify_form').submit(function (e) {
    e.preventDefault();
    $("#err_verifyCode").parent('div').removeClass('has-error');
    $("#err_verifyCode").html('');
    var _this = $(this);
    loader_start();
    _this.find('.has-error').removeClass('has-error');
    _this.find('.help-block').html('');

    var data = _this.serialize();
    var url = full_path + 'user/checkotp';
    $.post(url, data,
            function (resp) {
                if (resp.type == 'success') {
                    $('#verfyModal').modal('hide');
                    success_msg(resp.msg);
                    setTimeout(function () {
                        window.location.reload()
                    })
                } else {
                    loader_stop();
                    $("#err_verifyCode").parent('div').addClass('has-error');
                    $("#err_verifyCode").html(resp.msg);
                }
            }, 'json');
});
$('form#newsletter_form').submit(function (e) {
    e.preventDefault();
    $(".help-block").parent('div').removeClass('has-error');
    $(".help-block").html('');
    var _this = $(this);
    loader_start();
    _this.find('.has-error').removeClass('has-error');
    _this.find('.help-block').html('');

    var data = _this.serialize();
    var url = full_path + 'site/newsletter';
    $.post(url, data,
            function (resp) {
                if (resp.type == 'success') {
                    $('#verfyModal').modal('hide');
                    success_msg(resp.msg);
                    setTimeout(function () {
                        window.location.reload()
                    })
                } else {
                    loader_stop();
                    $.each(resp.error, function(index, elem) {
                        $("#err_" + index).text(elem);
                        $("#err_" + index).addClass("help-block");
                        $("#err_" + index).parent().addClass("has-error");

                    });
                }
            }, 'json');
});

useridentityverify = function (event) {
    loader_start();
    var selector = $('#' + event.id);

    var url = full_path + "user/checkdocumentverify";

    $.post(url, {},
            function (resp) {
                if (resp.alertType == "notApplied") {
                    $('#useridentitymodal').modal();
                } else if (resp.alertType == "wating") {
                    warning_msg(resp.msg);
                } else if (resp.alertType == "approved") {
                    success_msg(resp.msg);
                }
                loader_stop();
            }, 'json');
};

userIdentificationImage = function (event) {
    var ext = $('#identitydocument-document').val().split('.').pop().toLowerCase();
    var name = $('#identitydocument-document').val().split('\\').pop();
    if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
        if (!$('#previewIdentifyImage').parent().hasClass("noDisplay")) {
            $('#previewIdentifyImage').parent().addClass("noDisplay");
        }
        $('#identityFileName').val("");
        $('#identitydocument-document').parent().addClass('has-error');
        $('#identitydocument-document').parent().find(".help-block").html("Sólo se aceptan archivos con las siguientes extensiones: png, jpg, jpeg, gif");
    } else {
        if ($('#identitydocument-document').parent().hasClass('has-error')) {
            $('#identitydocument-document').parent().removeClass('has-error');
        }
        $('#identitydocument-document').parent().find(".help-block").html("");
        if (event.files && event.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#previewIdentifyImage')
                        .attr('src', e.target.result)
                        .width("auto")
                        .height('100');
                $('#identityFileName').val(name);
            };
            reader.readAsDataURL(event.files[0]);
        }
        $('#previewIdentifyImage').parent().removeClass("noDisplay");
    }
};
$('#checkIdentityDocuentForm').submit(function (e) {
    e.preventDefault();
    loader_start();
    var _this = $(this);
    var url = full_path + "user/submituseridentifydocument";
    _this.find('.has-error').removeClass('has-error');
    _this.find('.help-block').html('');
    $.ajax({
        url: url,
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        success: function (resp) {
            console.log(resp);
            if (resp.flag == true) {
                success_msg(resp.msg);
                setTimeout(function () {
                    window.location.href = window.location.href;
                }, "3000");
            } else {
                if (resp.imgError == true) {
                    error_msg(resp.imgErrorMsg);
                } else {
                    $.each(resp.errors, function (item, value) {
                        if(item == "file_name"){
                            item = "document";
                        }
                        $('#identitydocument-' + item).parent("div").addClass("has-error");
                        $('#identitydocument-' + item).parent("div").find('.help-block').html(value);
                    });
                }
                loader_stop();
            }
        },
        error: function () {}
    });
});
function deletePost() {
    var post_id = $('#post_id').val();
    var url = full_path + "post/delete";
    $.ajax({
        url: url,
        type: "POST",
        data: {post_id: post_id},
        dataType: 'json',
        success: function (resp) {
            if (resp.flag == true) {
                $('#deleteModal').modal('hide');
                success_msg(resp.msg);
                setTimeout(function () {
                    window.location.reload();
                }, '3000')

            }
            loader_stop();
        },
        error: function (data) {
            loader_stop();
        },
        complete: function (data) {
            loader_stop();
        }
    });

}