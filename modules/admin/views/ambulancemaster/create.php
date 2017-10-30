<?php

use yii\helpers\Html;

$data['model'] = $model;
/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Manage Ambulance';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->title = "Add Ambulance";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', $data) ?>

</div>
<script>
$(document).ready(function () {
        getLocation();
        $('.google_map').on('click', function () {
            $('#myModal').modal('show');
        });
        $('#myModal').on('shown.bs.modal', function ()
        {
            googlMap('ambulance.png');

            google.maps.event.trigger(map, "resize");
        });
        $('[data-toggle="tooltip"]').tooltip();
        $('.refresh').click(function(){
            //alert();
          google.maps.event.trigger(map, "resize");  
        })
    });
</script>
