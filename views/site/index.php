<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
?>
<!--<section class="banner-sec">
    <div class="container">
        <h1 class="title">123 Vamos</h1>
        <h2 class="subtitle heading">Una nueva comunidad para compartir tus viajes en Colombia.</h2>
    </div>
</section>
<section class="search-sec open-sans">
    <div class="container">
        <h3 class="serach-title heading">¡Suban al carro!</h3>
        <form action="<?= Yii::$app->request->baseUrl . '/search/searchtrip' ?>">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <input required name="TripLocation[location_a_name]" type="text" class="form-control cust-input" placeholder="<?= Yii::t('app', 'desde') ?>" id="TripLocation_location_a_name" onkeyup="codeAddress('TripLocation_location_a_name')" autocomplete="off">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input required name="TripLocation[location_b_name]" type="text" class="form-control cust-input" placeholder="<?= Yii::t('app', 'hasta') ?>" id="TripLocation_location_b_name" onkeyup="codeAddress('TripLocation_location_b_name')" autocomplete="off">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input required name="TripLocation[departure_datetime]" type="text" class="form-control cust-input datepicker" placeholder="<?= Yii::t('app', 'fecha') ?>" autocomplete="off">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <button type="submit" class="btn btn-block search-btn"><?= Yii::t('app', 'BUSCAR UN VIAJE') ?></button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</section>
<section class="search-btm-sec open-sans">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <img src="<?= $this->context->getStaticImage('animation-gif-homepage.gif') ?>" alt="" class="img-responsive center-block" />
            </div>
            <div class="col-sm-6">
                            <p class="search-btm-text">
                    Pa' Que el viaje sea m&aacute;s barato! M&aacute;s alegre! M&aacute;s r&aacute;pido! M&aacute;s ecol&oacute;gico!
                </p>
            </div>

        </div>
    </div>
</section>
<section class="four-icon-sec open-sans">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="icon-wrap">
                    <img src="<?= $this->context->getStaticImage('safe-123vamos-icon.png')?>" alt="" class="center-block img-responsive title-icon" />
                    <h3 class="title heading">Es súper seguro.</h3>
                    <p class="title-detail">
                        Verificamos cada documento de identidad y foto para que nuestra plataforma sea una comunidad fiable. ¡Para que viajes tranquilo!
                    </p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="icon-wrap">
                    <img src="<?= $this->context->getStaticImage('fast-123vamos-icon.png')?>" alt="" class="center-block img-responsive title-icon" />
                    <h3 class="title heading">Es más rápido.</h3>
                    <p class="title-detail">
                        En solo unos segundos puedes consultar anuncios, ver perfiles de usuarios y encontrar las personas perfectas para compartir tu trayecto por toda Colombia.
                    </p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="icon-wrap">
                    <img src="<?= $this->context->getStaticImage('cheap-123vamos-icon.png')?>" alt="" class="center-block img-responsive title-icon" />
                    <h3 class="title heading">Es más barato.</h3>
                    <p class="title-detail">
                        Porque compartir tu viaje con otros miembros de nuestra comunidad, divides los gastos del trayecto. Y puedes encontrar nuevos amigos al mismo tiempo ¡Para que viajes más!
                    </p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="icon-wrap">
                    <img src="<?= $this->context->getStaticImage('environment-123vamos-icon.png')?>" alt="" class="center-block img-responsive title-icon" />
                    <h3 class="title heading">Es mejor para el ambiente</h3>
                    <p class="title-detail">
                        Hay demasiadas personas que viajan solas en un carro. Hagamos algo bueno por nuestro planeta ¡Compartemos nuestros
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="buscar-sec open-sans">
    <div class="container">
        <div class="row">
            <div class="col-sm-5">
                            <img src="images/benefit.png" alt="" class="img-responsive center-block"  style="border: 5px solid #fff;margin: 15px auto;" />
            </div>
            <div class="col-sm-7">
                <div class="row">
                    
                    
                </div>

                <div class="row">
                    <div class="col-sm-12"><a href="<?php echo Yii::$app->urlManager->createUrl(["search/viewall"])?>" class="btn-block btn bascar-btn">VER TODOS LOS VIAJES</a></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="publicar-sec open-sans">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="single-publicar-wrap">
                    <div class="icon-wrap"><i class="fa fa-bus"></i></div>
                    <h4 class="publicar-title">Medellín - Bogotá en bus</h4>
                    <p class="publicar-title">desde $65.000</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="single-publicar-wrap">
                    <div class="icon-wrap"><i class="fa fa-plane"></i></div>
                    <h4 class="publicar-title">Medellín - Bogotá en avión</h4>
                    <p class="publicar-title">desde $120.000</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="single-publicar-wrap">
                    <div class="icon-wrap"><i class="fa fa-car"></i></div>
                    <h4 class="publicar-title">Medellín - Bogotá con 123Vamos</h4>
                    <p class="publicar-title">desde $51.000</p>
                </div>
            </div>
        </div>
        <div class="text-center open-sans"><a href="<?= Yii::$app->urlManager->createUrl('post/create') ?>" class="btn all-default-btn">PUBLICAR UN VIAJE</a></div>
    </div>
</section>
<section class="insta-sec">
    <a href="<?= $this->context->getInstagramLink() ?>" target="_blank" class="btn-block">
        <img src="<?= $this->context->getStaticImage('insta-img.png')?>" alt="" class="img-responsive full-img" />
    </a>
</section>-->
<!-- Start intro section -->
    <section id="intro" class="section-intro">
      <div class="overlay">
        <div class="container">
          <div class="main-text">
            <h1 class="intro-title">Welcome To <span style="color: #3498DB">PoriSeba.Com</span></h1>
            <p class="sub-title">Buy and sell everything from used cars to mobile phones and computers, or search for property, jobs and more</p>

            <!-- Start Search box -->
            <div class="row search-bar">
              <div class="advanced-search">
                <form class="search-form" method="get">
                  <div class="col-md-3 col-sm-6 search-col">
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
                  <div class="col-md-3 col-sm-6 search-col">
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
                  <div class="col-md-3 col-sm-6 search-col">
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
              <h3 class="section-title">Browse Ads from 8 Categories</h3>
            </div>          
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="category-box border-1 wow fadeInUpQuick" data-wow-delay="0.3s">
                <div class="icon">
                  <a href="category.html"><i class="lnr lnr-users color-1"></i></a>
                </div>
                <div class="category-header">  
                  <a href="category.html"><h4>Community</h4></a>
                </div>
                <div class="category-content">
                  <ul>
                    <li>
                      <a href="category.html">Announcements</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Car Pool - Bike Ride</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Charity - Donate - NGO</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Lost - Found</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Tender Notices</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">General Entertainment</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">View all subcategories →</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
             <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="category-box border-2 wow fadeInUpQuick" data-wow-delay="0.6s">
                <div class="icon">
                  <a href="category.html"><i class="lnr lnr-laptop-phone color-2"></i></a>
                </div>
                <div class="category-header">  
                  <a href="category.html"><h4>Electronics</h4></a>
                </div>
                <div class="category-content">
                  <ul>
                    <li>
                      <a href="category.html">Home Electronics</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">LCDs</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Charity - Donate - NGO</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Mobile & Tablets</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">TV & DVDs</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Technical Services</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Others</a>
                      <sapn class="category-counter">1</sapn>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="category-box border-3 wow fadeInUpQuick" data-wow-delay="0.9s">
                <div class="icon">
                  <a href="category.html"><i class="lnr lnr-cog color-3"></i></a>
                </div>
                <div class="category-header">  
                  <a href="category.html"><h4>Services</h4></a>
                </div>
                <div class="category-content">
                  <ul>
                    <li>
                      <a href="category.html">Cleaning Services</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Educational</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Food Services</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Medical</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Office & Home Removals</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">General Entertainment</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">View all subcategories →</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>            
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="category-box border-4 wow fadeInUpQuick" data-wow-delay="1.2s">
                <div class="icon">
                  <a href="category.html"><i class="lnr lnr-cart color-4"></i></a>
                </div>
                <div class="category-header">  
                  <a href="category.html"><h4>Shopping</h4></a>
                </div>
                <div class="category-content">
                  <ul>
                    <li>
                      <a href="category.html">Bags</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Beauty Products</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Jewelry</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Shoes M/F</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Tender Notices</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Others</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="category-box border-5 wow fadeInUpQuick" data-wow-delay="1.5s">
                <div class="icon">
                  <a href="category.html"><i class="lnr lnr-briefcase color-5"></i></a>
                </div>
                <div class="category-header">  
                  <a href="category.html"><h4>Jobs</h4></a>
                </div>
                <div class="category-content">
                  <ul>
                    <li>
                      <a href="category.html">Accounts Jobs</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Cleaning & Washing</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Web design</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Design & Code</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Finance Jobs</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Data Entry</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">View all subcategories →</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>            
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="category-box border-6 wow fadeInUpQuick" data-wow-delay="1.8s">
                <div class="icon">
                  <a href="category.html"><i class="lnr lnr-graduation-hat color-6"></i></a>
                </div>
                <div class="category-header">  
                  <a href="category.html"><h4>Training</h4></a>
                </div>
                <div class="category-content">
                  <ul>
                    <li>
                      <a href="category.html">Android Development</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">20 Days HTML/CSS</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">iOS Development with Swift</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">SEO for rest of us</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Mastering in Java</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Others</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">View all subcategories →</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="category-box border-7 wow fadeInUpQuick" data-wow-delay="2.1s">
                <div class="icon">
                  <a href="category.html"><i class="lnr lnr-apartment color-7"></i></a>
                </div>
                <div class="category-header">  
                  <a href="category.html"><h4>Real Estate</h4></a>
                </div>
                <div class="category-content">
                  <ul>
                    <li>
                      <a href="category.html">Farms</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Home for rent</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Hotels</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Land for sale</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Offices for rent</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Others</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                  </ul>
                </div>
              </div>
            </div>            
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="category-box border-8 wow fadeInUpQuick" data-wow-delay="2.3s">
                <div class="icon">
                  <a href="category.html"><i class="lnr lnr-car color-8"></i></a>
                </div>
                <div class="category-header">  
                  <a href="category.html"><h4>Vehicles</h4></a>
                </div>
                <div class="category-content">
                  <ul>
                    <li>
                      <a href="category.html">Cars</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Fancy Cars</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Kids Bikes</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Motor Bikes</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Classic & Modern</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">Kinds</a>
                      <sapn class="category-counter">3</sapn>
                    </li>
                    <li>
                      <a href="category.html">View all subcategories →</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>     
          </div>
        </div>
      </section>
      <!-- Categories Homepage Section End -->

      <!-- Featured Listings Start -->
      <section class="featured-lis" >
        <div class="container">
          <div class="row">
            <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
              <h3 class="section-title">Featured Listings</h3>
              <div id="new-products" class="owl-carousel">
                <div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <img src="assets/img/product/img1.jpg" alt=""> 
                      <div class="overlay">
                        <a href="ads-details.html"><i class="fa fa-link"></i></a>
                      </div> 
                    </div>    
                    <a href="ads-details.html" class="item-name">Lorem ipsum dolor sit</a>  
                    <span class="price">$150</span>  
                  </div>
                </div>
                <div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <img src="assets/img/product/img2.jpg" alt=""> 
                      <div class="overlay">
                        <a href="ads-details.html"><i class="fa fa-link"></i></a>
                      </div> 
                    </div> 
                    <a href="ads-details.html" class="item-name">Sed diam nonummy</a>  
                    <span class="price">$67</span> 
                  </div>
                </div>
                <div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <img src="assets/img/product/img3.jpg" alt=""> 
                      <div class="overlay">
                        <a href="ads-details.html"><i class="fa fa-link"></i></a>
                      </div> 
                    </div>
                    <a href="ads-details.html" class="item-name">Feugiat nulla facilisis</a>  
                    <span class="price">$300</span>  
                  </div>
                </div>
                <div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <img src="assets/img/product/img4.jpg" alt=""> 
                      <div class="overlay">
                        <a href="ads-details.html"><i class="fa fa-link"></i></a>
                      </div> 
                    </div> 
                    <a href="ads-details.html" class="item-name">Lorem ipsum dolor sit</a>  
                    <span class="price">$149</span> 
                  </div>
                </div>
                <div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <img src="assets/img/product/img5.jpg" alt=""> 
                      <div class="overlay">
                        <a href="ads-details.html"><i class="fa fa-link"></i></a>
                      </div> 
                    </div>
                    <a href="ads-details.html" class="item-name">Sed diam nonummy</a>  
                    <span class="price">$90</span> 
                  </div>
                </div>
                <div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <img src="assets/img/product/img6.jpg" alt=""> 
                      <div class="overlay">
                        <a href="ads-details.html"><i class="fa fa-link"></i></a>
                      </div> 
                    </div>                     
                    <a href="ads-details.html" class="item-name">Praesent luptatum zzril</a>  
                    <span class="price">$169</span> 
                  </div>
                </div>
                <div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <img src="assets/img/product/img7.jpg" alt=""> 
                      <div class="overlay">
                        <a href="ads-details.html"><i class="fa fa-link"></i></a>
                      </div> 
                    </div>  
                    <a href="ads-details.html" class="item-name">Lorem ipsum dolor sit</a>  
                    <span class="price">$79</span> 
                  </div>
                </div>
                <div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <img src="assets/img/product/img8.jpg" alt=""> 
                      <div class="overlay">
                        <a href="ads-details.html"><i class="fa fa-link"></i></a>
                      </div> 
                    </div>
                    <a href="ads-details.html" class="item-name">Sed diam nonummy</a>  
                    <span class="price">$149</span>   
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
              <h3 class="title-2"><i class="fa fa-search"></i> Popular Searches</h3>
              <ul class="cat-list col-sm-4">
                <li> <a href="account-saved-search.html">puppies</a></li>
                <li> <a href="account-saved-search.html">puppies for sale</a></li>
                <li> <a href="account-saved-search.html">bed</a></li>
                <li> <a href="account-saved-search.html">household</a></li>
                <li> <a href="account-saved-search.html">chair</a></li>
                <li> <a href="account-saved-search.html">materials</a></li>
              </ul>
              <ul class="cat-list col-sm-4">
                <li> <a href="account-saved-search.html">sofa</a></li>
                <li> <a href="account-saved-search.html">wanted</a></li>
                <li> <a href="account-saved-search.html">furniture</a></li>
                <li> <a href="account-saved-search.html">van</a></li>
                <li> <a href="account-saved-search.html">wardrobe</a></li>
                <li> <a href="account-saved-search.html">caravan</a></li>

              </ul>
              <ul class="cat-list col-sm-4">
                <li> <a href="account-saved-search.html">for sale</a></li>
                <li> <a href="account-saved-search.html">free</a></li>
                <li> <a href="account-saved-search.html">1 bedroom flat</a></li>
                <li> <a href="account-saved-search.html">photo+video</a></li>
                <li> <a href="account-saved-search.html">bmw</a></li>
                <li> <a href="account-saved-search.html">Land </a></li>
              </ul>
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
<script>
    function codeAddress(id) {
        var input = document.getElementById(id);
        var options = {
            types: ['(cities)'],
            componentRestrictions: {country: 'CO'}//Colombia only
        };
        var autocomplete = new google.maps.places.Autocomplete(input, options);
        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            $('#' + id + '_lat').val(place.geometry['location'].lat());
            $('#' + id + '_long').val(place.geometry['location'].lng());
        });
    }
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6ByNv7U0Tc36ib6VTn68Vml-0Z4DrBZc&libraries=places" charset="UTF-8"></script>