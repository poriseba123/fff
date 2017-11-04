<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Alert;
use app\assets\backend\MainAsset;

MainAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?= $this->context->getProjectFavicon() ?>" rel="shortcut icon" type="image/x-icon"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <script src="http://maps.google.com/maps/api/js?v=3.28&key=AIzaSyCyOuj28fWTVZQT4XBcgWJFLAk4sI54qlM&libraries=places&region=in&language=en&sensor=false"></script>
        <style>
            .pac-container {
                background-color: #FFF;
                z-index: 20;
                position: fixed;
                display: inline-block;
                float: left;
            }
            .modal{
                z-index: 20;   
            }
            .modal-backdrop{
                z-index: 10;        
            }
        </style>
    </head>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-content-white">
        <?php $this->beginBody() ?>
        <?= $this->context->renderPartial('../menu/loader'); ?>
        <div class="page-wrapper">
            <?= $this->context->renderPartial('../menu/header-menu'); ?>
            <div class="clearfix"> </div>
            <div class="page-container">
                <?= $this->context->renderPartial('../menu/left-menu'); ?>
                <div class="page-content-wrapper">
                    <div class="page-content">
                        <?php
                        echo Breadcrumbs::widget([
                            'homeLink' => [
                                'label' => 'Home',
                                'url' => ['dashboard/'],
                                'template' => '<li><i class="icon-home"></i> {link}</li>',
                            ],
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]);


                        if (Yii::$app->getSession()->hasFlash('success')) {
                            echo Alert::widget([
                                'options' => [
                                    'class' => 'alert-success',
                                ],
                                'body' => Yii::$app->getSession()->getFlash('success'),
                            ]);
                        }
                        if (Yii::$app->getSession()->hasFlash('danger')) {
                            echo Alert::widget([
                                'options' => [
                                    'class' => 'alert-danger',
                                ],
                                'body' => Yii::$app->getSession()->getFlash('danger'),
                            ]);
                        }
                        ?>
                        <?= $content ?>
                    </div>
                </div>
            </div>
            <?= $this->context->renderPartial('../menu/footer-menu'); ?>
        </div>
        <?php $this->endBody() ?>
        <script type="text/javascript">
            var full_path = '<?php echo Yii::$app->request->baseUrl; ?>/admin/';
            var base_path = '<?php echo Yii::$app->request->baseUrl; ?>/';
        </script>
    </body>
    <?php $this->endPage() ?>
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog" style="padding-top: 40px;">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add location  in google map</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-2">Status</label>
                            <div class="col-md-7">
                                <input id="searchTextField" class="col-md-12" type="text"> 
                            </div>
                            <a href="javascript:void(0)" align="right" title="Refresh" class="refresh col-md-3"><i class="fa fa-refresh"></i></a>
                        </div>
                        <div class="row"></div>
                        <div class="form-body">
                            <div class="form-group">
                                <div class="col-md-12" id="map_canvas" align="center" style="height: 350px;"></div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>




</html>
<script type="text/javascript">


///////////////////////////////////////////////////google map start//////////////////////////////////////////////////////////
// move the marker to a new position, and center the map on it
//    function update_map(geometry) {
//        map.fitBounds(geometry.viewport)
//        marker.setPosition(geometry.location)
//    }

// fill in the UI elements with new position data
    function update_ui(address, latLng) {
        //$('#gmaps-input-address').autocomplete("close");
        //$('#gmaps-input-address').val(address);
        //$('#gmaps-output-latitude').html(latLng.lat());
        //$('#gmaps-output-longitude').html(latLng.lng());
    }

// Query the Google geocode object
//
// type: 'address' for search by address
//       'latLng'  for search by latLng (reverse lookup)
//
// value: search query
//
// update: should we update the map (center map and position marker)?

//    positionObj = {};
//    marker = '';
//    image = '';
//    map = '';
//    function getLocation() {
//        if (navigator.geolocation) {
//            navigator.geolocation.getCurrentPosition(showPosition);
//        } else {
//            positionObj.lat = 20.5937;
//            positionObj.long = 78.9629;
//        }
//    }
//    function showPosition(position) {
//        positionObj.lat = position.coords.latitude;
//        positionObj.long = position.coords.longitude;
//    }
//    function googlMap(imgName) {
//        /////////////////////////////////////////////////////////////////////////////////
//        // the geocoder object allows us to do latlng lookup based on address
//        geocoder = new google.maps.Geocoder();
//        var lat = positionObj.lat,
//                lng = positionObj.long,
//                latlng = new google.maps.LatLng(lat, lng),
//                image = full_path+'/assets/img/' + imgName;
//        //console.log("lat" + lat);
//        var mapOptions = {
//            center: new google.maps.LatLng(lat, lng),
//            zoom: 13,
//            mapTypeId: google.maps.MapTypeId.ROADMAP
//        },
//                map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions),
//                marker = new google.maps.Marker({
//                    position: latlng,
//                    map: map,
//                    draggable: true,
//                    icon: image
//                });
//        // event triggered when marker is dragged and dropped
//        google.maps.event.addListener(marker, 'dragend', function () {
//            console.log(marker.getPosition().lat());
//            console.log(marker.getPosition().lng());
//            geocode_lookup('latLng', marker.getPosition());
//        });
//        google.maps.event.addListener(marker, 'click', function (event) {
//            //console.log(marker.getPosition().lat());
//            //console.log(marker.getPosition().lng());
//            marker.setPosition(event.latLng)
//            geocode_lookup('latLng', event.latLng);
//        });
//        var input = document.getElementById('searchTextField');
//        var autocomplete = new google.maps.places.Autocomplete(input, {
//            types: ["geocode"]
//        });
//        autocomplete.bindTo('bounds', map);
//        var infowindow = new google.maps.InfoWindow();
//        google.maps.event.addListener(autocomplete, 'place_changed', function () {
//            infowindow.close();
//            var place = autocomplete.getPlace();
//            if (place.geometry.viewport) {
//                map.fitBounds(place.geometry.viewport);
//            } else {
//                map.setCenter(place.geometry.location);
//                map.setZoom(17);
//            }
//
//            moveMarker(place.name, place.geometry.location);
//        });
//        $("input").focusin(function () {
//            $(document).keypress(function (e) {
//                if (e.which == 13) {
//                    selectFirstResult();
//                }
//            });
//        });
//        $("input").focusout(function () {
//            if (!$(".pac-container").is(":focus") && !$(".pac-container").is(":visible"))
//                selectFirstResult();
//        });
//        function selectFirstResult() {
//            infowindow.close();
//            $(".pac-container").hide();
//            var firstResult = $(".pac-container .pac-item:first").text();
//            var geocoder = new google.maps.Geocoder();
//            geocoder.geocode({"address": firstResult}, function (results, status) {
//                if (status == google.maps.GeocoderStatus.OK) {
//                    var lat = results[0].geometry.location.lat(),
//                            lng = results[0].geometry.location.lng(),
//                            placeName = results[0].address_components[0].long_name,
//                            latlng = new google.maps.LatLng(lat, lng);
//                    moveMarker(placeName, latlng);
//                    $("input").val(firstResult);
//                }
//            });
//        }
//        function moveMarker(placeName, latlng) {
//            marker.setIcon(image);
//            marker.setPosition(latlng);
//            infowindow.setContent(placeName);
//            infowindow.open(map, marker);
//            setTimeout(function () {
//                map.setZoom(19);
//                //smoothZoom(map, 20, map.getZoom(), false);
//            }, 500);
//        }
//        setTimeout(function () {
//            map.setZoom(19);
//            //smoothZoom(map, 20, map.getZoom(), false);
//        }, 200);
//        google.maps.event.addListener(map, 'zoom_changed', function () {
//
//            var maptype = map.getMapTypeId();
//            if (map.getMapTypeId() != google.maps.MapTypeId.HYBRID) {
//                map.setMapTypeId(google.maps.MapTypeId.HYBRID)
//                map.setTilt(0); // disable 45 degree imagery
//            }
//        });
//
//    }
///////////////////////////////////////////////////google map end//////////////////////////////////////////////////////////
    function ajaxindicatorstart()
    {
        if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
            jQuery('body').append('<div id="resultLoading" style="display:none"><div><i style="font-size: 46px;color: #F44336;" class="fa fa-spinner fa-spin fa-3x fa-fw" aria-hidden="true"></i></div><div class="bg"></div></div>');
        }

        jQuery('#resultLoading').css({
            'width': '100%',
            'height': '100%',
            'position': 'fixed',
            'z-index': '10000000',
            'top': '0',
            'left': '0',
            'right': '0',
            'bottom': '0',
            'margin': 'auto'
        });
        jQuery('#resultLoading .bg').css({
            'background': '#ffffff',
            'opacity': '0.8',
            'width': '100%',
            'height': '100%',
            'position': 'absolute',
            'top': '0'
        });
        jQuery('#resultLoading>div:first').css({
            'width': '250px',
            'height': '75px',
            'text-align': 'center',
            'position': 'fixed',
            'top': '0',
            'left': '0',
            'right': '0',
            'bottom': '0',
            'margin': 'auto',
            'font-size': '16px',
            'z-index': '10',
            'color': '#ffffff'

        });
        jQuery('#resultLoading .bg').height('100%');
        jQuery('#resultLoading').fadeIn(300);
        jQuery('body').css('cursor', 'wait');
    }

    function ajaxindicatorstop()
    {
        jQuery('#resultLoading .bg').height('100%');
        jQuery('#resultLoading').fadeOut(300);
        jQuery('body').css('cursor', 'default');
    }
</script>
<script src="http://maps.google.com/maps/api/js?v=3.28&key=AIzaSyCyOuj28fWTVZQT4XBcgWJFLAk4sI54qlM&libraries=places&region=in&language=en&callback=initAutocomplete"></script>