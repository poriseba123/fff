$(document).ready(function ($) {
    $('#radioBtn a').on('click', function(){
    var sel = $(this).data('title');
    var tog = $(this).data('toggle');
    $('#'+tog).prop('value', sel);
    
    $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
    $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
})
    adjustWinHeight();
//    $('.datepicker').datepicker({
//        format: 'yyyy-mm-dd',
//        autoclose: true,
//        startDate: new Date(),
//        language : 'es'
//    });
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
function addPhone(e) {
    e > global_val && (global_val = e), $(".main_contact_div").append('<div><div class="row row_' + global_val + '"><div class="col-md-8"><input type="text" class="form-control" name="contact_no[]" value=""></div><div class="col-md-4"><div class="btn-group btn-group-solid"><button type="button" class="btn btn-danger" style="font-size:17px;" onclick="removeRow(' + global_val + ')">X</button></div></div></div><div class="help-block"></div></div>'), global_val++
}

function removeRow(e) {
    $(".row_" + e).remove()
}

function geocodeLatLng(e, t) {
    var o = {
        lat: parseFloat(e),
        lng: parseFloat(t)
    };
    geocoder.geocode({
        location: o
    }, function(e, t) {
        "OK" === t ? e[0] ? (document.getElementsByClassName("pac-input")[0].value = e[0].formatted_address, marker.setPosition(e[0].geometry.location), map.setCenter(e[0].geometry.location), map.setZoom(17)) : window.alert("No results found") : window.alert("Geocoder failed due to: " + t)
    })
}

function showPosition(e) {
    currentlat = e.coords.latitude, currentlong = e.coords.longitude, document.getElementsByClassName("latitude")[0].value = currentlat, document.getElementsByClassName("longitude")[0].value = currentlong, geocodeLatLng(currentlat, currentlong)
}

function showError(e) {
    switch (e.code) {
        case e.PERMISSION_DENIED:
            message = "User denied the request for Geolocation.";
            break;
        case e.POSITION_UNAVAILABLE:
            message = "Location information is unavailable.";
            break;
        case e.TIMEOUT:
            message = "The request to get user location timed out.";
            break;
        case e.UNKNOWN_ERROR:
            message = "An unknown error occurred."
    }
}

function getLocation() {
    navigator.geolocation ? navigator.geolocation.getCurrentPosition(showPosition, showError) : message = "Geolocation is not supported by this browser.", message && alert(message)
}

function initAutocomplete() {
    if ("undefined" != typeof currentlat && "undefined" != typeof currentlong) {
        var e = new google.maps.LatLng(currentlat, currentlong),
            t = {
                zoom: 5,
                center: e,
                scrollwheel: !1,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
        geocoder = new google.maps.Geocoder, map = new google.maps.Map(document.getElementsByClassName("map")[0], t), marker = new google.maps.Marker({
            position: e,
            map: map,
            draggable: !0
        }), google.maps.event.addListener(marker, "dragend", function() {
            document.getElementsByClassName("latitude")[0].value = marker.getPosition().lat(), document.getElementsByClassName("longitude")[0].value = marker.getPosition().lng()
        });
        var o = document.getElementsByClassName("pac-input")[0],
            a = new google.maps.places.Autocomplete(o, {
                types: ["geocode"]
            });
        a.bindTo("bounds", map);
        var n = new google.maps.InfoWindow;
        google.maps.event.addListener(a, "place_changed", function() {
            n.close();
            var e = a.getPlace();
            e.geometry.viewport ? map.fitBounds(e.geometry.viewport) : (map.setCenter(e.geometry.location), map.setZoom(17)), moveMarker(e.name, e.geometry.location, map), document.getElementsByClassName("latitude")[0].value = e.geometry.location.lat(), document.getElementsByClassName("longitude")[0].value = e.geometry.location.lng()
        })
    }
}

function moveMarker(e, t, o) {
    marker = new google.maps.Marker({
        position: t,
        map: o,
        draggable: !0
    }), marker.setPosition(t), marker.addListener("drag", handleEvent), marker.addListener("dragend", handleEvent)
}

function handleEvent(e) {
    document.getElementsByClassName("latitude")[0].value = e.latLng.lat(), document.getElementsByClassName("longitude")[0].value = e.latLng.lng()
}
$(function() {
     //alert();
     initAutocomplete();
    function e() {
        setTimeout(function() {
           
            console.log("now"), $("#" + district).val(district_id).trigger("change").trigger("onchange")
            
        }, "1000")
    }
    $(".outdore").click(function() {
       (flag = $("#hospitalnursingmaster-outdore").val(), 1 == flag ? $(".showme").css("display", "block") : $(".showme").css("display", "none"))
    }), setTimeout(function() {
        $(".select2-hidden-accessible").each(function(e) {
            id = $(this).attr("id").split("-"), "country_id" == id[1] ? country = $(this).attr("id") : "state_id" == id[1] ? state = $(this).attr("id") : "district_id" == id[1] ? district = $(this).attr("id") : "city_id" == id[1] && (city = $(this).attr("id"))
        }).promise().done(function() {
            "undefined" != typeof country && "undefined" != typeof state && "undefined" != typeof state_id && ($("#" + country).trigger("onchange"), setTimeout(function() {
                $("#" + state).val(state_id).trigger("change"), e()
            }, "1000"))
        }), "undefined" == typeof state_id && ($("#" + country).val("1").trigger("change"), setTimeout(function() {
            $("#" + state).val("1").trigger("change")
        }, "1000"))
    }, "2500")
});
var global_val = 1;
message = !1;