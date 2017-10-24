<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">View User Details</span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form class="form-horizontal">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Name:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?php echo (isset($model->first_name) && $model->first_name != null) ? ucfirst(strtolower($model->first_name)) : "Not Given"; ?>  <?php echo (isset($model->last_name) && $model->last_name != null) ? ucfirst(strtolower($model->last_name)) : ""; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Email:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?php echo (isset($model->email) && $model->email != null) ? $model->email : "Not Given"; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Address:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?php echo (isset($user_det->address) && $user_det->address != null) ? $user_det->address : "Not Given"; ?> </p>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Status:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?php
                                    if ($model->status == 1) {
                                        echo "Active";
                                    } else if ($model->status == 2) {
                                        echo "Suspended";
                                    } else {
                                        echo "Inactive";
                                    }
                                    ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions text-right">
<!--                <a href="<?php // echo Url::to(['users/update', 'id' => $model->id]); ?>" class="btn green">
                    <i class="fa fa-pencil"></i> Edit
                </a>-->
                <a href="<?php echo Url::to(['users/index']); ?>" class="btn default">Back</a>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>
