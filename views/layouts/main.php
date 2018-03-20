<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
//use app\models\Users;
use yii\helpers\Url;
use app\models\Settings;

$google_map_key = Settings::find()->where(['slug' => 'google_map_key'])->one();
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!--<meta charset="utf-8">-->
        <meta http-equiv="Content-type" value="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="google-signin-client_id" content="682570649470-st4gt7dqvsr46cb4d3f4oh19ae6hjvha.apps.googleusercontent.com">
        <meta name="google-signin-scope" content="https://www.googleapis.com/auth/analytics.readonly">
        <meta name="msvalidate.01" content="A98777032436CF09C413C484BFC1CD0E" />
        <?= Html::csrfMetaTags() ?>
        <?php
        $this->title = $this->context->getPageMetaTitle(Yii::$app->controller->id, Yii::$app->controller->action->id);
        ?>
        <meta name="description" content="News,Gyms Near Me, Pathology, Blood Bank, Ambulance,Usefull Information,Locations,nursinghome,medicine shop,yoga center,orphan homw">
        <title><?= Html::encode($this->title) ?></title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Quicksand:300,400,500,700&amp;subset=latin-ext,vietnamese" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href="<?= $this->context->getProjectFavicon() ?>" rel="shortcut icon" type="image/x-icon"/>

        <?php $this->head() ?>
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({
                google_ad_client: "ca-pub-4351265563256692",
                enable_page_level_ads: true
            });
        </script>
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-111092827-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-111092827-1');
        </script>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
        <script>
            var OneSignal = window.OneSignal || [];
            OneSignal.push(function () {
                OneSignal.init({
                    appId: "5b15f2cc-2a04-4979-a90a-e9a59545990c",
                });
            });
        </script>


    </head>
    <?php $this->beginBody() ?>
    <body>
        <?php $this->beginBody() ?>
        <input type="hidden" name="facebookAppId" id="facebookAppId" value="<?= $this->context->getFacebookAppID() ?>"/>
        <?= $this->context->renderPartial('../partials/loader'); ?>
        <?= $content ?>
        <?= $this->context->renderPartial('../partials/jquery_modals'); ?>
        <script type="text/javascript">
            var full_path = '<?php echo Url::base(true); ?>/';
            var logged_in =<?= Yii::$app->user->isGuest ? 'false' : 'true'; ?>;
            var csrf_token = '<?= Yii::$app->request->csrfToken ?>';
        </script>
    </body>
    <?php $this->endBody() ?>
    <?php
    if (Yii::$app->session->hasFlash('success')) {
        ?>
        <script>
            notie.alert('success', '<?php echo Yii::$app->session->getFlash('success'); ?>', 5);
        </script>
        <?php
    }if (Yii::$app->session->hasFlash('error')) {
        ?>
        <script>
            notie.alert('error', '<?php echo Yii::$app->session->getFlash('error'); ?>', 5);
        </script>
        <?php
    }
    ?>
</html>
<?php $this->endPage() ?>