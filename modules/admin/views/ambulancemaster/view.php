<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Manage Doctor Specialities';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
//$this->title = $model->route;
$this->params['breadcrumbs'][] = $this->title;
//;
//print_r($countryname);
//die();
//print_r($ambulance_contact);
?>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">Ambulance Details</span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form class="form-horizontal" role="form">
            <div class="form-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Country:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?= (isset($model->country_id) && $model->country_id != '') ? $countryname = \app\models\Countries::find()->select('name')->where(["id" => $model->country_id])->one()->name : "Not Set"; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">State:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?= (isset($model->state_id) && $model->state_id != '') ? $statename = \app\models\States::find()->select('name')->where(["id" => $model->state_id])->one()->name : "Not Set"; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">City:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?= (isset($model->city_id) && $model->city_id != '') ? $cityname = \app\models\Cities::find()->select('name')->where(["id" => $model->city_id])->one()->name : "Not Set"; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Title:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?= (isset($model->title) && $model->title != '') ? $model->title : "Not Set"; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Vehicle number:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?= (isset($model->vehiclenumber) && $model->vehiclenumber != '') ? $model->vehiclenumber : "Not Set"; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Address:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?= (isset($model->address) && $model->address != '') ? $model->address : "Not Set"; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if (count($ambulance_contact) > 0) {
                    foreach ($ambulance_contact as $key => $value) {
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Contact Number <?= $key + 1; ?>:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?= (isset($value->contact_number) && $value->contact_number != '') ? $value->contact_number : "Not Set"; ?> </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                }
                ?>



                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Location in Map:</label>
                            <div class="col-md-9">
                                <div id="map" style="height: 324px;width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">24X7 Available:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?= (isset($model->all_time) && $model->all_time == '1') ? 'Yes' : "No"; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Oxygen:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?= (isset($model->oxygen) && $model->oxygen == '1') ? 'Yes' : "No"; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">AC:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?= (isset($model->ac) && $model->ac == '1') ? 'Yes' : "No"; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <a href="<?php echo Url::toRoute(['ambulancemaster/update', 'id' => $model->id]); ?>" class="btn green">Edit</a>
                                <a href="<?php echo Url::to(['ambulancemaster/index']); ?>" class="btn default">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6"> </div>
                </div>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>
<script>
    $(document).ready(function () {
<?php
if ($model->lat != "" && $model->longi != "") {
    ?>
            var myLatlng = new google.maps.LatLng(<?= $model->lat ?>, <?= $model->longi ?>);
            var myOptions = {
                zoom: 5,
                center: myLatlng,
                scrollwheel: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }

            var map = new google.maps.Map(document.getElementById("map"), myOptions),
                    marker = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                        draggable: false,
                    });
<?php }
?>


    })

</script>