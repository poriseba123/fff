<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\models\ContestMaster;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Register User List';
$this->params['breadcrumbs'][] = ["label" => $this->title, "url" => ["index"]];
$this->title = 'User Detail';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
if ($model->email_varified == 1) {
    $emailVerified = '<i class="fa fa-check-circle" aria-hidden="true" style="font-size: 18px;"></i>';
    $emailLink = "linkDisabled";
    $emailVarifyTitle = "Email Varified";
    $emailOnclickOption = "";
} else {
    $emailVerified = '<i class="fa fa-times-circle" aria-hidden="true" style="font-size: 18px;"></i>';
    $emailLink = "";
    $emailVarifyTitle = "Do Email Varified";
    $emailOnclickOption = "douseremailvarified(this)";
}
if ($model->phone_verification == 1) {
    $phoneVerified = '<i class="fa fa-check-circle" aria-hidden="true" style="font-size: 18px;"></i>';
    $phoneLink = "linkDisabled";
    $phoneVarifyTitle = "Phone Varified";
    $phoneOnclickOption = "";
} else {
    $phoneVerified = '<i class="fa fa-times-circle" aria-hidden="true" style="font-size: 18px;"></i>';
    $phoneLink = "";
    $phoneVarifyTitle = "Do Phone Varified";
    $phoneOnclickOption = "douserphonevarified(this)";
}
if ($model->identity_document_verified == 1) {
    $iDVerified = '<i class="fa fa-check-circle" aria-hidden="true" style="font-size: 18px;"></i>';
} else {
    $iDVerified = '<i class="fa fa-times-circle" aria-hidden="true"></i>';
}
?>
<h1 class="page-title">View User Detail</h1>
<div class="row">
    <div class="col-md-12">
        <div class="profile-sidebar">
            <div class="portlet light profile-sidebar-portlet ">
                <div class="profile-userpic">
                    <img src="<?= $this->context->getProfilePicture($model->id) ?>" onerror="this.src='<?= $this->context->getProfileImgErrorImg() ?>'" class="img-responsive" alt=""> </div>
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> <?= $model->first_name . ' ' . $model->last_name ?> </div>
                </div>
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="<?= (Yii::$app->controller->id == "users" && Yii::$app->controller->action->id == "editdetails") ? "active" : "" ?>">
                            <a class="<?= (Yii::$app->controller->id == "users" && Yii::$app->controller->action->id == "editdetails") ? "linkDisabled" : "" ?>" href="<?= Yii::$app->urlManager->createUrl(["admin/users/editdetails", "id" => $model->id]) ?>">
                                <i class="fa fa-user" aria-hidden="true"></i> User Details 
                            </a>
                        </li>
                        <?php if (isset($model->vehicle) && ($model->vehicle->status != 2 || $model->vehicle->status != 3)) : ?>
                            <li class="<?= (Yii::$app->controller->id == "driverrequest" && Yii::$app->controller->action->id == "view") ? "active" : "" ?>">
                                <a href="<?= Yii::$app->urlManager->createUrl(["admin/driverrequest/view", "id" => $model->vehicle->id]) ?>">
                                    <i class="fa fa-car" aria-hidden="true"></i> Vehicle Details 
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">User Account</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_1" data-toggle="tab">User Details</a>
                                </li>
                                <li>
                                    <!--<a href="#tab_1_2" data-toggle="tab">Change Password</a>-->
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1_1">
                                    <div class="alert alert-success text-center noDisplay" id="user-update-success" role="alert">
                                        <strong></strong>
                                    </div>
                                    <div class="alert alert-danger noDisplay" id="user-update-error" role="alert">
                                        <strong></strong>
                                    </div>
                                    <?php
                                    $form = ActiveForm::begin([
                                                'options' => ['id' => 'user-pro-update', 'class' => '', 'enctype' => 'multipart/form-data'],
                                                'enableClientValidation' => false
                                            ])
                                    ?>
                                    <div class="clearfix">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" name="userId" id="userId" value="<?php echo $model->id ?>"/>
                                                    <?= $form->field($model, 'first_name')->textInput(['class' => "form-control", 'placeholder' => "First Name *"])->label(); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?= $form->field($model, 'last_name')->textInput(['class' => "form-control", 'placeholder' => "Last Name *"])->label(); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="usermaster-email">Email Id</label>
                                                    <a href="javascript:;" data-userId="<?= $model->id ?>" id="emailvarify_<?= $model->id ?>" class="pull-right <?= $emailLink ?>" title="<?= $emailVarifyTitle ?>" onclick="<?= $emailOnclickOption ?>"><?= $emailVerified ?></a>
                                                    <?= $form->field($model, 'email')->textInput(['class' => "form-control", 'placeholder' => "Email *"])->label(false); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?= $form->field($model, 'facebook_email')->textInput(['readonly' => true, 'class' => "form-control", 'placeholder' => "Facebook Email"])->label(); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="usermaster-phone">Phone Number</label>
                                                    <a href="javascript:;" data-userId="<?= $model->id ?>" id="phonevarify_<?= $model->id ?>" class="pull-right <?= $phoneLink ?>" title="<?= $phoneVarifyTitle ?>" onclick="<?= $phoneOnclickOption ?>"><?= $phoneVerified ?></a>
                                                    <div class="form-group field-usermaster-email">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <?php
                                                                $countryPhoneCodeList = $this->context->getAllCountryMobileCodes();
                                                                if ($model->phone_code > 0) {
                                                                    $selectedCode = $model->phone_code;
                                                                } else {
                                                                    $selectedCode = 199;
                                                                }
                                                                ?>
                                                                <select class="form-control" name="UserMaster[phone_code]" id="usermaster-phone_code">
                                                                    <?php foreach ($countryPhoneCodeList as $v) : ?>
                                                                        <option value="<?= $v->id ?>" <?= ($v->id == $selectedCode) ? "selected" : "" ?>><?= "(+" . $v->phonecode . ")" ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input class="form-control" type="text" value="<?= $model->phone ?>"  name="UserMaster[phone]" id="usermaster-phone">
                                                                <div class="help-block"></div>
                                                            </div>
                                                        </div>
                                                    </div>                                                
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?= $form->field($model, 'gender')->radioList(['1' => 'Male', '2' => 'Female'])->label() ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <?php if ($model->status == 0) : ?>
                                                        <?= $form->field($model, 'status')->radioList(['0' => 'Inactive', '1' => 'Active'])->label() ?>
                                                    <?php else : ?>
                                                        <?= $form->field($model, 'status')->radioList(['1' => 'Active', '2' => 'Suspend'])->label() ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info">Update Details</button>
                                                <a class="btn green btn-sm btn-outline dropdown-toggle pull-right" href="<?= Yii::$app->request->referrer; ?>"> <i class="fa fa-reply"></i> Back</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php ActiveForm::end() ?>
                                    <!--</form>-->
                                </div>
                                <div class="tab-pane" id="tab_1_2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>
