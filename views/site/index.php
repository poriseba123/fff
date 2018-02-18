<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\ArrayHelper;

Yii::$app->userCounter->refresh();
$online_user = Yii::$app->userCounter->getOnline();
$total_visitor = Yii::$app->userCounter->getMaximal();
?>

<div class="wrapper">
    <!-- Categories Homepage Section Start -->
    <section id="categories-homepage">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-title"><?= isset($landing_page[0]->listing_line)?strip_tags($landing_page[0]->listing_line):'';?></h3>
                </div>
                <?php
                if (isset($all_services) && count($all_services) > 0) {
                    foreach ($all_services as $key => $val) {
                        $catagories = $val->id;
                        ?>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="category-box <?= $val->border_color ?> wow fadeInUpQuick" data-wow-delay="0.9s">
                                <div class="icon">
                                    <a href="<?= Yii::$app->request->baseUrl . "/search/index?cityid=&categories=$catagories&state=&city=&keyword=" ?>" target="_blank"><i class="<?= $val->fa_icon ?>"></i></a>
                                </div>
                                <div class="category-header">
                                    <a href="<?= Yii::$app->request->baseUrl . "/search/index?cityid=&categories=$catagories&state=&city=&keyword=" ?>" target="_blank">
                                        <h4><?= $val->name ?></h4>
                                    </a>
                                </div>
                                <div class="category-content">
                                    <ul>
                                        <?php
                                        $total[] = 0;
                                        $result = $val->model::find()->select(['*,COUNT(id) as cityrow_count'])->where(['status' => '1'])->groupBy(['city_id'])->all();

                                        if (isset($result) && count($result) > 0) {
                                            foreach ($result as $key => $val) {
                                                $state_id = $val->state_id;
                                                $city_id = $val->city->id;
                                                $total[] = $val->cityrow_count;
                                                ?>
                                                <li>
                                                    <a href="<?= Yii::$app->request->baseUrl . "/search/index?cityid=&categories=$catagories&state=$state_id&city=$city_id&keyword=" ?>" target="_blank"><?= $val->city->name ?></a>
                                                    <span class="category-counter"><?= $val->cityrow_count ?></span>
                                                </li>
                                                <?php
                                                if ($key == 5) {
                                                    break;
                                                }
                                            }
                                            ?>
                                            <li>
                                                <a href="<?= Yii::$app->request->baseUrl . "/search/index?cityid=&categories=$catagories&state=&city=&keyword=" ?>" target="_blank">View all →</a>
                                            </li>
                                        <?php } else { ?>
                                            <li>
                                                <a href="javascript:void(0)">No Data Found</a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                <?php } ?>

            </div>
        </div>
    </section>
    <!-- Categories Homepage Section End -->
    <!-- Featured Listings Start -->
    <?php
    $medicalnews_list = \app\models\MedicalnewsMaster::find()->where(['status' => '1'])->all();
    if (!empty($medicalnews_list)) {
        ?>
        <section class="featured-lis" >
            <div class="container">
                <div class="row">
                    <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
                        <h3 class="section-title"><?= isset($landing_page[0]->slider_line)?strip_tags($landing_page[0]->slider_line):'';?></h3>
                        <div id="new-products" class="owl-carousel">
                            <?php
                            foreach ($medicalnews_list as $key => $value) {
                                ?>
                                <div class="item">
                                    <div class="product-item">
                                        <div class="carousel-thumb">
                                            <img src="<?= (isset($value->image) && $value->image != '') ? Yii::$app->request->baseUrl . '\uploads\medicalnews\thumbnail\\' . $value->image : Yii::$app->request->baseUrl . '\uploads\noimage\noimg.jpg' ?>" alt=""> 
                                            <div class="overlay">
                                                <a href="<?= $value->link; ?>"><i class="fa fa-link"></i></a>
                                            </div>
                                        </div>
                                        <a href="<?= $value->link; ?>" class="item-name" target="_blank"><?= substr($value->description, 0, 50) . ".."; ?></a>  
                                        <br>
                                        <span class="info">Sourse:<?= $value->sourse; ?></span>
                                    </div>
                                </div>
                            <?php }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php }
    ?>

    <!-- Featured Listings End -->
    <!-- Start Services Section -->
    <?php
    $feature_list = \app\models\Homepagefeatures::find()->all();
    ?>
    <div class="features">
        <div class="container">
            <div class="row">
                <?php
                foreach ($feature_list as $key => $value) {
                    ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="features-box wow fadeInDownQuick" data-wow-delay="0.3s">
                            <div class="features-icon">
                                <i class="fa <?= $value->fav_icon; ?>">
                                </i>
                            </div>
                            <div class="features-content">
                                <h4>
                                    <?= $value->heading; ?>
                                </h4>
                                <p>
                                    <?= $value->description; ?> 
                                </p>
                            </div>
                        </div>
                    </div>
                <?php }
                ?>
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
                        <p><?= isset($landing_page[0]->subscription_line)?ucfirst(strip_tags($landing_page[0]->subscription_line)):'';?></p>
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
<?php
$total_count = 0;
if (!empty($total)) {
    foreach ($total as $key => $value) {
        $total_count += $value;
    }
}
?>
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
                        <h3 class="counter"><?= isset($all_services) ? count($all_services) : 0 ?></h3>
                        <p>Total Services</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="counting wow fadeInDownQuick" data-wow-delay="1s">
                    <div class="icon">
                        <span>
                            <i class="lnr lnr-users"></i>
                        </span>
                    </div>
                    <div class="desc">
                        <h3 class="counter"><?= isset($online_user) ? $online_user : 0; ?></h3>
                        <p>Online User</p>
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
                        <h3 class="counter"><?= isset($total_visitor) ? $total_visitor : 0; ?></h3>
                        <p>Total Visitor</p>
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
                        <h3 class="counter"><?= isset($total_count) ? $total_count : 0; ?></h3>
                        <p>Total Listed Data</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>






