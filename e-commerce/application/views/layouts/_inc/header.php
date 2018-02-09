<div class="header">
    <div class="header-container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-4 p0">
                <div class="header-block-left pull-left">
                    <?php if (isset($company_logo) && !empty($company_logo)) {?>
                		<div class="hp-logo-container text-center">
                        <a href="<?php echo BASEURL ?>" title="<?php echo SITE_NAME; ?>">
                        	<img src="<?php echo POWERED_BY_LOGO ?>" alt="" class=" hp-logo-pwdby"></a>
                		</div>
                    <?php }?>
                    <div class="info-links first_block">
                        <ul class="menu_links m0">
                            <li>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#itWorkModal"><span>How It Works</span></a>
                            </li>
                            <li><a href="<?php echo BASEURL . 'brands'; ?>"><span>Brands</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-2 col-xs-4">
                <div class="hp-logo-container text-center">
                	   <?php 
                	   //if user logged in
                	   if (isset($company_logo) && !empty($company_logo)) { ?>
										<?php  if(file_exists(CRUD_COMPANY_LOGO . '/' . $company_logo))  {?>
                           					<a href="<?php echo BASEURL ?>" title="<?php echo $company_name; ?>">
											<img src=" <?php echo CRUD_COMPANY_LOGO . '/' . $company_logo; ?>" alt="" class="hp-logo-pwdby img-responsive" >
											</a>
										<?php  } else { ?>
										<a href="<?php echo BASEURL ?>" title="<?php echo $company_name; ?>">
											<?php echo "<h4 class='text-white'>".$company_name."</h4>"; ?>
										</a>
										<?php } 
                            } else {  ?>
                       <a href="<?php echo BASEURL ?>" title="<?php echo SITE_NAME; ?>">
                       		<img src="<?php echo HEADER_LOGO ?>" alt="" class="img-responsive" >
                   	   </a>
                       <?php  } ?>
                </div>
            </div>
            <div class="col-lg-5 col-md-7 col-xs-4 p0">
                <div class="header-block-right pull-right">
                    <div class="info-links">
                        <ul class="menu_links m0 p0">
                            <li>
	                            <div class="form-group label-floating">
	                                <?php echo form_open(BASEURL.'vouchers/search'); ?>
	                                    <input class="form-control valid text-white" placeholder="Search here" name="name" type="text" required="required" aria-required="true">
	                                <?php echo form_close(); ?>
	                            </div>
                            </li>
                             <li>
                                <a data-toggle="modal" href="#" data-target="#LocationPickerModal"><i class="hp-icons">location_on</i>
                                    <span>
                                        <?php
                                            if (get_session_var('user_location') != '') {
                                                $selectedLocation = get_session_var('user_location');
                                                echo (array_key_exists('name', $selectedLocation)) ? $selectedLocation['name'] : 'Location';
                                            } else {
                                                echo 'Location';
                                            }
                                            ?>
                                    </span>
                                </a>
                            </li>
                            <?php if (get_session_var('logged_in')): ?>
                            <li>
                                <?php if ($this->aauth->is_loggedin()) {?>
                                    <a href=" <?php echo BASEURL.'user/profile#wallet' ?>" class="wallet_link"><i class="hp-icons">account_balance_wallet</i><span>Wallet - <?php echo $this->mybalance; ?></span></a>
                                <?php } else {?>
                                    <a href="<?php echo BASEURL.'login' ?>" class="wallet_link"><i class="hp-icons">account_balance_wallet</i><span>Wallet - <?php echo $this->mybalance; ?></span></a>
                                <?php }?>
                            </li>
                            <?php endif;?>
                            <li>
                                <a href="#"><i class="hp-icons">account_circle</i><span>Account</span></a>
                                <div class="account-links-wrapper pt15">
                                    <?php if (!$this->aauth->is_loggedin()) {?>
                                        <ul class="account-links">
                                            <li><a href="<?php echo BASEURL.'login' ?>" ><span>Login</span></a></li>
                                            <li><a data-toggle="modal" href="#" data-target="#RegistrationModal"><span>Register</span></a></li>
                                        </ul>
                                    <?php } else {?>
                                        <ul class="account-links">
                                            <li><a href="<?php echo BASEURL. 'user/profile/'; ?>"><i class="hp-icons">person_pin</i><span>My Account</span></a></li>
                                            <li><a href="<?php echo BASEURL. 'user/profile#orders'; ?>"><i class="hp-icons">list</i><span>My Orders</span></a></li>
                                            
                                            <li><a href="<?php echo BASEURL . 'cart'; ?>"><i class="hp-icons">shopping_cart</i><span>My Cart</span>
                                            <?php echo "-" . $cart_items = ($this->cart->contents() != '')	 ? count($this->cart->contents()) : 0; ?>
                                            </a></li>
                                            <li><a href="<?php echo BASEURL ?>user/logout"><i class="hp-icons">exit_to_app</i><span>Logout</span></a></li>
                                        </ul>
                                    <?php }?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <button type="button" class="navbar-toggle m0 p0" data-toggle="collapse">
                    <span class="hp-icons">menu</span>
                </button>
            </div>
	            <div class="sidebar" data-color="purple">
	               <?php /* <div class="logo">
	                    <?php if (isset($company_logo) && !empty($company_logo)) {?>
	                        <a href="<?php echo BASEURL ?>" title="<?php echo $company_name; ?>">
	                        	<img src=" <?php echo CRUD_COMPANY_LOGO . '/' . $company_logo; ?>" alt="" class="hp-logo-pwdby img-responsive" >
	                        </a>
	                    <?php } else {?>
	                        <a href="<?php echo BASEURL ?>" title="<?php echo SITE_NAME; ?>">
	                        	<img src="<?php echo HEADER_LOGO ?>" alt="" class="img-responsive">
	                        </a>
	                    <?php }?>
	                </div> */ ?>
	                <div class="sidebar-wrapper">
	                    <ul class="nav">
	                        <li class="active">
	                            <a href="#">
	                                <i class="hp-icons">home</i>
	                                <p>Home</p>
	                            </a>
	                        </li>
	                        <li>
	                            <a data-toggle="collapse" href="#configs" class="collapsed" aria-expanded="false">
	                                <i class="hp-icons">account_circle</i>
	                                <p>Account
	                                    <b class="caret"></b>
	                                </p>
	                            </a>
	                            <div class="collapse" id="configs" aria-expanded="false" style="height: 0px;">
	                                 <?php if (!$this->aauth->is_loggedin()) {?>
	                                        <ul class="account-links">
	                                            <li><a href="<?php echo BASEURL.'login'?>" >
                                                        <i class="hp-icons">input</i>
                                                        <p>Login
                                                        </p>
                                                </a></li>
	                                            <li><a data-toggle="modal" href="#" data-target="#RegistrationModal"> <i class="hp-icons">input</i>
                                                        <p>Register
                                                        </p></a>
                                                
                                                </li>
	                                        </ul>
	                                    <?php } else {?>
	                                        <ul class="account-links">
	                                             <li><a href="<?php echo BASEURL. 'user/profile'; ?>" >
                                                        <i class="hp-icons">person_pin</i>
                                                        <p>My Account</p>
                                                     </a>
                                                 </li>
                                                 <li><a href="<?php echo BASEURL. 'user/profile'; ?>" >
                                                        <i class="hp-icons">list</i>
                                                        <p>My Orders</p>
                                                     </a>
                                                 </li>
                                                 <li><a href="<?php echo BASEURL. 'cart'; ?>" >
                                                        <i class="hp-icons">shopping_cart</i>
                                                        <p>My Cart  <?php echo " - " . $cart_items = ($this->cart->contents() != '') ? count($this->cart->contents()) : 0; ?></p>
                                                     </a>
                                                 </li>
                                                 <li><a href="<?php echo BASEURL. 'user/logout'; ?>" >
                                                        <i class="hp-icons">power_settings_new</i>
                                                        <p>Logout</p>
                                                     </a>
                                                 </li>
	                                        </ul>
	                                    <?php }?>
	                            </div>
	                        </li>
	                        <li class="">
	                            <a href="#">
	                                <i class="hp-icons">settings</i>
	                                <p>How It Works</p>
	                            </a>
	                        </li>
	                        <li class="">
	                            <a href="#">
	                                <i class="hp-icons">info</i>
	                                <p>About Us</p>
	                            </a>
	                        </li>
	                    </ul>
	                </div>
	            </div>
        </div>
    </div>
</div>