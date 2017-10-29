<?php

use yii\helpers\Html;

$data['data'] = $data;
/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Add Doctor';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->title = "Add Doctor";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', $data) ?>

</div>
