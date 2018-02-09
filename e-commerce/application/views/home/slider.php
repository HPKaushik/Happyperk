<div id="slideshow">
    <div class="full-screen-slider">
        <div id="banner-slider-demo-19" class="owl-carousel owl-theme owl-banner-carousel">
            <?php if (isset($slides) && !empty($slides)) {?>
            <?php foreach ($slides as $key => $slide) :    ?>
            <div class="item">
                <div class="slide-content content no-padding content1 col-sm-6">
                    <div class="inner-content">
                        <?php echo (!empty($slide->content)) ? $slide->content :''; ?>
                    </div>
                </div>
                <div class="col-sm-6 no-padding fix-height"><img class="image-responsive" src="<?php echo LARAVEL_IMAGE_PATH.$slide->image; ?>" /></div>
            </div>
           <?php endforeach; 
            } else {?>
            <div class="item">
                <div class="slide-content no-padding content content2 col-sm-6" >
                    <div class="inner-content">
                        <div style="width: 100%; float: left;">
                            <p class="content-top discount">50%</p>
                        </div>
                        <h3 style="font-weight: 100; font-size: 35px;">HEY!</h3>
                        <h2>GRAB THE DELICIOUS <br>FOOD DEAL</h2>
                        <div class="slider-actions">
                            <a class="btn btn-danger" href="#">BUY NOW !</a> 
                            <a class="" style="color: #fff; font-size: 17px; font-weight: 100; margin-left: 30px;" href="#">View All Food Deals</a>
                        </div>
                        <h2>Cafe Coffee Day <br> 
                            <span class="offer-price">Rs.200</span>
                            <span class="actual-price underline">Rs.400</span>
                        </h2>
                        <p>Starting @ Just - Rs.200 Only</p> 
                        </div>
                </div>
                <div class="col-sm-6 no-padding fix-height"><img class="image-responsive" alt="" src="<?php echo IMGURL; ?>/slider/2.jpg" /></div>
            </div>
            <?php }?>
        </div>
    </div>
</div>