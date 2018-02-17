<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Order <?php echo $order_details->order_id; ?> Invoice : Happyperks | Happy to get </title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		/*margin: 40px;*/
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
		border-right: : 1px solid #D0D0D0;
	}
	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}
	.header {
		color: #f4424b;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		/*border-right-width: 1px;*/
		font-size: 25px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}
	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}
	#body {
		margin: 0 15px 0 15px;
	}
	p.footer {
		text-align: center;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
		color: white;
	}
	#container {
		margin: auto;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
		width: 60%;
	}
	h5.next{
	border-bottom: 1px solid #D0D0D0;
	}
	sidebar {
    float: left;
    max-width: 25%;
    margin: 0;
    padding: 1em;
    width: 70%;
	}
	sidebar ul {
    list-style-type: none;
    padding: 0;
	}
	   
	sidebar ul a {
	    text-decoration: none;
	}
	article {
	    margin-left: 170px;
	    border-left: 1px solid gray;
	    padding: 1em;
	    overflow: hidden;
	}
	.mcode {
    color: #f4424b;
    width: 400px;
    border: 1px solid grey;
    padding: 10px;
    margin: 0 auto;
    text-align: center;

}
	
	</style>
</head>
<body>
<div id="container">
	<h1 class="header"><strong> 
		<img src="<?php echo base_url().'/assets/frontend/img/logo-footer.png' ?>" />
	</strong>
</h1>
	<sidebar>
	  	<h3>Locations</h3>
	  	<ul>
			<li>koramangala,560066</li>
			<li>BTM 2nd stage</li>
			<li>malleswaram</li>
		</ul>
	</sidebar>
	<article>
		<div id="body">
			<div>
				<div>
					<h3><strong>Coupon Details</strong></h3>
					<p>Brand:</p>	
					<p>Product Name: <?php echo isset($voucher_details) && isset($voucher_details->name) ? $voucher_details->name : '' ?> </p>	
					<p>Price: <?php echo isset($order_details) && isset($order_details->price) ? $order_details->price : '' ?></p>
					<p>Validity:</p>
					<p>Timing:</p>
				</div>
				<div>
					<h3><strong>Order Details</strong></h3>
					<p><span >Date : </span></span><?php echo isset($order_details) && isset($order_details->created_at) ? date("d-m-Y", strtotime($order_details->created_at)) : ''; ?></p>	
					<p>Invoice Id: #<?php echo isset($order_details) && isset($order_details->order_id) ? $order_details->order_id : ''; ?></p>	
					<p>Order By:</p>
				</div>
				<div>
					<h5 class="next"></h5>
					<h3><strong>Merchant Code:</strong></h3>
					<p class="mcode"><?php echo isset($coupon_code) ? $coupon_code : ''; ?></p>
				</div>
				<h5 class="next"></h5>
				<h3><strong>Things to Remember</strong></h3>
				<ul>
					<li>Creating a recognizable design solution based on the company's existing visual identity</li>
					<li>Developing a Content Management System-based Website</li>
					<li>Optimize the site for search engines (SEO)	</li>
					<li>Initial training sessions for staff responsible for uploading web content	</li>
				</ul>
				<h3><strong>Next Steps</strong></h3>
				<ul>
					<li>Creating a recognizable design solution based on the company's existing visual identity</li>
					<li>Developing a Content Management System-based Website</li>
					<li>Optimize the site for search engines (SEO)	</li>
					<li>Initial training sessions for staff responsible for uploading web content	</li>
				</ul>
				<h3><strong>Cancellation Policy</strong></h3>
				<ul>
					<p>Non-Cancellable</p>
				</ul>
			</div>
		</div>
    </article>
	<p class="footer" style="background-color: #f4424b"><strong>Questions? Email <a href="mailto:">help@happyperks.com</a></p>
</div>
</body>
</html>