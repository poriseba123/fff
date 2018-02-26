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
            <?php
//Yii::$app->controller->renderPartial('@app/views/layouts/search_leftbar.php'); 
            ?>
            <div class="col-sm-1"></div>
            <div class="col-sm-10 page-content">


                <!-- Product filter Start -->
                <div class="product-filter">
                    <div class="row">
                        <?php
                        if ($total_results_count > 0) {
                            ?>
                            <div class="col-sm-2">
                                <div class="grid-list-count">
                                    <a class="list switchToGrid" href="#"><i class="fa fa-list"></i></a>
                                    <a class="grid switchToList" href="#"><i class="fa fa-th-large"></i></a>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div style="float: right;">
                                    <ul class="pagination-sm pagination sync-pagination"></ul>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="Show-item">
                                    <span>Show Items</span>
                                    <form class="woocommerce-ordering" method="post">
                                        <label>
                                            <select name="order" class="orderby" id="setlimit">
                                                <option selected="selected" value="5"> 5 items</option>
                                                <option value="10">10 items</option>
                                                <option value="20">20 items</option>
                                                <option value="30">30 items</option>
                                                <option value="50">50 items</option>

                                            </select>
                                        </label>
                                    </form>
                                </div>
                            </div>
                        <?php }
                        ?>

                    </div>



<!--                                            <span>Short By</span>
                            <form class="name-ordering" method="post">
                                <label>
                                    <select name="order" class="orderby">
                                        <option selected="selected" value="menu-order">Short by</option>
                                        <option value="popularity">Price: Low to High</option>
                                        <option value="popularity">Price: High to Low</option>
                                    </select>
                                </label>
                            </form>-->


                </div>
                <!-- Product filter End -->

                <!-- Adds wrapper Start -->

                <div class="<?= ($total_results_count == 0) ? '' : 'adds-wrapper' ?>" id="search-result">
                    <?php
                    if ($total_results_count == 0) {
                        ?>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h2>No Data Found!!</h2>
                            </div>
                        </div>
                    <?php }
                    ?>
                </div>
                <!--                 Adds wrapper End -->

                <!--                 Start Pagination -->
                <div class="pagination-bar">
                    <ul  class="pagination-sm pagination sync-pagination"></ul>
                </div>
                <!--                 End Pagination -->

                <!--                <div class="post-promo text-center">
                                    <h2> Do you get anything for sell ? </h2>
                                    <h5>Sell your products online FOR FREE. It's easier than you think !</h5>
                                    <a href="post-ads.html" class="btn btn-post btn-danger">Post a Free Ad </a>
                                </div>-->
            </div>
            <div class="col-sm-1"></div>
        </div>
    </div>
</div>
<!-- Start Pagination -->
<?php
$total_no_pages = 0;
if ((int) $total_results_count > 0) {
    $result = (int) ($total_results_count % $limit);
    if ($result == 0) {
        (int) $total_no_pages = (int) ($total_results_count / $limit);
    } else {
        (int) $total_no_pages = (int) ($total_results_count / $limit) + 1;
    }
}
?>
<form id="details" action="/search/details">

    <input type="hidden" name="city"  value="<?= isset($city)?$city:''; ?>">
    <input type="hidden" name="state"  value="<?= isset($state)?$state:''; ?>">
    <input type="hidden" name="categories" value="<?= isset($categories)?$categories:''; ?>">
    <input type="hidden" name="table"  value="<?= isset($category_table)?$category_table:''; ?>">
    <input type="hidden" name="imagefolder"  value="<?=  isset($image_folder_name)?$image_folder_name:''; ?>">
    <input type="hidden" name="id"  id="contentid" value="">
</form>
<form id="detailslocation" action="/search/location">

    <input type="hidden" name="city"  value="<?= isset($city)?$city:''; ?>">
    <input type="hidden" name="state"  value="<?= isset($state)?$state:''; ?>">
    <input type="hidden" name="categories" value="<?= isset($categories)?$categories:''; ?>">
    <input type="hidden" name="table"  value="<?= isset($category_table)?$category_table:''; ?>">
    <input type="hidden" name="imagefolder"  value="<?=  isset($image_folder_name)?$image_folder_name:''; ?>">
    <input type="hidden" name="id"  id="locationcontentid" value="">
</form>
<!-- End Pagination -->
<!--http://jsfiddle.net/freedawirl/dc4zebow/-->


<?php
$this->registerJsFile(
        Yii::$app->request->baseUrl . '/themes/frontend/custom/js/search.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>
<script src="http://esimakin.github.io/twbs-pagination/js/jquery.twbsPagination.js"></script> 
<script>
    function  pagination(paged = false) {
        if (paged != false) {
            Pages = parseInt("<?= $total_no_pages; ?>");
        } else {
            Pages = parseInt($("#pagecount").val());
        }
        if (Pages > 0) {
            $('.sync-pagination').twbsPagination({
                totalPages: Pages,
                visiblePages: 4,
                onPageClick: function (event, page) {
                    setTimeout(function () {
                        paged = false;
                    }, 10);
                    items_per_page = parseInt($("#limit").val());
                    offset = (page - 1) * items_per_page;
                    $("#offset").val(offset);
                    if (paged == false) {
                        search();
                    }
                }
            })
    }
    }
    $(document).ready(function () {
        pagination("<?= $total_no_pages; ?>");
        $("#setlimit").change(function () {
            $('#loader').css("display", "block");
            $('.sync-pagination').twbsPagination('destroy');
            $("#limit").val($(this).val());
            search();
            setTimeout(function () {
                pagination();
            }, 400);
        });

    });

</script>