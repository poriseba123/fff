<?php

use yii\db\Query;
use app\models\TripLocation;
?>
<div class="adds-wrapper" id="search-result">

    <?php
    if (count($results) > 0) {
        foreach ($results as $k => $val) {
            $val = (object) $val;
            ?>
            <div class="item-list">
                <div class="col-sm-2 no-padding photobox">
                    <div class="add-image">
                        <a href="javascript:;"><img src="<?= $this->context->getCategoryImage($image_folder_name, $val->image); ?>" alt=""></a>
                        <span class="photo-count"><i class="fa fa-camera"></i>2</span>
                    </div>
                </div>
                <div class="col-sm-7 add-desc-box">
                    <div class="add-details">
                        <h5 class="add-title"><a href="ads-details.html"><?= (strlen($val->name) > 20) ? substr($val->name, 0, 100) . '..' : $val->name ?></a></h5>
                        <div class="info">
                            <span class="add-type">B</span>
                            <span class="date">
                                <i class="fa fa-clock"></i>
                                16:22:13 2017-02-29
                            </span> -
                            <span class="category">Electronics</span> -
                            <span class="item-location"><i class="fa fa-map-marker"></i>London</span>
                        </div>
                        <div class="item_desc">
                            <a href="#">Donec ut quam felis. Cras egestas, quam in plac erat dictum, erat mauris inte rdum est nec.</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 text-right  price-box">
                    <h2 class="item-price"> $ 320 </h2>
                    <a class="btn btn-danger btn-sm"><i class="fa fa-certificate"></i>
                        <span>Top Ads</span></a> 
                    <a class="btn btn-common btn-sm"> <i class="fa fa-eye"></i> <span>215</span> </a> 
                </div>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>No Data Found!!</h2>
            </div>
        </div>
    <?php } ?>
</div>
<!-- Start Pagination -->
<?php
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
    $k = 0;
    for ($i = 1; $i <= $total_no_pages; $i++) {
        if ($i < 5) {
            ?>
            <li class="tapo <?= ($i == 1) ? 'active' : ''; ?>"><a href="javascript:void(0);" id="<?= $i; ?>"><?= $i; ?></a></li>
            <?php
        } else {
            if ($k == 0) {
                $last_one = $i - 1;
                ?>
                <li class="boka"><a href="javascript:void(0);" > ...</a></li>
                <li><a class="pagination-btn next" href="javascript:void(0);">Next »</a></li>
                    <?php
                    $k++;
                    //exit;
                }
            }
            ?>

    <?php }
    ?>
</ul>
<!-- End Pagination -->
<script>
    $(document).ready(function () {
        tapo = false;
        final = false;
        $('body').on('click', 'li.tapo', function () {
            // do something
            tapo = true;
            $('.tapo').removeClass('active');
            $(this).addClass('active');
        });
//        $(".tapo").click(function () {
//            
//        })
        totalpage_count = "<?= $total_no_pages; ?>";
        flag = false;
        last_one = "<?= $last_one; ?>";
        $(".next").click(function () {
            if (final) {
                now = $(".active").children('a').attr('id');
                console.log("now" + now);
                $("#" + now).parent().removeClass('active');
                then = parseInt(now) + parseInt(1);
                console.log("then" + then);
                $("#" + then).parent().addClass('active');
            }
            if (tapo && !(final)) {
                activeID = $(".active").children('a').attr('id');
                next_countactive = parseInt(activeID) + parseInt(1);
                if (last_one != activeID) {
                    $("#" + activeID).parent().removeClass('active');
                    alert("next_countactive"+next_countactive)
                    $("#" + next_countactive).parent().addClass('active');
                }
                console.log(next_countactive);

            }

            if (flag) {
                id = newid;
            } else {
                id = $(".active").children('a').attr('id');
                alert(id);

            }
            if (id != totalpage_count) {
                $("#" + id).parent().removeClass('active');
            }
            if (!tapo) {
                next_count = parseInt(id) + parseInt(1);
            }else{
                next_count = parseInt(id) + parseInt(0);
            }


            if (id >= last_one) {
                if (totalpage_count >= next_count) {
                    alert("id"+id)
                    flag = true;
                    newid = parseInt(id) + parseInt(1);
                    $('<li class="tapo active"><a href="javascript:void(0);" id="' + newid + '">' + newid + '</a></li>').insertBefore(".boka");
                    if (newid == (parseInt(totalpage_count))) {
                        $(".boka").remove();
                        final = true;
                    }
                }
            } else {

                if (totalpage_count >= next_count) {
                    $("#" + next_count).parent().addClass('active');
                }
            }

        })
    });

</script>