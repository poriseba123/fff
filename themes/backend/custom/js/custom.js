$('body').on('submit', '#create_gym_form', function (e) {       ///hospital form add

    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");

    var data = new FormData(this);
    var url = full_path + "gymcenter/createajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {
                if (resp.imgErr == true) {
                    $('#gymcenter-image').parent('div').addClass('has-error');
                    $('#gymcenter-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#gymcenter-' + item).parent().addClass("has-error");
                    $('#gymcenter-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });
});
$('body').on('submit', '#update_gym_form', function (e) {   /// ///hospital form update
    //$('#user-pro-update').submit(function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "gymcenter/updateajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {
            
                if (resp.imgErr == true) {
                    $('#err-image').parent('div').addClass('has-error');
                    $('#err-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#gymcenter-' + item).parent().addClass("has-error");
                    $('#gymcenter-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });

});
$('body').on('submit', '#create_orphanehome_form', function (e) {       ///hospital form add

    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");

    var data = new FormData(this);
    var url = full_path + "orphanehome/createajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {
                if (resp.imgErr == true) {
                    $('#orphanehome-image').parent('div').addClass('has-error');
                    $('#orphanehome-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#orphanehome-' + item).parent().addClass("has-error");
                    $('#orphanehome-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });
});
$('body').on('submit', '#update_orphanehome_form', function (e) {   /// ///hospital form update
    //$('#user-pro-update').submit(function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "orphanehome/updateajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {
            
                if (resp.imgErr == true) {
                    $('#err-image').parent('div').addClass('has-error');
                    $('#err-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#orphanehome-' + item).parent().addClass("has-error");
                    $('#orphanehome-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });

});

$('body').on('submit', '#create_oldagehome_form', function (e) {       ///hospital form add

    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");

    var data = new FormData(this);
    var url = full_path + "oldagehome/createajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {
                if (resp.imgErr == true) {
                    $('#oldagehome-image').parent('div').addClass('has-error');
                    $('#oldagehome-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#oldagehome-' + item).parent().addClass("has-error");
                    $('#oldagehome-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });
});
$('body').on('submit', '#update_oldagehome_form', function (e) {   /// ///hospital form update
    //$('#user-pro-update').submit(function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "oldagehome/updateajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {
            
                if (resp.imgErr == true) {
                    $('#err-image').parent('div').addClass('has-error');
                    $('#err-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#oldagehome-' + item).parent().addClass("has-error");
                    $('#oldagehome-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });

});
$('body').on('submit', '#create_hospitalnursinghome_form', function (e) {       ///hospital form add

    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");

    var data = new FormData(this);
    var url = full_path + "hospitalnursing/createajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {
                if (resp.checkbox == false) {
                    $("input:checkbox[type=checkbox]:checked").each(function () {
                        if ($(this).is(":visible")) {
                            var day_master_val = $(this).val();
                            $('.day_master_time_' + day_master_val).find('input:text')
                                    .each(function () {
                                        var input_field_val = $(this).val();
                                        if (input_field_val == '') {
                                            $(this).parent().parent().addClass("has-error");
                                            $(this).parent().parent().find(".help-block").html('Field cannot be blank');
                                            error = true;
                                        }
                                    });
                        }

                    });
                }
                if (resp.imgErr == true) {
                    $('#hospitalnursingmaster-image').parent('div').addClass('has-error');
                    $('#hospitalnursingmaster-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#hospitalnursingmaster-' + item).parent().addClass("has-error");
                    $('#hospitalnursingmaster-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });
});
$('body').on('submit', '#update_hospitalnursinghome_form', function (e) {   /// ///hospital form update
    //$('#user-pro-update').submit(function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "hospitalnursing/updateajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {
                if (resp.checkbox == false) {
                    $("input:checkbox[type=checkbox]:checked").each(function () {
                        if ($(this).is(":visible")) {
                            var day_master_val = $(this).val();
                            $('.day_master_time_' + day_master_val).find('input:text')
                                    .each(function () {
                                        var input_field_val = $(this).val();
                                        if (input_field_val == '') {
                                            $(this).parent().parent().addClass("has-error");
                                            $(this).parent().parent().find(".help-block").html('Field cannot be blank');
                                            error = true;
                                        }
                                    });
                        }

                    });
                }
                if (resp.imgErr == true) {
                    $('#err-image').parent('div').addClass('has-error');
                    $('#err-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#hospitalnursingmaster-' + item).parent().addClass("has-error");
                    $('#hospitalnursingmaster-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });

});
$('body').on('submit', '#create_features_form', function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);
    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "homepagefeatures/createajax";

    $.post(url, data,
            function (resp) {
                loader_stop();
                if (resp.flag == true) {
                    notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                    setTimeout(function () {
                        location.href = resp.url;
                    }, '2000');
                } else {
                    $.each(resp.errors, function (item, value) {
                        $('#homepagefeatures-' + item).parent().addClass("has-error");
                        $('#homepagefeatures-' + item).parent().find(".help-block").html(value);
                    });

                }
            }, 'json');
});
$('body').on('submit', '#update_features_form', function (e) {

    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "homepagefeatures/updateajax";

    $.post(url, data,
            function (resp) {
                loader_stop();
                if (resp.flag == true) {
                    notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                    setTimeout(function () {
                        location.href = resp.url;
                    }, '2000');
                } else {
                    $.each(resp.errors, function (item, value) {
                        $('#homepagefeatures-' + item).parent().addClass("has-error");
                        $('#homepagefeatures-' + item).parent().find(".help-block").html(value);
                    });

                }
            }, 'json');
});
$('body').on('submit', '#create_optin_form', function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);
    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "leftmenu/createajax";

    $.post(url, data,
            function (resp) {
                loader_stop();
                if (resp.flag == true) {
                    notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                    setTimeout(function () {
                        location.href = resp.url;
                    }, '2000');
                } else {
                    $.each(resp.errors, function (item, value) {
                        $('#leftmenu-' + item).parent().addClass("has-error");
                        $('#leftmenu-' + item).parent().find(".help-block").html(value);
                    });

                }
            }, 'json');
});
$('body').on('submit', '#update_optin_form', function (e) {

    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "leftmenu/updateajax";

    $.post(url, data,
            function (resp) {
                loader_stop();
                if (resp.flag == true) {
                    notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                    setTimeout(function () {
                        location.href = resp.url;
                    }, '2000');
                } else {
                    $.each(resp.errors, function (item, value) {
                        $('#leftmenu-' + item).parent().addClass("has-error");
                        $('#leftmenu-' + item).parent().find(".help-block").html(value);
                    });

                }
            }, 'json');
});
$('body').on('submit', '#user-pro-update', function (e) {
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");

    var data = _this.serialize();
    var url = full_path + "users/editdetails";

    $.post(url, data,
            function (resp) {
                loader_stop();
                if (resp.flag == true) {
                    $('#user-update-success').find('strong').html(resp.msg);
                    $('#user-update-success').show("slow");
                    setTimeout(function () {
                        $('#user-update-success').hide("slow");
                    }, "5000");
                } else {
                    $.each(resp.errors, function (item, value) {
                        $('#usermaster-' + item).parent().addClass("has-error");
                        $('#usermaster-' + item).parent().find(".help-block").html(value);
                    });
                }
            }, 'json');
});
$('body').on('submit', '#create-chamber-form', function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);
    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "doctor/createchamberajax";

    $.post(url, data,
            function (resp) {
                loader_stop();
                if (resp.flag == true) {
                    notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                    setTimeout(function () {
                        location.href = resp.url;
                    }, '2000');
                } else {
                    $.each(resp.errors, function (item, value) {
                        $('#doctorchamber-' + item).parent().addClass("has-error");
                        $('#doctorchamber-' + item).parent().find(".help-block").html(value);
                    });
                    if (resp.checkbox == false) {
                        $("input:checkbox[type=checkbox]:checked").each(function () {
                            var day_master_val = $(this).val();
                            $('.day_master_time_' + day_master_val).find('input:text')
                                    .each(function () {
                                        var input_field_val = $(this).val();
                                        if (input_field_val == '') {
                                            $(this).parent().parent().addClass("has-error");
                                            $(this).parent().parent().find(".help-block").html('Field cannot be blank');
                                            error = true;
                                        }
                                    });
                        });
                    }
                }
            }, 'json');
});
$('body').on('submit', '#update-chamber-form', function (e) {

    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "doctor/updatechamberajax";

    $.post(url, data,
            function (resp) {
                loader_stop();
                if (resp.flag == true) {
                    notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                    setTimeout(function () {
                        location.href = resp.url;
                    }, '2000');
                } else {
                    $.each(resp.errors, function (item, value) {
                        $('#doctorchamber-' + item).parent().addClass("has-error");
                        $('#doctorchamber-' + item).parent().find(".help-block").html(value);
                    });
                    if (resp.checkbox == false) {
                        $("input:checkbox[type=checkbox]:checked").each(function () {
                            var day_master_val = $(this).val();
                            $('.day_master_time_' + day_master_val).find('input:text')
                                    .each(function () {
                                        var input_field_val = $(this).val();
                                        if (input_field_val == '') {
                                            $(this).parent().parent().addClass("has-error");
                                            $(this).parent().parent().find(".help-block").html('Field cannot be blank');
                                            error = true;
                                        }
                                    });
                        });
                    }
                }
            }, 'json');
});

$('body').on('submit', '#create_hospitalunits_form', function (e) {
    e.preventDefault();
    var error = false;
    loader_start();
    var _this = $(this);
    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "hospitalunits/createajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {

                $.each(resp.errors, function (item, value) {
                    $('#hospitalfacility-' + item).parent().addClass("has-error");
                    $('#hospitalfacility-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });

});

$('body').on('submit', '#update_hospitalunits_form', function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);
    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "hospitalunits/updateajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {

                $.each(resp.errors, function (item, value) {
                    $('#hospitalfacility-' + item).parent().addClass("has-error");
                    $('#hospitalfacility-' + item).parent().find(".help-block").html(value);
                });

            }
        }
    });

});

//////////////////////////////////////////////////////medical test create form start////////////////////////////////////////

$('body').on('submit', '#create_medicaltest_form', function (e) {
    e.preventDefault();
    var error = false;
    loader_start();
    var _this = $(this);
    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "medicaltest/createajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {

                $.each(resp.errors, function (item, value) {
                    $('#medicaltest-' + item).parent().addClass("has-error");
                    $('#medicaltest-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });

});
/////////////////////////////////////////////////end///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////medical test update form///////////////////////////////////////////////
$('body').on('submit', '#update_medicaltest_form', function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);
    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "medicaltest/updateajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {

                $.each(resp.errors, function (item, value) {
                    $('#medicaltest-' + item).parent().addClass("has-error");
                    $('#medicaltest-' + item).parent().find(".help-block").html(value);
                });

            }
        }
    });

});
//////////////////////////////////////////////////////////////end/////////////////////////////////////////////////////

//////////////////////////////////////////////////////aya center create form start////////////////////////////////////////

$('body').on('submit', '#create_ayacenter_form', function (e) {
    e.preventDefault();
    var error = false;
    loader_start();
    var _this = $(this);
    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "ayacenter/createajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {
                if (resp.imgErr == true) {
                    $('#ayamaster-image').parent('div').addClass('has-error');
                    $('#ayamaster-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#ayamaster-' + item).parent().addClass("has-error");
                    $('#ayamaster-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });

});
/////////////////////////////////////////////////////////////////////end/////////////////////////////////////////
/////////////////////////////////////////////////////////update aya center///////////////////////////////////////
$('body').on('submit', '#update_ayacenter_form', function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "ayacenter/updateajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {
                if (resp.imgErr == true) {
                    $('#ayamaster-image').parent('div').addClass('has-error');
                    $('#ayamaster-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#ayamaster-' + item).parent().addClass("has-error");
                    $('#ayamaster-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });
//
    $.post(url, data,
            function (resp) {
                loader_stop();
                if (resp.flag == true) {
                    notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                    setTimeout(function () {
                        location.href = resp.url;
                    }, '2000');
                } else {
                    $.each(resp.errors, function (item, value) {
                        $('#ayamaster-' + item).parent().addClass("has-error");
                        $('#ayamaster-' + item).parent().find(".help-block").html(value);
                    });
                    if (resp.phone == false) {
                        $('.main_contact_div').find('input:text')
                                .each(function () {
                                    var input_field_val = $(this).val();
                                    if (input_field_val == '') {
                                        $(this).parent().parent().parent().addClass("has-error");
                                        $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                        error = true;
                                    }
                                });
                    }
                }
            }, 'json');
});
/////////////////////////////////////////////////////////////////end////////////////////////////////////////////////////////
$('body').on('submit', '#create_medicine_shop_form', function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);
    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "medicineshop/createajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {
                if (resp.imgErr == true) {
                    $('#medicineshopmaster-image').parent('div').addClass('has-error');
                    $('#medicineshopmaster-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#medicineshopmaster-' + item).parent().addClass("has-error");
                    $('#medicineshopmaster-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });
    $.post(url, data,
            function (resp) {
                loader_stop();
                if (resp.flag == true) {
                    notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                    setTimeout(function () {
                        location.href = resp.url;
                    }, '2000');
                } else {
                    $.each(resp.errors, function (item, value) {
                        $('#medicineshopmaster-' + item).parent().addClass("has-error");
                        $('#medicineshopmaster-' + item).parent().find(".help-block").html(value);
                    });
                    if (resp.phone == false) {
                        $('.main_contact_div').find('input:text')
                                .each(function () {
                                    var input_field_val = $(this).val();
                                    if (input_field_val == '') {
                                        $(this).parent().parent().parent().addClass("has-error");
                                        $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                        error = true;
                                    }
                                });
                    }
                }
            }, 'json');
});
$('body').on('submit', '#update_medicine_shop_form', function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "medicineshop/updateajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {
                if (resp.imgErr == true) {
                    $('#err-image').parent('div').addClass('has-error');
                    $('#err-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#medicineshopmaster-' + item).parent().addClass("has-error");
                    $('#medicineshopmaster-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });

    $.post(url, data,
            function (resp) {
                loader_stop();
                if (resp.flag == true) {
                    notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                    setTimeout(function () {
                        location.href = resp.url;
                    }, '2000');
                } else {
                    $.each(resp.errors, function (item, value) {
                        $('#medicineshopmaster-' + item).parent().addClass("has-error");
                        $('#medicineshopmaster-' + item).parent().find(".help-block").html(value);
                    });
                    if (resp.phone == false) {
                        $('.main_contact_div').find('input:text')
                                .each(function () {
                                    var input_field_val = $(this).val();
                                    if (input_field_val == '') {
                                        $(this).parent().parent().parent().addClass("has-error");
                                        $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                        error = true;
                                    }
                                });
                    }
                }
            }, 'json');
});

$('body').on('submit', '#create_diagnostic_centre_form', function (e) {
    //$('#user-pro-update').submit(function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);
    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    //    var data = _this.serialize();
    var data = new FormData(this);
    var url = full_path + "diagnosticcentre/createajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {
                if (resp.imgErr == true) {
                    $('#diagnosticcentre-image').parent('div').addClass('has-error');
                    $('#diagnosticcentre-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#diagnosticcentre-' + item).parent().addClass("has-error");
                    $('#diagnosticcentre-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });
});
$('body').on('submit', '#update_diagnostic_centre_form', function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);
    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = new FormData(this);
    var url = full_path + "diagnosticcentre/updateajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {
                if (resp.imgErr == true) {
                    $('#err-image').parent('div').addClass('has-error');
                    $('#err-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#diagnosticcentre-' + item).parent().addClass("has-error");
                    $('#diagnosticcentre-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });
});

$('body').on('submit', '#create_blood_bank_form', function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);
    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    //var data = _this.serialize();
    var data = new FormData(this);
    var url = full_path + "bloodbank/createajax";

    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {
                if (resp.imgErr == true) {
                    $('#bloodbankmaster-image').parent('div').addClass('has-error');
                    $('#bloodbankmaster-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#bloodbankmaster-' + item).parent().addClass("has-error");
                    $('#bloodbankmaster-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });
});
$('body').on('submit', '#update_blood_bank_form', function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = new FormData(this);
    var url = full_path + "bloodbank/updateajax";

    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {
                if (resp.imgErr == true) {
                    $('#err-image').parent('div').addClass('has-error');
                    $('#err-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#bloodbankmaster-' + item).parent().addClass("has-error");
                    $('#bloodbankmaster-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });

});
$('body').on('submit', '#update_medical_news_form', function (e) {
    //$('#user-pro-update').submit(function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "medicalnews/updateajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {
                if (resp.imgErr == true) {
                    $('#err-image').parent('div').addClass('has-error');
                    $('#err-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#medicalnewsmaster-' + item).parent().addClass("has-error");
                    $('#medicalnewsmaster-' + item).parent().find(".help-block").html(value);
                });

            }
        }
    });

});
$('body').on('submit', '#create_medical_news_form', function (e) {

    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");

    var data = new FormData(this);
    var url = full_path + "medicalnews/createajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {

                if (resp.imgErr == true) {
                    $('#medicalnewsmaster-image').parent('div').addClass('has-error');
                    $('#medicalnewsmaster-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#medicalnewsmaster-' + item).parent().addClass("has-error");
                    $('#medicalnewsmaster-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });
});
$('body').on('submit', '#create_eye_bank_form', function (e) {

    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");

    var data = new FormData(this);
    var url = full_path + "eyebank/createajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {
                if (resp.checkbox == false) {
                    $("input:checkbox[type=checkbox]:checked").each(function () {
                        var day_master_val = $(this).val();
                        $('.day_master_time_' + day_master_val).find('input:text')
                                .each(function () {
                                    var input_field_val = $(this).val();
                                    if (input_field_val == '') {
                                        $(this).parent().parent().addClass("has-error");
                                        $(this).parent().parent().find(".help-block").html('Field cannot be blank');
                                        error = true;
                                    }
                                });
                    });
                }
                if (resp.imgErr == true) {
                    $('#eyebankmaster-image').parent('div').addClass('has-error');
                    $('#eyebankmaster-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#eyebankmaster-' + item).parent().addClass("has-error");
                    $('#eyebankmaster-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });
});
$('body').on('submit', '#update_image_form', function (e) {
    //$('#user-pro-update').submit(function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "homepagelogoslider/updateajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {
                if (resp.imgErr == true) {
                    $('#err-image').parent('div').addClass('has-error');
                    $('#err-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#homepagesliderlogo-' + item).parent().addClass("has-error");
                    $('#homepagesliderlogo-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });

});
$('body').on('submit', '#update_eye_bank_form', function (e) {
    //$('#user-pro-update').submit(function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "eyebank/updateajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {
                if (resp.imgErr == true) {
                    $('#err-image').parent('div').addClass('has-error');
                    $('#err-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#eyebankmaster-' + item).parent().addClass("has-error");
                    $('#eyebankmaster-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });

});
$('body').on('submit', '#create_mortuary_form', function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");



    var data = _this.serialize();
    var url = full_path + "mortuary/createajax";

    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {
                if (resp.imgErr == true) {
                    $('#mortuarymaster-image').parent('div').addClass('has-error');
                    $('#mortuarymaster-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#mortuarymaster-' + item).parent().addClass("has-error");
                    $('#mortuarymaster-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });

});
$('body').on('submit', '#update_mortuary_form', function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");



    var data = _this.serialize();
    var url = full_path + "mortuary/updateajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {
                if (resp.imgErr == true) {
                    $('#err-image').parent('div').addClass('has-error');
                    $('#err-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#mortuarymaster-' + item).parent().addClass("has-error");
                    $('#mortuarymaster-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });

});

////////////////////////////////////////////create state form start////////////////////////////////////////
$('body').on('submit', '#create_state_form', function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "state/createajax";

    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {

                $.each(resp.errors, function (item, value) {
                    $('#states-' + item).parent().addClass("has-error");
                    $('#states-' + item).parent().find(".help-block").html(value);
                });

            }
        }
    });

});
/////////////////////////////////////////////////////end/////////////////////////////////////////////
//
//////////////////////////////////////////////update state form/////////////////////////////////////
$('body').on('submit', '#update_state_form', function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);
    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "state/updateajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {

                $.each(resp.errors, function (item, value) {
                    $('#states-' + item).parent().addClass("has-error");
                    $('#states-' + item).parent().find(".help-block").html(value);
                });

            }
        }
    });

});
//
////////////////////////////////////////////////////end//////////////////////////////////////////////
//
////////////////////////////////////////////create district form start////////////////////////////////////////
$('body').on('submit', '#create_district_form', function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "district/createajax";

    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {

                $.each(resp.errors, function (item, value) {
                    $('#districts-' + item).parent().addClass("has-error");
                    $('#districts-' + item).parent().find(".help-block").html(value);
                });

            }
        }
    });

});
///////////////////////////////////////////////////end/////////////////////////////////////////////

////////////////////////////////////////////update district form/////////////////////////////////////
$('body').on('submit', '#update_district_form', function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);
    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "district/updateajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {

                $.each(resp.errors, function (item, value) {
                    $('#districts-' + item).parent().addClass("has-error");
                    $('#districts-' + item).parent().find(".help-block").html(value);
                });

            }
        }
    });

});

////////////////////////////////////////////////////end//////////////////////////////////////////////
//
////////////////////////////////////////////create city form start////////////////////////////////////////
$('body').on('submit', '#create_city_form', function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "city/createajax";

    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {

                $.each(resp.errors, function (item, value) {
                    $('#cities-' + item).parent().addClass("has-error");
                    $('#cities-' + item).parent().find(".help-block").html(value);
                });

            }
        }
    });

});
/////////////////////////////////////////////////////end/////////////////////////////////////////////
//
//////////////////////////////////////////////update city form/////////////////////////////////////
$('body').on('submit', '#update_city_form', function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);
    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");
    var data = _this.serialize();
    var url = full_path + "city/updateajax";
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {

                $.each(resp.errors, function (item, value) {
                    $('#cities-' + item).parent().addClass("has-error");
                    $('#cities-' + item).parent().find(".help-block").html(value);
                });

            }
        }
    });

});

//////////////////////////////////////////////////end//////////////////////////////////////////////
$('body').on('submit', '#create_ambulance_form', function (e) {
    //$('#user-pro-update').submit(function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");



    var data = _this.serialize();
    var url = full_path + "ambulance/createajax";

    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {
                if (resp.imgErr == true) {
                    $('#ambulancemaster-image').parent('div').addClass('has-error');
                    $('#ambulancemaster-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#ambulancemaster-' + item).parent().addClass("has-error");
                    $('#ambulancemaster-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });

    /*$.post(url, data,
     function (resp) {
     loader_stop();
     if (resp.flag == true) {
     notifySuccess(true, true, resp.msg, 'bottom center', 5000);
     setTimeout(function(){
     location.href=resp.url;
     },'2000');
     } else {
     $.each(resp.errors, function (item, value) {
     $('#ambulancemaster-' + item).parent().addClass("has-error");
     $('#ambulancemaster-' + item).parent().find(".help-block").html(value);
     });
     if(resp.phone==false){
     $('.main_contact_div').find('input:text')
     .each(function() {
     var input_field_val=$(this).val();
     if(input_field_val==''){
     $(this).parent().parent().parent().addClass("has-error");
     $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
     error=true;
     }
     });
     }
     }
     }, 'json');*/
});
$('body').on('submit', '#update_ambulance_form', function (e) {
    //$('#user-pro-update').submit(function (e) {
    var error = false;
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find(".has-error").removeClass("has-error");
    _this.find(".help-block").html("");



    var data = _this.serialize();
    var url = full_path + "ambulance/updateajax";

    $.ajax({
        url: url, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (resp) // A function to be called if request succeeds
        {
            loader_stop();
            if (resp.flag == true) {
                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                setTimeout(function () {
                    location.href = resp.url;
                }, '2000');
            } else {
                if (resp.imgErr == true) {
                    $('#err-image').parent('div').addClass('has-error');
                    $('#err-image').parent('div').find('.help-block').html(resp.msg);
                }
                $.each(resp.errors, function (item, value) {
                    $('#ambulancemaster-' + item).parent().addClass("has-error");
                    $('#ambulancemaster-' + item).parent().find(".help-block").html(value);
                });
                if (resp.phone == false) {
                    $('.main_contact_div').find('input:text')
                            .each(function () {
                                var input_field_val = $(this).val();
                                if (input_field_val == '') {
                                    $(this).parent().parent().parent().addClass("has-error");
                                    $(this).parent().parent().parent().find(".help-block").html('Field cannot be blank');
                                    error = true;
                                }
                            });
                }
            }
        }
    });

});



$('.image-input').change(function (e) {
    if (typeof (FileReader) != "undefined") {
        obj = $(this).parent().parent().next().children();
        var image_holder = $(obj);
        image_holder.empty();
//obj=image_holder.parent().children().find('img');
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




//==================================================================================

//douserphonevarified = function(event) {
//    var selector = $('#' + event.id);
//
//    var userId = selector.attr('data-userId');
//    var url = full_path + "users/userdetailsvarify";
//    $.post(url, {
//            userId: userId,
//            type: 'phoneverify'
//        },
//        function(resp) {
//            if (resp.flag == true) {
//                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
//                selector.html('<i class="fa fa-check-circle" aria-hidden="true" style="font-size: 18px;"></i>');
//                selector.addClass('linkDisabled');
//            } else {
//                notifyError(true, true, resp.msg, 'bottom center', 5000);
//            }
//        }, 'json');
//};

//douseremailvarified = function(event) {
//    var selector = $('#' + event.id);
//
//    var userId = selector.attr('data-userId');
//    var url = full_path + "users/userdetailsvarify";
//    $.post(url, {
//            userId: userId,
//            type: 'emailverify'
//        },
//        function(resp) {
//            if (resp.flag == true) {
//                notifySuccess(true, true, resp.msg, 'bottom center', 5000);
//                selector.html('<i class="fa fa-check-circle" aria-hidden="true" style="font-size: 18px;"></i>');
//                selector.addClass('linkDisabled');
//            } else {
//                notifyError(true, true, resp.msg, 'bottom center', 5000);
//            }
//        }, 'json');
//};

$('#usersearch').submit(function (e) {
    var _this = $(this);
    var data = _this.serialize();
    data.push({
        name: "fname",
        value: $('#fname').val()
    });
    data.push({
        name: "lname",
        value: $('#lname').val()
    });
    data.push({
        name: "email",
        value: $('#email').val()
    });
    data.push({
        name: "userstatus",
        value: $('#userstatus').val()
    });
});
