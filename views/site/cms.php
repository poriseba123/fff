<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="index-body">
    <section class="total-tab-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <?=$model->content ?>

                </div>
            </div>
        </div>
    </section>


</div>
