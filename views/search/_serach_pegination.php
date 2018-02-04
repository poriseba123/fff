<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

if ((int) $total_results_count > 0) {
    $result = (int) ($total_results_count % $limit);
    if ($result == 0) {
        (int) $total_no_pages = (int) ($total_results_count / $limit);
    } else {
        (int) $total_no_pages = (int) ($total_results_count / $limit) + 1;
    }
}
?>
<ul class="pagination">
    <?php
    die('jjj');
    for ($i = 1; $i <= $total_no_pages; $i++) {
        if ($i < 5) {
            ?>
            <li class="active"><a href="javascript:void(0);"><?= $i; ?></a></li>
        <?php } else {
            ?>
            <li><a href="javascript:void(0);"> ...</a></li>
            <li><a class="pagination-btn" href="javascript:void(0);">Next »</a></li>
                <?php
                exit;
            }
            ?>

    <?php }
    ?>
</ul>