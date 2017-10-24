<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\models\ContestMaster;
use yii\widgets\ActiveForm;

$this->title = 'User Identity';
$this->params['breadcrumbs'][] = ["label" => $this->title, "url" => ["index"]];
$this->title = 'View Identity Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="page-title">View user Identification Details</h1>
<div class="row">
    <div class="col-md-12">
        <div class="profile-sidebar">
            <div class="portlet light profile-sidebar-portlet ">
                <div class="profile-userpic">
                    <img src="<?= $this->context->getProfilePicture($model->id) ?>" onerror="this.src='<?= $this->context->getProfileImgErrorImg() ?>'" class="img-responsive" alt=""> </div>
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> <?= $model->first_name . ' ' . $model->last_name ?> </div>
                </div>
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="<?= (Yii::$app->controller->id == "users" && Yii::$app->controller->action->id == "editdetails") ? "active" : "" ?>">
                            <a href="<?= Yii::$app->urlManager->createUrl(["admin/users/editdetails", "id" => $model->id]) ?>">
                                <i class="fa fa-user" aria-hidden="true"></i> User Details 
                            </a>
                        </li>
                        <?php if ($model->identity_document_verified != 0) : ?>
                            <li class="<?= (Yii::$app->controller->id == "usersidentity" && Yii::$app->controller->action->id == "view") ? "active" : "" ?>">
                                <a class="<?= (Yii::$app->controller->id == "usersidentity" && Yii::$app->controller->action->id == "view") ? "linkDisabled" : "" ?>" href="<?= Yii::$app->urlManager->createUrl(["admin/usersidentity/view", "id" => $model->id]) ?>">
                                    <i class="fa fa-car" aria-hidden="true"></i> User Identity 
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (isset($model->vehicle) && ($model->vehicle->status != 2 || $model->vehicle->status != 3)) : ?>
                            <li class="<?= (Yii::$app->controller->id == "driverrequest" && Yii::$app->controller->action->id == "view") ? "active" : "" ?>">
                                <a class="<?= (Yii::$app->controller->id == "driverrequest" && Yii::$app->controller->action->id == "view") ? "linkDisabled" : "" ?>" href="<?= Yii::$app->urlManager->createUrl(["admin/driverrequest/view", "id" => $model->vehicle->id]) ?>">
                                    <i class="fa fa-car" aria-hidden="true"></i> Vehicle Details 
                                </a>
                            </li>
                        <?php endif; ?>
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
                                        <span class="caption-subject font-blue-madison bold uppercase">User Identity Details</span>
                                    </div>
                                    <hr/>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Driver Name</label>
                                            <input type="hidden" name="userId" id="userId" value="<?php echo $model->id ?>"/>
                                            <input type="text" name="userId" class="form-control" disabled="true" id="userId" value="<?= $model->first_name . " " . $model->last_name ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Identification Photo</label>
                                            <img src="<?= $this->context->getUserIdentificationImage($model->id) ?>" class="img-responsive"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 form-group" id="vehicleActionContainer" style="border-bottom: 1px solid #eeeeee; padding-bottom: 15px;">
                                        <?php
                                        if ($model->identity_document_verified == 2) {
                                            $vehicleShowAppBtn = "";
                                            $vehicleShowCancelBtn = "";
                                            $vehicleShowStatusDiv = "noDisplay";
                                            $vehicleStatusMsg = "";
                                        } elseif ($model->identity_document_verified == 1) {
                                            $vehicleShowAppBtn = "noDisplay";
                                            $vehicleShowCancelBtn = "noDisplay";
                                            $vehicleShowStatusDiv = "";
                                            $vehicleStatusMsg = "User Identity Document has been approved";
                                        } elseif ($model->identity_document_verified == 3) {
                                            $vehicleShowAppBtn = "noDisplay";
                                            $vehicleShowCancelBtn = "noDisplay";
                                            $vehicleShowStatusDiv = "";
                                            $vehicleStatusMsg = "User Identity Document has been declined";
                                        }
                                        ?>
                                        <a href="<?= Yii::$app->urlManager->createUrl(["admin/usersidentity/approveduseridentity", "id" => $model->id]) ?>" class="btn btn-info pull-right <?= $vehicleShowAppBtn ?>" id="vehicleApproved" data-targetId="<?= $model->id ?>" >Approved Identity Document</a>
                                        <a href="<?= Yii::$app->urlManager->createUrl(["admin/usersidentity/canceluseridentity", "id" => $model->id]) ?>" class="btn alert-warning pull-left <?= $vehicleShowCancelBtn ?>" id="vehicleCancellation" data-targetId="<?= $model->id ?>" >Cancel Identity Document</a>
                                        
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
