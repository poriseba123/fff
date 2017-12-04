<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
?>
<!-- Start intro section -->
<section id="intro" class="section-intro">
    <div class="overlay">
        <div class="container">
            <div class="main-text">
                <h1 class="intro-title">Welcome To <span style="color: #3498DB">poriseba.com</span></h1>
                <p class="sub-title">We are here to give you poriseba.One importent information can save a presious life and open up millions of posibility.</p>
                <!-- Start Search box -->
                <div class="row search-bar">
                    <div class="advanced-search">
                        <form class="search-form" method="get">
                            <div class="col-md-2 col-sm-6 search-col" style="margin-right:45px;">
                                <div class="input-group-addon search-category-container">
                                    <label class="styled-select">
                                        <select class="dropdown-product selectpicker" name="product-cat" >
                                            <option value="0">All Categories</option>
                                            <option class="subitem" value="community"> Community</option>
                                            <option value="items-for-sale"> Items For Sale</option>
                                            <option value="jobs"> Jobs</option>
                                            <option value="personals"> Personals</option>
                                            <option value="training"> Training</option>
                                            <option value="real_estate"> Real Estate</option>
                                            <option value="services"> Services</option>
                                            <option value="vehicles"> Vehicles</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6 search-col" style="margin-right:45px;">
                                <div class="input-group-addon search-category-container">
                                    <label class="styled-select">
                                        <select class="dropdown-product selectpicker" name="product-cat" >
                                            <option value="0">All Categories</option>
                                            <option class="subitem" value="community"> Community</option>
                                            <option value="items-for-sale"> Items For Sale</option>
                                            <option value="jobs"> Jobs</option>
                                            <option value="personals"> Personals</option>
                                            <option value="training"> Training</option>
                                            <option value="real_estate"> Real Estate</option>
                                            <option value="services"> Services</option>
                                            <option value="vehicles"> Vehicles</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6 search-col" style="margin-right:33px;">
                                <div class="input-group-addon search-category-container">
                                    <label class="styled-select location-select">
                                        <select class="dropdown-product selectpicker" name="product-cat" >
                                            <option value="0">All Locations</option>
                                            <option value="New York">New York</option>
                                            <option value="California">California</option>
                                            <option value="Washington">Washington</option>
                                            <option value="churches">Birmingham</option>
                                            <option value="Birmingham">Chicago</option>
                                            <option value="Phoenix">Phoenix</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 search-col">
                                <input class="form-control keyword" name="keyword" value="" placeholder="Enter Keyword" type="text">
                                <i class="fa fa-search"></i>
                            </div>
                            <div class="col-md-1 col-sm-6 search-col" style="width:150px">
                                <button class="btn btn-common btn-search btn-block"><strong>Search</strong></button>
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
<div class="wrapper">
    <!-- Categories Homepage Section Start -->
    <section id="categories-homepage">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-title">over view of our listed poriseba you can acess</h3>
                </div>
                <?php
                if(isset($all_services) && count($all_services)>0){
                    foreach ($all_services as $key => $val) {
                ?>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="category-box <?=$val->border_color?> wow fadeInUpQuick" data-wow-delay="0.9s">
                        <div class="icon">
                            <a href="category.html"><i class="<?=$val->fa_icon?>"></i></a>
                        </div>
                        <div class="category-header">
                            <a href="category.html">
                                <h4><?=$val->name?></h4>
                            </a>
                        </div>
                        <div class="category-content">
                            <ul>
                                <?php
                                $result=$val->model::find()->select(['*,COUNT(id) as cityrow_count'])->where(['status'=>'1'])->groupBy(['city_id'])->all();
                                if(isset($result) && count($result) >0){
                                    foreach ($result as $key => $val) {
                                ?>
                                <li>
                                    <a href="category.html"><?=$val->city->name?></a>
                                    <span class="category-counter"><?=$val->cityrow_count?></span>
                                </li>
                                    <?php if($key==5){break;}} ?>
                                <li>
                                    <a href="category.html">View all →</a>
                                </li>
                                    <?php }else{ ?>
                                <li>
                                    <a href="javascript:;">No Data Found</a>
                                </li>
                                    <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php }}else{ ?>
                <?php } ?>

            </div>
        </div>
    </section>
    <!-- Categories Homepage Section End -->
    <!-- Featured Listings Start -->
    <section class="featured-lis" >
        <div class="container">
            <div class="row">
                <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
                    <h3 class="section-title">Medical News</h3>
                    <div id="new-products" class="owl-carousel">
                        <div class="item">
                            <div class="product-item">
                                <div class="carousel-thumb">
                                    <img src="https://pbs.twimg.com/media/DOSktI3WsAARky9.jpg" alt=""> 
                                    <div class="overlay">
                                        <a href="https://twitter.com/mnt"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                                <a href="https://twitter.com/mntl" class="item-name">Psychedelic plant brew could improve mental health </a>  
                                <span class="info">Sourse:Twitter/mnt</span>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-item">
                                <div class="carousel-thumb">
                                    <img src="https://pbs.twimg.com/media/DOSW_0QW0AEo_Kr.jpg" alt=""> 
                                    <div class="overlay">
                                        <a href="https://twitter.com/mntl"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                                <a href="https://twitter.com/mntl" class="item-name">Mushrooms may help you fight off aging </a>  
                                <span class="info">Sourse:Twitter/mnt</span>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-item">
                                <div class="carousel-thumb">
                                    <img src="https://pbs.twimg.com/media/DOSW-V5W4AAMELM.jpg" alt=""> 
                                    <div class="overlay">
                                        <a href="https://twitter.com/mntl"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                                <a href="https://twitter.com/mntl" class="item-name">Best essential oils for treating cold sores </a>  
                                <span class="info">Sourse:Twitter/mnt</span>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-item">
                                <div class="carousel-thumb">
                                    <img src="https://pbs.twimg.com/media/DOSJPQKW0AEYzO0.jpg" alt=""> 
                                    <div class="overlay">
                                        <a href="https://twitter.com/mnt"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                                <a href="https://twitter.com/mnt" class="item-name">The legacy of grief: Coping with loss </a>  
                                <span class="info">Sourse:Twitter/mnt</span>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-item">
                                <div class="carousel-thumb">
                                    <img src="https://pbs.twimg.com/media/DOR7gcyWsAY7SrA.jpg" alt=""> 
                                    <div class="overlay">
                                        <a href="https://twitter.com/mnt"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                                <a href="https://twitter.com/mnt" class="item-name">Bugs in the basement? Here's why </a>  
                                <span class="info">Sourse:Twitter/mnt</span>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-item">
                                <div class="carousel-thumb">
                                    <img src="https://www.menshealth.com/sites/menshealth.com/files/styles/listicle_slide_custom_user_phone_1x/public/images/slideshow2/fecal-transplant.jpg?itok=4HLba1GI" alt=""> 
                                    <div class="overlay">
                                        <a href="https://www.menshealth.com/health/medical-breakthroughs/slide/4"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                                <a href="https://www.menshealth.com/health/medical-breakthroughs/slide/4" class="item-name">The Fecal Transplant</a>  
                                <span class="info">Sourse:menshealth.com</span>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-item">
                                <div class="carousel-thumb">
                                    <img src="https://www.menshealth.com/sites/menshealth.com/files/styles/listicle_slide_custom_user_phone_1x/public/images/slideshow2/Hepatitis%20Cure.jpg?itok=6Q6XCQMv" alt=""> 
                                    <div class="overlay">
                                        <a href="https://www.menshealth.com/health/medical-breakthroughs/slide/7"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                                <a href="https://www.menshealth.com/health/medical-breakthroughs/slide/7" class="item-name">The Hepatitis Cure</a>  
                                <span class="info">Sourse:menshealth.com</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured Listings End -->
    <!-- Start Services Section -->
    <div class="features">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="features-box wow fadeInDownQuick" data-wow-delay="0.3s">
                        <div class="features-icon">
                            <i class="fa fa-book">
                            </i>
                        </div>
                        <div class="features-content">
                            <h4>
                                Full Documented
                            </h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere. 
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="features-box wow fadeInDownQuick" data-wow-delay="0.6s">
                        <div class="features-icon">
                            <i class="fa fa-paper-plane"></i>
                        </div>
                        <div class="features-content">
                            <h4>
                                Clean & Modern Design
                            </h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere. 
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="features-box wow fadeInDownQuick" data-wow-delay="0.9s">
                        <div class="features-icon">
                            <i class="fa fa-map"></i>
                        </div>
                        <div class="features-content">
                            <h4>
                                Great Features
                            </h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere. 
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="features-box wow fadeInDownQuick" data-wow-delay="1.2s">
                        <div class="features-icon">
                            <i class="fa fa-cogs"></i>
                        </div>
                        <div class="features-content">
                            <h4>
                                Completely Customizable
                            </h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere. 
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="features-box wow fadeInDownQuick" data-wow-delay="1.5s">
                        <div class="features-icon">
                            <i class="fa fa-hourglass"></i>
                        </div>
                        <div class="features-content">
                            <h4>
                                100% Responsive Layout
                            </h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere. 
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="features-box wow fadeInDownQuick" data-wow-delay="1.8s">
                        <div class="features-icon">
                            <i class="fa fa-hashtag"></i>
                        </div>
                        <div class="features-content">
                            <h4>
                                User Friendly
                            </h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere. 
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="features-box wow fadeInDownQuick" data-wow-delay="2.1s">
                        <div class="features-icon">
                            <i class="fa fa-newspaper-o"></i>
                        </div>
                        <div class="features-content">
                            <h4>
                                Awesome Layout
                            </h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere. 
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="features-box wow fadeInDownQuick" data-wow-delay="2.4s">
                        <div class="features-icon">
                            <i class="fa fa-leaf"></i>
                        </div>
                        <div class="features-content">
                            <h4>
                                High Quality
                            </h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere. 
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="features-box wow fadeInDownQuick" data-wow-delay="2.7s">
                        <div class="features-icon">
                            <i class="fa fa-google"></i>
                        </div>
                        <div class="features-content">
                            <h4>
                                Free Google Fonts Use
                            </h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere. 
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Services Section -->
    <!-- Location Section Start -->
    <section class="location">
        <div class="container">
            <div class="row localtion-list">
                <div class="col-md-6 col-sm-6 col-xs-12 wow fadeInLeft" data-wow-delay="0.5s">
                    <h3 class="title-2"><i class="fa fa-envelope"></i> Subscribe for updates</h3>
                    <form id="subscribe" action="">
                        <p>Join our 10,000+ subscribers and get access to the latest templates, freebies, announcements and resources!</p>
                        <div class="subscribe">
                            <input class="form-control" name="EMAIL" placeholder="Your email here" required="" type="email">
                            <button class="btn btn-common" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 wow fadeInRight" data-wow-delay="1s">
                    <h3 class="title-2"><i class="fa fa-youtube fa-1x"></i>Visit our Youtube Chanel</h3>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/ZQ_fOV5iWq4" frameborder="0" allowfullscreen></iframe>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Location Section End -->
</div>
<!-- Counter Section Start -->
<section id="counter">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="counting wow fadeInDownQuick" data-wow-delay=".5s">
                    <div class="icon">
                        <span>
                            <i class="lnr lnr-tag"></i>
                        </span>
                    </div>
                    <div class="desc">
                        <h3 class="counter">12090</h3>
                        <p>Regular Ads</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="counting wow fadeInDownQuick" data-wow-delay="1s">
                    <div class="icon">
                        <span>
                            <i class="lnr lnr-map"></i>
                        </span>
                    </div>
                    <div class="desc">
                        <h3 class="counter">350</h3>
                        <p>Locations</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="counting wow fadeInDownQuick" data-wow-delay="1.5s">
                    <div class="icon">
                        <span>
                            <i class="lnr lnr-users"></i>
                        </span>
                    </div>
                    <div class="desc">
                        <h3 class="counter">23453</h3>
                        <p>Reguler Members</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="counting wow fadeInDownQuick" data-wow-delay="2s">
                    <div class="icon">
                        <span>
                            <i class="lnr lnr-license"></i>
                        </span>
                    </div>
                    <div class="desc">
                        <h3 class="counter">150</h3>
                        <p>Premium Ads</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Counter Section End -->

