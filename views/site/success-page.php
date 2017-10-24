<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Church - Home';
?>
<?= $this->context->renderPartial('../partials/header'); ?>

<section class="block-box-sign">
    <div class="row">
        <div class="sign-top-bg">
            <div class="container"> <h1><?= $model->page_title ?></h1></div>
        </div>
        <div class="container">

            <div class="col-md-12"> 

                <div class="sign-up-warpr">
                    <div class="site-logo">
                        <a href="<?= Yii::$app->urlManager->createUrl('site/index'); ?>" class="brand"><img class="img-responsive center-block" src="<?= $this->context->getStaticImage('Logo.png') ?>" alt=""/></a>                                           
                    </div>
                    <div class="form-area clearfix">
<!--                        <p>Integer vitae felis ut leo tincidunt aliquam porta ut urna. Etiam suscipit, turpis lobortis lacinia volutpat, augue lectus imperdiet
                            risus, ac convallis arcu diam eu mauris. 
                        </p>-->
                        <?= $model->message ?>
                    </div>
                </div> 
            </div>
        </div> 
    </div>      
</section>

<?= $this->context->renderPartial('../partials/footer'); ?>