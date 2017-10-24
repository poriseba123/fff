Lobibox.base.DEFAULTS = $.extend({}, Lobibox.base.DEFAULTS, {
    iconSource: 'fontAwesome'
});
Lobibox.notify.DEFAULTS = $.extend({}, Lobibox.notify.DEFAULTS, {
    iconSource: 'fontAwesome'
});
//======== notify function ================
notifyDefault = function (status, title, msg, position, delay) {
    Lobibox.notify('default', {
        icon: status,
        title: title,
        msg: msg,
        position: position,
        delay: delay,
        showClass: 'fadeInDown',
        hideClass: 'fadeUpDown',
        delayIndicator: true
    });
};
notifyInfo = function (status, title, msg, position, delay) {
    Lobibox.notify('info', {
        icon: status,
        title: title,
        msg: msg,
        position: position,
        delay: delay,
        showClass: 'fadeInDown',
        hideClass: 'fadeUpDown',
        delayIndicator: true
    });
};
notifyWarning = function (status, title, msg, position, delay) {
    Lobibox.notify('warning', {
        icon: status,
        title: title,
        msg: msg,
        position: position,
        delay: delay,
        showClass: 'fadeInDown',
        hideClass: 'fadeUpDown',
        delayIndicator: true
    });
};
notifyError = function (status, title, msg, position, delay) {
    Lobibox.notify('error', {
        icon: status,
        title: title,
        msg: msg,
        position: position,
        delay: delay,
        showClass: 'fadeInDown',
        hideClass: 'fadeUpDown',
        delayIndicator: true
    });
};
notifySuccess = function (status, title, msg, position, delay) {
    Lobibox.notify('success', {
        icon: status,
        title: title,
        msg: msg,
        position: position,
        delay: delay,
        showClass: 'fadeInDown',
        hideClass: 'fadeUpDown',
        delayIndicator: true
    });
};
//============ notify with image ================
notifyImageDefault = function (title, msg, position, imgPath, delay) {
    Lobibox.notify('default', {
        icon: true,
        title: title,
        msg: msg,
        position: position,
        img: imgPath,
        delay: delay,
        showClass: 'fadeInDown',
        hideClass: 'fadeUpDown',
        delayIndicator: true
    });
};
notifyImageInfo = function (title, msg, position, imgPath, delay) {
    Lobibox.notify('info', {
        icon: true,
        title: title,
        msg: msg,
        position: position,
        img: imgPath,
        delay: delay,
        showClass: 'fadeInDown',
        hideClass: 'fadeUpDown',
        delayIndicator: true
    });
};
notifyImageWarning = function (title, msg, position, imgPath, delay) {
    Lobibox.notify('warning', {
        icon: true,
        title: title,
        msg: msg,
        position: position,
        img: imgPath,
        delay: delay,
        showClass: 'fadeInDown',
        hideClass: 'fadeUpDown',
        delayIndicator: true
    });
};
notifyImageError = function (title, msg, position, imgPath, delay) {
    Lobibox.notify('error', {
        icon: true,
        title: title,
        msg: msg,
        position: position,
        img: imgPath,
        delay: delay,
        showClass: 'fadeInDown',
        hideClass: 'fadeUpDown',
        delayIndicator: true
    });
};
notifyImageSuccess = function (title, msg, position, imgPath, delay) {
    Lobibox.notify('success', {
        icon: true,
        title: title,
        msg: msg,
        position: position,
        img: imgPath,
        delay: delay,
        showClass: 'fadeInDown',
        hideClass: 'fadeUpDown',
        delayIndicator: true
    });
};
//============ alert function with image ================
alertInfo = function (msg) {
    Lobibox.alert('info', {
        icon: true,
        msg: msg
    });
};
alertWarning = function (msg) {
    Lobibox.alert('warning', {
        icon: true,
        msg: msg
    });
};
alertError = function (msg) {
    Lobibox.alert('error', {
        icon: true,
        msg: msg

    });
};
alertSuccess = function (msg) {
    Lobibox.alert('success', {
        icon: true,
        msg: msg
    });
};
//============ confirm function  ================
notifyConfirmation = function (title, msg, okButton, cancelButton) {
    Lobibox.confirm({
        msg: "Are you sure you want to delete this user?",
        buttons: {
            yes: {
                'class': 'lobibox-btn lobibox-btn-yes',
                text: 'Yes I Will',
                closeOnClick: true
            },
            no: {
                'class': 'lobibox-btn lobibox-btn-no',
                text: 'No',
                closeOnClick: true
            }
        },
        callback: function ($this, type) {
            if (type === 'yes') {
                Lobibox.notify('success', {
                    msg: 'You have clicked "Yes" button.'
                });
            } else if (type === 'no') {
                Lobibox.notify('info', {
                    msg: 'You have clicked "No" button.'
                });
            }
        }
    });
}
