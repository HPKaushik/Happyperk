<div class="container">
    <div class="row" align="center">
        <div class="card">
            <div class="card-content">
                <div class="col-sm-12 col-md-10 col-md-offset-1">
                	<!-- <img src="product/hp/assets/img" alt="user-img" class="img-circle user-img"> -->
                	<img style="height: 40px" src="<?php echo IMGURL; ?>/success.svg" alt="" class="hp-logo m-t-20 img-responsive">
					<h5>Congratulations! Your order has been placed.</h5>	
					<div class="order-details">
						<div class="order-info">

							<h3>Your Order Number is 
								<strong class="text-green"><?php echo !empty($order_id) ? $order_id : '';?></strong>
							</h3>
							<p>You'll receive an email confirmation shortly to 
								<strong class="text-green"><?php echo !empty($email) ? $email: '';?></strong>
							</p>
						</div>
						<p class="text-uppercase text-green mt15">O2 full body massage spa & saloon</p>
						<div align="center">
							<h4>Amount Paid <strong class="text-green"></strong></h4>
							<p>Your Cashback:</p>
							<a href="<?php echo BASEURL; ?>" class="btn btn-round buy-now-button mtb15">
								Continue Shopping with us
							</a>
						</div>
					</div>
				</div> 
            </div>
        </div>
    </div>
	<div class="row"> 
	    <div class="card">
	        <div class="card-content">
	            <div class="voucher-info-content">
	                <h4 class="font-12 text-uppercase">How to use </h4>
	            </div>
	            <div class="voucher-info-content">
		            <li>After payment you would recieve a coupon through email and SMS to your mobile number.</li>
					<li>Show your coupon code at your destination shop with you recieved.</li>
					<li>Enjoy the service and please come back for shopping withus again.</li>
	            </div>
	        </div>
	    </div>
	</div>
</div>