<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Alert;
use app\assets\backend\MainAsset;

MainAsset::register($this);
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
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-content-white">
        <?php $this->beginBody() ?>
        <?= $this->context->renderPartial('../menu/loader'); ?>
        <div class="page-wrapper">
            <?= $this->context->renderPartial('../menu/header-menu'); ?>
            <div class="clearfix"> </div>
            <div class="page-container">
                <?= $this->context->renderPartial('../menu/left-menu'); ?>
                <div class="page-content-wrapper">
                    <div class="page-content">
                        <?php
                        echo Breadcrumbs::widget([
                            'homeLink' => [
                                'label' => 'Home',
                                'url' => ['dashboard/'],
                                'template' => '<li><i class="icon-home"></i> {link}</li>',
                            ],
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]);


                        if (Yii::$app->getSession()->hasFlash('success')) {
                            echo Alert::widget([
                                'options' => [
                                    'class' => 'alert-success',
                                ],
                                'body' => Yii::$app->getSession()->getFlash('success'),
                            ]);
                        }
                        if (Yii::$app->getSession()->hasFlash('danger')) {
                            echo Alert::widget([
                                'options' => [
                                    'class' => 'alert-danger',
                                ],
                                'body' => Yii::$app->getSession()->getFlash('danger'),
                            ]);
                        }
                        ?>
                        <?= $content ?>
                    </div>
                </div>
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


<script type="text/javascript">

    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });


    function ajaxindicatorstart()
    {
        if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
            jQuery('body').append('<div id="resultLoading" style="display:none"><div><i style="font-size: 46px;color: #F44336;" class="fa fa-spinner fa-spin fa-3x fa-fw" aria-hidden="true"></i></div><div class="bg"></div></div>');
        }

        jQuery('#resultLoading').css({
            'width': '100%',
            'height': '100%',
            'position': 'fixed',
            'z-index': '10000000',
            'top': '0',
            'left': '0',
            'right': '0',
            'bottom': '0',
            'margin': 'auto'
        });

        jQuery('#resultLoading .bg').css({
            'background': '#ffffff',
            'opacity': '0.8',
            'width': '100%',
            'height': '100%',
            'position': 'absolute',
            'top': '0'
        });

        jQuery('#resultLoading>div:first').css({
            'width': '250px',
            'height': '75px',
            'text-align': 'center',
            'position': 'fixed',
            'top': '0',
            'left': '0',
            'right': '0',
            'bottom': '0',
            'margin': 'auto',
            'font-size': '16px',
            'z-index': '10',
            'color': '#ffffff'

        });

        jQuery('#resultLoading .bg').height('100%');
        jQuery('#resultLoading').fadeIn(300);
        jQuery('body').css('cursor', 'wait');
    }

    function ajaxindicatorstop()
    {
        jQuery('#resultLoading .bg').height('100%');
        jQuery('#resultLoading').fadeOut(300);
        jQuery('body').css('cursor', 'default');
    }




</script>
