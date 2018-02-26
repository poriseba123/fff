<style>
    .label-warning {
        position: absolute;
        top: 9px;
        right: 7px;
        text-align: center;
        font-size: 9px;
        padding: 2px 3px;
        line-height: .9;
    </style>
    <?php

    use yii\helpers\Html;
    use yii\helpers\Url;

$contact_email = \app\models\ContactUs::find()->where(['status' => '0'])->all();
    ?>
    <div class="page-header navbar navbar-fixed-top" style="height: 57px;">
        <div class="page-header-inner">

            <div class="page-logo">
                <a href="<?= $this->context->adminUrl('/') ?>">
                    <?php
                    $logoname = \app\models\Homepagesliderlogo::find()->select('logo_image')->one();
                    ?>
                    <img src="http://poriseba.com/../uploads\logoslider\thumbnail\<?= $logoname->logo_image; ?>" alt="logo" class="logo-default" style="height: 61px !important;background-color: #FFF;" /> </a>
                    <!--<span><?php // $this->context->getProjectName()              ?></span>-->
                </a>
                <div class="menu-toggler sidebar-toggler">
                    <span></span>
                </div>
            </div>
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                <span></span>
            </a>
            <div class="top-menu">

                <ul class="nav navbar-nav pull-right">
                    <!-- Messages: style can be found in dropdown.less-->
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-warning"><?= isset($contact_email) ? count($contact_email) : '0'; ?></span>
                        </a>
                        <?php
                        if (!empty($contact_email) && count($contact_email) > 0) {
                            ?> 
                            <ul class="dropdown-menu">
                                <li class="header">You have <?= isset($contact_email) ? count($contact_email) : '0'; ?> unseen email</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <?php
                                        foreach ($contact_email as $key => $value) {
                                            ?>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-users text-aqua"></i><?= isset($value->name)?$value->name:'';?> (<?= isset($value->submit_date)?date('d-M-Y',strtotime(str_replace('-','/',$value->submit_date))):'';?>)
                                                </a>
                                            </li>
                                        <?php }
                                        ?>

                                    </ul>
                                </li>
                                <li class="footer"><a href="<?=$this->context->adminUrl('feedback') ?>">View all</a></li>
                            </ul>
                        <?php }
                        ?>

                    </li>
                    <li class="dropdown dropdown-user" id="dh-user-opt">
                        <?php
                        $name = 'Site Admin';
                        $img = '';
                        if (!Yii::$app->user->isGuest) {
                            $user = $this->context->getLogedInUser();
                            $name = $user->first_name;
                        }
                        ?>
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle" src="<?= $this->context->getProfilePicture() ?>"/>
                            <span class="username username-hide-on-mobile"> <?= $name ?> </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="<?= $this->context->adminUrl('myprofile') ?>">
                                    <i class="icon-user"></i> My Profile </a>
                            </li>
                            <li>
                                <a href="<?= $this->context->adminUrl('auth/logout') ?>">
                                    <i class="icon-key"></i> Log Out 
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>