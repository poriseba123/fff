$(document).ready(function () {
    var location_a_name = $('#TripLocation_location_a_name').val()
    var location_b_name = $('#TripLocation_location_b_name').val()
    var geocoder = new google.maps.Geocoder();
    if (geocoder) {
        geocoder.geocode({
            'address': location_a_name,
            componentRestrictions: {
                country: 'co',
            }
        }, function (place) {
            place = place[0];
            $('#TripLocation_location_a_lat').val(place.geometry.location.lat());
            $('#TripLocation_location_a_long').val(place.geometry.location.lng());
        });
        geocoder.geocode({
            'address': location_b_name,
            componentRestrictions: {
                country: 'co',
            }
        }, function (place) {
            place = place[0];
            $('#TripLocation_location_b_lat').val(place.geometry.location.lat());
            $('#TripLocation_location_b_long').val(place.geometry.location.lng());
            var geocoder;
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());
            geocoder.geocode({'latLng': latlng}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        var add = results[0].formatted_address;
                        var value = add.split(",");
                        count = value.length;
                        var city = '';
                        if (count == 4) {
                            city = value[count - 3];
                        } else {
                            city = value[count - 2];
                        }
                        $('#TripLocation_location_b_city').val(city);
                        searchTrip();
                    } else {
                        searchTrip();
                    }
                } else {
                    searchTrip();
                }
            });
        });
    } else {
        searchTrip();
    }
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        startDate: new Date(),
        language: 'es'
    });
});
$('#filter-trip-form').on('submit', function (event) {
    event.preventDefault();
    $('#TripLocation_page_no').val('1');
    $('#TripLocation_offset').val('0');
    var location_a_name = $('#TripLocation_location_a_name').val()
    var location_b_name = $('#TripLocation_location_b_name').val()
    var geocoder = new google.maps.Geocoder();
    if (geocoder) {
        geocoder.geocode({
            'address': location_a_name,
            componentRestrictions: {
                country: 'co',
            }
        }, function (place) {
            place = place[0];
            $('#TripLocation_location_a_lat').val(place.geometry.location.lat());
            $('#TripLocation_location_a_long').val(place.geometry.location.lng());
        });
        geocoder.geocode({
            'address': location_b_name,
            componentRestrictions: {
                country: 'co',
            }
        }, function (place) {
            place = place[0];
            $('#TripLocation_location_b_lat').val(place.geometry.location.lat());
            $('#TripLocation_location_b_long').val(place.geometry.location.lng());
            var geocoder;
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());
            geocoder.geocode({'latLng': latlng}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        var add = results[0].formatted_address;
                        var value = add.split(",");
                        count = value.length;
                        var city = '';
                        if (count == 4) {
                            city = value[count - 3];
                        } else {
                            city = value[count - 2];
                        }
                        $('#TripLocation_location_b_city').val(city);
                        searchTrip();
                    } else {
                        searchTrip();
                    }
                } else {
                    searchTrip();
                }
            });
        });
    } else {
        searcgTrip();
    }
});
function searchTrip() {
    loader_start();
    var formData = $('#filter-trip-form').serialize();
    var url = $('#filter-trip-form').attr('action');
    $.post(url, formData, function (data) {
        if (data.res == 1) {
            window.history.pushState('obj', 'newtitle', data.url);
            $('#trip-listing').html(data.html);
        }
        loader_stop();
    }, 'json');
}
function setPageNo(obj) {
    var page_no = $(obj).html();
    var offset = parseInt(page_no) - 1;
    $('#TripLocation_page_no').val(page_no);
    $('#TripLocation_offset').val(offset);
    var location_a_name = $('#TripLocation_location_a_name').val()
    var location_b_name = $('#TripLocation_location_b_name').val()
    var geocoder = new google.maps.Geocoder();
    if (geocoder) {
        geocoder.geocode({
            'address': location_a_name,
            componentRestrictions: {
                country: 'co',
            }
        }, function (place) {
            place = place[0];
            $('#TripLocation_location_a_lat').val(place.geometry.location.lat());
            $('#TripLocation_location_a_long').val(place.geometry.location.lng());
        });
        geocoder.geocode({
            'address': location_b_name,
            componentRestrictions: {
                country: 'co',
            }
        }, function (place) {
            place = place[0];
            $('#TripLocation_location_b_lat').val(place.geometry.location.lat());
            $('#TripLocation_location_b_long').val(place.geometry.location.lng());
            var geocoder;
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());
            geocoder.geocode({'latLng': latlng}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        var add = results[0].formatted_address;
                        var value = add.split(",");
                        count = value.length;
                        var city = '';
                        if (count == 4) {
                            city = value[count - 3];
                        } else {
                            city = value[count - 2];
                        }
                        $('#TripLocation_location_b_city').val(city);
                        searchTrip();
                    } else {
                        searchTrip();
                    }
                } else {
                    searchTrip();
                }
            });
        });
    } else {
        searchTrip();
    }
}
function codeAddress(id) {
    var input = document.getElementById(id);
    var options = {
        types: ['(cities)'],
        componentRestrictions: {country: 'CO'}//Colombia only
    };
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.addListener('place_changed', function () {
        var place = autocomplete.getPlace();
        $('#' + id + '_lat').val(place.geometry['location'].lat());
        $('#' + id + '_long').val(place.geometry['location'].lng());
    });
}