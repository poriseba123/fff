$(document).ready(function () {
    var images = $("#back-img").find("img").map(function () {
        return this.src;
    }).get();

    $.backstretch(images, {
        fade: 1e3,
        duration: 8e3
    });
});

$('#poriseba-admin-login').submit(function (e) {
    e.preventDefault();
    loader_start();
    $('#admin-login-sub-btn').attr('disabled', true);

    var _this = $(this);

    _this.find('.has-error').removeClass('has-error');
    _this.find('.help-block').html('');

    var data = _this.serialize();
    var url = full_path + 'auth/login';
    $.post(url, data,
            function (resp) {
                if (resp.flag == true) {
                    notifySuccess(true, true, resp.msg, 'top center', 5000);
                    setTimeout(function () {
                        window.location.href = resp.redirectUrl
                    }, 3000);
                } else {
                    loader_stop();
                    notifyError(true, true, resp.msg, 'top center', 5000);
                    $('#admin-login-sub-btn').attr('disabled', false);
                    $.each(resp.errors, function (item, value) {
                        _this.find('#loginform_' + item + '_em_').parent('div').addClass('has-error');
                        _this.find('#loginform_' + item + '_em_').html(value);
                    });
                }
            }, 'json');

});

openForgotPassModal = function () {
    $('#forgot-password-modal').modal('show');
};

$('#admin-pass-forgot').submit(function (e) {
    e.preventDefault();
    loader_start();
    var _this = $(this);
    var data = _this.serialize();
    var url = full_path + 'auth/forgotpass';
    $.post(url, data,
            function (resp) {
                loader_stop();
                if (resp.flag == true) {
                    $('#forgotEmailId').val('');
                    $('#forgot-password-modal').modal('hide');
                    notifySuccess(true, true, resp.msg, 'top center', 5000);
                    $('#sports-notion-admin-login').find('input[type="text"]').val('').focus();
                    $('#sports-notion-admin-login').find('input[type="password"]').val('');
                } else {
//                    notifyError(true, true, resp.msg, 'top center', 5000);
                    $('#forgotEmailId').parent('div').addClass('has-error');
                    $('#forgotEmailId').parent('div').find('.help-block').html(resp.errorMsg);
                }
            }, 'json');
});

closeForgotPassModal = function () {
    $('#forgotEmailId').val('');
    $('#forgot-password-modal').modal('hide')
}

$('#admin-reset-password').submit(function (e) {
    e.preventDefault();
    loader_start();
    var _this = $(this);
    _this.find('.has-error').removeClass('has-error');
    _this.find('.help-block').html('');
    _this.find('#admin-reset-pass-sub-btn').attr('disabled', true);
    var data = _this.serialize();
    var url = full_path + 'auth/resetpassword';
    $.post(url, data,
            function (resp) {
                if (resp.flag == true) {
                    notifySuccess(true, true, resp.msg, 'top center', 5000);
                    setTimeout(function () {
                        window.location.href = resp.redirectUrl;
                    }, 3000);
                } else {
                    loader_stop();
                    _this.find('#admin-reset-pass-sub-btn').attr('disabled', false);
                    $.each(resp.error, function (item, value) {
                        $("#usermaster_" + item + '_em_').parent('div').addClass('has-error');
                        $("#usermaster_" + item + '_em_').parent('div').find('.help-block').html(value);
                    });
                }
            }, 'json');
});
