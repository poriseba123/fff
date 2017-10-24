<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Update User: ' . ((isset($model->first_name) && $model->first_name != null) ? ucfirst(strtolower($model->first_name)) : "") . ' ' . ((isset($model->last_name) && $model->last_name != null) ? ucfirst(strtolower($model->last_name)) : "");
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <?=
    $this->render('_form', [
        'model' => $model,
        'user_det' => $user_det,
    ])
    ?>

</div>
