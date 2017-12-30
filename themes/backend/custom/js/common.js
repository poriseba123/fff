   $(function () {
        setTimeout(function () {
            $(".select2-hidden-accessible").each(function (e) {
                //alert(e);
                if (e == 0) {
                    country = $(this).attr('id');
                } else if (e == 1) {
                    state = $(this).attr('id');
                } else if (e == 2) {
                    district = $(this).attr('id');
                } else if (e == 3) {
                    city = $(this).attr('id');
                }
            }).promise().done(function () {
                $('#' + country).trigger('onchange');
                setTimeout(function () {
                    $('#' + state).val(state_id).trigger("change"), fireagain()
                }, '1000');
            })
        }, '2500');
        $('.timepicker').datetimepicker({
            format: 'LT'
        });
        $('.timepicker').datetimepicker({
            format: 'LT'
        });
        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });

        function fireagain() {
            setTimeout(function () {
                console.log('now'), $('#' + district).val(district_id).trigger("change").trigger('onchange');
            }, '1000');
        }


    });
    var global_val = 1;
    function addPhone(count) {
        if (global_val < count) {
            global_val = count;
        }
        $('.main_contact_div').append('<div><div class="row row_' + global_val + '">' +
                '<div class="col-md-8">' +
                '<input type="text" class="form-control" name="contact_no[]" value="">' +
                '</div>' +
                '<div class="col-md-4">' +
                '<div class="btn-group btn-group-solid">' +
                '<button type="button" class="btn btn-danger" style="font-size:17px;" onclick="removeRow(' + global_val + ')">X</button>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="help-block"></div>' +
                '</div>'
                );
        global_val++;
    }
    function removeRow(id) {
        $('.row_' + id).remove();
    }
/////////////////////////////map script start/////////////////////////// 
    message = false;
    function geocodeLatLng(currentlat, currentlong) {

        var latlng = {lat: parseFloat(currentlat), lng: parseFloat(currentlong)};
        //alert(geocoder);
        geocoder.geocode({'location': latlng}, function (results, status) {
            //alert(status);
            if (status === 'OK') {
                if (results[0]) {
                    //alert(results[0].formatted_address);
                    document.getElementsByClassName('pac-input')[0].value = results[0].formatted_address;
                    //var mylatlng = new google.maps.LatLng(currentlat, currentlong);
                    // moveMarker(results[0].formatted_address, mylatlng, map);
                    marker.setPosition(results[0].geometry.location);
                    map.setCenter(results[0].geometry.location);
                    map.setZoom(17);

                } else {
                    window.alert('No results found');
                }
            } else {
                window.alert('Geocoder failed due to: ' + status);
            }
        });
    }
    function showPosition(position) {
        currentlat = position.coords.latitude;
        currentlong = position.coords.longitude;
        document.getElementsByClassName('latitude')[0].value = currentlat;
        document.getElementsByClassName('longitude')[0].value = currentlong;
        geocodeLatLng(currentlat, currentlong);


    }
    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                message = "User denied the request for Geolocation."
                break;
            case error.POSITION_UNAVAILABLE:
                message = "Location information is unavailable."
                break;
            case error.TIMEOUT:
                message = "The request to get user location timed out."
                break;
            case error.UNKNOWN_ERROR:
                message = "An unknown error occurred."
                break;
        }
    }
    function getLocation() {
        if (navigator.geolocation) {
            //console.log(navigator.geolocation);
            navigator.geolocation.getCurrentPosition(showPosition, showError);

        } else {
            message = "Geolocation is not supported by this browser.";
        }
        if (message) {
            alert(message);
        }
    }

    function initAutocomplete() {
        var myLatlng = new google.maps.LatLng(currentlat, currentlong);
        var myOptions = {
            zoom: 5,
            center: myLatlng,
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        geocoder = new google.maps.Geocoder;
        map = new google.maps.Map(document.getElementsByClassName("map")[0], myOptions),
                marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    draggable: true,
                });
        google.maps.event.addListener(marker, 'dragend', function () {
            document.getElementsByClassName('latitude')[0].value = marker.getPosition().lat();
            document.getElementsByClassName('longitude')[0].value = marker.getPosition().lng();
        });


        // Create the search box and link it to the UI element.
        var input = document.getElementsByClassName('pac-input')[0];
        var autocomplete = new google.maps.places.Autocomplete(input, {
            types: ["geocode"]
        });
        autocomplete.bindTo('bounds', map);
        var infowindow = new google.maps.InfoWindow();
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            infowindow.close();
            var place = autocomplete.getPlace();
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            moveMarker(place.name, place.geometry.location, map);
            document.getElementsByClassName('latitude')[0].value = place.geometry.location.lat();
            document.getElementsByClassName('longitude')[0].value = place.geometry.location.lng();
        });
    }
    function moveMarker(placeName, latlng, map) {
        marker = new google.maps.Marker({
            position: latlng,
            map: map,
            draggable: true
        });
        marker.setPosition(latlng);

        marker.addListener('drag', handleEvent);
        marker.addListener('dragend', handleEvent);
    }
    function handleEvent(event) {
        document.getElementsByClassName('latitude')[0].value = event.latLng.lat();
        document.getElementsByClassName('longitude')[0].value = event.latLng.lng();
    }
/////////////////////////////map script end/////////////////////////// 