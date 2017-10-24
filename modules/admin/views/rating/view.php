<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Ratings';
$this->params['breadcrumbs'][] = $this->title;
?>


<!--<h1 class="page-title">View refund request</h1>-->
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">View Ratings</span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form class="form-horizontal">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Driver:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?=$model->driverDetails->first_name.' '.$model->driverDetails->last_name?>(<?=$model->driverDetails->email?>)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Passenger:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?=$model->userDetails->first_name.' '.$model->userDetails->last_name?>&nbsp;(<?=$model->userDetails->email?>)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Booking Id:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?=$model->bookingDetails->trackId?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Rating:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?=($model->rating>1)?$model->rating.' stars':$model->rating.' star';?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Review:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?=$model->review?></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
            <div class="form-actions text-right">
                <a href="<?= Url::to(['rating/']); ?>" class="btn default">Back</a>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>