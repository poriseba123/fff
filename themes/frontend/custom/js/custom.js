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
                        if(item=='gender'){
                           _this.find('#usermaster-' + item).parent('div').addClass('has-error');
                        _this.find('#usermaster-' + item).parent('div').find('.help-block').html(value);  
                        }else{
                        _this.find('#usermaster-' + item).parent('div').addClass('has-error');
                        _this.find('#usermaster-' + item).parent('div').find('.material-input').html(value);
                    }
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
                        _this.find('#loginform-' + item).parent('div').find('.material-input').html(value);
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

(function ($) {

    $(function () {

        var flashDiv = '<div class="inner-box posting" id="flash" style="display: none;"><div class="alert alert-success alert-lg flash_inner" role="alert"><h2 class="postin-title">✔ Congratulations!</h2><div class="flash_close"></div> </div></div>';
        $(flashDiv).appendTo('body');

        $.extend({
            flash: function (content, options) {
                var flash = $('#flash');

                flash.find('.flash_inner').html(content);
                flash
                        .show()
                        .css({opacity: 0})
                        .bottom()
                        .animate({
                            top: (($(window).height() - flash.height())) - 50 + 'px',
                            opacity: 0.8
                        });

                $(document).click(function () {
                    flash.animate({
                        top: ($(window).height() + 50) + 'px',
                        opacity: 0
                    });
                });
            }
        });

        $.fn.extend({
            bottom: function () {
                var offLeft = Math.floor((($(window).width() - this.width()) / 2) - 20),
                        offTop = Math.floor($(window).height() + 50);
                this.css({
                    top: ((offTop != null && offTop > 0) ? offTop : '0') + 'px',
                    left: ((offLeft != null && offLeft > 0) ? offLeft : '0') + 'px'
                });
                return this;
            },

            flash: function (options) {
                $.flash(this.html(), options);
                return this;
            }
        });

    });

})(jQuery);


$(document).ready(function () {

    $('#search_states').change(function () {
        var city_id = $('#hidden_city').val();
        loader_start();
        var state_id = $(this).val();
        var url = full_path + 'site/getsearchbarcities';
        console.log(url);
        $.post(url, {state_id: state_id, city_id: city_id}, function (data) {
            $('#search_cities').html(data.html);
            $("#search_cities").selectpicker('refresh');
            loader_stop();
        }, 'json');
    });

    $('body').on('submit', '#contactForm', function (e) {
        $("#submitmessage").prop('disabled', true);
        regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var error = false;
        e.preventDefault();

        var _this = $(this);
        var email = $("#email").val();
        if (regex.test(email) == true) {
            loader_startfront();
            _this.find(".has-error").removeClass("has-error");
            _this.find("#eror_msg").html("");
            var data = _this.serialize();
            var url = full_path + "contactus/contact";
            //alert(url);
            $.post(url, data,
                    function (resp) {

                        if (resp.flag == true) {
                            loader_stopfront();
                            $.toast({
                                heading: 'Success',
                                position: 'top-center',
                                showHideTransition: 'slide',
                                text: 'Thank You for writhing to us.We will reach back to you shortly.',
                                icon: 'success',

                            })
                            setTimeout(function () {
                                 location.reload();
                            }, 3000);
                           
                        } else {
                            $.each(resp.error, function (item, value) {

                                $.toast({
                                    heading: 'Information',
                                    position: 'top-center',
                                    showHideTransition: 'slide',
                                    text: value,
                                    icon: 'info'
                                })
                            });

                        }
                    }, 'json');
        } else {
            $('#email').addClass("has-error");
            $.toast({
                heading: 'Error',
                position: 'top-center',
                showHideTransition: 'slide',
                text: 'Please provied valid email id.',
                icon: 'error'
            })


        }
        $("#submitmessage").prop('disabled', false);

    });
    $('body').on('submit', '#subscribe', function (e) {
        $("#sub").prop('disabled', true);
        regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var error = false;
        e.preventDefault();
        //loader_start();
        var _this = $(this);
        var email = $("#email").val();
        if (regex.test(email) == true) {
            _this.find(".has-error").removeClass("has-error");
            _this.find("#eror_msg").html("");
            var data = _this.serialize();
            var url = full_path + "site/newsletter";
            //alert(url);

            $.post(url, data,
                    function (resp) {
                        if (resp.flag == true) {
                            $.toast({
                                heading: 'Success',
                                position: 'top-center',
                                showHideTransition: 'slide',
                                text: 'Thank you for  subscribe.',
                                icon: 'success'
                            })

                        } else {
                            $.each(resp.error, function (item, value) {

                                $.toast({
                                    heading: 'Information',
                                    position: 'top-center',
                                    showHideTransition: 'slide',
                                    text: value,
                                    icon: 'info'
                                })
                            });

                        }
                    }, 'json');
        } else {
            $('.subscribe').addClass("has-error");
            $.toast({
                heading: 'Error',
                position: 'top-center',
                showHideTransition: 'slide',
                text: 'Please provied valid email id.',
                icon: 'error'
            })


        }
        $("#sub").prop('disabled', false);

    });

});