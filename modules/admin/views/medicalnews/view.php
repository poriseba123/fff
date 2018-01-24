<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Eye bank Details';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
//$this->title = $model->route;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">Medical News Details</span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form class="form-horizontal" role="form">
            <div class="form-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Link:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?= (isset($model->link) && $model->link != '') ? $model->link : "Not Set"; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Description :</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?= (isset($model->description)) ? $model->description : "Not Set"; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Image:</label>
                            <div class="form-group col-md-9" id='preview-img-holder'>
                                <img src="<?= (isset($model->image) && $model->image != '') ? Yii::$app->request->baseUrl . '\uploads\medicalnews\thumbnail\\' . $model->image : Yii::$app->request->baseUrl . '\uploads\noimage\noimg.jpg' ?>" class="thumb-image img-thumbnail" style="height: 80px;">
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
                                <a href="<?php echo Url::toRoute(['medicalnews/update', 'id' => $model->id]); ?>" class="btn green">Edit</a>
                                <a href="<?php echo Url::to(['medicalnews/index']); ?>" class="btn default">Back</a>
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

