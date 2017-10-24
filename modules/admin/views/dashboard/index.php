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
                <a class="dashboard-stat dashboard-stat-v2" style="background-color: #32c5d2; color:#fff ;" href="<?= $this->context->adminUrl('users'); ?>">
                    <div class="visual">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="50">50</span>
                        </div>
                        <div class="desc bold"> Total Members</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2" style="background-color: #8E44AD; color:#fff ;" href="<?= $this->context->adminUrl('users'); ?>">
                    <div class="visual">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="20">20</span>
                        </div>
                        <div class="desc bold"> Total Drivers</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>