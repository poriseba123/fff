<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\ArrayHelper;

//echo "<pre>";
//print_r($all_data);
$city_list = \app\models\Cities::find()->where(["id" => (isset($all_data['result']['city_id']) && $all_data['result']['city_id'] != '') ? $all_data['result']['city_id'] : 0])->all();
$state_list = \app\models\States::find()->where(["id" => (isset($all_data['result']['state_id']) && $all_data['result']['state_id'] != '') ? $all_data['result']['state_id'] : 0])->all();
$category_list = \app\models\ServicesList::find()->where(["id" => (isset($all_data['categories']) && $all_data['categories'] != "") ? $all_data['categories'] : 0])->all();
$day_master = \app\models\DayMaster::find()->where(["id" => (isset($all_data['result']['close_day']) && $all_data['result']['close_day'] != '') ? $all_data['result']['close_day'] : 0])->all();
//print_r($day_master);
?>
<!-- Start Content -->
<div id="content">
    <div class="container">
        <div class="row">
            <!-- Product Info Start -->
            <div class="product-info">
                <div class="col-sm-8">
                    <div class="inner-box ads-details-wrapper">
                        <h2><?= isset($all_data['result']['name']) ? $all_data['result']['name'] : 'No data found'; ?></h2>
                        <p class="item-intro"><span class="poster">Last Updated<span class="ui-bubble is-member">-</span> <span class="date"> <?= date('d M, Y h:i A', strtotime($all_data['result']['updated_at'])); ?></span> from <span class="location"><?= !empty($city_list) ? $city_list[0]->name : 'No data found'; ?>,<?= !empty($state_list) ? $state_list[0]->name : 'No data found'; ?></span></p>
                        <div id="owl-demo" class="owl-carousel owl-theme">
                            <div class="item">
                                <img src="<?= (isset($all_data['result']['image']) && $all_data['result']['image'] != '') ? Yii::$app->request->baseUrl . '\uploads' . '\\' . $all_data['imagefolder'] . '\original\\' . $all_data['result']['image'] : Yii::$app->request->baseUrl . '\uploads\noimage\noimg.jpg' ?>" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="box">
                        <h2 class="title-2"><strong>Details</strong></h2>
                        <div class="row">
                            <div class="ads-details-info col-md-8">
                                <?php
                                $pin = 'N/A';
                                if (isset($all_data['result']['pin'])) {
                                    $pin = $all_data['result']['pin'];
                                }
                                ?>
                                <p class="mb15">Address: <?= (isset($all_data['result']['address']) && $all_data['result']['address'] != '') ? $all_data['result']['address'] . ', PIN-' . $pin : 'No data found'; ?></p>
                                <p class="mb15">Description: <?= (isset($all_data['result']['description']) && $all_data['result']['description'] != '') ? $all_data['result']['description'] : 'No data found'; ?></p>
                                <?php
                                if ($all_data['categories'] == '2') {
                                    $test_name = array();
                                    $medical_tests_lists = \app\models\Hospitalfacility::find()->all();
                                    $listData = ArrayHelper::map($medical_tests_lists, 'id', 'name');
                                    if (isset($all_data['result']['facility']) && $all_data['result']['facility'] != '') {
                                        $arr = explode(",", $all_data['result']['facility']);

                                        foreach ($arr as $index => $value) {
                                            $test_name[] = $listData[$value];
                                        }
                                    }
                                    ?>
                                    <p class="mb15">Facility:  <?= (isset($test_name) && !empty($test_name)) ? implode(",", $test_name) : "Not known"; ?></p>
                                <?php } else if ($all_data['categories'] == '5' || $all_data['categories'] == '4') {
                                    ?>
                                    <p class="mb15">Vehicle Number: <?= (isset($all_data['result']['vehicle_no']) && $all_data['result']['vehicle_no'] != '') ? $all_data['result']['vehicle_no'] : 'No data found'; ?></p>
                                    <?php
                                } else if ($all_data['categories'] == '6') {
                                    $test_name = array();
                                    $medical_tests_lists = \app\models\MedicalTests::find()->all();
                                    $listData = ArrayHelper::map($medical_tests_lists, 'id', 'name');
                                    if (isset($all_data['result']['medical_tests']) && $all_data['result']['medical_tests'] != '') {
                                        $arr = explode(",", $all_data['result']['medical_tests']);

                                        foreach ($arr as $index => $value) {
                                            $test_name[] = $listData[$value];
                                        }
                                    }
                                    if ($all_data['result']['website']) {
                                        $url = $all_data['result']['website'];
                                    }
                                    ?>
                                    <p class="mb15">Medical Test: <?= (isset($test_name) && !empty($test_name)) ? implode(",", $test_name) : "No data found"; ?></p>
                                    <p class="mb15">Other Facility: <?= (isset($all_data['result']['others']) && $all_data['result']['others'] != '') ? $all_data['result']['others'] : 'No data found'; ?></p>
                                    <p class="mb15">Website: <?= (isset($all_data['result']['website']) && $all_data['result']['website'] != '') ? "<a href='$url' target='_blank'>" . $all_data['result']['website'] . "</a>" : 'No data found'; ?></p>

                                <?php } else if ($all_data['categories'] == '12' || $all_data['categories'] == '17') {
                                    ?>
                                    <p class="mb15">Facility:  <?= (isset($all_data['result']['facility']) && !empty($all_data['result']['facility'])) ? $all_data['result']['facility'] : "Not known"; ?></p>
                                    <?php
                                } else if ($all_data['categories'] == '18' || $all_data['categories'] == '19') {
                                    if ($all_data['result']['website']) {
                                        $url = $all_data['result']['website'];
                                    }
                                    ?>
                                    <p class="mb15">Website: <?= (isset($all_data['result']['website']) && $all_data['result']['website'] != '') ? "<a href='$url' target='_blank'>" . $all_data['result']['website'] . "</a>" : 'No data found'; ?></p>
                                    <?php
                                }
                                ?>
                                <ul class="list-circle">

                                    <?php
                                    if ($all_data['categories']) {
                                        if ($all_data['categories'] == '11') {      /// for eye bank
                                            echo '<p class="mb15"><B>FREE EYE CHECK UP TIME</b></p>';
                                            $day_master = \app\models\DayMaster::find()->all();
                                            $listData = ArrayHelper::map($day_master, 'id', 'day');
//print_r($day_master);
                                            if ($all_data['result']['free_eyetest']) {
                                                $eyetest_arr = json_decode($all_data['result']['free_eyetest']);
                                                if (!empty($eyetest_arr)) {
                                                    foreach ($eyetest_arr as $index => $content) {
                                                        $temp_arr = explode("-", $content);
                                                        $start_time[$temp_arr[0]] = $temp_arr[1];
                                                        $end_time[$temp_arr[0]] = $temp_arr[2];
                                                        ?>
                                                        <li><i class="fa fa-check-circle"></i> <?= $listData[$temp_arr[0]] . '  Open-' . $start_time[$temp_arr[0]] . ' - ' . 'Close-' . $end_time[$temp_arr[0]]; ?> </li>
                                                        <?php
                                                    }
                                                }
                                                //die();
                                            }
                                        } else if ($all_data['categories'] == '2') {       // for nursing home
                                            $type_list = \app\models\Typeofhospital::find()->where(["id" => (isset($all_data['result']['type']) && $all_data['result']['type'] != '') ? $all_data['result']['type'] : 0])->all();
                                            ?>
                                            <li><i class="fa fa-check-circle"></i>Type: <?= !empty($type_list) ? $type_list[0]->name : ''; ?></li>
                                            <li><i class="fa fa-check-circle"></i>Emergency Word: <?= ( isset($all_data['result']['emergency']) && $all_data['result']['emergency'] != '') ? ($all_data['result']['emergency'] == "1") ? 'Yes' : 'No' : 'Not known'; ?></li>
                                            <li><i class="fa fa-check-circle"></i>Operation Theater: <?= ( isset($all_data['result']['ot']) && $all_data['result']['ot'] != '') ? ($all_data['result']['ot'] == "1") ? 'Yes' : 'No' : 'Not known'; ?></li>
                                            <li><i class="fa fa-check-circle"></i>Life Support: <?= ( isset($all_data['result']['life_support']) && $all_data['result']['life_support'] != '') ? ($all_data['result']['life_support'] == "1") ? 'Yes' : 'No' : 'Not known'; ?></li>
                                            <li><i class="fa fa-check-circle"></i>Own Ambulance Service: <?= ( isset($all_data['result']['ambulance']) && $all_data['result']['ambulance'] != '') ? ($all_data['result']['ambulance'] == "1") ? 'Yes' : 'No' : 'Not known'; ?></li>
                                            <li><i class="fa fa-check-circle"></i>Own Medical Shop: <?= ( isset($all_data['result']['medicine_shop']) && $all_data['result']['medicine_shop'] != '') ? ($all_data['result']['medicine_shop'] == "1") ? 'Yes' : 'No' : 'Not known'; ?></li>
                                            <li><i class="fa fa-check-circle"></i>Payment(Other than cash accepted): <?= ( isset($all_data['result']['payment_otherthancash']) && $all_data['result']['payment_otherthancash'] != '') ? ($all_data['result']['payment_otherthancash'] == "1") ? 'Yes' : 'No' : 'Not known'; ?></li>
                                            <li><i class="fa fa-check-circle"></i>Outdoor: <?= ( isset($all_data['result']['outdore']) && $all_data['result']['outdore'] != '') ? ($all_data['result']['outdore'] == "1") ? 'Yes' : 'No' : 'Not known'; ?></li>
                                            <?php
                                        } else if ($all_data['categories'] == '5') {       // for motuary van
                                            ?>
                                            <li><i class="fa fa-check-circle"></i>Ac: <?= ( isset($all_data['result']['ac']) && $all_data['result']['ac'] != '') ? ($all_data['result']['ac'] == "1") ? 'Yes' : 'No' : 'Not known'; ?></li>
                                            <?php
                                        } else if ($all_data['categories'] == '4') {       // for ambulance
                                            ?>
                                            <li><i class="fa fa-check-circle"></i>24X7(available): <?= ( isset($all_data['result']['all_time']) && $all_data['result']['all_time'] != '') ? ($all_data['result']['all_time'] == "1") ? 'Yes' : 'No' : 'Not known'; ?></li>
                                            <li><i class="fa fa-check-circle"></i>Oxygen: <?= ( isset($all_data['result']['oxygen']) && $all_data['result']['oxygen'] != '') ? ($all_data['result']['oxygen'] == "1") ? 'Yes' : 'No' : 'Not known'; ?></li>
                                            <li><i class="fa fa-check-circle"></i>Ac: <?= ( isset($all_data['result']['ac']) && $all_data['result']['ac'] != '') ? ($all_data['result']['ac'] == "1") ? 'Yes' : 'No' : 'Not known'; ?></li>
                                            <li><i class="fa fa-check-circle"></i>Life-support system: <?= ( isset($all_data['result']['lifesupport']) && $all_data['result']['lifesupport'] != '') ? ($all_data['result']['lifesupport'] == "1") ? 'Yes' : 'No' : 'Not known'; ?></li>
                                            <?php
                                        } else if ($all_data['categories'] == '6') {       // for digonistick center home
                                            ?>
                                            <li><i class="fa fa-check-circle"></i>E-report(available): <?= ( isset($all_data['result']['e_report']) && $all_data['result']['e_report'] != '') ? ($all_data['result']['e_report'] == "1") ? 'Yes' : 'No' : 'Not known'; ?></li>
                                            <li><i class="fa fa-check-circle"></i>Home collection: <?= ( isset($all_data['result']['home_collection']) && $all_data['result']['home_collection'] != '') ? ($all_data['result']['home_collection'] == "1") ? 'Yes' : 'No' : 'Not known'; ?></li>
                                            <?php
                                        } else if ($all_data['categories'] == '8') {       // for aya center
                                            ?>
                                            <li><i class="fa fa-check-circle"></i>Aya for child(available): <?= ( isset($all_data['result']['baby_siter']) && $all_data['result']['baby_siter'] != '') ? ($all_data['result']['baby_siter'] == "1") ? 'Yes' : 'No' : 'Not known'; ?></li>
                                            <li><i class="fa fa-check-circle"></i>Male aya: <?= ( isset($all_data['result']['male_aya']) && $all_data['result']['male_aya'] != '') ? ($all_data['result']['male_aya'] == "1") ? 'Yes' : 'No' : 'Not known'; ?></li>
                                            <?php
                                        } else if ($all_data['categories'] == '12') {      /// old age home
                                            $type_list = \app\models\Typeofhospital::find()->where(["id" => (isset($all_data['result']['type']) && $all_data['result']['type'] != '') ? $all_data['result']['type'] : 0])->all();
                                            ?>
                                            <li><i class="fa fa-check-circle"></i>Type: <?= !empty($type_list) ? $type_list[0]->name : ''; ?></li>
                                            <li><i class="fa fa-check-circle"></i>No of rooms: <?=
                                                ( isset($all_data['result']['noof_room']) && $all_data['result']['noof_room'] != '') ?
                                                        $all_data['result']['noof_room'] : 'Not known';
                                                ?></li>
                                            <li><i class="fa fa-check-circle"></i>Ac: <?= ( isset($all_data['result']['ac']) && $all_data['result']['ac'] != '') ? ($all_data['result']['ac'] == "1") ? 'Yes' : 'No' : 'Not known'; ?></li>
                                            <?php
                                        } else if ($all_data['categories'] == '17') {      /// orphan  home
                                            $type_list = \app\models\Typeofhospital::find()->where(["id" => (isset($all_data['result']['type']) && $all_data['result']['type'] != '') ? $all_data['result']['type'] : 0])->all();
                                            ?>
                                            <li><i class="fa fa-check-circle"></i>Type: <?= !empty($type_list) ? $type_list[0]->name : ''; ?></li>
                                            <li><i class="fa fa-check-circle"></i>No of rooms: <?=
                                                ( isset($all_data['result']['noof_room']) && $all_data['result']['noof_room'] != '') ?
                                                        $all_data['result']['noof_room'] : 'Not known';
                                                ?></li>
                                            <li><i class="fa fa-check-circle"></i>Child(sex): <?= ( isset($all_data['result']['sex_flag']) && $all_data['result']['sex_flag'] != '') ? ($all_data['result']['sex_flag'] == "1") ? 'Female' : ($all_data['result']['sex_flag'] == "0") ? "Male" : "Male/Female"  : 'Not known'; ?></li>
                                            <?php
                                        } else if ($all_data['categories'] == '18' || $all_data['categories'] == '19') {       // for gym/yoga
                                            ?>

                                            <li><i class="fa fa-check-circle"></i>Trainer(sex): <?= ( isset($all_data['result']['trainer_sex']) && $all_data['result']['trainer_sex'] != '') ? ($all_data['result']['trainer_sex'] == "1") ? 'Female' : ($all_data['result']['trainer_sex'] == "0") ? "Male" : "Male/Female"  : 'Not known'; ?></li>
                                            <li><i class="fa fa-check-circle"></i>Only for(sex): <?= ( isset($all_data['result']['sexof_traines']) && $all_data['result']['sexof_traines'] != '') ? ($all_data['result']['sexof_traines'] == "1") ? 'Female' : ($all_data['result']['sexof_traines'] == "0") ? "Male" : "Male/Female"  : 'Not known'; ?></li>
                                            <li><i class="fa fa-check-circle"></i>Ac: <?= ( isset($all_data['result']['ac']) && $all_data['result']['ac'] != '') ? ($all_data['result']['ac'] == "1") ? 'Yes' : 'No' : 'Not known'; ?></li>

                                            <?php
                                        }
                                    }
                                    ?>
<!--                                    <li>
                                        <a href="javascript:void(0);"> <i class="fa fa-share-alt"></i> Share <div class="sharethis-inline-share-buttons"></div></a> 
                                    </li>-->

                                </ul>
                            </div>
                            <div class="col-md-4">
                                <aside class="panel panel-body panel-details">
                                    <ul>
                                        <li>
                                            <p class="no-margin"><strong>Type:</strong> <a href="javascript:void(0)"><?= !empty($category_list) ? $category_list[0]->name : 'No data found'; ?></a></p>
                                        </li>
                                        <li>
                                            <p class="no-margin"><strong>Establishment Date:</strong> <a href="javascript:void(0)"><?= !empty($all_data['result']['establishment_date']) ? date('d M, Y h:i A', strtotime($all_data['result']['establishment_date'])) : 'No data found'; ?></a></p>
                                        </li>
                                        <li>
                                            <p class="no-margin"><strong>Location:</strong> <a href="javascript:void(0)"><?= !empty($city_list) ? $city_list[0]->name : 'No data found'; ?>,<?= !empty($state_list) ? $state_list[0]->name : 'No data found'; ?></a></p>
                                        </li>
                                        <li>
                                            <p class=" no-margin "><strong>Open Time:</strong> <?= isset($all_data['result']['open_time']) ? $all_data['result']['open_time'] : 'No data found'; ?></p>
                                        </li>
                                        <li>
                                            <p class="no-margin"><strong>Close Time:</strong> <a href="javascript:void(0)"><?= isset($all_data['result']['close_time']) ? $all_data['result']['close_time'] : 'No data found'; ?></a></p>
                                        </li>
                                        <li>
                                            <p class="no-margin"><strong>Close Day:</strong> <a href="javascript:void(0)"><?= !empty($day_master) ? $day_master[0]->day : 'No data found'; ?></a></p>
                                        </li>
                                    </ul>
                                </aside>

                                <div class="ads-action">
                                    <ul class="list-border">
                                        <?php
                                        if ($all_data['result']['contact_no']) {
                                            $contact_array = explode(',', $all_data['result']['contact_no']);
                                            if (!empty($contact_array)) {
                                                foreach ($contact_array as $key => $value) {
                                                    ?>
                                                    <li>
                                                        <a href="javascript:void(0)"> <i class=" fa fa-phone"></i> <?= isset($value) ? $value : 'No data found'; ?> </a></li>
                                                    <li>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>

                                            <!--                                        <li>
                                                                                        <a href="#">Posted by <i class=" fa fa-user"></i> Admin</a></li>-->
                                            <!--                                        <li>
                                                                                        <a href="#"> <i class=" fa fa-heart"></i> Save ad</a></li>
                                                                                    <li>-->

                                            <!--                                            <div class="social-link">  -->

<!--                                                <a class="twitter" target="_blank" data-original-title="twitter" href="#" data-toggle="tooltip" data-placement="top"><i class="fa fa-twitter"></i></a>
<a class="facebook" target="_blank" data-original-title="facebook" href="#" data-toggle="tooltip" data-placement="top"><i class="fa fa-facebook"></i></a>
<a class="google" target="_blank" data-original-title="google-plus" href="#" data-toggle="tooltip" data-placement="top"><i class="fa fa-google"></i></a>
<a class="linkedin" target="_blank" data-original-title="linkedin" href="#" data-toggle="tooltip" data-placement="top"><i class="fa fa-linkedin"></i></a>-->
                                            <!--                                            </div>-->

                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="inner-box">
                        <div class="widget-title">
                            <h4>Advertisement</h4>
                        </div>
                        <img src="assets/img/img1.jpg" alt="">
                    </div>
                    <div class="col-xs-12">
                        <div class="features-box wow fadeInDownQuick" data-wow-delay="0.3s">
                            <div class="features-icon">
                                <i class="lnr lnr-star">
                                </i>
                            </div>
                            <div class="features-content">
                                <h4>
                                    Fraud Protection
                                </h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere. 
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="features-box wow fadeInDownQuick" data-wow-delay="0.6s">
                            <div class="features-icon">
                                <i class="lnr lnr-chart-bars"></i>
                            </div>
                            <div class="features-content">
                                <h4>
                                    No Extra Fees 
                                </h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere. 
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="features-box wow fadeInDownQuick" data-wow-delay="0.9s">
                            <div class="features-icon">
                                <i class="lnr lnr-spell-check"></i>
                            </div>
                            <div class="features-content">
                                <h4>
                                    Verified Data
                                </h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere. 
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="features-box wow fadeInDownQuick" data-wow-delay="0.9s">
                            <div class="features-icon">
                                <i class="lnr lnr-smile"></i>
                            </div>
                            <div class="features-content">
                                <h4>
                                    Friendly Return Policy
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
    </div>
    <!-- End Content -->

    <!-- Related Products Start -->
    <section class="featured-lis mb30" >
        <div class="container">
            <div class="row">
                <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
                    <h3 class="section-title">Related Products</h3>
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
                                <a href="ads-details.html" class="item-name">Feugiat nulla facilisis</a>  
                                <span class="price">$45</span>  
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
                                <a href="ads-details.html" class="item-name">Feugiat nulla facilisis</a>  
                                <span class="price">$1120</span>  
                            </div>
                        </div>


                    </div>
                </div>
            </div> 
        </div>
</div>
