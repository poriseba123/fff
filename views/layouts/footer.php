<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Settings;

$google_map_key = Settings::find()->where(['slug' => 'google_map_key'])->one();
$data_arr = \app\models\Settings::find()->where(['options' => '1'])->all();
$landing_page = \app\models\Landingpage::find()->where(['id' => '1'])->all();
?>
<!-- Footer Section Start -->
<footer>
    <!-- Footer Area Start -->
    <section class="footer-Content">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-delay="0">
                    <div class="widget">
                        <h3 class="block-title">About us</h3>
                        <div class="textwidget">
                            <p><?= isset($landing_page[0]->about_us) ? ucfirst($landing_page[0]->about_us) : ''; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-delay="0.5">
                    <div class="widget">
                        <h3 class="block-title">Useful Links</h3>
                        <ul class="menu">
                            <li><a href="http://poriseba.com">Home</a></li>
                            <li><a href="http://poriseba.com/site/faq">FAQ</a></li>
                            <li><a href="http://poriseba.com/aboutus">About</a></li>
                            <li><a href="http://poriseba.com/contactus">Contact</a></li>
                            <!--                            <li><a href="#">Terms of Use</a></li>
                                                        <li><a href="#">Privacy Policy</a></li>-->
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-delay="1s">
                    <div class="widget">
                        <h3 class="block-title">Terms of Use</h3>
                        <div class="textwidget">
                            <p><?= isset($landing_page[0]->tearmsof_use) ? ucfirst($landing_page[0]->tearmsof_use) : ''; ?></p>
                        </div>
                    </div>
                    <!--                    <div class="widget">
                                            <h3 class="block-title">Latest Tweets</h3>
                                            <div class="twitter-content clearfix">
                                                <ul class="twitter-list">
                                                    <li class="clearfix">
                                                        <span>
                                                            Platform to Download and Submit #Bootstrap Templates via @ProductHunt @GrayGrids
                                                            <a href="#">http://t.co/cLo2w7rWOx</a>
                                                        </span>
                                                    </li>
                                                    <li class="clearfix">
                                                        <span>
                                                            Introducing Bootstrap 4 Features: What’s new, What’s gone!
                                                            <a href="#">http://t.co/cLo2w7rWOx</a>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>-->
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-delay="1.5s">
                    <div class="widget">
                        <h3 class="block-title">Privacy policy</h3>
                        <div class="textwidget">
                            <p><?= isset($landing_page[0]->privacy_policy) ? ucfirst($landing_page[0]->privacy_policy) : ''; ?></p>
                        </div>
                    </div>
                    <!--                    <div class="widget">
                                            <h3 class="block-title">Random Ads</h3>
                                            <ul class="featured-list">
                                                <li>
                                                    <img alt="" src="assets/img/featured/img1.jpg">
                                                    <div class="hover">
                                                        <a href="#"><span>$49</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <img alt="" src="assets/img/featured/img2.jpg">
                                                    <div class="hover">
                                                        <a href="#"><span>$49</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <img alt="" src="assets/img/featured/img3.jpg">
                                                    <div class="hover">
                                                        <a href="#"><span>$49</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <img alt="" src="assets/img/featured/img4.jpg">
                                                    <div class="hover">
                                                        <a href="#"><span>$49</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <img alt="" src="assets/img/featured/img5.jpg">
                                                    <div class="hover">
                                                        <a href="#"><span>$49</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <img alt="" src="assets/img/featured/img6.jpg">
                                                    <div class="hover">
                                                        <a href="#"><span>$49</span></a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>-->
                </div>
            </div>
        </div>
    </section>
    <!-- Footer area End -->
    <!-- Copyright Start  -->
    <div id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="site-info pull-left">
                        <p>All copyrights reserved &copy; poriseba.com <?= date('Y') ?></p>
                    </div>
                    <div class="bottom-social-icons social-icon pull-right">  
                        <?php
                        if (!empty($data_arr)) {
                            foreach ($data_arr as $key => $value) {
                                $class = explode('-', $value->slug);
                                ?>
                                <a class="<?= isset($value->slug) ? $class[1] : ''; ?>" target="_blank" href="<?= isset($value->value) ? $value->value : ''; ?>"><i class="fa <?= isset($value->slug) ? $value->slug : ''; ?>"></i></a> 
                                <?php
                            }
                        }
                        ?>
<!--                        <a class="facebook" target="_blank" href="javascript:;"><i class="fa fa-facebook"></i></a> 
<a class="twitter" target="_blank" href="javascript:;"><i class="fa fa-twitter"></i></a>
<a class="youtube" target="_blank" href="javascript:;"><i class="fa fa-youtube"></i></a>
<a class="google-plus" target="_blank" href="javascript:;"><i class="fa fa-google-plus"></i></a>
<a class="linkedin" target="_blank" href="javascript:;"><i class="fa fa-linkedin"></i></a>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->
</footer>
<!-- Footer Section End -->  
<!-- Go To Top Link -->
<a href="#" class="back-to-top">
    <i class="fa fa-angle-up"></i>
</a>
<!-- Start Loader -->
<div id="loader">
    <div class="sk-folding-cube">
        <div class="sk-cube1 sk-cube"></div>
        <div class="sk-cube2 sk-cube"></div>
        <div class="sk-cube4 sk-cube"></div>
        <div class="sk-cube3 sk-cube"></div>
    </div>
</div>

<!-- Modal content-->
<div class="modal fade" id="myModal" role="dialog" style="Z-index:9999;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
                <div class="page-login-form box login-div">
                    <h3>
                        Login
                    </h3>
                    <button class="btn btn-common log-btn"><i class="fa fa-google-plus-square fa-2x" aria-hidden="true"></i></button>
                    <button class="btn btn-facebook log-btn"><i class="fa fa-facebook fa-2x" aria-hidden="true"></i></button>
                    <form role="form" class="login-form">
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="icon fa fa-user"></i>
                                <input type="text" id="sender-emailrrrr" class="form-control" name="email" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="icon fa fa-unlock-alt"></i>
                                <input type="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="rememberlogin" name="rememberme" value="forever" style="float: left;">
                            <label for="rememberlogin">Remember me</label>
                        </div>
                        <button class="btn btn-common log-btn">Submit</button>
                    </form>
                    <ul class="form-links">
                        <li class="pull-left"><a href="javascript:void(0)" onclick="signup();">Don't have an account?</a></li>
                        <li class="pull-right forgot"><a href="javascript:void(0);" >Lost your password?</a></li>
                    </ul>
                </div>
                <div class="page-login-form box forgot-div" style="display: none;">
                    <h3>
                        Forgot Password
                    </h3>
                    <form role="form" class="login-form">
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="icon fa fa-user"></i>
                                <input type="text" id="sender-emailss" class="form-control" name="email" placeholder="Email">
                            </div>
                        </div>
                        <button class="btn btn-common log-btn">Send me my Password</button>
                    </form>
                    <ul class="form-links">
                        <li class="pull-left"><a href="javascript:void(0)"onclick="signup();">Don't have an account?</a></li>
                        <li class="pull-right back-login"><a href="javascript:void(0);">Back to Login</a></li>
                    </ul>
                </div>
                <div class="page-login-form box" id="registerform" style="display:none;">
                    <h3>
                        Register
                    </h3>
                    <form role="form" class="login-form">
                        <div class="form-group">
                            <select class=" form-control" name="registeredas">
                                <option value="0">Registered as</option>
                                <option value="1">Doctor</option>
                                <option value="2"> User</option>
                                <option value="3">Medical Representitve</option>
                                <option value="4">Fitness trainer</option>
                                <option value="5"> Pathology Collecter</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="icon fa fa-mobile"></i>
                                <input type="text" id="sender-contact" class="form-control" name="contactno" placeholder="Contact no">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="icon fa fa-envelope"></i>
                                <input type="text" id="sender-emailssssss" class="form-control" name="email" placeholder="Email Address">
                            </div>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="blooddonation" name="blooddonation" value="forever" style="float: left;">
                            <label for="blooddonation">Are you intersted for donating blood without any personal benefits</label>
                        </div>
                        <div class="form-group" id="blood" style="display:none;">
                            <div class="input-icon">
                                <i class="icon fa fa-tint"></i>
                                <input type="text" class="form-control" placeholder="Blood group">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="icon fa fa-unlock-alt"></i>
                                <input type="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="icon fa fa-unlock-alt"></i>
                                <input type="password" class="form-control" placeholder="Retype Password">
                            </div>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="remember" name="rememberme" value="forever" style="float: left;">
                            <label for="remember">By creating account you agree to our Terms & Conditions</label>
                        </div>
                        <button class="btn btn-common log-btn">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://maps.google.com/maps/api/js?v=3.30&key=<?php echo $google_map_key->value ?>&libraries=places&region=in&language=en&callback=initAutocomplete"></script>
<script type="text/javascript">

                            var apiGeolocationSuccess = function (position) {
                                console.log("API geolocation success!\n\nlat = " + position.coords.latitude + "\nlng = " + position.coords.longitude);
                            };

                            var tryAPIGeolocation = function () {
                                jQuery.post("https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyBOtvKwP4T1s3wOZ5h9QjDP2dSrly-SJXA", function (success) {
                                    apiGeolocationSuccess({coords: {latitude: success.location.lat, longitude: success.location.lng}});
                                })
                                        .fail(function (err) {
                                            console.log("API Geolocation error! \n\n" + err);
                                            console.log(err);
                                        });
                            };

                            var browserGeolocationSuccess = function (position) {
                                console.log("Browser geolocation success!\n\nlat = " + position.coords.latitude + "\nlng = " + position.coords.longitude);
                            };

                            var browserGeolocationFail = function (error) {
                                switch (error.code) {
                                    case error.TIMEOUT:
                                        console.log("Browser geolocation error !\n\nTimeout.");
                                        break;
                                    case error.PERMISSION_DENIED:
                                        if (error.message.indexOf("Only secure origins are allowed") == 0) {
                                            tryAPIGeolocation();
                                        }
                                        break;
                                    case error.POSITION_UNAVAILABLE:
                                        console.log("Browser geolocation error !\n\nPosition unavailable.");
                                        break;
                                }
                            };

                            var tryGeolocation = function () {
                                if (navigator.geolocation) {
                                    navigator.geolocation.getCurrentPosition(
                                            browserGeolocationSuccess,
                                            browserGeolocationFail,
                                            {maximumAge: 50000, timeout: 20000, enableHighAccuracy: true});
                                }
                            };

                            tryGeolocation();
                            var map;
                            var plain = new google.maps.LatLng(22.7483, 88.3385);
                            var mapCoordinates = new google.maps.LatLng(22.7483, 88.3385);
                            var markers = [];
                            var image = new google.maps.MarkerImage(
                                    '<?= Yii::$app->request->baseUrl; ?>/assets/img/map-marker.png',
                                    new google.maps.Size(84, 70),
                                    new google.maps.Point(0, 0),
                                    new google.maps.Point(60, 60)
                                    );
                            function addMarker() {
                                markers.push(new google.maps.Marker({
                                    position: plain,
                                    raiseOnDrag: false,
                                    icon: image,
                                    map: map,
                                    draggable: false
                                }));
                            }
                            function initialize() {
                                var mapOptions = {
                                    backgroundColor: "#ffffff",
                                    zoom: 15,
                                    disableDefaultUI: true,
                                    center: mapCoordinates,
                                    zoomControl: false,
                                    scaleControl: false,
                                    scrollwheel: false,
                                    disableDoubleClickZoom: true,
                                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                                    styles: [{
                                            "featureType": "landscape.natural",
                                            "elementType": "geometry.fill",
                                            "stylers": [{
                                                    "color": "#ffffff"
                                                }
                                            ]
                                        }
                                        , {
                                            "featureType": "landscape.man_made",
                                            "stylers": [{
                                                    "color": "#ffffff"
                                                }
                                                , {
                                                    "visibility": "off"
                                                }
                                            ]
                                        }
                                        , {
                                            "featureType": "water",
                                            "stylers": [{
                                                    "color": "#80C8E5"
                                                }
                                                , {
                                                    "saturation": 0
                                                }
                                            ]
                                        }
                                        , {
                                            "featureType": "road.arterial",
                                            "elementType": "geometry",
                                            "stylers": [{
                                                    "color": "#999999"
                                                }
                                            ]
                                        }
                                        , {
                                            "elementType": "labels.text.stroke",
                                            "stylers": [{
                                                    "visibility": "off"
                                                }
                                            ]
                                        }
                                        , {
                                            "elementType": "labels.text",
                                            "stylers": [{
                                                    "color": "#333333"
                                                }
                                            ]
                                        }

                                        , {
                                            "featureType": "road.local",
                                            "stylers": [{
                                                    "color": "#dedede"
                                                }
                                            ]
                                        }
                                        , {
                                            "featureType": "road.local",
                                            "elementType": "labels.text",
                                            "stylers": [{
                                                    "color": "#666666"
                                                }
                                            ]
                                        }
                                        , {
                                            "featureType": "transit.station.bus",
                                            "stylers": [{
                                                    "saturation": -57
                                                }
                                            ]
                                        }
                                        , {
                                            "featureType": "road.highway",
                                            "elementType": "labels.icon",
                                            "stylers": [{
                                                    "visibility": "off"
                                                }
                                            ]
                                        }
                                        , {
                                            "featureType": "poi",
                                            "stylers": [{
                                                    "visibility": "off"
                                                }
                                            ]
                                        }

                                    ]

                                }
                                ;
                                map = new google.maps.Map(document.getElementById('google-map'), mapOptions);
                                addMarker();

                            }
                            var elementExists = document.getElementById("google-map");
                            if (elementExists != null) {
                                google.maps.event.addDomListener(window, 'load', initialize);
                            }

</script>