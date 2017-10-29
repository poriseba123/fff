<?php

use yii\helpers\Html;

$data['model'] = $model;
/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Manage Doctor Specialities';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->title = "Create Doctor Specialities";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', $data) ?>

</div>
