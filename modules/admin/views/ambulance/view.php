<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Manage Ambulance Details';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
//$this->title = $model->route;
$this->params['breadcrumbs'][] = $this->title;

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
                            <label class="control-label col-md-3">Name:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?= (isset($model->name) && $model->name != '') ? $model->name : "Not Set"; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Vehicle No:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?= (isset($model->vehicle_no) && $model->vehicle_no != '') ? $model->vehicle_no : "Not Set"; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">address:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?= (isset($model->address) && $model->address != '') ? $model->address : "Not Set"; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Country:</label>
                            <div class="col-md-9">
							<?php
							 
									$country_list = \app\models\Countries::find()->where(["id" => (isset($model->country_id) && $model->country_id != '') ? $model->country_id : 0])->all();
									$listData = ArrayHelper::map($country_list,'id','name');
									 
							?>
                                <p class="form-control-static"> <?= (isset($listData[0]) && $listData[0] != '') ? $listData[0] : "Not Set"; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">State:</label>
                            <div class="col-md-9">
							<?php
							 
									$state_list = \app\models\States::find()->where(["id" => (isset($model->state_id) && $model->state_id != '') ? $model->state_id : 0])->all();
									$listData = ArrayHelper::map($state_list,'id','name');
									 
							?>
                                <p class="form-control-static"> <?= (isset($listData[0]) && $listData[0] != '') ? $listData[0] : "Not Set"; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">District:</label>
                            <div class="col-md-9">
							<?php
							 
									$district_list = \app\models\Districts::find()->where(["id" => (isset($model->district_id) && $model->district_id != '') ? $model->district_id : 0])->all();
									$listData = ArrayHelper::map($district_list,'id','name');
									 
							?>
                                <p class="form-control-static"> <?= (isset($listData[0]) && $listData[0] != '') ? $listData[0] : "Not Set"; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">City:</label>
                            <div class="col-md-9">
							<?php
							 
									$city_list = \app\models\Cities::find()->where(["id" => (isset($model->city_id) && $model->city_id != '') ? $model->city_id : 0])->all();
									$listData = ArrayHelper::map($city_list,'id','name');
									 
							?>
                                <p class="form-control-static"> <?= (isset($listData[0]) && $listData[0] != '') ? $listData[0] : "Not Set"; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
				 <div class="form-body">
					<div class="form-group">
						<label class="control-label col-md-3">Map<span class="required">*</span></label>
						<div class="col-md-6">
							
							
							<div id="map" style="height: 324px;width: 100%;"></div>
						</div>
						
					</div>
				</div>
				<div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">24 X 7:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?= (isset($model->all_time) && $model->all_time == '1') ? 'Yes' : "No"; ?> </p>
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
                            <label class="control-label col-md-3">Life support:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?= (isset($model->lifesupport) && $model->lifesupport == '1') ? 'Yes' : "No"; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Description:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?= (isset($model->description) && $model->description != '') ? $model->description : "Not Set"; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
				<?php
					$contacts = explode(',', $model->contact_no);
                        foreach ($contacts as $key => $value) {
							?>
							<div class="row">
								<div class="col-md-12">
								
								
									<div class="form-group">
										<label class="control-label col-md-3">Contact No <?= $key+1;?>:</label>
										<div class="col-md-9">
											<p class="form-control-static"> <?= (isset($value) && $value!= '') ? $value : "Not Active"; ?> </p>
										</div>
									</div>
								</div>
							</div>
							
						<?php
						}
					
					?>
					
				
				
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Status:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?= (isset($model->status) && $model->status == '1') ? 'Active' : "Not Active"; ?> </p>
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
                                <a href="<?php echo Url::toRoute(['ambulance/update', 'id' => $model->id]); ?>" class="btn green">Edit</a>
                                <a href="<?php echo Url::to(['ambulance/index']); ?>" class="btn default">Back</a>
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
 map='';
 global_markers = [];    
 markers = [[<?= (isset($model->latitude) && $model->latitude != '') ? $model->latitude : 20.5937; ?>, <?= (isset($model->longitude) && $model->longitude != '') ? $model->longitude : 78.9629; ?>, <?= (isset($model->address) && $model->address != '') ? "'".$model->address."'" : "Not Set"; ?>]];


function initialize() {
	
 infowindow = new google.maps.InfoWindow({});
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(20.5937, 78.9629);
    var myOptions = {
        zoom: 15,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map"), myOptions);
    addMarker();
}

function addMarker() {
    for (var i = 0; i < markers.length; i++) {
        // obtain the attribues of each marker
        var lat = parseFloat(markers[i][0]);
        var lng = parseFloat(markers[i][1]);
        var trailhead_name = markers[i][2];

        var myLatlng = new google.maps.LatLng(lat, lng);

        var contentString = "<html><body><div><p><h2>" + trailhead_name + "</h2></p></div></body></html>";

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: "Coordinates: " + lat + " , " + lng + " | Trailhead name: " + trailhead_name
        });

        marker['infowindow'] = contentString;

        global_markers[i] = marker;
		map.setCenter(marker.getPosition());  

        google.maps.event.addListener(global_markers[i], 'click', function() {
            infowindow.setContent(this['infowindow']);
            infowindow.open(map, this);
        });
    }
}

window.onload = initialize;

</script>
