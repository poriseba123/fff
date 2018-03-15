<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\ArrayHelper;
use app\models\ServicesList;

$landing_page = \app\models\Landingpage::find()->where(['id' => '1'])->all();
?>
<!-- Main container Start -->  
<div class="main-container">
    <div class="container">
        <div class="row">          
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body"><?= isset($landing_page[0]->tearmsof_use) ? ucfirst($landing_page[0]->tearmsof_use) : ''; ?></div>
                </div>
                
            </div>

        </div>
    </div>
</div>
<!-- Main container End -->  
