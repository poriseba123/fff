<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
?> 

<section class="dash-top-ara">
    <div class="btm-org-area">
        <div class="container">                 
            <div class="col-sm-12">
                <div class="top-or-mnu">
                    <ul>
                        <li class="<?= ($controller == 'site' && $action == 'contestlist') ? 'active' : '' ?> ">
                            <a href="<?= Url::to(['site/contestlist']); ?>">
                                <div class="anchr-ht">
<!--                                    <div class="clearfix">
                                        //<?= Html::img('@web/frontend/images/das_ico_1.png', ['class' => 'clearfix', 'data-holder-rendered' => "true"]); ?>

                                    </div>-->
                                    LOBBY
                                </div>
                            </a>
                        </li>
                        <li class="<?php echo ($controller == 'participation' && $action == 'index') ? 'active' : ''; ?>">
                            <a href="javascript:;" onclick="go_to_url(this);" data-href="<?= Url::to(['participation/index']); ?>">
                                <div class="anchr-ht">
<!--                                    <div class="clearfix">
                                        //<?= Html::img('@web/frontend/images/das_ico_2.png', ['class' => 'clearfix', 'data-holder-rendered' => "true"]); ?>

                                    </div>-->
                                    LINEUP
                                </div>
                            </a>
                        </li>
                        <li class="<?php echo ($controller == 'participation' && ($action == 'ongoingcontest' || $action == 'completecontest' || $action == 'viewcontestresult')) ? 'active' : ''; ?>">
                            <a href="javascript:;" onclick="go_to_url(this);" data-href="<?= Url::to(['participation/ongoingcontest']); ?>">
                                <div class="anchr-ht">
<!--                                    <div class="clearfix">
                                        //<?= Html::img('@web/frontend/images/das_ico_3.png', ['class' => 'clearfix', 'data-holder-rendered' => "true"]); ?>

                                    </div>-->
                                    CONTESTS
                                </div>
                            </a>
                        </li>
                        <li class="<?php echo (($controller == 'friends' && in_array($action, ['index','friendcontestlist','friendcontestpoint'])) || ($controller=='site' && $action=='privatecontestdetails')) ? 'active' : ''; ?>">
                            <a  href="javascript:;" onclick="go_to_url(this);" data-href="<?= Url::to(['friends/friendcontestlist']); ?>">
                                <div class="anchr-ht">
<!--                                    <div class="clearfix">
                                        //<?= Html::img('@web/frontend/images/das_ico_4.png', ['class' => 'clearfix', 'data-holder-rendered' => "true"]); ?>

                                    </div>-->
                                    FRIENDS MODE
                                </div>
                            </a>
                        </li>
                        <li class="<?php echo ($controller == 'user' && ($action == 'wallettrack' || $action == 'withdrawlrequest' || $action == 'requestfund')) ? 'active' : ''; ?>">
                            <a  href="javascript:;" onclick="go_to_url(this);" data-href="<?= Url::to(['user/wallettrack']); ?>">
                                <div class="anchr-ht">
<!--                                    <div class="clearfix">
                                        //<?= Html::img('@web/frontend/images/das_ico_5.png', ['class' => 'clearfix', 'data-src' => "holder.js/", 'data-holder-rendered' => "true"]); ?>

                                    </div>-->
                                    TRANSACTION
                                </div>
                            </a>
                        </li>
                        <li class="<?php echo ($controller == 'user' && $action == 'index') ? 'active' : ''; ?>" >
                            <a  href="javascript:;" onclick="go_to_url(this);" data-href="<?= Url::to(['user/index']); ?>">
                                <div class="anchr-ht">
<!--                                    <div class="clearfix">
                                        //<?= Html::img('@web/frontend/images/das_ico_6.png', ['class' => 'clearfix', 'data-src' => "holder.js/", 'data-holder-rendered' => "true"]); ?>

                                    </div>-->
                                    DASHBOARD
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

</section>