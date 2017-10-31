<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php
$accessAction = ['index','profile', 'changepassword', 'userverification', 'addvehicle','postdetail','searchtrip','index','create','success','postedit','howitworks','faq','aboutus','ruleofprocedures','termconditions','privacypolicy','como_funciona','quien_somos','reglamento_interno','preguntas_y_respuestas','terminos_y_condiciones','preceptos_de_confidencialidad','booked','alreadycancelled','completedtrip','allmessages','opinions','editvehicle'];
$accessController = ['advertisements','vehicle', 'user','search','post','site','publicprofile','reservation','message','money'];
if (Yii::$app->controller->id == "site" && (Yii::$app->controller->action->id == "index" || Yii::$app->controller->action->id == "information")) {
    $menuItem1 = "";
    $menuItem2 = "";
    if(Yii::$app->user->isGuest){
     $menuItem3 = "";
    $menuItem4 = "";   
    }else{
    $menuItem3 = "noDisplay";
    $menuItem4 = "noDisplay";
    }
    $menuItem5 = "noDisplay";
    $menuItem6 = "noDisplay";
} elseif (Yii::$app->controller->id == "site" && Yii::$app->controller->action->id == "login") {
    $menuItem1 = "";
    $menuItem2 = "";
    $menuItem3 = "";
    $menuItem4 = "";
    $menuItem5 = "noDisplay";
    $menuItem6 = "noDisplay";
} elseif (Yii::$app->controller->id == "registration" && Yii::$app->controller->action->id == "index") {
    $menuItem1 = "noDisplay";
    $menuItem2 = "noDisplay";
    $menuItem3 = "noDisplay";
    $menuItem4 = "noDisplay";
    $menuItem5 = "";
    $menuItem6 = "";
} elseif (in_array(Yii::$app->controller->id, $accessController) && in_array(Yii::$app->controller->action->id, $accessAction)) {
    $menuItem1 = "";
    $menuItem2 = "";
    if(Yii::$app->user->isGuest){
     $menuItem3 = "";
    $menuItem4 = "";   
    }else{
    $menuItem3 = "noDisplay";
    $menuItem4 = "noDisplay";
    }
    $menuItem5 = "noDisplay";
    $menuItem6 = "noDisplay";
} else {
    $menuItem1 = "";
    $menuItem2 = "";
    $menuItem3 = "";
    $menuItem4 = "";
    $menuItem5 = "";
    $menuItem6 = "";
}
?>
<!--<header class="header">
    <div class="nav-sec">
        <div id="navigation" class="animated">
            <nav class="navbar navbar-custom" role="navigation">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="site-logo">
                                <a href="<?= Yii::$app->urlManager->createUrl("/") ?>" class="brand"><img class="img-responsive" src="<?= $this->context->getProjectLogo() ?>" alt=""/></a>                                                   
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu" style="z-index: 9999999999;"><i class="fa fa-bars"></i></button>
                            </div>
                        </div>
                        <div class="col-sm-9">
                             Brand and toggle get grouped for better mobile display 
                             Collect the nav links, forms, and other content for toggling 
                            <div class="collapse navbar-collapse" id="menu">
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="<?= $menuItem1 ?>"><a href="<?= Yii::$app->urlManager->createUrl('search/searchtrip') ?>" class="" >Busca un viaje</a></li>
                                    <li class="<?= $menuItem2 ?>"><a href="<?= Yii::$app->urlManager->createUrl('post/create') ?>" class="" >Publica un viaje</a></li>
                                    <li class="<?= $menuItem3 ?>"><a href="<?= Yii::$app->urlManager->createUrl('registration/index') ?>" class="">Regístrate</a></li>
                                    <li class="<?= $menuItem4 ?>"><a href="<?= Yii::$app->urlManager->createUrl('site/login') ?>" class="" >¿Ya eres miembro? Conéctate</a></li>
                                    <li class="<?= $menuItem5 ?>"><a href="" class="linkDisabled" ></a></li>
                                    <li class="<?= $menuItem6 ?>"><a href="<?= Yii::$app->urlManager->createUrl('site/login') ?>" class="">¿Ya eres miembro? Conéctate</a></li>
                                    <?php if (!Yii::$app->user->isGuest) : ?>
                                        <li>
                                            <div class="btn-group show-on-hover-2">
                                                <span data-toggle="dropdown">
                                                    <img class="img-responsive img-circle headr-prof-pic" src="<?= $this->context->getUserProfileImage() ?>" alt="">
                                                </span>
                                                                                                    <i class="fa fa-angle-down fa-fw" aria-hidden="true"></i>
                                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                    <li><a href="<?= Yii::$app->urlManager->createUrl('user/profile') ?>"><i class="fa fa-user fa-fw" aria-hidden="true"></i>Editar perfil</a></li>
                                                    <li><a href="<?php // Yii::$app->urlManager->createUrl('user/bankDetails') ?>"><i class="fa fa-user fa-fw" aria-hidden="true"></i>Editar perfil</a></li>
                                                    <li><a href="<?= Yii::$app->urlManager->createUrl('user/changepassword') ?>"><i class="fa fa-lock fa-fw" aria-hidden="true"></i>Cambia la contraseña</a></li>
                                                    <li><a href="<?= Yii::$app->urlManager->createUrl('site/logout') ?>"><i class="fa fa-power-off fa-fw" aria-hidden="true"></i>Cerrar sesión</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                             /.Navbar-collapse 
                        </div>
                    </div>
                </div> 
            </nav>
        </div>    
    </div>    
</header>-->
<!-- Header Section Start -->
    <div class="header">    
      <nav class="navbar navbar-default main-navigation" role="navigation">
           <!-- End Toggle Nav Link For Mobiles -->
           <a class="navbar-brand logo" href="index.html"><img src="assets/img/logo.png" alt="" style="padding-left: 0px; padding-top: 0px; height: 65px;"></a>
        <div class="container">
          <div class="navbar-header">
            <!-- Stat Toggle Nav Link For Mobiles -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
           
          </div>
          <!-- brand and toggle menu for mobile End -->

          <!-- Navbar Start -->
          <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="login.html"><i class="lnr lnr-enter"></i> Login</a></li>
              <li><a href="signup.html"><i class="lnr lnr-user"></i> Signup</a></li>
              <li class="postadd">
                <a class="btn btn-danger btn-post" href="post-ads.html"><span class="fa fa-plus-circle"></span> Post an Ad</a>
              </li>
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
          <ul class="nav navmenu-nav"> <!--- Menu -->
            <li><a href="index.html">Home V1</a></li>
            <li><a href="index-v-2.html">Home Page V2</a></li>
            <li><a href="index-v-3.html">Home Page V3</a></li>
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
        </ul><!--- End Menu -->
      </div> <!--- End Off Canvas Side Menu -->
      </div> <!--- End Off Canvas Side Menu -->
      <div class="tbtn wow pulse" id="menu" data-wow-iteration="infinite" data-wow-duration="500ms" data-toggle="offcanvas" data-target=".navmenu">
        <p><i class="fa fa-file-text-o"></i> All Pages</p>
      </div>
    </div>
    <!-- Header Section End -->