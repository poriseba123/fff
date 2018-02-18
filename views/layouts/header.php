<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\ServicesList;
use app\models\States;
use app\models\Cities;

$imgname = \app\models\Homepagesliderlogo::find()->select('slider_image1,slider_image2,slider_image3,slider_image4')->one();
$landing_page = \app\models\Landingpage::find()->where(['id' => '1'])->all();
?>
<style>

    .section-intro{
        background:url(../../uploads/logoslider/original/<?= $imgname->slider_image1; ?>) center center no-repeat;
        background-size:cover
    }
    #img1{
        background:url(../../uploads/logoslider/original/<?= $imgname->slider_image1; ?>) center center no-repeat;
        background-size:cover
    }
    #img2{
        background:url(../../uploads/logoslider/original/<?= $imgname->slider_image2; ?>) center center no-repeat;
        background-size:cover
    }
    #img3{
        background:url(../../uploads/logoslider/original/<?= $imgname->slider_image3; ?>) center center no-repeat;
        background-size:cover
    }
    #img4{
        background:url(../../uploads/logoslider/original/<?= $imgname->slider_image4; ?>) center center no-repeat;
        background-size:cover
    }

    .dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover {
        background-color: #337ab7 !important;
    }
    .st-first{
        display: none;
    }
</style>
<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5a8065d9d4d59e0012e897a8&product=sop' async='async'></script>
<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5a830430e45fbb001343001e&product=sticky-share-buttons"></script>

<?php
$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;

$logoname = \app\models\Homepagesliderlogo::find()->select('logo_image')->one();
?>
<!-- Header Section Start -->
<div class="header">
    <nav class="navbar navbar-default main-navigation"  role="navigation">
        <div class="container">
            <div class="navbar-header">
                <!-- Stat Toggle Nav Link For Mobiles -->
                <!--                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>-->
                <!-- End Toggle Nav Link For Mobiles -->

                <a class="navbar-brand logo" href="http://poriseba.com/"><img src="http://poriseba.com\uploads\logoslider\thumbnail\<?= $logoname->logo_image; ?>" alt=""></a>
            </div>
            <!-- brand and toggle menu for mobile End -->
            <!-- Navbar Start -->
            <!--            <div class="collapse navbar-collapse" id="navbar">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="javascript:void(0);" id="login"><i class="lnr lnr-enter"></i> Login</a></li>
                                <li><a href="javascript:void(0);" id="signup"><i class="lnr lnr-user"></i> Signup</a></li>
                                <li><a href="javascript:void(0);"><i class="fa fa-rss"></i> Blog</a></li>
                                <li class="postadd">
                                    <div class="btn btn-danger btn-post wow pulse" id="emergency" data-wow-iteration="infinite" data-wow-duration="500ms" data-toggle="offcanvas" data-target="">
                                        <p><i class="fa fa-globe fa-spin fa-1x fa-fw"></i>Emergency</p>
                                    </div>
                                    <a class="btn btn-danger btn-post" href="post-ads.html"><span class="fa fa-plus-circle"></span> Post an Ad</a>
                                </li>
                            </ul>
            
                        </div>-->

            <!-- Navbar End -->
        </div>
    </nav>
    <!-- Off Canvas Navigation -->
    <?= \Yii::$app->view->render('left_menue'); ?>
    <!--- End Off Canvas Side Menu -->
</div>
<!--- End Off Canvas Side Menu -->

<div class="tbtn wow pulse" id="menu"  data-toggle="offcanvas" data-target=".navmenu">
    <p><i class="fa fa-file-text-o"></i>Menus</p>
</div>

<!-- Header Section End -->
<!-- Start intro section -->
<?php
$all_services = ServicesList::find()->where(['status' => '1'])->all();
$all_states = States::find()->where(['status' => '1'])->all();
if (($controller == 'site' && $action == 'index')) {
    ?>
    <section id="intro" class="section-intro">
        <div class="overlay">
            <div class="container">
                <div class="main-text">
                    <h1 class="intro-title"><?= isset($landing_page[0]->heading) ? ucfirst($landing_page[0]->heading) : ''; ?></h1>
                    <p class="sub-title"><?= isset($landing_page[0]->tagline) ? ucfirst(strip_tags($landing_page[0]->tagline)) : ''; ?></p>
                    <!-- Start Search box -->
                    <div class="row search-bar">
                        <div class="advanced-search">
                            <form action="<?= Yii::$app->request->baseUrl . '/search/index' ?>">
                                <input type="hidden" name="cityid" id="hidden_city" value="<?= (isset($_GET['city']) && $_GET['city'] != '') ? $_GET['city'] : '' ?>">
                                <div class="col-md-2 col-sm-6 search-col" style="margin-right:45px;">
                                    <div class="input-group-addon search-category-container">
                                        <label class="styled-select">
                                            <select class="dropdown-product selectpicker" name="categories" data-live-search="true"  >
                                                <option value="">All Categories</option>
                                                <?php
                                                if (isset($all_services) && count($all_services) > 0) {
                                                    foreach ($all_services as $key => $val) {
                                                        ?>
                                                        <option class="subitem" value="<?= $val->id ?>"><?= $val->name ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6 search-col" style="margin-right:45px;">
                                    <div class="input-group-addon search-category-container">
                                        <label class="styled-select">
                                            <select class="dropdown-product selectpicker" name="state" id="search_states" data-live-search="true" >
                                                <option value="">Choose States</option>
                                                <?php
                                                if (isset($all_states) && count($all_states) > 0) {
                                                    foreach ($all_states as $key => $val) {
                                                        ?>
                                                        <option class="subitem" value="<?= $val->id ?>"><?= $val->name ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6 search-col" style="margin-right:33px;">
                                    <div class="input-group-addon search-category-container">
                                        <label class="styled-select location-select">
                                            <select class="dropdown-product selectpicker" name="city" id="search_cities" data-live-search="true">
                                                <option value="">All Cities</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 search-col">
                                    <input class="form-control keyword" name="keyword" value="" placeholder="Enter Keyword" type="text">
                                    <i class="fa fa-search"></i>
                                </div>
                                <div class="col-md-1 col-sm-6 search-col" style="width:150px">
                                    <button type="submit" class="btn btn-common btn-search btn-block"><strong>Search</strong></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End Search box -->
                </div>
            </div>
        </div>
    </section>
    <!-- end intro section -->
    <?php
} else {
    //die("hello");
    ?>
    <div id="search-row-wrapper">
        <div class="container">
            <div class="search-inner">
                <!-- Start Search box -->
                <div class="row search-bar">
                    <div class="advanced-search">
                        <form id="searchForm" action="<?= Yii::$app->request->baseUrl . '/search/index' ?>">
                            <input type="hidden" name="city" id="hidden_city" value="<?= (isset($_GET['city']) && $_GET['city'] != '') ? $_GET['city'] : '' ?>">
                            <input type="hidden" name="limit" id="limit" value="5">
                            <input type="hidden" name="offset" id="offset" value="0">
                            <div class="col-md-2 col-sm-6 search-col" style="margin-right:45px;">
                                <div class="input-group-addon search-category-container">
                                    <label class="styled-select">
                                        <select class="dropdown-product selectpicker" name="categories" data-live-search="true">
                                            <option value="">All Categories</option>
                                            <?php
                                            if (isset($all_services) && count($all_services) > 0) {
                                                foreach ($all_services as $key => $val) {
                                                    ?>
                                                    <option class="subitem" value="<?= $val->id ?>" <?= (isset($_GET['categories']) && $_GET['categories'] == $val->id) ? 'selected="selected"' : '' ?>><?= $val->name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6 search-col" style="margin-right:45px;">
                                <div class="input-group-addon search-category-container">
                                    <label class="styled-select">
                                        <select class="dropdown-product selectpicker" name="state" id="search_states" data-live-search="true">
                                            <option value="">Choose States</option>
                                            <?php
                                            if (isset($all_states) && count($all_states) > 0) {
                                                foreach ($all_states as $key => $val) {
                                                    ?>
                                                    <option class="subitem" value="<?= $val->id ?>" <?= (isset($_GET['state']) && $_GET['state'] == $val->id) ? 'selected="selected"' : '' ?>><?= $val->name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6 search-col" style="margin-right:33px;">
                                <div class="input-group-addon search-category-container">
                                    <label class="styled-select location-select">
                                        <select class="dropdown-product selectpicker" name="city" id="search_cities" data-live-search="true">
                                            <option value="">All Cities</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 search-col">
                                <input class="form-control keyword" name="keyword" value="" placeholder="Enter Keyword" type="text">
                                <i class="fa fa-search"></i>
                            </div>
                            <div class="col-md-1 col-sm-6 search-col" style="width:150px">
                                <button type="submit" class="btn btn-common btn-search btn-block"><strong>Search</strong></button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End Search box -->
            </div>
        </div>
    </div>
<?php } ?>