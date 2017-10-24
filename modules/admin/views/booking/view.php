<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'View Booking';
$this->params['breadcrumbs'][] = $this->title;
?>


<!--<h1 class="page-title">View refund request</h1>-->
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">View Booking</span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form class="form-horizontal">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Passenger Name:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?=$model->userDetails->first_name.' '.$model->userDetails->last_name?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Driver Name:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?=$model->tripMasterDetails->userDetails->first_name.' '.$model->tripMasterDetails->userDetails->last_name?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Booking Id:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?=$model->trackId?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Trip Details:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?=$model->userDetailsTripLocationStart->location_a_name.' => '.$model->userDetailsTripLocationEnd->location_b_name?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Trip Time:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?=$model->userDetailsTripLocationStart->departure_datetime.' => '.$model->userDetailsTripLocationEnd->arrival_datetime?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Paid Amount($):</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?=$model->total_price?></p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="form-actions text-right">
                <a href="<?= Url::to(['claimrefund/']); ?>" class="btn default">Back</a>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>