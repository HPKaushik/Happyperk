<?php if (get_session_var('logged_in')): ?>
<?php $announcements = $this->home_model->getAllAnnoucements();?>
<?php if (isset($announcements) && count($announcements) > 0) { ?>
    <div class="hp-ansCnt hp-smooth">
        <span class="hp-ans hp-smooth scaleIt">
            <img src="<?php echo IMGURL.'/bell-white.png'; ?>" />
            <i class="hp-anNot"><?php echo count($announcements); ?></i>
        </span>
        <div class="hp-ansCont hp-smooth hide" id="hp-annoumnts-list">
            <div class="card-content">
                <h5 class="text-uppercase">Announcements</h5>
                <ul class="ann-list-latest nav">
                    <?php
                    $limit = (count($announcements) > 3) ? 3 : count($announcements);
                    $i = 0; 
                    foreach ($announcements as $key => $announcement) :
                        if ($i == $limit) break; ?>
                        <li class="unread pall20 mb10">
                            <div class="ann-title">
                                <h5 class="mb5"><?php echo $announcement->name; ?></h5>
                                <address class="text-uppercase mb5 font-11">By <?php echo get_user_name($announcement->user_id); ?></address>
                            </div>
                            <div class="ann-body">
                                <p class="text-right font-11">
                                   <?php echo $announcement->description; ?>
                                </p>
                            </div>
                            <div class="ann-footer">
                                <p class="text-right font-11 m0"><?php echo $announcement->created_at ?> &nbsp;&nbsp;<b>UNREAD</b></p>
                            </div>
                        </li> 
                        <?php $i++;
	               endforeach;?>
                </ul>
                <?php if (count($announcements) > 0) {?>
                    <a class="pull-right" href="<?php echo base_url('user/profile') ?>#announcement"><p>Read all here.</p> </a>
                <?php }?>
            </div>

        </div>
<?php }?>
<?php endif;?>
</div>
<div class="row m0">
         <!-- <div class="col-sm-1" ></div> -->
    <div class="col-sm-12">
            <div class="card">
                <div class="col-sm-3">
                    <div class="card-header">
                       <p class="text-center mt15"><img src="<?php echo IMGURL; ?>/best-price.png"></p>
                       <h5 class="text-center"> Best Price</h5>
                       <p class="text-center">Happiness is guaranteed at Paytm. If we fall short of your expectations, give us a shout.</p>
                    </div>
                </div><div class="col-sm-3">
                    <div class="card-header">
                       <p class="text-center mt15"><img src="<?php echo IMGURL; ?>/secure-payment.png"></p>
                       <h5 class="text-center"> Best Price</h5>
                       <p class="text-center">Happiness is guaranteed at Paytm. If we fall short of your expectations, give us a shout.</p>
                    </div>
                </div><div class="col-sm-3">
                    <div class="card-header">
                       <p class="text-center mt15"><img src="<?php echo IMGURL; ?>/freedom-to-choose.png"></p>
                       <h5 class="text-center"> Best Price</h5>
                       <p class="text-center">Happiness is guaranteed at Paytm. If we fall short of your expectations, give us a shout.</p>
                    </div>
                </div><div class="col-sm-3">
                    <div class="card-header">
                       <p class="text-center mt15"><img src="<?php echo IMGURL; ?>/best-price.png"></p>
                       <h5 class="text-center"> Best Price</h5>
                       <p class="text-center">Happiness is guaranteed at Paytm. If we fall short of your expectations, give us a shout.</p>
                    </div>
                </div>

        </div>
            </div>
    <!-- <div class="col-sm-1"></div> -->
</div>
    <div class="footer-container">
        <div class="footer">
            <div class="footer-top ptb15">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="nav theme-color text-center text-uppercase footer-links">
                                <li><a href="#">Food Deals</a></li>
                                <li><a href="#">Hotel Deals</a></li>
                                <li><a href="#">Spa & Saloon Deals</a></li>
                                <li><a href="#">Gym & Yoga Deals</a></li>
                                <li><a href="#">Movie Ticket Deals</a></li>
                                <li><a href="#">Cashback Offers</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-middle ptb15 hide">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="nav text-center text-capitalize footer-links">
                                <li><a href="<?php echo BASEURL . 'about-us'; ?>">About Us</a></li>
                                <?php if (isset($this->userId) && !empty($this->userId)) {?>
                                    <li><a href = "<?php echo BASEURL; ?>contact-us">Contact Us</a></li>
                                <?php } else {?>
                                    <li><a href = "<?php echo BASEURL; ?>login">Contact Us</a></li>
<?php }?>
                                <li><a href = "#">Blog</a></li>
                                <li><a href = "#">Cancellation Policy</a></li>
                                <li><a href = "#">Media</a></li>
                                <li><a href = "#">Partner With Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class = "footer-bottom border-gery-top ptb15">
                <div class = "fluid-container">
                    <div class = "row m0">
                        <div class = "col-lg-3 text-center">
                            <img src = "<?php echo FOOTER_LOGO; ?>" alt = "Happyperks" class = "img-responsive ptb15">
                            <address>2017 Happyperks.<br> All Rights Reserved.</address>
                        </div>
                        <input type="hidden" id="txtbaseurl" value="<?php echo BASEURL; ?>">
                        <div class = "col-lg-6 border-gery-right border-gery-left">
                            <div class = "input-group footer-sign-up ptb15 hide">
                                <span class = "input-group-addon"><i class = "hp-icons">mail</i></span>
                                <div class = "form-group m0 p0">
                                    <input type = "email" class = "text-center boxed-input" placeholder = "SIGN UP FOR NEWSLETTER" name = "sign-up-email" />
                                </div>
                                <span class = "input-group-addon"><i class = "hp-icons">trending_flat</i></span>
                            </div>

                            <ul class = "nav text-center text-capitalize footer-links">
                                <li><a href = "#">Privacy & Cookies</a></li>
                                <li><a href = "#">Terms & Conditions</a></li>
                                <li><a href = "#">Accessibility</a></li>
                            </ul>
                            <ul class = "nav text-center text-capitalize footer-links border-gery-top pt15">
                                <li><a href = "mailto:info@happyperks.com">Support: info@happyperks.com</a></li>
                                <li><a href = "tel:+91 802 572 7560">Phone: +91 802 572 7560</a></li>
                            </ul>
                        </div>
                        <div class = "col-lg-3">
                            <div class = "row">
                                <div class = "col-lg-12">
                                    <ul class="nav text-center text-uppercase footer-links">
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                                        <li><a href="https://in.linkedin.com/company/happyperks"><i class="fa fa-linkedin-square"></i></a></li>
                                        <li><a href="#"><i aria-hidden="true" class="fa fa-google plus"></i></a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 text-center hide">
                                    <a  target="_blank" href="http://www.Amazon.in/exec/obidos/redirect-home?tag=happyperks-21&placement=home_multi.gif&site=amazon">
                                        <img src="http://g-ec2.images-amazon.com/images/G/31/associates/promohub/amazonIN_logo_200_75.jpg?tag-id=happyperks-21" border="0" alt="In Association with Amazon.in">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--How it work modal-->
<div class="modal fade in" id="itWorkModal" role="dialog" style="display: none; padding-right: 17px;">
        <div class="modal-dialog" style="width:100%; margin:0px;">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="how-it-works how-it-works-show">
                            <button type="button" onclick="document.getElementById('itWorkModal').style.display = 'none'" style="padding: 18px !important;" class="close" data-dismiss="modal" aria-hidden="true">
                                <i class="material-icons">x</i>
                            </button>
                            <div class="wrapper">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-4">
                                            <div class="text-center margin-bottom-s">
                                                <img alt="" class="img-responsive" height="251" src="<?php echo IMGURL.'/hiw1.png'?>" width="251" xsrc="<?php echo IMGURL.'/hiw1.png'?>" data-lzled="true">
                                                <p class="h5 font-weight-semibold text-uppercase"> Explore </p>
                                                <p class=""> Amazing options at restaurants, spas, gyms, movies, hotels and more around you. </p>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="text-center margin-bottom-s">
                                                <img alt="" class="img-responsive" height="251" src="<?php echo IMGURL.'/hiw2.png'?>" width="251" xsrc="<?php echo IMGURL.'/hiw2.png'?>" data-lzled="true">
                                                <p class="h5 font-weight-semibold text-uppercase"> Buy </p>
                                                <p class=""> Easily and securely, using credit/debit cards, net-banking or wallets. </p>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="text-center margin-bottom-s">
                                                <img alt="" class="img-responsive" height="251" src="<?php echo IMGURL.'/hiw3.png'?>" width="251" xsrc="<?php echo IMGURL.'/hiw3.png'?>" data-lzled="true">
                                                <p class="h5 font-weight-semibold text-uppercase"> Enjoy </p>
                                                <p class=""> The service by simply showing your voucher on the nearbuy app. </p>
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
    </div>
    <!--end-->  