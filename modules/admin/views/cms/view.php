<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Static Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">View Static Page Details</span>
        </div>
    </div>
    <div class="portlet-body form">
        <form class="form-horizontal">
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-2 control-label">Slug:</label>
                    <div class="col-md-6">
                        <span class="form-control-static"> <?php echo (isset($model->slug) && $model->slug != null) ? $model->slug : "Not Given"; ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Page Name:</label>
                    <div class="col-md-6">
                        <span class="form-control-static"> <?php echo (isset($model->page_name) && $model->page_name != null) ? $model->page_name : "Not Given"; ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Content:</label>
                    <div class="col-md-9">
                        <span class="form-control-static"> <?php echo (isset($model->content) && $model->content != null) ? $model->content : "Not Given"; ?></span>
                    </div>
                </div>
            </div>
            <div class="form-actions text-right">
                <a href="<?php echo Url::to(['cms/update', 'id' => $model->id]); ?>" class="btn green">
                    <i class="fa fa-pencil"></i> Edit
                </a>
                <a href="<?php echo Url::to(['cms/index']); ?>" class="btn default">Back</a>                   
            </div>
        </form>
    </div>
</div>
