<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Add State';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->title = "Add State";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model'=>$model]) ?>

</div>
