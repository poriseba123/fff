<div class="page-header navbar navbar-fixed-top" style="height: 57px;">
    <div class="page-header-inner ">
        <div class="page-logo">
            <a href="<?= $this->context->adminUrl('/') ?>">
                <?php
                 $logoname = \app\models\Homepagesliderlogo::find()->select('logo_image')->one();
                ?>
                <img src="<?= Yii::$app->request->baseUrl ?>../uploads\logoslider\thumbnail\<?= $logoname->logo_image; ?>" alt="logo" class="logo-default" style="height: 61px !important;background-color: #FFF;" /> </a>
                <!--<span><?php // $this->context->getProjectName() ?></span>-->
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