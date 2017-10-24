<?php

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<?php
$this->title = 'Static Pages';
$this->params['breadcrumbs'][] = ["label" => $this->title, "url" => ["index"]];
$this->title = 'Update';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="page-title"> View Static Page Content</h1>
<div class="row">
    <div class="col-md-12">
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <?php if (Yii::$app->session->hasFlash('success-msg')) : ?>
                        <div class="alert alert-success" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!&nbsp;</strong>
                            <?= Yii::$app->session->getFlash('success-msg') ?>
                        </div>
                    <?php endif; ?>
                    <div class="portlet light ">
                        <div class="listing-view-title">
                            <h4><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update Static Page Content</h4>
                        </div>
                        <div class="listing view-content">
                            <?php
                            $data['model'] = $model;
                            ?>
                            <?= $this->render('_form', $data) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>