<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
?>
<!-- Main container Start -->  
<div class="main-container">
    <div class="container">
        <div class="row">
            <?= Yii::$app->controller->renderPartial('@app/views/layouts/search_leftbar.php'); ?>
            <div class="col-sm-9 page-content">
                <!-- Product filter Start -->
                <div class="product-filter">
                    <div class="grid-list-count">
                        <a class="list switchToGrid" href="#"><i class="fa fa-list"></i></a>
                        <a class="grid switchToList" href="#"><i class="fa fa-th-large"></i></a>
                    </div>
                    <div class="short-name">
                        <span>Short By</span>
                        <form class="name-ordering" method="post">
                            <label>
                                <select name="order" class="orderby">
                                    <option selected="selected" value="menu-order">Short by</option>
                                    <option value="popularity">Price: Low to High</option>
                                    <option value="popularity">Price: High to Low</option>
                                </select>
                            </label>
                        </form>
                    </div>
                    <div class="Show-item">
                        <span>Show Items</span>
                        <form class="woocommerce-ordering" method="post">
                            <label>
                                <select name="order" class="orderby">
                                    <option selected="selected" value="menu-order">49 items</option>
                                    <option value="popularity">popularity</option>
                                    <option value="popularity">Average ration</option>
                                    <option value="popularity">newness</option>
                                    <option value="popularity">price</option>
                                </select>
                            </label>
                        </form>
                    </div>
                </div>
                <!-- Product filter End -->

                <!-- Adds wrapper Start -->
                <div id="output">
                    
                </div>
<!--                <div class="adds-wrapper" id="search-result">

                </div>
                 Adds wrapper End 

                 Start Pagination 
                <div class="pagination-bar">
                    <ul class="pagination">
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#"> ...</a></li>
                        <li><a class="pagination-btn" href="#">Next »</a></li>
                    </ul>
                </div>
                 End Pagination -->

                <div class="post-promo text-center">
                    <h2> Do you get anything for sell ? </h2>
                    <h5>Sell your products online FOR FREE. It's easier than you think !</h5>
                    <a href="post-ads.html" class="btn btn-post btn-danger">Post a Free Ad </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->registerJsFile(
        Yii::$app->request->baseUrl . '/themes/frontend/custom/js/search.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>