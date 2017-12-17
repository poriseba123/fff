<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Manage District Details';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
//$this->title = $model->route;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">District Details</span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form class="form-horizontal" role="form">
            <div class="form-body">
 
				
				<div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">State:</label>
                            <div class="col-md-9">
							<?php
							 
									$state_list = \app\models\States::find()->where(["id" => (isset($model->state_id) && $model->state_id != '') ? $model->state_id : 0])->all();
									$listData = ArrayHelper::map($state_list,'id','name');
									$listData=implode(" ",$listData);
									 
							?>
                                <p class="form-control-static"> <?= (isset($listData) && $listData != '') ? $listData : "Not Set"; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">District Name:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?= (isset($model->name) && $model->name != '') ? $model->name : "Not Set"; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
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
                                <a href="<?php echo Url::toRoute(['district/update', 'id' => $model->id]); ?>" class="btn green">Edit</a>
                                <a href="<?php echo Url::to(['district/index']); ?>" class="btn default">Back</a>
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

