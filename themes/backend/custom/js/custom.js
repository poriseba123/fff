$('body').on('submit', '#user-pro-update', function (e) {
//$('#user-pro-update').submit(function (e) {
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

douserphonevarified = function (event) {
    var selector = $('#' + event.id);

    var userId = selector.attr('data-userId');
    var url = full_path + "users/userdetailsvarify";
    $.post(url,
            {
                userId: userId,
                type: 'phoneverify'
            },
            function (resp) {
                if (resp.flag == true) {
                    notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                    selector.html('<i class="fa fa-check-circle" aria-hidden="true" style="font-size: 18px;"></i>');
                    selector.addClass('linkDisabled');
                } else {
                    notifyError(true, true, resp.msg, 'bottom center', 5000);
                }
            }, 'json');
};

douseremailvarified = function (event) {
    var selector = $('#' + event.id);

    var userId = selector.attr('data-userId');
    var url = full_path + "users/userdetailsvarify";
    $.post(url,
            {
                userId: userId,
                type: 'emailverify'
            },
            function (resp) {
                if (resp.flag == true) {
                    notifySuccess(true, true, resp.msg, 'bottom center', 5000);
                    selector.html('<i class="fa fa-check-circle" aria-hidden="true" style="font-size: 18px;"></i>');
                    selector.addClass('linkDisabled');
                } else {
                    notifyError(true, true, resp.msg, 'bottom center', 5000);
                }
            }, 'json');
};

$('#usersearch').submit(function (e) {
    var _this = $(this);
    var data = _this.serialize();
    data.push({name: "fname", value: $('#fname').val()});
    data.push({name: "lname", value: $('#lname').val()});
    data.push({name: "email", value: $('#email').val()});
    data.push({name: "userstatus", value: $('#userstatus').val()});
});

notaccepteddrivinglicence = function (event) {
    var selector = $('#' + event.id);
    var userId = selector.attr("data-userId");
    $('#cancelDrivingLicenceForm').find('#drivingUserId').val(userId);
    $('#cancelDrivingLicenceForm').find('#drivingUserType').val("not-accepted");
    $('#cancelDrivingLicence').modal();

};

$('body').on('submit', '#cancelDrivingLicenceForm', function (e) {
    e.preventDefault();
    loader_start();
    var selector = $('#driveLicActionContainer');
    var _this = $(this);
    _this.find('.has-error').removeClass('has-error');
    _this.find('.help-block').html('');
    var data = _this.serialize();
    var url = full_path + "driverrequest/acceptdriverlicence";
    $.post(url, data,
            function (resp) {
                if (resp.flag == true) {
                    $('#cancelDrivingLicence').modal('hide');
                    selector.find("button").addClass('noDisplay');
                    selector.find("#drivingLicStatusMsg").removeClass('noDisplay');
                    selector.find("#drivingLicStatusMsg").find('strong').html(resp.msg);
                    loader_stop();
                } else {
                    loader_stop();
                    $('#causeOfDLCCancellation').parent().addClass("has-error");
                    $('#causeOfDLCCancellation').parent().find(".help-block").html(resp.causemsg);
                }
            }, 'json');
});

accepteddrivinglicence = function (event) {
    loader_start();
    var selector = $('#' + event.id);
    var userId = selector.attr("data-userId");
    var url = full_path + "driverrequest/acceptdriverlicence";
    $.post(url,
            {
                userId: userId,
                type: "accepted"
            },
            function (resp) {
                if (resp.flag == true) {
                    selector.parent().find("button").addClass('noDisplay');
                    selector.parent().find("#drivingLicStatusMsg").removeClass('noDisplay');
                    selector.parent().find("#drivingLicStatusMsg").find('strong').html(resp.msg);
                }
                loader_stop();
            }, 'json');
};

vehicleNotAccepted = function (event) {
    var selector = $('#' + event.id);
    var targetId = selector.attr("data-targetId");
    $('#cancelVehicleForm').find('#vehicleTargetId').val(targetId);
    $('#cancelVehicleForm').find('#vehicleUserType').val("not-accepted");
    $('#cancelVehicleFormModal').modal();
};

$('body').on('submit', '#cancelVehicleForm', function (e) {
    e.preventDefault();
    loader_start();
    var selector = $('#vehicleActionContainer');
    var _this = $(this);
    _this.find('.has-error').removeClass('has-error');
    _this.find('.help-block').html('');
    var data = _this.serialize();
    var url = full_path + "driverrequest/acceptvehicle";
    $.post(url, data,
            function (resp) {
                if (resp.flag == true) {
                    $('#cancelVehicleFormModal').modal('hide');
                    selector.find("button").addClass('noDisplay');
                    selector.find("#vehicleStatusMsg").removeClass('noDisplay');
                    selector.find("#vehicleStatusMsg").find('strong').html(resp.msg);
                    loader_stop();
                } else {
                    loader_stop();
                    $('#causeOfVehicleCancellation').parent().addClass("has-error");
                    $('#causeOfVehicleCancellation').parent().find(".help-block").html(resp.causemsg);
                }
            }, 'json');
});

vehicleAccepted = function (event) {
    loader_start();
    var selector = $('#' + event.id);
    var targetId = selector.attr("data-targetId");
    var url = full_path + "driverrequest/acceptvehicle";
    $.post(url,
            {
                targetId: targetId,
                type: "accepted"
            },
            function (resp) {
                loader_stop();
                selector.parent().find("button").addClass('noDisplay');
                selector.parent().find("#vehicleStatusMsg").removeClass('noDisplay');
                selector.parent().find("#vehicleStatusMsg").find('strong').html(resp.msg);
            }, 'json');
};