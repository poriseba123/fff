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
    <div class="page-header navbar navbar-fixed-top" style="height: 57px;">
        <div class="page-header-inner">

            <div class="page-logo">
                <a href="<?= $this->context->adminUrl('/') ?>">
                    <?php
                    $logoname = \app\models\Homepagesliderlogo::find()->select('logo_image')->one();
                    ?>
                    <img src="http://poriseba.com/../uploads\logoslider\thumbnail\<?= $logoname->logo_image; ?>" alt="logo" class="logo-default" style="height: 61px !important;background-color: #FFF;" /> </a>
                    <!--<span><?php // $this->context->getProjectName()      ?></span>-->
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
                            <span class="label label-warning">10</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 10 notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                                            page and may cause design problems
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-red"></i> 5 new members joined
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-user text-red"></i> You changed your username
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
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