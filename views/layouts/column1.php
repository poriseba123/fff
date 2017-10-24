<?php

use app\assets\frontend\MainAsset;
//use app\assets\frontend\NotifyAsset;

MainAsset::register($this);
//NotifyAsset::register($this);


?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<?php echo Yii::$app->controller->renderPartial('@app/views/layouts/header.php'); ?>
<div class="main-body-wrap">
    <?= $content ?>
</div>   
<?php echo Yii::$app->controller->renderPartial('@app/views/layouts/footer'); ?>
<?php $this->endContent(); ?>