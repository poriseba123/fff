<?php

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<?php
$this->title = 'Manage Multilingual Messages';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="page-title"> Manage Multilingual Messages</h1>
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
<?php // $this->registerJsFile(Yii::$app->request->baseUrl . '/themes/backend/custom/js/dropdown-toogle.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>