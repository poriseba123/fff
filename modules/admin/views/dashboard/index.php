<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
?>

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="dashboard">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Dashboard</span>
                </li>
            </ul>
            <div class="page-toolbar">
                <div class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Tody's Date">
                    <i class="icon-calendar"></i>&nbsp;
                    <span class=""><?= date('F', strtotime(date('Y-m-d'))) . ' ' . date('d', strtotime(date('Y-m-d'))) . ', ' . date('Y', strtotime(date('Y-m-d'))) ?></span>&nbsp;
                </div>
            </div>
        </div>
        <h1 class="page-title"> Dashboard <small>dashboard & statistics</small></h1>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2" style="background-color: #32c5d2; color:#fff ;" href="javascript:void(0);">
                    <div class="visual">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="0">0</span>
                        </div>
                        <div class="desc bold"> Total Members</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2" style="background-color: #32c5d2; color:#fff ;" href="javascript:void(0);">
                    <div class="visual">
                        <i class="fa fa-user-md"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="0">0</span>
                        </div>
                        <div class="desc bold"> Total Doctor</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2" style="background-color: #32c5d2; color:#fff ;" href="<?= $this->context->adminUrl('diagnosticcentre'); ?>">
                    <div class="visual">
                        <i class="fa fa-h-square fa-fw fa-1x"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?php
                            $diagnosticcentreTotal = \app\models\DiagnosticCentre::find()->where(['status' => '1'])->all();
                            ?>
                            <span data-counter="counterup" data-value="<?= (count($diagnosticcentreTotal) > 0) ? count($diagnosticcentreTotal) : 0 ?>"><?= (count($diagnosticcentreTotal) > 0) ? count($diagnosticcentreTotal) : 0 ?></span>
                        </div>
                        <div class="desc bold"> Total Diagnostic Center</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2" style="background-color: #32c5d2; color:#fff ;" href="<?= $this->context->adminUrl('ambulance'); ?>">
                    <div class="visual">
                        <i class="fa fa-ambulance fa-fw"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?php
                            $ambulanceTotal = \app\models\AmbulanceMaster::find()->where(['status' => '1'])->all();
                            ?>
                            <span data-counter="counterup" data-value="<?= (count($ambulanceTotal) > 0) ? count($ambulanceTotal) : 0 ?>"><?= (count($ambulanceTotal) > 0) ? count($ambulanceTotal) : 0 ?></span>
                        </div>
                        <div class="desc bold"> Total Ambulance</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2" style="background-color: #32c5d2; color:#fff ;" href="<?= $this->context->adminUrl('mortuary'); ?>">
                    <div class="visual">
                        <i class="fa fa-car fa-fw"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?php
                            $mortuaryTotal = \app\models\MortuaryMaster::find()->where(['status' => '1'])->all();
                            ?>
                            <span data-counter="counterup" data-value="<?= (count($mortuaryTotal) > 0) ? count($mortuaryTotal) : 0 ?>"><?= (count($mortuaryTotal) > 0) ? count($mortuaryTotal) : 0 ?></span>
                        </div>
                        <div class="desc bold"> Total Mortuary van</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2" style="background-color: #32c5d2; color:#fff ;" href="<?= $this->context->adminUrl('eyebank'); ?>">
                    <div class="visual">
                        <i class="fa fa-eye fa-fw"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?php
                            $eyebankTotal = \app\models\EyeBankMaster::find()->where(['status' => '1'])->all();
                            ?>
                            <span data-counter="counterup" data-value="<?= (count($eyebankTotal) > 0) ? count($eyebankTotal) : 0 ?>"><?= (count($eyebankTotal) > 0) ? count($eyebankTotal) : 0 ?></span>
                        </div>
                        <div class="desc bold"> Total EyeBank</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2" style="background-color: #32c5d2; color:#fff ;" href="<?= $this->context->adminUrl('bloodbank'); ?>">
                    <div class="visual">
                        <i class="fa fa-tint"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?php
                            $bloodbankTotal = \app\models\BloodBankMaster::find()->where(['status' => '1'])->all();
                            ?>
                            <span data-counter="counterup" data-value="<?= (count($bloodbankTotal) > 0) ? count($bloodbankTotal) : 0 ?>"><?= (count($bloodbankTotal) > 0) ? count($bloodbankTotal) : 0 ?></span>
                        </div>
                        <div class="desc bold"> Total BloodBank</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2" style="background-color: #32c5d2; color:#fff ;" href="<?= $this->context->adminUrl('medicineshop'); ?>">
                    <div class="visual">
                        <i class="fa fa-medkit"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?php
                            $MedicineShopTotal = \app\models\MedicineShopMaster::find()->where(['status' => '1'])->all();
                            ?>
                            <span data-counter="counterup" data-value="<?= (count($MedicineShopTotal) > 0) ? count($MedicineShopTotal) : 0 ?>"><?= (count($MedicineShopTotal) > 0) ? count($MedicineShopTotal) : 0 ?></span>
                        </div>
                        <div class="desc bold"> Total Medicine Shop</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2" style="background-color: #32c5d2; color:#fff ;" href="<?= $this->context->adminUrl('ayacenter'); ?>">
                    <div class="visual">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?php
                            $ayacenterTotal = \app\models\AyaMaster::find()->where(['status' => '1'])->all();
                            ?>
                            <span data-counter="counterup" data-value="<?= (count($ayacenterTotal) > 0) ? count($ayacenterTotal) : 0 ?>"><?= (count($ayacenterTotal) > 0) ? count($ayacenterTotal) : 0 ?></span>
                        </div>
                        <div class="desc bold"> Total Aya center</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>