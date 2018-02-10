<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Faq";
$this->params['breadcrumbs'][] = $this->title;
?>
<h3 class="page-title">Faq
</h3>
<div class="user-index">
    <?php
    echo $widget;
    ?>
</div>
<?php $this->registerJsFile(Yii::$app->request->baseUrl . '/themes/backend/custom/js/dropdown-toogle.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
