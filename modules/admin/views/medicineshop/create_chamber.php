<?php

use yii\helpers\Html;

$data['data'] = $data;
/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Add Chamber';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['chamberindex']];
$this->title = "Add Chamber";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_chamber', $data) ?>

</div>
