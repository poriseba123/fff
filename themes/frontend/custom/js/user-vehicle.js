openAddVehicleContainer = function (event) {

    if ($('#addvehiclecontainer').hasClass("noDisplay")) {
        $('#addvehiclecontainer').removeClass("noDisplay");
    }

    if (!$('#addvehicleoptioncontainer').hasClass("noDisplay")) {
        $('#addvehicleoptioncontainer').addClass("noDisplay")
    }
};

getVehicleModelList = function (event) {
    loader_start();
    var selector = $('#' + event.id);
    var vBrandId = selector.val();
    var url = full_path + "vehicle/getvehiclemodellist";
    $.post(url,
            {
                vBrandId: vBrandId
            },
            function (resp) {
                $('#uservehicle-car_model').append(resp);
                loader_stop();
            }, 'json');
};

getVehiclecolor = function (event) {
    loader_start();
    var selector = $('#' + event.id);
    var vColorId = selector.val();
    var url = full_path + "vehicle/getvehiclecolor";
    $.post(url,
            {
                vColorId: vColorId
            },
            function (resp) {
                $('#vehicel-color-span').css({'background-color': resp});
                loader_stop();
            }, 'json');
};
$('#usermaster-drive_frontimage, #usermaster-drive_backimage').change(function (event) {
    var ext = $(this).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
        $(this).parent().addClass('has-error');
        $(this).parent().find(".help-block").html("Sólo se aceptan archivos con las siguientes extensiones: png, jpg, jpeg, gif");
    } else {
        if ($(this).parent().hasClass('has-error')) {
            $(this).parent().removeClass('has-error')
        }
//        $('#usermaster-userimage').parent().find(".help-block").html("");
//        if (event.files && event.files[0]) {
//            var reader = new FileReader();
//            reader.onload = function (e) {
//                $('#uploaded-image')
//                        .attr('src', e.target.result)
//                        .width(100)
//                        .height(100);
//            };
//            reader.readAsDataURL(event.files[0]);
//        }
    }
});
checkVehicleImg = function (event) {
    var selector = $('#' + event.id);
    var ext = selector.val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
        selector.parent().addClass('has-error');
        selector.parent().find(".help-block").html("Sólo se aceptan archivos con las siguientes extensiones: png, jpg, jpeg, gif");
    } else {
        if (selector.parent().hasClass('has-error')) {
            selector.parent().removeClass('has-error')
        }
        selector.parent().find(".help-block").html("");
        if (event.files && event.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#userIdentityVehicleImg')
                        .attr('src', e.target.result)
                        .width('auto')
                        .height(150);
            };
            reader.readAsDataURL(event.files[0]);
        }
    }
};

$('body').on('submit', '#userVehicleRequest', function (e) {
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find('.has-error').removeClass('has-error');
    _this.find('.help-block').html('');

    var url = full_path + "vehicle/addvehicle";
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
                setTimeout(function () {
                    window.location.href = window.location.href;
                }, "3000");
            } else {
                loader_stop();
                if (resp.imageError == true) {
                    error_msg(resp.imgErrorMsg);
                }
                $.each(resp.errors, function (item, value) {
                    if (item == "licence_font_image") {
                        item = "drive_frontimage";
                    }
                    if (item == "licence_back_image") {
                        item = "drive_backimage";
                    }

                    $('#usermaster-' + item).parent("div").addClass("has-error");
                    $('#usermaster-' + item).parent("div").find('.help-block').html(value);
                });
                $.each(resp.vehicleErrors, function (item, value) {
                    if (item == "car_img") {
                        item = "vehicleImg";
                    }
                    console.log('#uservehicle-' + item);
                    if (item == "color") {
                        $('#uservehicle-' + item).parent("div").parent("div").addClass("has-error");
                        $('#uservehicle-' + item).parent("div").parent("div").find('.help-block').html(value);
                    } else {
                        $('#uservehicle-' + item).parent("div").addClass("has-error");
                        $('#uservehicle-' + item).parent("div").find('.help-block').html(value);
                    }
                });
            }
        },
        error: function () {}
    });
});
$('body').on('submit', '#userVehicleEditRequest', function (e) {
    e.preventDefault();
    loader_start();
    var _this = $(this);

    _this.find('.has-error').removeClass('has-error');
    _this.find('.help-block').html('');

    var url = full_path + "vehicle/editvehicle";
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
                setTimeout(function () {
                    window.location.href = resp.redirectUrl;
                }, "3000");
            } else {
                loader_stop();
                if (resp.imageError == true) {
                    error_msg(resp.imgErrorMsg);
                }
                $.each(resp.errors, function (item, value) {
                    if (item == "licence_font_image") {
                        item = "drive_frontimage";
                    }
                    if (item == "licence_back_image") {
                        item = "drive_backimage";
                    }

                    $('#usermaster-' + item).parent("div").addClass("has-error");
                    $('#usermaster-' + item).parent("div").find('.help-block').html(value);
                });
                $.each(resp.vehicleErrors, function (item, value) {
                    if (item == "car_img") {
                        item = "vehicleImg";
                    }
                    console.log('#uservehicle-' + item);
                    if (item == "color") {
                        $('#uservehicle-' + item).parent("div").parent("div").addClass("has-error");
                        $('#uservehicle-' + item).parent("div").parent("div").find('.help-block').html(value);
                    } else {
                        $('#uservehicle-' + item).parent("div").addClass("has-error");
                        $('#uservehicle-' + item).parent("div").find('.help-block').html(value);
                    }
                });
            }
        },
        error: function () {}
    });
});