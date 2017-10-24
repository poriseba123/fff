<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <li class="sidebar-search-wrapper">
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <li class="nav-item start <?= (Yii::$app->controller->id == 'dashboard') ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('dashboard'); ?>" class="nav-link ">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="heading">
                <h3 class="uppercase">Site Settings</h3>
            </li>
            <li class="nav-item start <?= (Yii::$app->controller->id == 'settings') ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('settings'); ?>" class="nav-link ">
                    <i class="fa fa-globe fa-spin fa-3x fa-fw"></i>
                    <span class="title">Global Settings</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="heading">
                <h3 class="uppercase">Generals</h3>
            </li>
            <li class="nav-item start <?= (Yii::$app->controller->id == 'users') ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('users'); ?>" class="nav-link ">
                    <i class="fa fa-users fa-fw"></i>
                    <span class="title">Users</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start <?= (Yii::$app->controller->id == 'usersidentity') ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('usersidentity'); ?>" class="nav-link ">
                    <i class="fa fa-users fa-fw"></i>
                    <span class="title">Users Identity</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start <?= (Yii::$app->controller->id == 'booking') ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('booking'); ?>" class="nav-link ">
                    <i class="fa fa-car fa-fw"></i>
                    <span class="title">Booking</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start <?= (Yii::$app->controller->id == 'driverrequest') ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('driverrequest'); ?>" class="nav-link ">
                    <i class="fa fa-car fa-fw"></i>
                    <span class="title">Driver Request</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start <?= (Yii::$app->controller->id == 'refund') ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('refund'); ?>" class="nav-link ">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    <span class="title">Cancel & Refund</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start <?= (Yii::$app->controller->id == 'claimrefund') ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('claimrefund'); ?>" class="nav-link ">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    <span class="title">Claim & Refund</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start <?= (Yii::$app->controller->id == 'report') ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('report'); ?>" class="nav-link ">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    <span class="title">Report Master</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start <?= (Yii::$app->controller->id == 'messagereport') ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('messagereport'); ?>" class="nav-link ">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    <span class="title">Message Report</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start <?= (Yii::$app->controller->id == 'rating') ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('rating'); ?>" class="nav-link ">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    <span class="title">Rating Master</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item start <?= (Yii::$app->controller->id == 'emails') ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('emails'); ?>" class="nav-link ">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    <span class="title">Email Contents</span>
                    <span class="selected"></span>
                </a>
            </li>
            <?php $allControllers = ['cms', 'multilingual', 'seo']; ?>
            <li class="nav-item <?= (in_array(Yii::$app->controller->id, $allControllers)) ? 'active' : '' ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Content Management</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
<!--                    <li class="nav-item <?= (Yii::$app->controller->id == "cms") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('cms/') ?>" class="nav-link ">
                            <i class="fa fa-laptop" aria-hidden="true"></i>
                            <span class="title">Static Pages</span>
                        </a>
                    </li>-->
                    <li class="noDisplay nav-item <?= (Yii::$app->controller->id == "multilingual") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('multilingual/') ?>" class="nav-link ">
                            <i class="fa fa-language" aria-hidden="true"></i>
                            <span class="title">Multilingual Messages</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (Yii::$app->controller->id == "seo") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('seo/') ?>" class="nav-link ">
                            <i class="fa fa-laptop" aria-hidden="true"></i>
                            <span class="title">SEO Management</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>