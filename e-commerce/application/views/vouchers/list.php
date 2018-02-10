<?php
$printed = array();  
// if (isset($vouchers)) //unset($vouchers['0']); ?>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="full-width mtb20">
                    <?php if (isset($vouchers)) { ?>
                    <h3>Search All Result (<?php echo count($vouchers); ?>)</h3>
                    <?php  } ?>
                </div>
            </div>
            <div class="col-md-2 col-xs-12">
                <?php echo form_open(base_url() . 'vouchers/search'); ?>
                    <h5>Search </h5><input type="text" name="name" required="true" aria-required="true" aria-invalid="false" class="form-control" value="<?php echo isset($search_keyword) ? $search_keyword : ''; ?>" placeholder="Search here.." >                   
                    <?php echo form_close(); ?>
                <h5>Brands </h5>
                <?php
                $brandname = $this->brands_model->getResult('*', array('status' => '1'));
                if (!empty($brandname)) {
                    foreach ($brandname as $key => $bname) {
                        ?>
                        <label class="containerbox"><?php echo $bname->name; ?>
                            <input type="checkbox" onclick="getbrandcheck(this.id);" class="brandcheckbox" id="<?php echo $bname->id; ?>" name="brand_name[]" value="<?php echo $bname->id; ?>">
                            <span class="checkmark"></span>
                        </label>
                        <?php
                    }
                }
                ?><br>
                <h5>Categories</h5>
                <?php
                $categories = $this->category_model->getResult('*', array('status' => '1'));
                if (!empty($categories)) {
                    foreach ($categories as $key => $category) {
                        ?>
                        <label class="containerbox"><?php echo $category->name; ?>
                            <input type="checkbox" class="categorycheckbox" id="category_name" name="category_name[]" value="<?php echo $category->id; ?>">
                            <span class="checkmark"></span>
                        </label>
                        <?php
                    }
                }
                ?>
            </div>
            <div class="col-md-10 col-xs-12" >
                <div class="hp_grid mt20 col-sm-12" id="brand_vocher">
                    <?php
                    $c = 1;
                    if (isset($vouchers) && !empty($vouchers) && count($vouchers) > 0) {
                        shuffle($vouchers);
                        foreach ($vouchers as $voc) { 
                            ?>
                            <div class="hp-coupon-item <?php echo ($c % 2 != 0) ? 'hp-coupon-item--height2' : ''; ?>">
                                <article class="coupon-container">
                                    <div class="hp-coupon-item-details">
                                        <div class="coupon-image">
                                            <a href="#" title="<?php echo is_array($voc) &&  array_key_exists('name',$voc) ? $voc['name'] :''; ?>" class="coupon-link">
                                                <?php if (!empty($voc['image_1'])) { ?>
                                                    <img src="<?php echo LARAVEL_IMAGE_PATH . $voc['image_1']; ?>" class="" alt="<?php echo is_array($voc) &&  array_key_exists('name',$voc) ? $voc['name'] :''; ?>" />
                                                <?php } else { ?>
                                                    <img src="<?php echo base_url(); ?>assets/frontend/img/coupons/1.jpg" class="" alt="<?php echo is_array($voc) &&  array_key_exists('name',$voc) ? $voc['name'] :''; ?>" />
                                                <?php } ?>
                                            </a>
                                        </div>
                                        <div class="coupon-details-btm">
                                            <div class="coupon-title-wrapper col-sm-7 no-padding">
                                                <h2 class="coupon-title h3">
                                                    <a class="" href="#"> <?php echo is_array($voc) &&  array_key_exists('name',$voc) ? $voc['name'] :''; ?> <i class="icon tick-mark"></i></a>
                                                </h2>
                                            </div>
                                            <div class="coupon-price-wrapper  col-sm-5 no-padding">
                                                <p class="float-vendor-icon">
                                                    <?php if (!empty($voc['brandlogo'])) { ?>
                                                        <img class="" src="<?php echo LARAVEL_IMAGE_PATH . $voc['brandlogo']; ?>"
                                                             alt="<?php echo (!empty($voc)) ? $voc['brandname'] : ''; ?>"/>
                                                         <?php } else { ?>
                                                        <img class="" src="<?php echo base_url(); ?>assets/frontend/img/1.png" alt=""/>
                                                    <?php } ?>
                                                </p>
                                                <div class="coupon-prices">
                                                    <?php if (!empty($voc['offer_price'])) { ?>
                                                        <span class="offer-price">Rs.<?php echo number_format($voc['offer_price'], 0, '', ','); ?></span>
                                                        <span class="actual-price underline">Rs.<?php echo number_format($voc['price'], 0, '', ','); ?></span>
                                                    <?php } else {  ?>
                                                        <span class="actual-price">Rs.<?php echo is_array($voc) &&  array_key_exists('price',$voc) ? number_format($voc['price'], 0, '', ','): 0; ?></span>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ( is_array($voc) && array_key_exists('id',$voc)) {  ?>
                                    <a href='<?php echo base_url() . "vouchers/".  $voc['id']."/view"; ?>'>
                                        <div class="hp-coupon-popup">
                                            <div class="coupon-popup-wrapper">
                                                <div class="coupon-content">
                                                    <div class="area_01">
                                                        <p class="float-vendor-icon">
                                                            <?php if (isset($voc) && !empty($voc['brandlogo'])) { ?>
                                                                <img class="" src="<?php echo LARAVEL_IMAGE_PATH . $voc['brandlogo']; ?>" alt="<?php echo (isset($voc) && !empty($voc['brandname'])) ? $voc['brandname'] : ''; ?>"/>
                                                            <?php } else { ?>
                                                                <img class="" src="<?php echo base_url(); ?>assets/frontend/img/1.png" alt=""/>
                                                            <?php } ?>
                                                        </p>
                                                    </div>
                                                    <div class="area_02">
                                                        <p class="stars"></p>
                                                    </div>
                                                    <div class="area_03">
                                                        <?php if (!empty($voc['offer_price'])) { ?>
                                                            <span class="offer-price">Rs.<?php echo number_format($voc['offer_price'], 0, '', ','); ?></span>
                                                            <span class="actual-price underline">Rs.<?php echo number_format($voc['price'], 0, '', ','); ?></span>
                                                        <?php } else { ?>
                                                            <span class="actual-price">Rs.<?php echo number_format($voc['price'], 0, '', ','); ?></span>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="area_04">
                                                        <p class="description"><?php echo $voc['short_description']; ?></p>
                                                    </div>
                                                    <!--<div class="area_05">
                                                         <button class="btn btn-primary buy_now" onclick="return show_register_login('login');">Buy Now</button>
                                                     </div>-->
                                                </div>
                                                <div class="coupon-popup-footer">
                                                    <div class="discount">
                                                        <p>
                                                            <?php
                                                            $voc['offer_price'] = (empty($voc['offer_price'])) ? $voc['price'] : $voc['offer_price'];
                                                            $discount = (($voc['price'] - $voc['offer_price']) / $voc['price']) * 100;
                                                            echo (!empty($discount)) ? number_format($discount, 0) . '% Off' : '<span>No offer</span>';
                                                            ?>
                                                        </p>
                                                    </div>
                                                    <div class="expire_date">
                                                        <p class="small">ENDS ON <?php echo print_date($voc['valid_to']) ?> </p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </a> 
                                    <?php  } else echo $voc; ?>
                                    </aritcle>
                            </div>
                            <?php
                            $c++;
                        } // for each loop end
                    } else {
                        echo "No search result found.";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    /* The container */
    .containerbox {
            display: block;
    position: relative;
    padding-left: 23px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 14px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        text-transform: capitalize;
    }
    /* Hide the browser's default checkbox */
    .containerbox input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 15px;
        width: 15px;
        background-color:#a7a4a4;
    }

    /* On mouse-over, add a grey background color */
    .containerbox:hover input ~ .checkmark {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .containerbox input:checked ~ .checkmark {
        background-color: #673BB7;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .containerbox input:checked ~ .checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .containerbox .checkmark:after {
        left: 5px;
        top: 1px;
        width: 5px;
        height: 11px;
        border: solid white;
        border-width: 0 1px 1px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>
<script>
    function getbrandcheck(id) {
        var base_url = $('#txtbaseurl').val();
        var search_key = $('#search_name').val();
        //alert(search_key);
        var id = [];
        $('.brandcheckbox:checked').each(function (i) {
            id[i] = $(this).val();
            //alert(id[i]);
        });
        $.ajax({
            url: base_url + 'front_vouchers/brandWiseVoucherFilter',
            method: 'POST',
            data: {id: id, search_key: search_key},
            success: function (responseData)
            {
                //alert(responseData);
                $('#brand_vocher').html(responseData);
            }
        });
    }
</script>