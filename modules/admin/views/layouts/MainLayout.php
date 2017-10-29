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
        <script src="http://maps.google.com/maps/api/js?key=AIzaSyCyOuj28fWTVZQT4XBcgWJFLAk4sI54qlM&libraries=places&region=uk&language=en&sensor=false"></script>
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
                            <label class="control-label col-md-3">Status</label>
                            <div class="col-md-6">
                                <input id="searchTextField" type="text" size="50"> 
                            </div>
                        </div>
                        <div class="row"></div>
                        <div class="form-body">
                            <div class="form-group">
                                <div class="col-md-12" id="map_canvas" align="center" style="height: 300px;"></div>
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
    var geocoder;
    var map;
    var marker;

// initialise the google maps objects, and add listeners
    function gmaps_init() {

        // center of the universe
        var latlng = new google.maps.LatLng(51.751724, -1.255284);

        var options = {
            zoom: 4,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        // create our map object
        map = new google.maps.Map(document.getElementById("gmaps-canvas"), options);

        // the geocoder object allows us to do latlng lookup based on address
        geocoder = new google.maps.Geocoder();

        // the marker shows us the position of the latest address
        marker = new google.maps.Marker({
            map: map,
            draggable: true
        });

        // event triggered when marker is dragged and dropped
        google.maps.event.addListener(marker, 'dragend', function () {
            geocode_lookup('latLng', marker.getPosition());
        });

        // event triggered when map is clicked
        google.maps.event.addListener(map, 'click', function (event) {
            marker.setPosition(event.latLng)
            geocode_lookup('latLng', event.latLng);
        });

        $('#gmaps-error').hide();
    }

// move the marker to a new position, and center the map on it
    function update_map(geometry) {
        map.fitBounds(geometry.viewport)
        marker.setPosition(geometry.location)
    }

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
    function geocode_lookup(type, value, update) {
        // default value: update = false
        update = typeof update !== 'undefined' ? update : false;

        request = {};
        request[type] = value;

        geocoder.geocode(request, function (results, status) {
            $('#gmaps-error').html('');
            $('#gmaps-error').hide();
            if (status == google.maps.GeocoderStatus.OK) {
                // Google geocoding has succeeded!
                if (results[0]) {
                    // Always update the UI elements with new location data
                    update_ui(results[0].formatted_address,
                            results[0].geometry.location)

                    // Only update the map (position marker and center map) if requested
                    if (update) {
                        update_map(results[0].geometry)
                    }
                } else {
                    // Geocoder status ok but no results!?
                    $('#gmaps-error').html("Sorry, something went wrong. Try again!");
                    $('#gmaps-error').show();
                }
            } else {
                // Google Geocoding has failed. Two common reasons:
                //   * Address not recognised (e.g. search for 'zxxzcxczxcx')
                //   * Location doesn't map to address (e.g. click in middle of Atlantic)

                if (type == 'address') {
                    // User has typed in an address which we can't geocode to a location
                    $('#gmaps-error').html("Sorry! We couldn't find " + value + ". Try a different search term, or click the map.");
                    $('#gmaps-error').show();
                } else {
                    // User has clicked or dragged marker to somewhere that Google can't do a reverse lookup for
                    // In this case we display a warning, clear the address box, but fill in LatLng
                    $('#gmaps-error').html("Woah... that's pretty remote! You're going to have to manually enter a place name.");
                    $('#gmaps-error').show();
                    update_ui('', value)
                }
            }
            ;
        });
    }
    ;

// initialise the jqueryUI autocomplete element
    function autocomplete_init() {
        $("#gmaps-input-address").autocomplete({

            // source is the list of input options shown in the autocomplete dropdown.
            // see documentation: http://jqueryui.com/demos/autocomplete/
            source: function (request, response) {

                // the geocode method takes an address or LatLng to search for
                // and a callback function which should process the results into
                // a format accepted by jqueryUI autocomplete
                geocoder.geocode({'address': request.term}, function (results, status) {
                    response($.map(results, function (item) {
                        return {
                            label: item.formatted_address, // appears in dropdown box
                            value: item.formatted_address, // inserted into input element when selected
                            geocode: item                  // all geocode data: used in select callback event
                        }
                    }));
                })
            },

            // event triggered when drop-down option selected
            select: function (event, ui) {
                update_ui(ui.item.value, ui.item.geocode.geometry.location)
                update_map(ui.item.geocode.geometry)
            }
        });

        // triggered when user presses a key in the address box
        $("#gmaps-input-address").bind('keydown', function (event) {
            if (event.keyCode == 13) {
                geocode_lookup('address', $('#gmaps-input-address').val(), true);

                // ensures dropdown disappears when enter is pressed
                $('#gmaps-input-address').autocomplete("disable")
            } else {
                // re-enable if previously disabled above
                $('#gmaps-input-address').autocomplete("enable")
            }
        });
    }
    ; // autocomplete_init

    $(document).ready(function () {
        if ($('#gmaps-canvas').length) {
            gmaps_init();
            autocomplete_init();
        }
        ;
    });



/////////////////////////////////////////////////////////////////////////////////////////////////////////////


    $(document).ready(function () {
        $('.google_map').on('click', function () {
            //alert();
            $('#myModal').modal('show');
        });
        /////////////////////////////////////////////////////////////////////////////////
        // the geocoder object allows us to do latlng lookup based on address
        geocoder = new google.maps.Geocoder();
        var lat = -33.8688,
                lng = 151.2195,
                latlng = new google.maps.LatLng(lat, lng),
                image = 'http://localhost/poriseba/assets/img/ambulance.png';

        var mapOptions = {
            center: new google.maps.LatLng(lat, lng),
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        },
                map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions),
                marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    draggable: true,
                    icon: image
                });
        // event triggered when marker is dragged and dropped
        google.maps.event.addListener(marker, 'dragend', function () {
            console.log(marker.getPosition().lat());
            console.log(marker.getPosition().lng());
            geocode_lookup('latLng', marker.getPosition());
        });
        google.maps.event.addListener(marker, 'click', function (event) {
            console.log(marker.getPosition().lat());
            console.log(marker.getPosition().lng());
            marker.setPosition(event.latLng)
            geocode_lookup('latLng', event.latLng);
        });

        var input = document.getElementById('searchTextField');
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

            moveMarker(place.name, place.geometry.location);
        });

        $("input").focusin(function () {
            $(document).keypress(function (e) {
                if (e.which == 13) {
                    selectFirstResult();
                }
            });
        });
        $("input").focusout(function () {
            if (!$(".pac-container").is(":focus") && !$(".pac-container").is(":visible"))
                selectFirstResult();
        });

        function selectFirstResult() {
            infowindow.close();
            $(".pac-container").hide();
            var firstResult = $(".pac-container .pac-item:first").text();

            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({"address": firstResult}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var lat = results[0].geometry.location.lat(),
                            lng = results[0].geometry.location.lng(),
                            placeName = results[0].address_components[0].long_name,
                            latlng = new google.maps.LatLng(lat, lng);

                    moveMarker(placeName, latlng);
                    $("input").val(firstResult);
                }
            });
        }

        function moveMarker(placeName, latlng) {
            marker.setIcon(image);
            marker.setPosition(latlng);
            infowindow.setContent(placeName);
            infowindow.open(map, marker);
        }




    })



    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });


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
