<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Error - 404';
?>
<section class="block-box-sign">
    <div class="row">
        <div class="sign-top-bg">
            <div class="container"> <h1>Page Error!</h1></div>
        </div>
        <div class="container">

            <div class="col-md-12"> 

                <div class="sign-up-warpr">
                    <div class="site-logo">
                        <a href="<?= Yii::$app->urlManager->createUrl('site/index'); ?>" class="brand"><img class="img-responsive center-block" src="<?= $this->context->getStaticImage('Logo.png') ?>" alt=""/></a>                                           
                    </div>
                    <p></p>
                    <div class="form-area clearfix">
                        <div class="col-md-12 error-400" style="text-align: center;">
                            <h1><em>404</em></h1>
                            <?php if (isset($errorMsg) && $errorMsg != '') : ?>
                                <p><em><?= $errorMsg ?></em></p>
                            <?php else : ?>
                                <p><em>Error occured! - File not Found</em></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div> 
            </div>
        </div> 
    </div>      
</section>