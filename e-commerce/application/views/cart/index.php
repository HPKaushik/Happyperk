<?php $rechargdata = get_session_var('rechargevalue');?>
<div class="container">
<?php if (!empty($this->cart->contents())) {
$num_of_items = count($this->cart->contents());

 ?>
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="card">
                        <div class="card-header">
                    <?php if (isset($rechargdata['rechargeOfType']) && !empty($rechargdata['rechargeOfType'])) { ?>
                            <h5 class="card-title theme-color text-uppercase">
                                <?php   if ($rechargdata['rechargeOfType'] == '1') {
                                            echo "Mobile Recharge";
                                        } elseif ($rechargdata['rechargeOfType'] == '2') {
                                            echo "Land Line Recharge";
                                        } elseif ($rechargdata['rechargeOfType'] == '3') {
                                            echo "Broadband Recharge";
                                        } elseif ($rechargdata['rechargeOfType'] == '4') {
                                            echo "Datacard Recharge";
                                        } elseif ($rechargdata['rechargeOfType'] == '5') {
                                            echo "DTH Recharge";
                                        } elseif ($rechargdata['rechargeOfType'] == '6') {
                                            echo "Electricity Bill Recharge";
                                        } elseif ($rechargdata['rechargeOfType'] == '7') {
                                            echo "Gas Bill Recharge";
                                        } ?>        
                            </h5> 
                        <?php } else { ?>
                            <h5 class="card-title theme-color text-uppercase">Order Summary</h5>
                        <?php } ?>
                        </div>
                        <div class="card-content">
                            <div class="cardt-items">
                                <?php $i = 1; foreach ($this->cart->contents() as $key => $items): 
                                 $sub_total = ($items['subtotal'] > 0 ) ? number_format($items['subtotal'], 0, '.', ',') :  0;
                                ?>
                                    <div class="cart-item">
                                        <?php echo form_open('cart/update_cart'); ?>
                                        <div class="col-sm-8">
                                            <h5><?php echo $items['name']; ?></h5>
                                        </div>
                                        <div class="col-sm-4 pull-right">
                                            <h5>Rs. <?php echo number_format($items['price'], 0, '.', ','); ?></h5>
                                        </div>
                                        <div class="mt10">
                                            <div class="col-sm-8 hide">
                                                <?php if (strpos(current_url(), 'cart/recharge') != true) {?>
                                                    <div class="qty-actions" >
                                                        <span>Qty -</span>&nbsp;
                                                        <span class="dec"><i class="hp-icons">remove_circle_outline</i></span>
                                                        <?php 
                                                        if(isset($items)) {
                                                        echo form_input(array('name' => 'coupon[' . $key . '][qty]', 'value' => $items['qty'], 'max' => $items['max'], 'min' => '1', 'size' => '5', 'class' => 'form-control input-transparent', 'data-row-id' => $key)); } ?>
                                                        <span class="inc"><i class="hp-icons">add_circle_outline</i></span>
                                                    </div>
                                                <?php } else { ?>
                                                    <h5>Operator: <span class="text-uppercase"> <?php echo $rechargdata['operatorname']; ?></span></h5>
                                                    <h5>Circle: <span class="text-uppercase"> <?php echo $rechargdata['regioncircle']; ?></span></h5>
                                                    <?php if ($rechargdata['rechargeOfType'] == '1') {?>
                                                        <h5>Amount:  Rs. <?php echo number_format($items['price'], 0, '.', ','); ?></h5>
                                                    <?php }?>
                                                <?php }?>
                                            </div>
                                            <!--Rs 599</small><span class="item-price"> 
                                        <div class="col-sm-6 text-right"><small class="old-price line-through">
                                        <?php //echo number_format($this->cart->format_number($items['price']), 0, '.', ','); ?>
                                        </span></div>-->
                                        </div>
                                        </form>
                                    </div>
                                    <?php $i++;
                                        	endforeach;
                                    ?>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title theme-color text-uppercase">Total Amount</h5>
                        </div>
                        <div class="card-content">
                            <div class="cardt-items">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Total items</td>
                                            <td class="text-right">Total amount to pay</td>
                                        </tr>
                                        <tr>
                                            <td class="items-count"><?php echo $num_of_items; ?></td>
                                            <td colspan="2" class="text-right items-totalPay">Rs <?php echo $sub_total; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-right no-border text-green"><i class="hp-icons">check_circle</i> inclusive of all taxes</td>
                                        </tr>
                                        <tr >
                                            <td colspan="2" class="no-border text-center font-12">Read our cancellation policy <a href="#" target="_blank" class="theme-color">here</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-7">
                    <?php /*if (isset($cashback) && $cashback > 0) {?>
                        <div class="card"> <!-- TODO: visible if cashback exists-->
                            <div class="card-header">
                                <h5 class="card-title theme-color text-uppercase">Cashbacks</h5>
                            </div>
                            <div class="card-content">
                            <p>Credited To Cashback Wallet - 
                                <span class="cashback_amount">Rs.<?php echo isset($cashback) ? $cashback : '00'; ?></span>
                            </p>
                            </div>
                        </div>
                    <?php } */ ?>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title theme-color text-uppercase">  Payment Methods</h5>
                        </div>
                        <div class="card-content p0">
                            <div class="row">
                                <div class="col-lg-4">
                                    <ul class="nav nav-pills custom-padding nav-pills-purple border-right-color nav-stacked">
                                        <li class="active">
                                            <a href="#hp-wallet" data-toggle="tab"><img src="<?php echo IMGURL.'/cart/hp-wallet.png'; ?>" width="20" />&nbsp;&nbsp;&nbsp;Happyperks Wallet</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-8">
                                    <div class="tab-content" style="margin-bottom: 30px">
                                        <div class="tab-pane active text-center" id="hp-wallet">
                                            <h5 class="text-center text-uppercase">Your Happyperks Wallet Balance Is</h5>
                                            <img src="<?php echo IMGURL.'/cart/hp-wallet-inner.png'; ?>" class="mtb15"/>
                                            <h3 class="text-light-green mb10">Rs. <?php echo number_format($this->mybalance, 0, '.', ','); ?></h3>
                                            <?php
                                            $url = base_url() . 'cart/review';
                                            if (strpos(current_url(), 'cart/recharge') != true) {
                                                 $this->session->set_userdata('is_recharge',false);
                                                //    $url = base_url() . 'placeorder';
                                            } else {
                                                $this->session->set_userdata('is_recharge',true);
                                                //  $url = base_url() . 'cart/review';
                                            }
                                            if (!empty($this->cart->contents())) :
                                            if ($sub_total > $this->mybalance) {  ?> 
                                            <span class=' text-center error-info'>You have to load money in wallet first<br><a href="<?php echo base_url().'user/profile#wallet' ?>" class='mt20 btn btn-round btn-fill btn-yellow btn-wallet-pay'>Load now</a>
                                            </span>
                                            <?php  } else { ?> 
                                            <span class="error-info" style="display:none;"></span>
                                                <a href=' <?php echo $url ?> ' class="btn btn-green btn-fill btn-round btn-wallet-pay">Pay Via Wallet</a>
                                            <?php }	?>
                                        <?php endif; ?>
                                        </div>
                                        <!-- <div class="tab-pane" id="net-banking">
                                            Net Banking
                                        </div>
                                        <div class="tab-pane" id="debit-cards">
                                            Debit Cards
                                        </div> -->
                                    </div>
                                    <div class="tabs-footer mt20 hide">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <img src="<?php echo IMGURL.'/cart/db-card.png'; ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <img src="<?php echo IMGURL.'/cart/db-card.png'; ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <img src="<?php echo IMGURL.'/cart/db-card.png'; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-sm-6" style="border-right: 2px solid #DDD;">
                                    <img src="<?php echo IMGURL.'/cart/coupon-one.png'; ?>" alt="Coupon One" class="img-responsive"/>
                                </div>
                                <div class="col-sm-6">
                                    <img src="<?php echo IMGURL.'/cart/coupon-two.png'; ?>" alt="Coupon Two" class="img-responsive"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } else {?>
        <div class="row">
            <div class="card">
                <div class="cart text-center card-content">
                    <h3>Your cart is Empty!</h3>
                    <a href="<?php echo base_url(); ?>">
                    <button class="btn btn-green btn-fill btn-round"><span>Start Shopping</span></button></a>
                </div>
            </div>
        </div>
        <?php } ?>
</div>