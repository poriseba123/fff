<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\models\ContestMaster;
use yii\widgets\ActiveForm;

$this->title = 'Requested Driver List';
$this->params['breadcrumbs'][] = ["label" => $this->title, "url" => ["index"]];
$this->title = 'View Driver Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="page-title">View Driver Detail</h1>
<div class="row">
    <div class="col-md-12">
        <div class="profile-sidebar">
            <div class="portlet light profile-sidebar-portlet ">
                <div class="profile-userpic">
                    <img src="<?= $this->context->getProfilePicture($model->userDetails->id) ?>" onerror="this.src='<?= $this->context->getProfileImgErrorImg() ?>'" class="img-responsive" alt=""> </div>
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> <?= $model->userDetails->first_name . ' ' . $model->userDetails->last_name ?> </div>
                </div>
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="<?= (Yii::$app->controller->id == "users" && Yii::$app->controller->action->id == "editdetails") ? "active" : "" ?>">
                            <a href="<?= Yii::$app->urlManager->createUrl(["admin/users/editdetails", "id" => $model->user_id]) ?>">
                                <i class="fa fa-user" aria-hidden="true"></i> User Details 
                            </a>
                        </li>
                        <?php if ($model->userDetails->identity_document_verified != 0) : ?>
                            <li class="<?= (Yii::$app->controller->id == "usersidentity" && Yii::$app->controller->action->id == "view") ? "active" : "" ?>">
                                <a class="<?= (Yii::$app->controller->id == "usersidentity" && Yii::$app->controller->action->id == "view") ? "linkDisabled" : "" ?>" href="<?= Yii::$app->urlManager->createUrl(["admin/usersidentity/view", "id" => $model->user_id]) ?>">
                                    <i class="fa fa-car" aria-hidden="true"></i> User Identity 
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="<?= (Yii::$app->controller->id == "driverrequest" && Yii::$app->controller->action->id == "view") ? "active" : "" ?>">
                            <a class="<?= (Yii::$app->controller->id == "driverrequest" && Yii::$app->controller->action->id == "view") ? "linkDisabled" : "" ?>" href="<?= Yii::$app->urlManager->createUrl(["admin/driverrequest/view", "id" => $model->id]) ?>">
                                <i class="fa fa-car" aria-hidden="true"></i> Vehicle Details 
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-body">
                            <div class="clearfix">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption caption-md">
                                        <i class="fa fa-id-card" aria-hidden="true"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase">Driving License Details</span>
                                    </div>
                                    <hr/>
                                </div>
                                <?php
                                if ($user->drive_image_verification == 0) {
                                    $showAppBtn = "";
                                    $showCancelBtn = "";
                                    $showStatusDiv = "noDisplay";
                                    $statusMsg = "";
                                    $disabled = "disabled";
                                } elseif ($user->drive_image_verification == 1) {
                                    $showAppBtn = "noDisplay";
                                    $showCancelBtn = "noDisplay";
                                    $showStatusDiv = "";
                                    $disabled = "disabled";
                                    $statusMsg = "Driving Licence has been approved";
                                } elseif ($user->drive_image_verification == 2) {
                                    $showAppBtn = "noDisplay";
                                    $showCancelBtn = "noDisplay";
                                    $showStatusDiv = "";
                                    $statusMsg = "Driving Licence has been declined";
                                    $disabled = "disabled";
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Driver Name</label>
                                            <input type="hidden" name="userId" id="userId" value="<?php echo $model->user_id ?>"/>
                                            <input type="text" name="userId" class="form-control" disabled="true" id="userId" value="<?= $user->first_name . " " . $user->last_name ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">License Number</label>
                                            <input type="text" name="UserMaster[driving_id]" <?= $disabled ?> class="form-control" id="usermaster-driving_id" value="<?= $user->driving_id ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Driving Experience (in years)</label>
                                            <input type="number" name="UserMaster[driving_exp]" <?= $disabled ?> min="0" max="50" class="form-control" id="usermaster-driving_exp" value="<?= $user->driving_exp ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet-title tabbable-line">
                                    <div class="caption caption-md">
                                        <i class="fa fa-car" aria-hidden="true"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase">Vehicle Details</span>
                                    </div>
                                    <hr/>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Vehicle Brand</label>
                                            <input type="text" name="UserVehicle[car_brand]" class="form-control" disabled="true" id="uservehicle-car_brand" value="<?= $model->vBrand->brand ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Vehicle Model</label>
                                            <input type="text" name="UserVehicle[car_model]" class="form-control" disabled="true" id="uservehicle-car_model" value="<?= $model->vModel->model_no ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Vehicle Color</label>
                                            <div class="input-group">
                                                <input type="text" name="UserVehicle[color]" class="form-control" disabled="true" id="uservehicle-car_brand" value="<?= $model->vColor->color_name_en . " (" . $model->vColor->color_code . ")" ?>"/>
                                                <div class="input-group-addon"><span class="vehicel-color-span" id="vehicel-color-span" style="background-color: <?= $model->vColor->color_code ?>"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Vehicle Plate Number</label>
                                            <input type="text" name="UserVehicle[plate_number]" class="form-control" disabled="true" id="uservehicle-plate_number" value="<?= $model->plate_number ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Vehicle Image</label>
                                            <img src="<?= $this->context->getUserVehicleImg($model->car_img) ?>" class="drivingimage img-responsive"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 form-group" id="vehicleActionContainer" style="border-bottom: 1px solid #eeeeee; padding-bottom: 15px;">
                                        <?php
                                        if ($model->status == 0) {
                                            $vehicleShowAppBtn = "";
                                            $vehicleShowCancelBtn = "";
                                            $vehicleShowStatusDiv = "noDisplay";
                                            $vehicleStatusMsg = "";
                                        } elseif ($model->status == 1) {
                                            $vehicleShowAppBtn = "noDisplay";
                                            $vehicleShowCancelBtn = "noDisplay";
                                            $vehicleShowStatusDiv = "";
                                            $vehicleStatusMsg = "Vehicle has been approved";
                                        } elseif ($model->status == 2) {
                                            $vehicleShowAppBtn = "noDisplay";
                                            $vehicleShowCancelBtn = "noDisplay";
                                            $vehicleShowStatusDiv = "";
                                            $vehicleStatusMsg = "Vehicle has been declined";
                                        }
                                        ?>
                                        <button class="btn btn-info pull-right <?= $vehicleShowAppBtn ?>" id="vehicleApproved" data-targetId="<?= $model->id ?>" onclick="vehicleAccepted(this)">Accept Vehicle Request</button>
                                        <button class="btn alert-warning pull-left <?= $vehicleShowCancelBtn ?>" id="vehicleCancellation" data-targetId="<?= $model->id ?>" onclick="vehicleNotAccepted(this)">Cancel Vehicle Request</button>
                                        <div class="alert alert-success text-center <?= $vehicleShowStatusDiv ?>" id="vehicleStatusMsg" role="alert">
                                            <strong> <?= $vehicleStatusMsg ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a class="btn green btn-sm btn-outline dropdown-toggle pull-right" href="<?= Yii::$app->request->referrer; ?>"> <i class="fa fa-reply"></i> Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>

<div class="modal fade" id="cancelDrivingLicence" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Reason for Driving Licence Cancellation</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="form" id="cancelDrivingLicenceForm" name="cancelDrivingLicenceForm" method="post">
                        <div class="col-sm-12 col-md-12">
                            <div class="clearfix form-group">
                                <label class="label-control">Cause for Cancellation:</label>
                                <input type="hidden" id="drivingUserId" name="userId" value=""/>
                                <input type="hidden" id="drivingUserType" name="type" value=""/>
                                <textarea name="causeOfDLCCancellation" id="causeOfDLCCancellation" class="form-control" placeholder="Please provide cancellation cause"></textarea>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="clearfix form-group">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="cancelVehicleFormModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Reason for Driving Licence Cancellation</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="form" id="cancelVehicleForm" name="cancelVehicleForm" method="post">
                        <div class="col-sm-12 col-md-12">
                            <div class="clearfix form-group">
                                <label class="label-control">Cause for Cancellation:</label>
                                <input type="hidden" id="vehicleTargetId" name="targetId" value=""/>
                                <input type="hidden" id="vehicleUserType" name="type" value=""/>
                                <textarea name="causeOfVehicleCancellation" id="causeOfVehicleCancellation" class="form-control" placeholder="Please provide cancellation cause"></textarea>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="clearfix form-group">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
