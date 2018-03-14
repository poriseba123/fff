<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$faqContent = \app\models\Faq::find()->where(['status' => '1'])->all();
?>
<div id="content">
    <div class="container">        
        <div class="row">
            <div class="col-md-12">
                <div class="head-faq text-center">
                    <h2 class="section-title">Frequently Asked Questions</h2>
                </div>
                <!-- accordion start -->
                <div class="panel-group" id="accordion">
                    <?php
                    if (!empty($faqContent) && count($faqContent) > 0) {
                        foreach ($faqContent as $index => $value) {
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                            <?= isset($value->question) ? $value->question : ''; ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <?= isset($value->answer) ? $value->answer : ''; ?>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                    }
                    ?>

                </div>
                <!-- accordion End -->    
            </div>      
        </div>
    </div>      
</div>