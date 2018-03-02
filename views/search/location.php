<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\ArrayHelper;

//echo "<pre>";
//print_r($all_data['result']);
?>

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 page-sideabr">
                <aside>
                    <div class="inner-box">
                        <div class="user-panel-sidebar">
                            <div class="collapse-box">
                                <h5 class="collapset-title no-border">Search</h5>
                                <div  id="myclassified" class="table-search">
                                    <div class="form-group">

                                        <div class="col-md-12 col-sm-12 col-xs-12 searchpan" style="padding: 0px;">
                                            <input class="form-control" id="filter" type="text">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="collapse-box">
                                <h5 class="collapset-title no-border">Transportation <a aria-expanded="true" class="pull-right" data-toggle="collapse" href="#myads"><i class="fa fa-angle-down"></i></a></h5>
                                <div aria-expanded="true" id="myads" class="panel-collapse collapse in">
                                    <ul class="acc-list">
                                        <li>
                                            <a href="javascript:void(0);">
                                                <div class="row">
                                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                                        <div class="checkbox" style="margin-top:0px !important;">
                                                            <label>
                                                                <input type="checkbox" class="customcheck" value="DRIVING" id="1">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                                        <i class="fa fa-car fa-fw"></i> Driving<span class="badge"></span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <div class="row">
                                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                                        <div class="checkbox" style="margin-top:0px !important;">
                                                            <label>
                                                                <input type="checkbox" class="customcheck" value="WALKING" id="2">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                                        <i class="fa fa-road fa-fw"></i>Walking<span class="badge"></span>
                                                    </div>
                                                </div>
                                            </a>

                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <div class="row">
                                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                                        <div class="checkbox" style="margin-top:0px !important;">
                                                            <label>
                                                                <input type="checkbox" class="customcheck" value="BICYCLING" id="3">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                                        <i class="fa fa-bicycle fa-fw"></i> Bicycle<span class="badge"></span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <div class="row">
                                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                                        <div class="checkbox" style="margin-top:0px !important;">
                                                            <label>
                                                                <input type="checkbox" class="customcheck" value="TRANSIT" id="4">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                                        <i class="fa fa-bus fa-fwcolor-3"></i> Transit <span class="badge"></span>
                                                    </div>
                                                </div>
                                            </a>

                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="collapse-box">

                                <div aria-expanded="true" id="directions" class="panel-collapse collapse in">

<!--                                    <button class="btn btn-common btn-search btn-block"><strong>Search</strong></button>-->

                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="col-sm-8 page-content">
                <div class="inner-box">
                    <h2 class="title-2"><i class="fa fa-globe fa-spin fa-1x fa-fw"></i>service map view</h2>
                    <div class="table-responsive">
                        <div class="table-action">
                            <div class="checkbox">
                                <!--                                <label for="checkAll">
                                                                    <input id="checkAll" onclick="checkAll(this)" type="checkbox">
                                                                    Select: All 
                                                                </label>-->
                            </div>
                            <!--                            <div class="table-search pull-right col-xs-7">
                                                           
                                                        </div>-->
                        </div>
                        <!----<table class="table table-striped table-bordered add-manage-table">--->
                        <div class="table table-striped table-bordered add-manage-table" id="map_canvas" style="height:500px;"></div>

                    </div>               
                </div>
            </div>
        </div>  
    </div>      
</div>
<script>
    $(document).ready(function () {

        global_markers = [];
        destilat = "<?= (isset($all_data['result']['latitude']) && $all_data['result']['latitude'] != '') ? $all_data['result']['latitude'] : 20.5937; ?>";
        destilong = "<?= (isset($all_data['result']['longitude']) && $all_data['result']['longitude'] != '') ? $all_data['result']['longitude'] : 20.5937; ?>";
        markers = [[<?= (isset($all_data['result']['latitude']) && $all_data['result']['latitude'] != '') ? $all_data['result']['latitude'] : 20.5937; ?>, <?= (isset($all_data['result']['longitude']) && $all_data['result']['longitude'] != '') ? $all_data['result']['longitude'] : 78.9629; ?>,
<?= (isset($all_data['result']['address']) && $all_data['result']['name'] != '') ? "'" . preg_replace('/\s+/', '', $all_data['result']['name'] . '<br>' . $all_data['result']['address']) . "'" : "'Not Set'"; ?>]];
        directionsDisplay = new google.maps.DirectionsRenderer({draggable: true});
        directionsService = new google.maps.DirectionsService();
        infowindow = new google.maps.InfoWindow({});
        map = null;
        myOptions = {
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            center: new google.maps.LatLng(destilat, destilong)
        };
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById("directions"));
        addMarkers();
        $(".customcheck").on("click", function () {
            id = $(this).attr("id");
            $(".customcheck").each(function () {
                id2 = $(this).attr("id");
                if (id != id2) {
                    $(this).attr('checked', false);
                }

            })
            mode = $("#" + id).val();
            if (typeof latus === "undefined" && typeof longus === "undefined") {
                $.toast({
                    heading: 'Information',
                    position: 'top-center',
                    showHideTransition: 'slide',
                    text: 'Please Enter Start Location.',
                    icon: 'info'
                })
                $("#filter").focus();

            } else {
                calcRoute(latus, longus, mode);
            }

        })
        $("#routeClear").on("click", function () {
            directionsDisplay.setDirections({routes: []});
        });

    });


    function calcRoute(lat, long, mode) {

        request = {
            origin: new google.maps.LatLng(lat, long),
            destination: new google.maps.LatLng(destilat, destilong),
            travelMode: google.maps.TravelMode[mode]
        };
        directionsService.route(request, function (response, status) {

            if (status == google.maps.DirectionsStatus.OK) {
                setTimeout(function () {
                    setMapOnAll(null);
                    directionsDisplay.setDirections(response);
                }, 100);

            }
        });
    }
    function initAutocomplete() {

        ac = new google.maps.places.Autocomplete(
                (document.getElementById('filter')), {
            types: ['geocode']
        });

        ac.addListener('place_changed', function () {

            place = ac.getPlace();

            if (place.geometry) {
                latus = place.geometry.location.lat();
                longus = place.geometry.location.lng();
                $(".customcheck").each(function () {
                    $(this).attr('checked', false);
                });
                // $('#4').prop('checked', true);
                calcRoute(latus, longus, 'TRANSIT');
                $('#4').trigger('click');
                $('#4').prop('checked', true);
            } else {
                $.toast({
                    heading: 'Information',
                    position: 'top-center',
                    showHideTransition: 'slide',
                    text: 'Sorry! Your starting address is not listed in google.',
                    icon: 'info'
                })
            }


        });
    }

    // Sets the map on all markers in the array.
    function setMapOnAll(map) {
        for (var i = 0; i < global_markers.length; i++) {
            global_markers[i].setMap(map);
        }
    }
    function addMarkers() {
        //alert();
        for (var i = 0; i < markers.length; i++) {
            // obtain the attribues of each marker
            var lat = parseFloat(markers[i][0]);
            var lng = parseFloat(markers[i][1]);
            var trailhead_name = markers[i][2];

            var myLatlng = new google.maps.LatLng(lat, lng);

            var contentString = "<html><body><div class='col-sm-7 col-md-7 col-xs-7'><p>" + trailhead_name + "</p></div></div></div></body></html>";

            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                animation: google.maps.Animation.DROP,
                title: "Coordinates: " + lat + " , " + lng + " | Trailhead name: " + trailhead_name
            });

            marker['infowindow'] = contentString;

            global_markers[i] = marker;
            map.setCenter(marker.getPosition());

            google.maps.event.addListener(global_markers[i], 'click', function () {
                marker.setAnimation(google.maps.Animation.BOUNCE);
                infowindow.setContent(this['infowindow']);
                infowindow.open(map, this);
            });
        }
    }

//initialize();

</script>