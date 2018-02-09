<?php

use yii\db\Query;
use app\models\TripLocation;

if (count($results) > 0) {
    //die($total_no_pages);
    foreach ($results as $k => $val) {
        $val = (object) $val;
        ?>
        <div class="item-list">
            <input type="hidden" id="pagecount" value="<?= isset($total_no_pages) ? $total_no_pages : "8" ?>">
            <div class="col-sm-2 no-padding photobox">
                <div class="add-image">
                    <a href="javascript:;"><img src="<?= $this->context->getCategoryImage($image_folder_name, $val->image); ?>" alt=""></a>
                    <span class="photo-count"><i class="fa fa-camera"></i>1</span>
                </div>
            </div>
            <div class="col-sm-7 add-desc-box">
                <div class="add-details">
                    <h5 class="add-title"><a href="javascript:void(0)"><?= (strlen($val->name) > 20) ? substr($val->name, 0, 100) . '..' : $val->name ?></a></h5>
                    <div class="info">
                        <span class="add-type"><i class="<?= isset($fa_icon) ? $fa_icon . ' fa-2x' : ''; ?>"></i></span>
        <!--                            <span class="date">
                            
                            16:22:13 2017-02-29
                        </span> --->
                        <span class="category">Contact No</span> -<?= isset($val->contact_no) ? $val->contact_no : ''; ?>
                        <?php
                        $city = \app\models\Cities::find()->select('name')->where(["id" => $val->city_id])->one();
                        ?>
                        <span class="item-location"><i class="fa fa-map-marker"></i><?= isset($city->name) ? $city->name : ''; ?></span>
                    </div>
                    <div class="item_desc">
                        <a href="#">Address: <?= isset($val->address) ? (strlen($val->address) > 500) ? substr($val->address, 0, 400) . '..' : $val->address : 'Not available'; ?></a>
                    </div>
                    <div class="item_desc">
                        <a href="#">Description: <?= isset($val->description) ? (strlen($val->description) > 500) ? substr($val->description, 0, 400) . '..' : $val->description : 'Not available'; ?></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 text-right  price-box">
                <!--                    <h2 class="item-price"> $ 320 </h2>-->
                <a class="btn btn-danger btn-sm"><i class="fa fa-certificate"></i>
                    <span>View Details</span></a> 
                <a class="btn btn-common btn-sm"> <i class="fa fa-map-marker"></i> <span>Location</span> </a> 
            </div>
        </div>
        <?php
    }
} else {
    ?>
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>No Data Found!!</h2>
        </div>
    </div>
<?php } ?>

