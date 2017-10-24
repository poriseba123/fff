<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Manage SEO';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->title = $model->route;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">SEO Details</span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form class="form-horizontal" role="form">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Route:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?= (isset($model->route) && $model->route != '') ? $model->route : ""; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Title:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?= (isset($model->title) && $model->title != '') ? $model->title : "Not Set"; ?> </p>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Keyword:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?= (isset($model->keyword) && $model->keyword != '') ? $model->keyword : "Not Set"; ?> </p>
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
                                <a href="<?php echo Url::toRoute(['seo/update','id'=>$model->id]); ?>" class="btn green">Edit</a>
                                <a href="<?php echo Url::to(['seo/index']); ?>" class="btn default">Back</a>
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
