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

            <?php $allControllers = ['leftmenu', 'homepagelogoslider', 'medicalnews', 'homepagefeatures','landingpage']; ?>
            <li class="nav-item <?= (in_array(Yii::$app->controller->id, $allControllers)) ? 'active' : '' ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Home-Page content Management</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start <?= (Yii::$app->controller->id == 'leftmenu') ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('leftmenu'); ?>" class="nav-link ">
                            <i class="fa fa-bars"></i>
                            <span class="title">Left Menu</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                     <li class="nav-item start <?= (Yii::$app->controller->id == 'landingpage') ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('landingpage'); ?>" class="nav-link ">
                            <i class="fa fa-bars"></i>
                            <span class="title">Home Page Content</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start <?= (Yii::$app->controller->id == 'homepagefeatures') ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('homepagefeatures'); ?>" class="nav-link ">
                            <i class="fa fa-star"></i>
                            <span class="title">Features</span>
                            <span class="selected"></span>
                        </a>
                    </li>

                    <li class="nav-item start <?= (Yii::$app->controller->id == 'homepagelogoslider') ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('homepagelogoslider'); ?>" class="nav-link ">
                            <i class="fa fa-picture-o fa-3x fa-fw"></i>
                            <span class="title">Upload Logo/Slider</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start <?= (Yii::$app->controller->id == 'medicalnews') ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('medicalnews'); ?>" class="nav-link ">
                            <i class="fa fa-newspaper-o fa-3x fa-fw"></i>
                            <span class="title">Medical News</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>
            </li>
           <li class="nav-item start <?= (Yii::$app->controller->id == 'aboutus') ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('aboutus'); ?>" class="nav-link ">
                    <i class="icon-diamond fa-3x fa-fw"></i>
                    <span class="title">About Us Page Content</span>
                    <span class="selected"></span>
                </a>
            </li>
             <li class="nav-item start <?= (Yii::$app->controller->id == 'faq') ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('faq'); ?>" class="nav-link ">
                    <i class="icon-diamond fa-3x fa-fw"></i>
                    <span class="title">Faq Page Content</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="heading">
                <h3 class="uppercase">location</h3>
            </li>
            <li class="nav-item start <?= (Yii::$app->controller->id == 'state') ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('state'); ?>" class="nav-link ">
                    <i class="fa fa-globe fa-spin fa-3x fa-fw"></i>
                    <span class="title">State</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start <?= (Yii::$app->controller->id == 'district') ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('district'); ?>" class="nav-link ">
                    <i class="fa fa-globe fa-spin fa-3x fa-fw"></i>
                    <span class="title">District</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start <?= (Yii::$app->controller->id == 'city') ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('city'); ?>" class="nav-link ">
                    <i class="fa fa-globe fa-spin fa-3x fa-fw"></i>
                    <span class="title">City</span>
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
            <li class="nav-item start <?= (Yii::$app->controller->id == 'medicaltest') ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('medicaltest'); ?>" class="nav-link ">
                    <i class="fa fa-flask  fa-3x fa-fw"></i>
                    <span class="title">Medical Test</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start <?= (Yii::$app->controller->id == 'hospitalunits') ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('hospitalunits'); ?>" class="nav-link ">
                    <i class="fa fa-cogs  fa-3x fa-fw"></i>
                    <span class="title">Hospital/Nursing-home Unit</span>
                    <span class="selected"></span>
                </a>
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
            </li>
            <!--user management section end-->
            <!--Doctor management section start-->
            <li class="nav-item <?= (Yii::$app->controller->id == "doctorspecialities") ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('doctorspecialities') ?>" class="nav-link ">
                    <i class="fa fa-user-md" aria-hidden="true"></i>
                    <span class="title">Doctor Specialities Management</span>
                </a>
            </li>
            <li class="nav-item <?= (Yii::$app->controller->id == "doctor") ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('doctor') ?>" class="nav-link ">
                    <i class="fa fa-user-md" aria-hidden="true"></i>
                    <span class="title">Doctor Management</span>
                </a>
            </li>

            <li class="nav-item <?= (Yii::$app->controller->id == "medicineshop") ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('medicineshop') ?>" class="nav-link ">
                    <i class="fa fa-medkit" aria-hidden="true"></i>
                    <span class="title">Med-Shop Management</span>
                </a>
            </li>
            <!--Doctor management end-->
            <!--emergency Transport management section start-->
            <?php $allControllers = ['ambulance', 'mortuary']; ?>


            <li class="nav-item <?= (in_array(Yii::$app->controller->id, $allControllers)) ? 'active' : '' ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-car fa-fw"></i>
                    <span class="title">Emergency Transport Service</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?= (Yii::$app->controller->id == "ambulance") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('ambulance') ?>" class="nav-link ">
                            <i class="fa fa-ambulance fa-fw" aria-hidden="true"></i>
                            <span class="title">Ambulance</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (Yii::$app->controller->id == "mortuary") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('mortuary') ?>" class="nav-link ">
                            <i class="fa fa-ambulance fa-fw" aria-hidden="true"></i>
                            <span class="title">Mortuary Van service</span>
                        </a>
                    </li>

                </ul>
            </li>

            <?php $allControllers = ['oldagehome', 'orphanehome']; ?>


            <li class="nav-item <?= (in_array(Yii::$app->controller->id, $allControllers)) ? 'active' : '' ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-home fa-fw"></i>
                    <span class="title">Shelter Home</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?= (Yii::$app->controller->id == "oldagehome") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('oldagehome') ?>" class="nav-link ">
                            <i class="fa fa-home fa-fw" aria-hidden="true"></i>
                            <span class="title">Old-age Home</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (Yii::$app->controller->id == "orphanehome") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('orphanehome') ?>" class="nav-link ">
                            <i class="fa fa-home fa-fw" aria-hidden="true"></i>
                            <span class="title">Orphan Home</span>
                        </a>
                    </li>

                </ul>
            </li>

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
                        <a href="<?= $this->context->adminUrl('bloodbank') ?>" class="nav-link ">
                            <i class="fa fa-flask fa-fw" aria-hidden="true"></i>
                            <span class="title">Blood Bank</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (Yii::$app->controller->id == "eyebank") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('eyebank') ?>" class="nav-link ">
                            <i class="fa fa-eye fa-fw" aria-hidden="true"></i>
                            <span class="title">Eye Bank</span>
                        </a>
                    </li>

                </ul>
            </li>

            <!--health care management end-->
            <!--shop management section start-->

            <?php $allControllers = ['allopathicshop', 'homeopathyshop', 'ayurvedicshop']; ?>

            <!--bank management end-->

            <!--fitness section start-->
            <?php $allControllers = ['gymcenter', 'yogacenter', 'physiotherapy', 'swimmingclub', 'karateclub']; ?>
            <li class="nav-item <?= (in_array(Yii::$app->controller->id, $allControllers)) ? 'active' : '' ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-spotify fa-fw"></i>
                    <span class="title">Fitness Center</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?= (Yii::$app->controller->id == "gymcenter") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('gymcenter') ?>" class="nav-link ">
                            <i class="fa fa-spotify fa-fw" aria-hidden="true"></i>
                            <span class="title">Gym Center</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (Yii::$app->controller->id == "yogacenter") ? 'active' : '' ?>">
                        <a href="<?= $this->context->adminUrl('yogacenter/') ?>" class="nav-link ">
                            <i class="fa fa-spotify fa-fw" aria-hidden="true"></i>
                            <span class="title">Yoga Center</span>
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
            </li>
            <!--fitness management end-->

            <li class="nav-item <?= (Yii::$app->controller->id == "diagnosticcentre") ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('diagnosticcentre') ?>" class="nav-link ">
                    <i class="fa fa-h-square fa-fw" aria-hidden="true"></i>
                    <span class="title">Diagnostic Center</span>
                </a>
            </li>

            <li class="nav-item <?= (Yii::$app->controller->id == "hospitalnursing") ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('hospitalnursing') ?>" class="nav-link ">
                    <i class="fa fa-hospital-o fa-fw" aria-hidden="true"></i>
                    <span class="title">Hospital/Nursing-home</span>
                </a>
            </li>
            <li class="nav-item <?= (Yii::$app->controller->id == "ayacenter") ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('ayacenter/') ?>" class="nav-link ">
                    <i class="fa fa-users fa-fw" aria-hidden="true"></i>
                    <span class="title">Aya Center</span>
                </a>
            </li>
            <li class="nav-item <?= (Yii::$app->controller->id == "blog") ? 'active' : '' ?>">
                <a href="<?= $this->context->adminUrl('seo/') ?>" class="nav-link ">
                    <i class="fa fa-rss fa-fw" aria-hidden="true"></i>
                    <span class="title">Blog Management</span>
                </a>
            </li>
            <?php $allControllers = ['emails', 'seo', 'doctorspecialities']; ?>
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