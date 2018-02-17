<?php include 'getdata.php'; // contails slider code.                        ?>
<?php include 'slider.php'; // contails slider code.                        ?>
<div class="content">
    <div class="container">
        <?php include 'recharge.php'; // contails code related to recharge. ?>
        <div class="row">
        <div class="hp_grid mt20 col-sm-12">
            <?php
            $itemID = '';
            $c = 1;
            $printed = false;
            $random_num = 6;
            if (isset($vouchers) && !empty($vouchers) && count($vouchers) > 0) {
                $itemID = $vouchers[0]->id;
                // shuffle($vouchers);
                foreach ($vouchers as $voc) {
                    ?>
                <div class="hp-coupon-item <?php echo ($c % 2 != 0) ? 'hp-coupon-item--height2' : ''; ?>">
                    <article class="coupon-container">
                        <div class="hp-coupon-item-details">
                            <div class="coupon-image">
                                <a href="#" title="<?php echo $voc->name; ?>" class="coupon-link">
                                    <?php if (!empty($voc->image_1)) { ?>
                                    <img src="<?php echo LARAVEL_IMAGE_PATH . $voc->image_1; ?>" class="" alt="<?php echo $voc->name; ?>" />
                                    <?php } else { ?>
                                    <img src="<?php echo IMGURL; ?>/coupons/1.jpg" class="" alt="<?php echo $voc->name; ?>" />
                                    <?php } ?>
                                </a>
                                <div class="font-14 voucher-tags"> <span class=""><?php echo (($voc->is_new == 1) ? "New" : ( ($voc->is_hot == 1) ? "Hot" : (($voc->is_featured == 1) ? "Featured" : '')));?></span></div>
                            </div>
                            <div class="coupon-details-btm">
                                <div class="coupon-title-wrapper col-sm-7 no-padding">
                                    <h2 class="coupon-title h3">
                                        <a class="" href="#">
                                            <?php echo $voc->name; ?> <i class="icon tick-mark"></i></a>
                                    </h2>
                                </div>
                                <div class="coupon-price-wrapper  col-sm-5 no-padding">
                                    <p class="float-vendor-icon">
                                        <?php if (!empty($voc->brandlogo)) { ?>
                                        <img class="" src="<?php echo LARAVEL_IMAGE_PATH . $voc->brandlogo; ?>" alt="" />
                                        <?php } else { ?>
                                        <img class="" src="<?php echo IMGURL; ?>/1.png" alt="" />
                                        <?php } ?>
                                    </p>
                                    <div class="coupon-prices">
                                        <?php if (!empty($voc->offer_price)) { ?>
                                        <span class="offer-price">Rs.<?php echo number_format($voc->offer_price, 0, '', ','); ?></span>
                                        <span class="actual-price underline">Rs.<?php echo number_format($voc->price, 0, '', ','); ?></span>
                                        <?php } else { ?>
                                        <span class="actual-price">Rs.<?php echo number_format($voc->price, 0, '', ','); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <a href='<?php echo BASEURL. "vc/$voc->id/".generateslug($voc->name); ?>'>
                            <div class="hp-coupon-popup">
                                <div class="coupon-popup-wrapper">
                                    <div class="coupon-content">
                                        <div class="area_01">
                                            <p class="float-vendor-icon">
                                                <?php if (isset($voc) && !empty($voc->brandlogo)) { ?>
                                                <img class="" src="<?php echo LARAVEL_IMAGE_PATH . $voc->brandlogo; ?>" alt="" />
                                                <?php } else { ?>
                                                <img class="" src="<?php echo IMGURL; ?>/1.png" alt="" />
                                                <?php } ?>
                                            </p>
                                        </div>
                                        <div class="area_02">
                                            <p class="stars"></p>
                                        </div>
                                        <div class="area_03">
                                            <?php if (!empty($voc->offer_price)) { ?>
                                            <span class="offer-price">Rs.<?php echo number_format($voc->offer_price, 0, '', ','); ?></span>
                                            <span class="actual-price underline">Rs.<?php echo number_format($voc->price, 0, '', ','); ?></span>
                                            <?php } else { ?>
                                            <span class="actual-price">Rs.<?php echo number_format($voc->price, 0, '', ','); ?></span>
                                            <?php } ?>
                                        </div>
                                        <div class="area_04">
                                            <p class="description">
                                                <?php echo $voc->short_description; ?>
                                            </p>
                                        </div>
                                        <!--  <div class="area_05">
                                                 <button class="btn btn-primary buy_now" onclick="return show_register_login('login');">Buy Now</button>
                                             </div> -->
                                    </div>
                                    <div class="coupon-popup-footer">
                                        <div class="discount">
                                            <p>
                                                <?php
                                                    $voc->offer_price = (empty($voc->offer_price)) ? $voc->price : $voc->offer_price;
                                                    $discount = (($voc->price - $voc->offer_price) / $voc->price) * 100;
                                                    echo (!empty($discount)) ? number_format($discount, 0) . '% Off' : '<span>No offer</span>';
                                                    ?>
                                            </p>
                                        </div>
                                        <div class="expire_date">
                                            <p class="small">ENDS ON
                                                <?php echo print_date($voc->valid_to) ?> </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </a>
                        </aritcle>
                </div>
                <?php
                    $c++;
                } // for each loop end
                ?>
                    <?php
                if (get_session_var('employeed_logged_in') && isset($award) && count($award) > 0) {
                    if ($printed == false) {
                        ?>
                        <div class="hp-coupon-item background-white">
                            <article class="coupon-container font-14">
                                <div class="hp-coupon-item-details text-center">
                                    <p class="mt20">Congratulations</p>
                                    <div class="coupon-image mt20">
                                        <img src="<?php echo IMGURL; ?>/coupons/best_performer.png" class="award-icon add_bounce hinge" alt="<?php echo $award->title ?>" />
                                    </div>
                                    <div class="mtb20">
                                        <p class="text-uppercase lp1 theme-purple-color">
                                            <?php echo get_user_name($award->employee); ?>
                                        </p>
                                        <p>
                                            <?php echo $award->title; ?>
                                        </p>
                                        <span class="font-11">Web Developer - HPE000152</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <?php
                        $printed = true;
                    }
                } // if condition end.
            } else {
                ?>
                            <b><span> No items found.</span></b>
                            <?php } ?>
        </div>
        </div>
    </div>
</div>
<?php if (isset($vouchers) && !empty($vouchers) && count($vouchers) > 0) { ?>
<div class="row m0 last_div">
    <div class="col-sm-12">
        <div data-lastid="<?php echo $itemID; ?>" class="loader" data-offset="5" data-limit="5" data-is_last="0" data-awardoffset="1" style="display: none;">
            <img src="<?php echo IMGURL ?>/loader.gif" />
        </div>
    </div>
</div>
<?php } ?>


