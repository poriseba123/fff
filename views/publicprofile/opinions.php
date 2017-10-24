<?php
use yii\helpers\Url;
?>
<style>
    .rating-sm {
    font-size: 1.1em !important;
}
.justify{
    text-align: justify!important;
}
</style>
<div class="index-body account-2">
    <section class="total-tab-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="row">
                        <?= $this->context->renderPartial("../partials/user_pro_main_tab_ul") ?>
                    </div>

                    <div class="row">
                        <div class="btm-area clearfix">
                            <div class="clearfix">
                                <div class="col-md-10 col-md-offset-1 col-sm-12">
                                    <div class="prof-nav">
                                        <?= $this->context->renderPartial("../partials/user_pro_sub_tab_ul") ?>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">
                                <div class="col-md-12 col-sm-12">

                                                <div class="cmn-upper-pad">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <?php if(count($rating_master)>0){ ?>
                                                            <h1>Ha recibido <?=count($rating_master);?> opiniones</h1>
                                                            <?php }else{ ?>
                                                            <h1>0 clasificaciones</h1>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="cmn-bbtm-pad">
                                                    <div class="clearfix">
                                                        <div class="col-md-6 col-md-offset-3 col-sm-12">
                                                            <?php
                                                            if(count($rating_master)>0){
                                                                foreach ($rating_master as $v) {
                                                            ?>
                                                                <div class="media">
                                                                    <div class="media-left">
                                                                       <a href="<?= Url::toRoute(['publicprofile/index','id'=>$v->user_id]); ?>" target="_blank">
                                                                        <img src="<?php echo $this->context->getUserProfileImage($v->user_id); ?>" class="media-object img-circle" style="width:60px;height:60px;">
                                                                        </a>
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <!--<h4 class="media-heading">-->
                                                                            <div class="rating-pop cust-rating">
                                            <input type="text" data-hover-enabled='false' data-display-only='true' class="ratingAnalysisItems rating rating-loading" data-size='sm' data-min="0" data-max="5" data-step="1" data-show-caption="false" data-show-clear='false' id="analysisRating<?=$v->id?>_id_input" class="form-control ratingAnalysisItems" type="number" value="<?= $v->rating ?>">
                                        </div>
                                                                        <!--</h4>-->
                                                                        <p class="justify"><span><?php echo $v->userDetails->first_name?> :</span> <?= $v->review ?></p>
                                                                        <h2><?= $this->context->get_month_name(date("F", strtotime($v->added_date))).' , '.date("Y", strtotime($v->added_date))?></h2>
                                                                    </div>
                                                                </div>
                                                            <?php }} ?>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                            </div>



                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>


</div>