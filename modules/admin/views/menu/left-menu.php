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
                <h3 class="uppercase">Emergency Settings</h3>
            </li>
            <li class="nav-item start <?= (Yii::$app->controller->id == 'emergencymessage') ? 'active' : '' ?>">
                <a href="javascript:void(0)" class="nav-link ">
                    <i class="fa fa-comments-o fa-fw"></i>
                    <span class="title">Emergency Flash message</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start <?= (Yii::$app->controller->id == 'emergencysearch') ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('settings'); ?>" class="nav-link ">
                    <i class="fa fa-search-plus fa-fw"></i>
                    <span class="title">Emergency search settings</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start <?= (Yii::$app->controller->id == 'bloodrequest') ? 'active' : '' ?>">
                <a href="javascript:void(0);" class="nav-link ">
                    <i class="fa fa-comments-o fa-fw"></i>
                    <span class="title">Blood Request</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="heading">
                <h3 class="uppercase">Generals</h3>
            </li>
            <!--user management section start-->
            <?php $allControllers = ['admin', 'subadmin', 'users']; ?>
            <li class="nav-item <?= (in_array(Yii::$app->controller->id, $allControllers)) ? 'active' : '' ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-users fa-fw"></i>
                    <span class="title">User Management</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?= (Yii::$app->controller->id == "admin") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('multilingual/') ?>" class="nav-link ">
                            <i class="fa fa-users fa-fw" aria-hidden="true"></i>
                            <span class="title">Admin</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (Yii::$app->controller->id == "subadmin") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('seo/') ?>" class="nav-link ">
                            <i class="fa fa-users fa-fw" aria-hidden="true"></i>
                            <span class="title">Sub-admin</span>
                        </a>
                    </li>
                    <li class="nav-item start <?= (Yii::$app->controller->id == 'users') ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('users'); ?>" class="nav-link ">
                            <i class="fa fa-users fa-fw"></i>
                            <span class="title">Users</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>
                <!--user management section end-->
                <!--Doctor management section start-->
                <?php $allControllers = ['homeopathy', 'allopathic']; ?>
            <li class="nav-item <?= (in_array(Yii::$app->controller->id, $allControllers)) ? 'active' : '' ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-user-md fa-fw"></i>
                    <span class="title">Doctor Management</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?= (Yii::$app->controller->id == "allopathic") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('multilingual/') ?>" class="nav-link ">
                            <i class="fa fa-user-md fa-fw" aria-hidden="true"></i>
                            <span class="title">Allopathic Doctor</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (Yii::$app->controller->id == "homeopathy") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('seo/') ?>" class="nav-link ">
                            <i class="fa fa-user-md fa-fw" aria-hidden="true"></i>
                            <span class="title">Homeopathy Doctor</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (Yii::$app->controller->id == "ayurvedic") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('seo/') ?>" class="nav-link ">
                            <i class="fa fa-user-md fa-fw" aria-hidden="true"></i>
                            <span class="title">Ayurvedic Doctor</span>
                        </a>
                    </li>
                </ul>

                <!--Doctor management end-->
                <!--emergency Transport management section start-->
                <?php $allControllers = ['ambulance', 'sobbahi']; ?>

            <li class="nav-item <?= (in_array(Yii::$app->controller->id, $allControllers)) ? 'active' : '' ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-car fa-fw"></i>
                    <span class="title">Emergency Transport Service</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?= (Yii::$app->controller->id == "ambulance") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('multilingual/') ?>" class="nav-link ">
                            <i class="fa fa-ambulance fa-fw" aria-hidden="true"></i>
                            <span class="title">Ambulance</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (Yii::$app->controller->id == "sobbahi") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('seo/') ?>" class="nav-link ">
                            <i class="fa fa-ambulance fa-fw" aria-hidden="true"></i>
                            <span class="title">Mortuary Van service</span>
                        </a>
                    </li>

                </ul>

                <!--emergency transport management end-->
                <!--health care bank  management section start-->
                <?php $allControllers = ['bloodbank', 'eyebank']; ?>
            <li class="nav-item <?= (in_array(Yii::$app->controller->id, $allControllers)) ? 'active' : '' ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-university fa-fw"></i>
                    <span class="title">Health care Bank</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?= (Yii::$app->controller->id == "bloodbank") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('multilingual/') ?>" class="nav-link ">
                            <i class="fa fa-flask fa-fw" aria-hidden="true"></i>
                            <span class="title">Blood Bank</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (Yii::$app->controller->id == "eyebank") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('seo/') ?>" class="nav-link ">
                            <i class="fa fa-eye fa-fw" aria-hidden="true"></i>
                            <span class="title">Eye Bank</span>
                        </a>
                    </li>

                </ul>

                <!--health care management end-->
                <!--shop management section start-->
                <?php $allControllers = ['allopathicshop', 'homeopathyshop', 'ayurvedicshop']; ?>
            <li class="nav-item <?= (in_array(Yii::$app->controller->id, $allControllers)) ? 'active' : '' ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-cart-plus fa-fw"></i>
                    <span class="title">Med-Shop Management</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?= (Yii::$app->controller->id == "allopathicshop") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('multilingual/') ?>" class="nav-link ">
                            <i class="fa fa-medkit fa-fw" aria-hidden="true"></i>
                            <span class="title">Allopathic  Shop</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (Yii::$app->controller->id == "homeopathyshop") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('seo/') ?>" class="nav-link ">
                            <i class="fa fa-medkit fa-fw" aria-hidden="true"></i>
                            <span class="title">Homeopathy Shop</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (Yii::$app->controller->id == "ayurvedicshop") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('seo/') ?>" class="nav-link ">
                            <i class="fa fa-medkit fa-fw" aria-hidden="true"></i>
                            <span class="title">Ayurvedic Shop</span>
                        </a>
                    </li>

                </ul>
                <!--bank management end-->

                <!--fitness section start-->
                <?php $allControllers = ['gym', 'yogacenter', 'physiotherapy', 'swimmingclub', 'karateclub']; ?>
            <li class="nav-item <?= (in_array(Yii::$app->controller->id, $allControllers)) ? 'active' : '' ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-spotify fa-fw"></i>
                    <span class="title">Fitness Center</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?= (Yii::$app->controller->id == "gym") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('multilingual/') ?>" class="nav-link ">
                            <i class="fa fa-spotify fa-fw" aria-hidden="true"></i>
                            <span class="title">Gym Center</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (Yii::$app->controller->id == "yogacenter") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('seo/') ?>" class="nav-link ">
                            <i class="fa fa-spotify fa-fw" aria-hidden="true"></i>
                            <span class="title">Physiotherapy Center</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (Yii::$app->controller->id == "swimmingclub") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('seo/') ?>" class="nav-link ">
                            <i class="fa fa-spotify fa-fw" aria-hidden="true"></i>
                            <span class="title">Swimming Center</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (Yii::$app->controller->id == "karateclub") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('seo/') ?>" class="nav-link ">
                            <i class="fa fa-spotify fa-fw" aria-hidden="true"></i>
                            <span class="title">Karate Center</span>
                        </a>
                    </li>

                </ul>
                <!--fitness management end-->

            <li class="nav-item <?= (Yii::$app->controller->id == "diagnosticcentre") ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('seo/') ?>" class="nav-link ">
                    <i class="fa fa-h-square fa-fw" aria-hidden="true"></i>
                    <span class="title">Diagnostic Center</span>
                </a>
            </li>

            <li class="nav-item <?= (Yii::$app->controller->id == "hospital") ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('seo/') ?>" class="nav-link ">
                    <i class="fa fa-hospital-o fa-fw" aria-hidden="true"></i>
                    <span class="title">Hospital/Nursing-home</span>
                </a>
            </li>
            <li class="nav-item <?= (Yii::$app->controller->id == "blog") ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('seo/') ?>" class="nav-link ">
                    <i class="fa fa-rss fa-fw" aria-hidden="true"></i>
                    <span class="title">Blog Management</span>
                </a>
            </li>
            <?php $allControllers = ['emails', 'seo','doctorspecialities']; ?>
            <li class="nav-item <?= (in_array(Yii::$app->controller->id, $allControllers)) ? 'active' : '' ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Content Management</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start <?= (Yii::$app->controller->id == 'doctorspecialities') ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('doctorspecialities'); ?>" class="nav-link ">
                            <i class="fa fa-list-ol" aria-hidden="true"></i>
                            <span class="title">Category Management</span>
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

                    <li class="nav-item <?= (Yii::$app->controller->id == "seo") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('seo/') ?>" class="nav-link ">
                            <i class="fa fa-laptop" aria-hidden="true"></i>
                            <span class="title">SEO Management</span>
                        </a>
                    </li>
                </ul>
            </li>
            <?php $allControllers = ['googleanalytics', 'datatracker']; ?>
            <li class="nav-item <?= (in_array(Yii::$app->controller->id, $allControllers)) ? 'active' : '' ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-line-chart fa-fw"></i>
                    <span class="title">Analytics Management</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">

                    <li class="nav-item start <?= (Yii::$app->controller->id == 'googleanalytics') ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('emails'); ?>" class="nav-link ">
                            <i class="fa fa-line-chart fa-fw" aria-hidden="true"></i>
                            <span class="title">Google Analytics</span>
                            <span class="selected"></span>
                        </a>
                    </li>

                    <li class="nav-item <?= (Yii::$app->controller->id == "datatracker") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('seo/') ?>" class="nav-link ">
                            <i class="fa fa-line-chart fa-fw" aria-hidden="true"></i>
                            <span class="title">Data Analytics</span>
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