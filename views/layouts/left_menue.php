<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
use app\models\MetaLocation;
use yii\helpers\ArrayHelper;

$_list = \app\models\Leftmenu::find()->where(['status' => '1'])->all();
?> 
<div class="navmenu navmenu-default navmenu-fixed-left offcanvas">
    <!--- Off Canvas Side Menu -->
    <div class="close" data-toggle="offcanvas" data-target=".navmenu">
        <i class="fa fa-close"></i>
    </div>
    <?php
    if (!empty($_list)) {
        ?>
        <h3 class="title-menu">All Pages</h3>
        <ul class="nav navmenu-nav">
            <?php
            foreach ($_list as $key => $value) {
                ?>
            <li><a href="<?= $value->link ?>" target="_blank"><?= $value->page_name; ?></a></li>
            <?php }
            ?>
        </ul>
    <?php }
    ?>

    <!--- End Menu -->
</div>        