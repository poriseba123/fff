<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;

$this->title = 'Update Claim & Refund requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
  
    #bookingmaster-refund_status label{
        margin-left:25px;
    }
</style>

<!--<h1 class="page-title">View refund request</h1>-->
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">View Claim & Refund request</span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <?php
        $form = ActiveForm::begin([
                    'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
                    'enableClientValidation' => false
                ])
        ?>
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">User Name:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?=$model->userDetails->first_name.' '.$model->userDetails->last_name?></p>
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
                            <label class="control-label col-md-3">Request for cancellation Time:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?=$model->request_time?>&nbsp;(<?=$this->context->getTimeDifference($model->request_time,$model->userDetailsTripLocationStart->departure_datetime)?>
                                    <?php 
                                    if(strtotime($model->request_time)>strtotime($model->userDetailsTripLocationStart->departure_datetime)){
                                        echo " after";
                                    }else{
                                        echo " before";
                                    }
                                    ?>
                                    )</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Paid Amount:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?=$model->total_price?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Refund Amount:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php 
                                    if(strtotime($model->request_time)<strtotime($model->userDetailsTripLocationStart->departure_datetime)){
                                       if($this->context->getTimeDifferenceinHour($model->request_time,$model->userDetailsTripLocationStart->departure_datetime)>24){
                                           echo round($model->total_price);
                                       }else{
                                           echo round($model->total_price/2);
                                       }
                                    }else{
                                        echo "0";
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Reason Category:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?=$model->reason_category?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Reason:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?=$model->cancel_reason?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Bank Owner Name:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?=(isset($model->bankDetails) && $model->bankDetails->owner_name!='')?$model->bankDetails->owner_name:'No Set';?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Banknote Number:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?=(isset($model->bankDetails) && $model->bankDetails->banknote_number!='')?$model->bankDetails->banknote_number:'No Set';?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Bank Name:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?=(isset($model->bankDetails) && $model->bankDetails->bank_name!='')?$model->bankDetails->bank_name:'No Set';?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Account Number:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><?=(isset($model->bankDetails) && $model->bankDetails->account_number!='')?$model->bankDetails->account_number:'No Set';?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Account Type:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php if(isset($model->bankDetails) && $model->bankDetails->account_type!=''){
                                    if($model->bankDetails->account_type==1){
                                    echo "Savings";
                                }else{
                                    echo "Current";
                                }
                                    }else{
                                        echo "No Set";
                                    }
?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (!$model->isNewRecord) { ?>
                <div class="row">
                    <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label col-md-3">Refund Status <span class="required">*</span></label>
                    <div class="col-md-6">
                        <div class="radio-list">                        
                            <label class="radio-inline">
                                <?= $form->field($model, 'refund_status')->radioList(['1' => 'Refunded', '0' => 'Pending'])->label(false); ?>
                            </label>
                        </div>
                    </div>
                </div>
                </div>
                </div>
            <?php } ?>
                
            </div>
            <div class="form-actions text-right">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn green']) ?>
                <a href="<?= Url::to(['claimrefund/']); ?>" class="btn default">Back</a>
            </div>
        <?php ActiveForm::end() ?>
        <!-- END FORM-->
    </div>
</div>