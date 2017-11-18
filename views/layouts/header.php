<?php

use yii\helpers\Html;
use yii\helpers\Url;
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
                <a class="navbar-brand logo" href="index.html"><img src="assets/img/logo.png" alt=""></a>
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
<div class="tbtnemergency wow pulse" id="emergency" data-wow-iteration="infinite" data-wow-duration="500ms" data-toggle="offcanvas" data-target="">
    <p><i class="fa fa-globe fa-spin fa-1x fa-fw"></i>Emergency</p>
</div>
<div class="tbtn wow pulse" id="menu"  data-toggle="offcanvas" data-target=".navmenu">
    <p><i class="fa fa-file-text-o"></i>Menu</p>
</div>

<!-- Header Section End -->