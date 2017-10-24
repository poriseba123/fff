<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'View Reports';
$this->params['breadcrumbs'][] = $this->title;
?>


<!--<h1 class="page-title">View refund request</h1>-->
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">View refund request</span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form class="form-horizontal">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Reported person:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?=$model->toUserDetails->first_name.' '.$model->toUserDetails->last_name?>(<?=$model->toUserDetails->email?>)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Who Report:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?=$model->fromUserDetails->first_name.' '.$model->fromUserDetails->last_name?>&nbsp;(<?=$model->fromUserDetails->email?>)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Reported Time:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?=$model->created_at?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Reason:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?=$model->reason?></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
            <div class="form-actions text-right">
                <a href="<?= Url::to(['report/']); ?>" class="btn default">Back</a>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>