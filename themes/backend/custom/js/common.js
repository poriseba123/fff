function addPhone(e){e>global_val&&(global_val=e),$(".main_contact_div").append('<div><div class="row row_'+global_val+'"><div class="col-md-8"><input type="text" class="form-control" name="contact_no[]" value=""></div><div class="col-md-4"><div class="btn-group btn-group-solid"><button type="button" class="btn btn-danger" style="font-size:17px;" onclick="removeRow('+global_val+')">X</button></div></div></div><div class="help-block"></div></div>'),global_val++}function removeRow(e){$(".row_"+e).remove()}function geocodeLatLng(e,t){var o={lat:parseFloat(e),lng:parseFloat(t)};geocoder.geocode({location:o},function(e,t){"OK"===t?e[0]?(document.getElementsByClassName("pac-input")[0].value=e[0].formatted_address,marker.setPosition(e[0].geometry.location),map.setCenter(e[0].geometry.location),map.setZoom(17)):window.alert("No results found"):window.alert("Geocoder failed due to: "+t)})}function showPosition(e){currentlat=e.coords.latitude,currentlong=e.coords.longitude,document.getElementsByClassName("latitude")[0].value=currentlat,document.getElementsByClassName("longitude")[0].value=currentlong,geocodeLatLng(currentlat,currentlong)}function showError(e){switch(e.code){case e.PERMISSION_DENIED:message="User denied the request for Geolocation.";break;case e.POSITION_UNAVAILABLE:message="Location information is unavailable.";break;case e.TIMEOUT:message="The request to get user location timed out.";break;case e.UNKNOWN_ERROR:message="An unknown error occurred."}}function getLocation(){navigator.geolocation?navigator.geolocation.getCurrentPosition(showPosition,showError):message="Geolocation is not supported by this browser.",message&&alert(message)}function initAutocomplete(){if("undefined"!=typeof currentlat&&"undefined"!=typeof currentlong){var e=new google.maps.LatLng(currentlat,currentlong),t={zoom:5,center:e,scrollwheel:!1,mapTypeId:google.maps.MapTypeId.ROADMAP};geocoder=new google.maps.Geocoder,map=new google.maps.Map(document.getElementsByClassName("map")[0],t),marker=new google.maps.Marker({position:e,map:map,draggable:!0}),google.maps.event.addListener(marker,"dragend",function(){document.getElementsByClassName("latitude")[0].value=marker.getPosition().lat(),document.getElementsByClassName("longitude")[0].value=marker.getPosition().lng()});var o=document.getElementsByClassName("pac-input")[0],a=new google.maps.places.Autocomplete(o,{types:["geocode"]});a.bindTo("bounds",map);var n=new google.maps.InfoWindow;google.maps.event.addListener(a,"place_changed",function(){n.close();var e=a.getPlace();e.geometry.viewport?map.fitBounds(e.geometry.viewport):(map.setCenter(e.geometry.location),map.setZoom(17)),moveMarker(e.name,e.geometry.location,map),document.getElementsByClassName("latitude")[0].value=e.geometry.location.lat(),document.getElementsByClassName("longitude")[0].value=e.geometry.location.lng()})}}function moveMarker(e,t,o){marker=new google.maps.Marker({position:t,map:o,draggable:!0}),marker.setPosition(t),marker.addListener("drag",handleEvent),marker.addListener("dragend",handleEvent)}function handleEvent(e){document.getElementsByClassName("latitude")[0].value=e.latLng.lat(),document.getElementsByClassName("longitude")[0].value=e.latLng.lng()}$(function(){function e(){setTimeout(function(){console.log("now"),$("#"+district).val(district_id).trigger("change").trigger("onchange")},"1000")}$("input:radio").click(function(){"HospitalNursingMaster[outdore]"==$(this).attr("name")&&(flag=$(this).val(),1==flag?$(".showme").css("display","block"):$(".showme").css("display","none"))}),setTimeout(function(){$(".select2-hidden-accessible").each(function(e){id=$(this).attr("id").split("-"),"country_id"==id[1]?country=$(this).attr("id"):"state_id"==id[1]?state=$(this).attr("id"):"district_id"==id[1]?district=$(this).attr("id"):"city_id"==id[1]&&(city=$(this).attr("id"))}).promise().done(function(){"undefined"!=typeof country&&"undefined"!=typeof state&&"undefined"!=typeof state_id&&($("#"+country).trigger("onchange"),setTimeout(function(){$("#"+state).val(state_id).trigger("change"),e()},"1000"))}),"undefined"==typeof state_id&&($("#"+country).val("1").trigger("change"),setTimeout(function(){$("#"+state).val("1").trigger("change")},"1000"))},"2500"),$(".timepicker").datetimepicker({format:"LT"}),$(".timepicker").datetimepicker({format:"LT"}),$(".datepicker").datepicker({changeMonth:!0,changeYear:!0,dateFormat:"yy-mm-dd"})});var global_val=1;message=!1;