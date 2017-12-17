<?php

use yii\db\Query;
use app\models\TripLocation;
if(count($results)>0){
    foreach($results as $k=>$val){
        $val=(object)$val;
?>
<div class="item-list">
                <div class="col-sm-2 no-padding photobox">
                  <div class="add-image">
                    <a href="javascript:;"><img src="<?=$this->context->getCategoryImage($image_folder_name,$val->image);?>" alt=""></a>
                    <span class="photo-count"><i class="fa fa-camera"></i>2</span>
                  </div>
                </div>
                <div class="col-sm-7 add-desc-box">
                  <div class="add-details">
                      <h5 class="add-title"><a href="ads-details.html"><?= (strlen($val->name)>20)?substr($val->name, 0, 100).'..':$val->name?></a></h5>
                    <div class="info">
                      <span class="add-type">B</span>
                      <span class="date">
                        <i class="fa fa-clock"></i>
                        16:22:13 2017-02-29
                      </span> -
                      <span class="category">Electronics</span> -
                      <span class="item-location"><i class="fa fa-map-marker"></i>London</span>
                    </div>
                    <div class="item_desc">
                      <a href="#">Donec ut quam felis. Cras egestas, quam in plac erat dictum, erat mauris inte rdum est nec.</a>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3 text-right  price-box">
                  <h2 class="item-price"> $ 320 </h2>
                  <a class="btn btn-danger btn-sm"><i class="fa fa-certificate"></i>
                  <span>Top Ads</span></a> 
                  <a class="btn btn-common btn-sm"> <i class="fa fa-eye"></i> <span>215</span> </a> 
                </div>
              </div>
<?php }}else{ ?>
<div class="row">
        <div class="col-md-12 text-center">
            <h2>No Data Found!!</h2>
        </div>
    </div>
<?php } ?>