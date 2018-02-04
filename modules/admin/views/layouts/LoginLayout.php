<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use app\assets\backend\LoginAsset;

LoginAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= $this->context->getProjectFavicon() ?>" rel="shortcut icon" type="image/x-icon"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="login">
        <?php $this->beginBody() ?>
        <?= $this->context->renderPartial('../menu/loader');
        $logoname = \app\models\Homepagesliderlogo::find()->select('logo_image')->one();
        ?>
        <div class="logo">
            <a href="<?= $this->context->adminUrl('/') ?>">
                <img src="<?= Yii::$app->request->baseUrl ?>uploads\logoslider\thumbnail\<?= $logoname->logo_image; ?>" style="height: 100%; background-color: #fff;"/>
                <!--<img src="<?= $this->context->getProjectLogo() ?>" alt="" />--> 
                <!--<span><?= $this->context->getProjectName() ?></span>-->
            </a>
        </div>

        <?= $content ?>
        
        <?php $this->endBody() ?>
        <script type="text/javascript">
            var full_path = '<?php echo Yii::$app->request->baseUrl; ?>/admin/';
        </script>
    </body>
    <?php $this->endPage() ?>
</html>
