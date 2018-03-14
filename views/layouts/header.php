<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\ServicesList;
use app\models\States;
use app\models\Cities;
$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
?>
<!-- Header Section Start -->
<div class="header">
    <nav class="navbar navbar-default main-navigation"  role="navigation">
        <div class="container">
            <div class="navbar-header">
                <!-- Stat Toggle Nav Link For Mobiles -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- End Toggle Nav Link For Mobiles -->
                <a class="navbar-brand logo" href="index.html"><img src="<?= $this->context->getProjectLogo() ?>" alt=""></a>
            </div>
            <!-- brand and toggle menu for mobile End -->
            <!-- Navbar Start -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="javascript:void(0);" id="login"><i class="lnr lnr-enter"></i> Login</a></li>
                    <li><a href="javascript:void(0);" id="signup"><i class="lnr lnr-user"></i> Signup</a></li>
                    <li><a href="blog.html"><i class="fa fa-rss"></i> Blog</a></li>
                </ul>
            </div>
            <!-- Navbar End -->
        </div>
    </nav>
    <!-- Off Canvas Navigation -->
    <div class="navmenu navmenu-default navmenu-fixed-left offcanvas">
        <!--- Off Canvas Side Menu -->
        <div class="close" data-toggle="offcanvas" data-target=".navmenu">
            <i class="fa fa-close"></i>
        </div>
        <h3 class="title-menu">All Pages</h3>
        <ul class="nav navmenu-nav">
            <!--- Menu -->
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About us</a></li>
            <li><a href="category.html">Category</a></li>
            <li><a href="ads-details.html">Ads details</a></li>
            <li><a href="pricing.html">Pricing Tables</a></li>
            <li><a href="account-archived-ads.html">Account - Archived</a></li>
            <li><a href="account-close.html">Account - Close</a></li>
            <li><a href="account-favourite-ads.html">Account - Favourite ads</a></li>
            <li><a href="account-home.html">Account - Home</a></li>
            <li><a href="account-myads.html">Account - My ads</a></li>
            <li><a href="account-pending-approval-ads.html">Ads pending/approval</a></li>
            <li><a href="account-saved-search.html">Saved search</a></li>
            <li><a href="post-ads.html">Post ads</a></li>
            <li><a href="posting-success.html">Posting success</a></li>
            <li><a href="blog.html">Blog</a></li>
            <li><a href="blog-details.html">Blog Details</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="forgot-password.html">Forgot password</a></li>
            <li><a href="faq.html">FAQ</a></li>
            <li><a href="signup.html">Signup</a></li>
        </ul>
        <!--- End Menu -->
    </div>
    <!--- End Off Canvas Side Menu -->
</div>
<!--- End Off Canvas Side Menu -->
<!--<div class="tbtnemergency wow pulse" id="emergency" data-wow-iteration="infinite" data-wow-duration="500ms" data-toggle="offcanvas" data-target="">
    <p><i class="fa fa-globe fa-spin fa-1x fa-fw"></i>Emergency</p>
</div>
<div class="tbtn wow pulse" id="menu"  data-toggle="offcanvas" data-target=".navmenu">
    <p><i class="fa fa-file-text-o"></i>Menu</p>
</div>-->

<!-- Header Section End -->
<!-- Start intro section -->
<?php
$all_services=ServicesList::find()->where(['status'=>'1'])->all();
$all_states= States::find()->where(['status'=>'1'])->all();
if(($controller == 'site' && $action == 'index')){
?>
<section id="intro" class="section-intro">
    <div class="overlay">
        <div class="container">
            <div class="main-text">
                <h1 class="intro-title">Welcome To <span style="color: #3498DB">poriseba.com</span></h1>
                <p class="sub-title">We are here to give you poriseba.One importent information can save a presious life and open up millions of posibility.</p>
                <!-- Start Search box -->
                <div class="row search-bar">
                    <div class="advanced-search">
                        <form action="<?= Yii::$app->request->baseUrl . '/search/index' ?>">
                            <input type="hidden" name="city" id="hidden_city" value="<?=(isset($_GET['city']) && $_GET['city']!='')?$_GET['city']:''?>">
                            <div class="col-md-2 col-sm-6 search-col" style="margin-right:45px;">
                                <div class="input-group-addon search-category-container">
                                    <label class="styled-select">
                                        <select class="dropdown-product selectpicker" name="categories" >
                                            <option value="">All Categories</option>
                                            <?php
                if(isset($all_services) && count($all_services)>0){
                    foreach ($all_services as $key => $val) {
                ?>
                                            <option class="subitem" value="<?=$val->id?>"><?=$val->name?></option>
                <?php }} ?>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6 search-col" style="margin-right:45px;">
                                <div class="input-group-addon search-category-container">
                                    <label class="styled-select">
                                        <select class="dropdown-product selectpicker" name="state" id="search_states">
                                            <option value="">Choose States</option>
                                            <?php
                if(isset($all_states) && count($all_states)>0){
                    foreach ($all_states as $key => $val) {
                ?>
                                            <option class="subitem" value="<?=$val->id?>"><?=$val->name?></option>
                <?php }} ?>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6 search-col" style="margin-right:33px;">
                                <div class="input-group-addon search-category-container">
                                    <label class="styled-select location-select">
                                        <select class="dropdown-product selectpicker" name="city" id="search_cities">
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
<?php }else{ ?>
<div id="search-row-wrapper">
      <div class="container">
        <div class="search-inner">
            <!-- Start Search box -->
            <div class="row search-bar">
              <div class="advanced-search">
                  <form id="searchForm" action="<?= Yii::$app->request->baseUrl . '/search/index' ?>">
                      <input type="hidden" name="city" id="hidden_city" value="<?=(isset($_GET['city']) && $_GET['city']!='')?$_GET['city']:''?>">
                      <input type="hidden" name="limit" id="limit" value="20">
                      <input type="hidden" name="offset" id="offset" value="0">
                            <div class="col-md-2 col-sm-6 search-col" style="margin-right:45px;">
                                <div class="input-group-addon search-category-container">
                                    <label class="styled-select">
                                        <select class="dropdown-product selectpicker" name="categories" >
                                            <option value="">All Categories</option>
                                            <?php
                if(isset($all_services) && count($all_services)>0){
                    foreach ($all_services as $key => $val) {
                ?>
                                            <option class="subitem" value="<?=$val->id?>" <?=(isset($_GET['categories']) && $_GET['categories']==$val->id)?'selected="selected"':''?>><?=$val->name?></option>
                <?php }} ?>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6 search-col" style="margin-right:45px;">
                                <div class="input-group-addon search-category-container">
                                    <label class="styled-select">
                                        <select class="dropdown-product selectpicker" name="state" id="search_states">
                                            <option value="">Choose States</option>
                                            <?php
                if(isset($all_states) && count($all_states)>0){
                    foreach ($all_states as $key => $val) {
                ?>
                                            <option class="subitem" value="<?=$val->id?>" <?=(isset($_GET['state']) && $_GET['state']==$val->id)?'selected="selected"':''?>><?=$val->name?></option>
                <?php }} ?>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6 search-col" style="margin-right:33px;">
                                <div class="input-group-addon search-category-container">
                                    <label class="styled-select location-select">
                                        <select class="dropdown-product selectpicker" name="city" id="search_cities">
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