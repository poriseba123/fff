<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
use app\models\MetaLocation;
use yii\helpers\ArrayHelper;
?> 
<div class="col-md-2 col-sm-3 no-padding-left">
    <div class="left-menu-part">
        <div class="d-pro-box">
            <div class="media">
                <div class="media-left">
                    <?= Html::img('@web/themes/frontend/images/sml_prof_1.png', ['class' => "media-object"]) ?>
                </div>
                <div class="media-body">
                    <h4 class="media-heading"> Ellis Nicholls</h4>
                </div>
            </div>
        </div>
        <?php
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        ?>
        <ul>
            <li class="<?php echo ($controller == "dashboard" && $action == "index") ? "active" : "" ?>"><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("dashboard/index") ?>"><i class="fa fa-tachometer" aria-hidden="true"></i><?php echo Yii::t("app", "Dashboard")?></a></li>
            <li class="<?php echo ($controller == "user" && $action == "profile") ? "active" : "" ?>"><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("user/profile") ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><?php echo Yii::t("app", "Edit Profile") ?></a></li>
            <li><a href="edit_profile.html"><i class="fa fa-search-plus" aria-hidden="true"></i><?php echo Yii::t("app", "Recent Analysis")?></a></li>
            <li><a href="transaction.html"><i class="fa fa-compress" aria-hidden="true"></i><?php echo Yii::t("app", "Compare Analysis")?></a></li>
            <li><a href="#"><i class="fa fa-comments" aria-hidden="true"></i><?php echo Yii::t("app", "Chat")?></a></li>
            <li><a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i><?php echo Yii::t("app", "Following")?></a></li>
            <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i><?php echo Yii::t("app", "Follower")?></a></li>
            <li><a href="#"><i class="fa fa-users" aria-hidden="true"></i><?php echo Yii::t("app", "Group")?></a></li>
        </ul>
    </div>
</div>        