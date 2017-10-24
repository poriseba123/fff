$(document).ready(function ($) {
    adjustWinHeight();
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        startDate: new Date(),
        language : 'es'
    });
    $(window).resize(function () {
        adjustWinHeight();
    });

    var select = $('.fancy-select');
    var selectOption = $('.fancy-select option');
    select.wrap('<div class="newSelect"></div>');
    $('.newSelect').prepend('<div class="selectedOption">Choose an Option</div><div class="newOptions"></div>');
    selectOption.each(function () {
        var optionContents = $(this).html();
        var optionValue = $(this).attr('value');
        $('.newOptions').append('<div class="newOption" data-value="' + optionValue + '">' + optionContents + '</div>')
    });
    // new select functionality
    var newSelect = $('.newSelect');
    var newOption = $('.newOption');
    var itemHeight = $('.newOption').height();
    var itemCount = $('.newOption').length;
    var optionsHeight = itemHeight * itemCount;
    newSelect.click(function () {
        $(this).addClass('clicked');
    });
    // update based on selection 
    newOption.on('mouseup', function () {
        var newValue = $(this).attr('data-value');
        $(this).parent().prev('.selectedOption').html(newValue).addClass('selected');
        // update the actual input
        selectOption.each(function () {
            var optionValue = $(this).attr('value');
            if (newValue == optionValue) {
                $(this).prop('selected', true);
            } else {
                $(this).prop('selected', false);
            }
        })
    });
    newSelect.on('mouseleave', function () {
        $(this).removeClass('clicked');
    });
$(".title-tooltip").tooltip();
});

function changelang(lang) {
    var url = full_path + 'language/changelang';
    $.post(url,
            {
                lang: lang
            },
            function (resp) {
                window.location.reload();
            }, 'json');
}

$(window).scroll(function () {
    var scroll = $(window).scrollTop();
    if (scroll >= 20) {
        $(".header").addClass("darkHeader");
    } else {
        $(".header").removeClass("darkHeader");
    }
});



function adjustWinHeight() {
    var $ = jQuery;
    var winHeight = $(window).height();
    var footerHeight = $('.footer').height();
    var headerHeight = $('.header').height();
    var mainHeight = winHeight - (parseInt(headerHeight) + parseInt(footerHeight));

    $('.main-body-wrap').css('min-height', mainHeight);
}

function forgotPassword() {
    $('#signin_modal').modal('hide');
    $('#forget_password').modal('show');
}
function signIn() {
    $('#signup_modal').modal('hide');
    $('#signin_modal').modal('show');
}