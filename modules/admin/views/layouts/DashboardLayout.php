<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use app\assets\backend\DashboardAssets;

DashboardAssets::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?= $this->context->getProjectFavicon() ?>" rel="shortcut icon" type="image/x-icon"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        
    </head>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <?php $this->beginBody() ?>
        <?= $this->context->renderPartial('../menu/loader'); ?>
        <div class="page-wrapper">
            <?= $this->context->renderPartial('../menu/header-menu'); ?>
            <div class="clearfix"> </div>
            <div class="page-container">
                <?= $this->context->renderPartial('../menu/left-menu'); ?>
                <?= $content ?>
            </div>
            <?= $this->context->renderPartial('../menu/footer-menu'); ?>
        </div>
        <?php $this->endBody() ?>
        <script type="text/javascript">
            var full_path = '<?php echo Yii::$app->request->baseUrl; ?>/admin/';
        </script>
    </body>
    <?php $this->endPage() ?>
</html>
