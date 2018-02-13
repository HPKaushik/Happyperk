<?php  $default_coupon_image = IMGURL.'/coupons/default-coupon.png'?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="col-lg-5 col-sm-6">
                    <div class="card res-max-height-315 res-min-height-315">
                        <div class="col-xs-12 col-sm-12 pall20">
                            <div class="img-circle col-lg-2 col-sm-2 col-xs-2">
                                <?php if (!empty($voucher->brandlogo)) {?>
                                    <img src="<?php echo LARAVEL_IMAGE_PATH . $voucher->brandlogo; ?>" alt="<?php echo (!empty($voucher)) ? $voucher->brandname : ''; ?>" class="img-responsive" />
                                <?php } else {?>
                                    <img src="<?php echo IMGURL.'/1.png' ?>" alt="<?php echo $voucher->brandname; ?>" class="img-responsive"/>
                                <?php }?>
                            </div>
                            <div class="col-lg-10 col-sm-10 col-xs-10">
                                <h1 class="text-capitalize font-16 wordwrap m0"><?php echo (!empty($voucher)) ? $voucher->name : ''; ?></h1>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12">
                            <div class="col-xs-12">
                                <ul class="nav text-uppercase">
                                    <li class="display-inline-block">About  <b><?php echo (isset($voucher->brandname)) ? $voucher->brandname :''; ?></b></li>
                                    <?php
                                    if (!empty($voucher->cashback_mode)) {
                                    $cbackamount = ($voucher->cashback_mode == 0) ? (!empty($voucher->offer_price)) ? ($voucher->offer_price * $voucher->cashback) : ($voucher->price * $voucher->cashback) : $voucher->cashback;
                                    ?>
                                        <li class="display-inline-block"><b class="theme-purple-color">  | Cashback - <span class="currency-symbol">₹</span> <?php echo isset($cbackamount) ? $cbackamount : '0'; ?></b></li>
                                    <?php }?>
                                </ul>
                            </div>
                            <div class="col-xs-12">
                                <p class="lp1 theme-grey-color mt10">
                                    <?php echo (strlen($voucher->branddescription) > 150) ? substr($voucher->branddescription, 0, 150) . '..' : $voucher->branddescription; ?>
                                </p>
                            </div>
                        </div>
                <?php $brandsloc = $this->brands_redeem_location_model->getResult('*',array('brand_id'=>$voucher->brandid)); 
                        if(count($brandsloc) > 0)  {  ?>
                        <div class="col-md-12 col-xs-12 mtb15">
                            <h6 class="text-middle-line text-uppercase mtb15 lp1 theme-grey-color"><span>Redeem Locations</span></h6>
                            <div class="col-md-6 col-sm-12 col-xs-6">
                                <img src="<?php echo IMGURL.'/coupons/map-placeholder.png' ?>" alt="" class="img-responsive" />
                            </div>
                            <div class="col-md-6 col-sm-12 res-ptb10 col-xs-6">
                            
                                <?php if(count($brandsloc) == 1)  { ?>
                                <address class="font-11 m0"> <!--show only one location here-->
                                </address>
                                <?php } else  { ?>
                                     Total available <b><?php echo count($brandsloc); ?></b> Redemption locations.   
                                <?php } ?>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#RedeemlocationModal" class="theme-color">View All Locations</a>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>
                <div class="col-lg-7 col-sm-6 col-xs-12">
                    <div class="card res-max-height-315 res-min-height-315 no-background">
                        <div class="hp-gallery">
                            <div class="row">
                                <div class=" background-white col-sm-12 col-lg-8 col-xs-8 height100 res-max-height-315 res-min-height-315 " >
                                <a class="lightbox" href="<?php echo (!empty($voucher->image_1)) ? LARAVEL_IMAGE_PATH . $voucher->image_1 : $default_coupon_image; ?>">
                                <span class="content-top discount deal background-white theme-purple-color">
                                <?php $discount=(($voucher->price-$voucher->offer_price) / $voucher->price)*100;
                                echo (!empty($discount)) ? number_format($discount, 0) . '% Off' : '';?>
                                </span>
                                <img src="<?php echo (!empty($voucher->image_1)) ? LARAVEL_IMAGE_PATH . $voucher->image_1 : $default_coupon_image; ?>" alt="<?php echo (!empty($voucher)) ? $voucher->name : ''; ?>" class="height100 img-responsive">
                                </a>
                                </div>
                                <div class="p0 background-white col-sm-6 col-lg-4 col-xs-4 res-max-height-170 res-min-height-170 mb5 res-mt10">
                                <a class="lightbox" href="<?php echo (!empty($voucher->image_2)) ? LARAVEL_IMAGE_PATH . $voucher->image_2 : $default_coupon_image; ?>">
                                <img src="<?php echo (!empty($voucher->image_2)) ? LARAVEL_IMAGE_PATH . $voucher->image_2 : $default_coupon_image; ?>" alt="<?php echo (!empty($voucher)) ? $voucher->name : ''; ?>" class="height100 img-responsive">
                                </a>
                                </div>
                                <div class="p0 background-white col-sm-6 col-lg-4 col-xs-4 res-min-height-170 res-mt10">
                                <a class="lightbox" href="<?php echo (!empty($voucher->image_3)) ? LARAVEL_IMAGE_PATH.$voucher->image_3 : $default_coupon_image; ?>">
                                <img src="<?php echo (!empty($voucher->image_3)) ? LARAVEL_IMAGE_PATH . $voucher->image_3 : $default_coupon_image; ?>" alt="<?php echo (!empty($voucher)) ? $voucher->name :''; ?>" class="height100 img-responsive">
                                </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
    <div class="row">
            <div class="col-xs-12 ">
                <div class="col-md-6 col-xs-12">
                    <div class="card m0">
                        <div class="card-content">
                            <div class="full-width mtb20">
                                <span>Valid :</span><ul class="nav voucher-valid-days">
                                        <li class="img-circle" title="Available">S</li>
                                        <li class="img-circle" title="Available">M</li>
                                        <li class="img-circle" title="Available">T</li>
                                        <li class="img-circle" title="Available">W</li>
                                        <li class="img-circle" title="Available">T</li>
                                        <li class="img-circle background-grey" title="Not Available">F</li>
                                        <li class="img-circle background-grey" title="Not Available">S</li>
                                </ul>
                                <span class="mlr10">Timings - <b><?php echo !empty($voucher->valid_from) ? date("H:m a", strtotime($voucher->valid_from)) : '0'; ?></b> to <b><?php echo !empty($voucher->valid_to) ? date("H:m a", strtotime($voucher->valid_to)) : '0'; ?></b></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12 res-mt10 deal-details-inner">
                   <div class="card m0">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-md-5 col-xs-6 mtb10">
                                    <div class="qty-container">
                                        <?php if ($count_coupons > 0) {?>
                                        <?php if ($this->aauth->is_loggedin()){ echo form_open(BASEURL.'cart/add'); } ?>
                                            <span class="no-of-persons"> Quantity :  
                                            </span>
                                            <button type="button" class="dec p0 no-background no-border"><i class="hp-icons icon">remove_circle</i></button>
                                            <input type="text"  name="quantity" id="quantity" class="form-control" value="1" data-min="1" data-max="<?php if (!empty($voucher->usage_per_user) && $count_coupons > $voucher->usage_per_user) {
                                                echo $voucher->usage_per_user;
                                                } elseif (!empty($voucher->usage_limit) && $count_coupons > $voucher->usage_limit) {
                                                echo $voucher->usage_limit;
                                                } else {
                                                echo $count_coupons;
                                                }
                                                ?>" readonly="">
                                            <button class="inc no-background no-border" type="button"><i class="hp-icons icon">add_circle</i></button>
                                            <input type="hidden" name="id" value="<?php echo (!empty($voucher->id)) ? $voucher->id : ''; ?>"/>
                                               <?php } else {?>
                                             <span class="no-of-persons"><img alt='Not avalible' src="<?php echo IMGURL.'/coupons/not-avalible.png' ?>" />&nbsp;  Coupon is not available </span>
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-6 mtb10">
                                    <p class="m0">
                                            <?php if (!empty($voucher->offer_price)) {?>
                                            <span class="regular-price"><span class="currency-symbol">₹</span><span class="line-through"><?php echo number_format($voucher->price, 0, '', ','); ?></span> | </span>
                                            <?php }?>
                                            <span class="special-price theme-purple-color font-20">
                                            <span class="currency-symbol"> ₹</span>
                                            <?php echo (!empty($voucher) && !empty($voucher->offer_price)) ? number_format($voucher->offer_price,0,'',','):number_format($voucher->price,0,'',',');
                                            ?>
                                            </span>
                                    </p>
                                </div>
                                <div class="col-md-3 col-xs-4 mtb10 p0">
                                    <?php 
                                     $today = strtotime(date('d-m-Y'));
                                     if (strtotime($voucher->valid_to) > $today) { ?>
                                        <?php if (!empty($this->userId)) {?>
                                            <input type="submit" class="btn full-width btn-round buy-now-button" value="Buy Now">
                                             <?php echo form_close(); ?> 
                                            <?php //} else { echo " Sorry, You have already purchased."; } ?>
                                        <?php } else {?>
                                            <a href="<?php echo base_url('login'); ?>">
                                                <button type="button" class="btn full-width btn-round buy-now-button">Buy Now</button>
                                            </a>
                                        <?php }?>
                                    <?php } else {echo "<small>Sorry, Voucher is expired.</small>";}?>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12"> 
            <div class="card">
                <div class="card-content p0">
                <div class="tab-content m0">
<div class="tab-pane active" id="info">
    <ul class="nav nav-pills nav-pills-purple border-bottom-color m0">
        <li class="active">
            <a href="#basic1" class="active no-border-radius" data-toggle="tab" aria-expanded="false"><b class="text-uppercase">DESCRIPTION</b></a>
        </li>
        <li class="">
            <a href="#basic2" class="no-border-radius" data-toggle="tab" aria-expanded="true"><b class="text-uppercase">How to use</b></a>
        </li>
        <li >
            <a href="#basic3" class="no-border-radius" data-toggle="tab" aria-expanded="true"><b class="text-uppercase">Terms & Conditions</b></a>
        </li>
        <li>
            <a href="#basic4" class="no-border-radius" data-toggle="tab" aria-expanded="true"><b class="text-uppercase">Cancellation Policy</b></a>
        </li><li>
            <a href="#basic5" class="no-border-radius" data-toggle="tab" aria-expanded="true"><b class="text-uppercase">Things to Remember</b></a>
        </li>
    </ul>
    <div class="tab-content">
        <!--Description-->
        <div class="tab-pane active" id="basic1">
            <div class="card-content">
                <p><?php echo (!empty($voucher->description)) ?  $voucher->description: '';   ?></p>
            </div>
        </div>
        <!--Description-->

        <!-- How to use details-->
        <div class="tab-pane" id="basic2">
            <div class="card-content">
               <div> 
                   <li>Easy and quick to implement natively in Shopify or using apps.</li>
                   <li>Easy to track with our new Discounts Report.</li>
                   <li>Increased customer acquisition.</li>
                   <li>Increased conversions.</li>
                   <li>Increased customer loyalty.</li>
               </div> 
            </div>
        </div>
        <!-- How to use details-->

        <!-- Terms and condition details-->
        <div class="tab-pane" id="basic3">
            <div class="card-content">
                <?php echo (!empty($voucher->terms)) ? strip_tags($voucher->terms,"<li>") : "No found."; ?>
            </div>
        </div>
        <div class="tab-pane" id="basic4">
            <div class="card-content">
                <?php echo (!empty($voucher->cancellation_policy)) ? strip_tags($voucher->cancellation_policy,"<li>") : "No found."; ?>
            </div>
        </div>
        <!-- Terms and condition details-->
        <!-- things to remember details-->
        <div class="tab-pane" id="basic5">
            <div class="card-content">
                <?php echo (!empty($voucher->things_to_remember)) ? strip_tags($voucher->things_to_remember,"<li>") : "No found."; ?>
            </div>
        </div>
        <!-- things to remember details-->
    </div>
</div>
</div>
</div>
</div>
</div>
<?php /*<div class="col-md-2 cashback-saving hide ">
<div class="card">
<div class="card-content">
<p class="pull-left saving-title">
<span>
Total Saving
</span>
</p>
<span class="pull-left save-amount">
<span class="currency-symbol"> ₹</span>50
</span> 
</div>
</div>
</div>
<div class="col-md-2 cashback-saving hide">
<div class="card">
<div class="card-content">
<p class="pull-right cashback-title">
<span class="pull-right">
HappyCash 
</span>
</p>
<span class="pull-right cashback-amount">
<span class="currency-symbol"> ₹</span>20
</span>
</div>
</div>
</div> 
            <!-- </div> -->
       
        <div class="row hide">
            <div class="col-md-12"> 
                <div class="col-md-8"> 
                    <div class="card">
                        <div class="card-content">
                            <div class="voucher-info-content dynamic-modal-how-to-use"  >
                                <h4 class="font-12 text-uppercase">How to use offer</h4>
                               <div> 
                                    <li>Easy and quick to implement natively in Shopify or using apps.</li>
                                    <li>Easy to track with our new Discounts Report.</li>
                                    <li>Increased customer acquisition.</li>
                                    <li>Increased conversions.</li>
                                    <li>Increased customer loyalty.</li>
                               </div> 
                               <a class="open-dynamic-modal" data-target="#OpenContentModal" data-cls="how-to-use" data-toggle="modal">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="row hide">
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-content">
                            <div class="voucher-info-content dynamic-modal-terms">
                                <h4 class="font-12 text-uppercase">Terms & Conditions </h4>
                            </div>
                            <div class="voucher-info-content dynamic-modal-terms ptb15">
                                <div class="font-11 theme-grey-color">
                                    <?php echo (!empty($voucher->terms)) ? strip_tags($voucher->terms,"<li>") : "No found."; ?>
                                </div>
                                <?php echo (!empty($voucher->terms))  ? '<a class="open-dynamic-modal" data-target="#OpenContentModal"  data-cls="terms" data-toggle="modal">Read more</a>' : '';?> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-content">
                            <div class="voucher-info-content dynamic-modal-policy">
                                <h4 class="font-12 text-uppercase">Cancellation Policy </h4>
                            </div>
                            <div class="voucher-info-content dynamic-modal-policy ptb15">
                                <div  class="font-11 theme-grey-color">
                                    <?php echo (!empty($voucher->cancellation_policy)) ? strip_tags($voucher->cancellation_policy,"<li>") : "No found."; ?>
                                </div>
                                <?php echo (!empty($voucher->cancellation_policy))  ? '<a class="open-dynamic-modal" data-target="#OpenContentModal" data-cls="policy" data-toggle="modal">Read more</a>' : '';?> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-content">
                            <div class="voucher-info-content dynamic-modal-things">
                                <h4 class="font-12 text-uppercase">Points To Remember</h4>
                            </div>
                            <div class="voucher-info-content dynamic-modal-things ptb15">
                                <div  class="font-11 theme-grey-color">
                                    <?php echo (!empty($voucher->things_to_remember)) ? strip_tags($voucher->things_to_remember,"<li>") : "No found."; ?>
                                </div>
                                 <?php echo (!empty($voucher->things_to_remember))  ? '<a class="open-dynamic-modal" data-target="#OpenContentModal" data-cls="things" data-toggle="modal">Read more</a>' : '';?>   
                               
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        */?>
            <?php
            $same_brand_voucher = $this->vouchers_model->get_voucher_of_same_brand($voucher->brandid, $voucher->id);
            if (isset($same_brand_voucher) && count($same_brand_voucher) > 1) {
            ?>
            <div class="col-xs-12 "> 
             <div class="card m0">
               <div class="card-content">
                  <div class="full-width mtb20">
                    <h4 class="header-title m-l-20 mt20">Coupons from same brand</h4>
                    <div class="col-md-12">
                    <?php foreach ($same_brand_voucher as $brandvoucher) {?>
                        <div class="col-md-3">
                            <!-- <div class="card"> -->
                                <div class="hp_grid mt20">
                                    <div class="hp-coupon-item full-width">
                                        <article class="coupon-container">
                                            <div class="hp-coupon-item-details">
                                                <div class="coupon-image">
                                                    <a href="#" title="Coupon Name" class="coupon-link">
                                                        <?php if (!empty($brandvoucher->image_1)) {?>
                                                            <img src="<?php echo LARAVEL_IMAGE_PATH . $brandvoucher->image_1; ?>" class="" alt="Image" />
                                                        <?php } else {?>
                                                           <img src="<?php echo $default_coupon_image; ?>" class="" alt="Image" />
                                                        <?php }?>
                                                    </a>
                                                </div>
                                                <div class="coupon-details-btm">
                                                    <div class="coupon-title-wrapper col-sm-7 no-padding">
                                                        <h2 class="coupon-title h3">
                                                            <a class="" href="#"> <?php echo $brandvoucher->name ?> <i class="icon tick-mark"></i></a>
                                                        </h2>
                                                    </div>
                                                    <div class="coupon-price-wrapper  col-sm-5 no-padding">
                                                        <p class="float-vendor-icon">
                                                            <?php if (!empty($brandvoucher->brandlogo)) {?>
                                                                <img class="" src="<?php echo LARAVEL_IMAGE_PATH . $brandvoucher->brandlogo; ?>" alt="<?php echo $brandvoucher->brandname ?>">
                                                            <?php } else {?>
                                                                <img class="" src="<?php echo IMGURL;?>/1.png" alt=""/>
                                                            <?php }?>
                                                        </p>
                                                        <div class="coupon-prices">
                                                            <?php if (!empty($voucher->offer_price)) {?>
                                                                <span class="offer-price">Rs.<?php echo number_format($brandvoucher->offer_price, 0, '', ','); ?></span>
                                                                <span class="actual-price underline">Rs.<?php echo number_format($brandvoucher->price, 0, '', ','); ?></span>
                                                            <?php } else {?>
                                                                <span class="actual-price">Rs.<?php echo number_format($brandvoucher->price, 0, '', ','); ?></span>
                                                            <?php }?>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <a href="<?php echo BASEURL .  "vc/$brandvoucher->id/".generateslug($brandvoucher->name); ?>">
                                                <div class="hp-coupon-popup">
                                                    <div class="coupon-popup-wrapper">
                                                        <div class="coupon-content">
                                                            <div class="area_01">
                                                                <p class="float-vendor-icon">
                                                                    <?php if (!empty($brandvoucher->brandlogo)) {?>
                                                                        <img class="" src="<?php echo LARAVEL_IMAGE_PATH . $brandvoucher->brandlogo; ?>" alt="<?php
                                                                            if (!empty($brandvoucher)) {
                                                                            echo $brandvoucher->brandname;
                                                                            }
                                                                            ?>"/>
                                                                         <?php } else {?>
                                                                        <img class="" src="<?php echo IMGURL; ?>/1.png" alt=""/>
                                                                    <?php }?>
                                                                </p>
                                                            </div>
                                                            <div class="area_02">
                                                                <p class="stars"></p>
                                                            </div>
                                                            <div class="area_03">
                                                                <?php if (!empty($brandvoucher->offer_price)) {?>
                                                                    <span class="offer-price">Rs.<?php echo number_format($brandvoucher->offer_price, 0, '', ','); ?></span>
                                                                    <span class="actual-price underline">Rs.<?php echo number_format($brandvoucher->price, 0, '', ','); ?></span>
                                                                <?php } else {?>
                                                                    <span class="actual-price">Rs.<?php echo number_format($brandvoucher->price, 0, '', ','); ?></span>
                                                                <?php }?>
                                                            </div>
                                                            <div class="area_04">
                                                                <p class="description"><?php echo $brandvoucher->short_description; ?></p>
                                                            </div>
                                                            <div class="area_05">
                                                            </div>
                                                        </div>
                                                        <div class="coupon-popup-footer">
                                                            <div class="discount"><p>
                                                                <?php
                                                                $brandvoucher->offer_price = (empty($brandvoucher->offer_price)) ? $brandvoucher->price : $brandvoucher->offer_price;
                                                                $discount = (($brandvoucher->price - $brandvoucher->offer_price) / $brandvoucher->price) * 100;
                                                                echo (!empty($discount)) ? number_format($discount, 0) . '% Off' : '<span>No offer</span>';
                                                                ?>
                                                                </p></div>
                                                            <div class="expire_date"><p class="small">ENDS ON <?php echo date('d M Y', strtotime($brandvoucher->valid_to)); ?></p></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </article>
                                    </div>
                                </div>
                            <!-- </div> -->
                        </div>
                        <?php }?></div>
                   </div>
                </div>
            </div>
        </div>
        <?php }
        $same_category_voucher = $this->vouchers_model->get_voucher_of_same_category($voucher->brandid, $voucher->brandcategoryid, $voucher->id);
        if (isset($same_category_voucher) && count($same_category_voucher) > 1) {
        ?>
            <div class="col-xs-12 "> <div class="card m0">
                <div class="card-content">
                    <div class="full-width mtb20">
                        <h4 class="header-title m-l-20 mt20">Coupons from same category </h4>
                <div class="col-md-12">
                    <?php foreach ($same_category_voucher as $categoryvoucher) { ?>
                        <div class="col-md-3">
                            <!-- <div class="card"> -->
                                <div class="hp_grid mt20">
                                    <div class="hp-coupon-item full-width">
                                        <article class="coupon-container">
                                            <div class="hp-coupon-item-details">
                                                <div class="coupon-image">
                                                    <a href="#" title="Coupon Name" class="coupon-link">
                                                        <?php if (!empty($categoryvoucher->image_1)) {?>
                                                            <img src="<?php echo LARAVEL_IMAGE_PATH . $categoryvoucher->image_1; ?>" class="" alt="Image" />
                                                        <?php } else {?>
                                                            <img src="<?php echo IMGURL;?>/coupons/1.jpg" class="" alt="Image" />
                                                        <?php }?>
                                                    </a>
                                                </div>
                                                <div class="coupon-details-btm">
                                                    <div class="coupon-title-wrapper col-sm-7 no-padding">
                                                        <h2 class="coupon-title h3">
                                                            <a class="" href="#"> <?php echo $categoryvoucher->name ?> <i class="icon tick-mark"></i></a>
                                                        </h2>
                                                    </div>
                                                    <div class="coupon-price-wrapper  col-sm-5 no-padding">
                                                        <p class="float-vendor-icon">
                                                            <?php if (!empty($categoryvoucher->brandlogo)) {?>
                                                                <img class="" src="<?php echo LARAVEL_IMAGE_PATH . $categoryvoucher->brandlogo; ?>" alt="<?php echo $categoryvoucher->brandname ?>">
                                                            <?php } else {?>
                                                                <img class="" src="<?php echo IMGURL; ?>/1.png" alt=""/>
                                                            <?php }?>
                                                        </p>
                                                        <div class="coupon-prices">
                                                            <?php if (!empty($voucher->offer_price)) {?>
                                                                <span class="offer-price">Rs.<?php echo number_format($categoryvoucher->offer_price, 0, '', ','); ?></span>
                                                                <span class="actual-price underline">Rs.<?php echo number_format($categoryvoucher->price, 0, '', ','); ?></span>
                                                            <?php } else {?>
                                                                <span class="actual-price">Rs.<?php echo number_format($categoryvoucher->price, 0, '', ','); ?></span>
                                                            <?php }?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="<?php echo BASEURL .  "vc/".$categoryvoucher->id."/".generateslug($categoryvoucher->name);?>">
                                                <div class="hp-coupon-popup">
                                                    <div class="coupon-popup-wrapper">
                                                        <div class="coupon-content">
                                                            <div class="area_01">
                                                                <p class="float-vendor-icon">
                                                                    <?php if (!empty($categoryvoucher->brandlogo)) {?>
                                                                        <img class="" src="<?php echo LARAVEL_IMAGE_PATH . $categoryvoucher->brandlogo; ?>" alt="<?php echo (!empty($categoryvoucher)) ? $categoryvoucher->brandname : ''; ?>"/>
                                                                    <?php } else {?>
                                                                        <img class="" src="<?php echo IMGURL; ?>/1.png" alt=""/>
                                                                    <?php }?>
                                                                </p>
                                                            </div>
                                                            <div class="area_02">
                                                                <p class="stars"></p>
                                                            </div>
                                                            <div class="area_03">
                                                                <?php if (!empty($categoryvoucher->offer_price)) {?>
                                                                    <span class="offer-price">Rs.<?php echo number_format($categoryvoucher->offer_price, 0, '', ','); ?></span>
                                                                    <span class="actual-price underline">Rs.<?php echo number_format($categoryvoucher->price, 0, '', ','); ?></span>
                                                                <?php } else {?>
                                                                    <span class="actual-price">Rs.<?php echo number_format($categoryvoucher->price, 0, '', ','); ?></span>
                                                                <?php }?>
                                                            </div>
                                                            <div class="area_04">
                                                                <p class="description"><?php echo $categoryvoucher->short_description; ?></p>
                                                            </div>
                                                            <div class="area_05">
                                                            </div>
                                                        </div>
                                                        <div class="coupon-popup-footer">
                                                            <div class="discount">
                                                                <p>
                                                                    <?php
// print_r($categoryvoucher);
        $categoryvoucher->offer_price = (empty($categoryvoucher->offer_price)) ? $categoryvoucher->price : $categoryvoucher->offer_price;
        $discount = (($categoryvoucher->price - $categoryvoucher->offer_price) / $categoryvoucher->price) * 100;
        echo (!empty($discount)) ? number_format($discount, 0) . '% Off' : '<span>No offer</span>';
        ?>
                                                                </p>
                                                            </div>
                                                            <div class="expire_date"><p class="small">ENDS ON <?php echo date('d M Y', strtotime($categoryvoucher->valid_to)); ?></p></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </article>
                                    </div>
                                </div>
                            <!-- </div> -->
                        </div>

                    <?php }?>
                </div>
            </div>
                    </div>
                </div>
            </div>
        </div> <?php }?>
</div></div>
</div>
</div>
<div id="OpenContentModal" class="modal fade" role="dialog" tabindex='-1'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="hp-icons font-30">highlight_off</i></button>
                    <h4 class="modal-title text-center">col-sm-6 </h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script>
baguetteBox.run('.hp-gallery');
</script>
