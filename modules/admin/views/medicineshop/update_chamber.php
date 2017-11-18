<?php

use yii\helpers\Html;
$model=$data['model'];
$data['data'] = $data;
/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Update Doctor';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->title = $data['model']->chamber_name;
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', "id" => $model->id]];

$this->params['breadcrumbs'][] = "Update";
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form_chamber_update', $data) ?>

</div>
