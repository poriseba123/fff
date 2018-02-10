<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\ArrayHelper;
use app\models\ServicesList;

$aboutusContent = \app\models\AboutUs::find()->all();
$aboutusContent = $aboutusContent[0];
$all_services = ServicesList::find()->where(['status' => '1'])->all();
?>
<!-- Main container Start -->  
<div class="main-container">
    <div class="container">
        <div class="row">          
            <div class="col-sm-8">
                <div class="embed-responsive embed-responsive-16by9">
                    <?= isset($aboutusContent->youtube_url) ? $aboutusContent->youtube_url : ''; ?>
                </div>
                <div class="ad-detail-content">
                    <?= isset($aboutusContent->description) ? $aboutusContent->description : ''; ?>
                </div>
            </div>
            <div class="col-sm-4 page-sidebar">
                <aside>
                    <div class="inner-box">
                        <?php
                        if (isset($all_services) && count($all_services) > 0) {
                            ?>
                            <div class="categories">
                                <div class="widget-title">
                                    <i class="fa fa-align-justify"></i>
                                    <h4>All Categories</h4>
                                </div>
                                <div class="categories-list">
                                    <ul>
                                        <?php
                                        foreach ($all_services as $key => $val) {

                                            $result = $val->model::find()->where(['status' => '1'])->all();
                                            ?>
                                            <li>
                                                <a href="<?= Yii::$app->request->baseUrl . "/search/index?cityid=&categories=$val->id&state=&city=&keyword=" ?>" target="_blank"">
                                                    <i class="fa fa-desktop"></i>
                                                    <?= isset($val->name) ? $val->name : ''; ?> <span class="category-counter">(<?= isset($result) ? count($result) : 0 ?>)</span>
                                                </a>
                                            </li>
                                        <?php }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                    <!--                    <div class="inner-box">
                                            <div class="widget-title">
                                                <h4>Premium Ads</h4>
                                            </div>
                                            <div class="advimg">
                                                <ul class="featured-list">
                                                    <li>
                                                        <img alt="" src="<?= Yii::$app->request->baseUrl; ?>/assets/img/featured/img1.jpg">
                                                        <div class="hover">
                                                            <a href="#"><span>$49</span></a>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <img alt="" src="<?= Yii::$app->request->baseUrl; ?>/assets/img/featured/img2.jpg">
                                                        <div class="hover">
                                                            <a href="#"><span>$49</span></a>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <img alt="" src="<?= Yii::$app->request->baseUrl; ?>/assets/img/featured/img3.jpg">
                                                        <div class="hover">
                                                            <a href="#"><span>$49</span></a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>-->
                    <!--                    <div class="inner-box">
                                            <div class="widget-title">
                                                <h4>Advertisement</h4>
                                            </div>
                                            <img src="<?= Yii::$app->request->baseUrl; ?>/assets/img/img1.jpg" alt="">
                                        </div>-->
                </aside>
            </div>
        </div>
    </div>
</div>
<!-- Main container End -->  
