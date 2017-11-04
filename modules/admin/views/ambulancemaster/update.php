<?php

use yii\helpers\Html;
//print_r($model['model']);
//print_r($contactmodel);
//die();
$data['model'] = $data['model'];
$data['contactmodel'] = $data['contactmodel'];
/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Manage Ambulance';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->title = 'Edite Ambulance';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', "id" => $data['model']->id]];

$this->params['breadcrumbs'][] = "Update";
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ["data" => $data]) ?>

</div>
