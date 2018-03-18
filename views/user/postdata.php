<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\ArrayHelper;
use app\models\ServicesList;
use app\models\HospitalNursingMaster;
use app\models\MedicineShopMaster;
use app\models\AmbulanceMaster;
use app\models\MortuaryMaster;
use app\models\DiagnosticCentre;
use app\models\EyeBankMaster;
use app\models\BloodBankMaster;
use app\models\Oldagehome;

$all_services = ServicesList::find()->where(['status' => '1'])->all();
?>
<!-- Main container Start -->  
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <div class="page-ads box">
                    <h2 class="title-2">Post A Free Classified Ad</h2><!-- Start Search box -->
                    <div class="row search-bar mb30 red-bg">
                        <div class="advanced-search">
                            <form class="search-form" method="get">
                                <div class="col-md-12 col-sm-12 col-xs-12 search-col">
                                    <div class="input-group-addon search-category-container">
                                        <label class="styled-select">
                                            <span class="hidden-sm hidden-xs">Category </span>
                                            <select class="dropdown-product selectpicker" name="usercategories" id="usercategory_id" data-live-search="true"  >
                                                <option value="">All Categories</option>
                                                <?php
                                                $id = Yii::$app->request->get('category');

                                                if (isset($all_services) && count($all_services) > 0) {

                                                    foreach ($all_services as $key => $val) {
                                                        ($id == $val->id) ? $selected = "selected" : $selected = '';
                                                        ?>
                                                        <option class="subitem" value="<?= $val->id ?>" <?= $selected; ?>><?= $val->name ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </label>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div><!-- End Search box -->
                    <?php
                    if ($id != '') {
                        if ($id == "2") { // hospital
                            $model = new HospitalNursingMaster;
                            include('hospitalnursinghome_form.php');
                        } else if ($id == "3") { // medicine shop
                            $model = new MedicineShopMaster;
                            include('medicineshop_form.php');
                        } else if ($id == "4") {  // ambulane
                            $model = new AmbulanceMaster;
                            include('ambulance_form.php');
                        } else if ($id == "5") {    // motoary van
                            $model = new MortuaryMaster;
                            include('motuaryvan_form.php');
                        } else if ($id == "6") {    // digonistic center
                            $model = new DiagnosticCentre;
                            include('digonisticcenter_form.php');
                        } else if ($id == "8") {     //nurse aya
                        } else if ($id == "10") { // blood bank
                            $model = new BloodBankMaster;
                            include('bloodbank_form.php');
                        } else if ($id == "11") {       //Eye Bank
                            $model = new EyeBankMaster;
                            include('eyebank_form.php');
                        } else if ($id == "12") {    //Old Age Home
                            $model = new Oldagehome;
                            include('oldage_form.php');
                        } else if ($id == "17") { //Orphan Home
                        } else if ($id == "18") {       //Gym Center
                        } else if ($id == "19") { //Yoga Center
                        }
                    }
                    ?>
                    <div class="mb30"></div>
                    <div class="form-group">
                        <div class="page-ads box">
                            <p></p>
                            <div class="checkbox">
                                <label><input type="checkbox"> I agree to the <a href="#">Terms of Use</a></label>
                            </div><br>
                            <button class="btn btn-common" type="button">Submit for review</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- Main container End -->  
