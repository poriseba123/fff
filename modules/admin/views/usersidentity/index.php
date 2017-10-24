<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\models\ContestMaster;

$this->title = 'User Identification List';
$this->params['breadcrumbs'][] = $this->title;
?>


<h1 class="page-title">Register Users Identification</h1>
<div class="row">
    <div class="col-md-12">
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <?php if (Yii::$app->session->hasFlash('pro-success-msg')) : ?>
                        <div class="alert alert-success" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!&nbsp;</strong>
                            <?= Yii::$app->session->getFlash('pro-success-msg') ?>
                        </div>
                    <?php endif; ?>
                    <div class="portlet light ">
                        <?= $widget ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>
<?php $this->registerJsFile(Yii::$app->request->baseUrl . '/themes/backend/custom/js/dropdown-toogle.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>