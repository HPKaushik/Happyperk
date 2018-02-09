<div class="content">
    <div class="container">
        <div class="row">
        	<div class="col-md-12 col-xs-12">
                    <div class="card m0">
                        <div class="card-content">
                            <div class="full-width mtb20">
                                <h3>Brands</h3>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12 col-xs-12">
                    <div class="card m0">
                        <div class="card-content">
                            <div class="full-width mtb20">
                               <ul>
                                <?php
                                $categories = $this->category_model->getResult('*', array('status' => '1'));
                                foreach ($categories as $key => $category) {?>
                                <li> <?php echo $category->name ?> </li>
                               <?php }?>
                            </ul>
                            </div>
                        </div>
                    </div>
                </div>
             <div class="hp_grid col-sm-12">
             	<?php foreach ($brands as $key => $brand) {?>
             	<div class="col-md-4">
                 <?php if (!empty($brand->logo)) {?>
                 <img class="img-responsive" src="<?php echo LARAVEL_IMAGE_PATH . $brand->logo; ?>">
                 <?php } else {?>
             	 <img class="img-responsive" style="max-height: 210px;" src="<?php echo IMGURL.'/default.png'; ?>">
                 <?php }?>
                 <?php print($brand->name);?>
                </div>
                <?php }?>
             </div>
        </div>
    </div>
</div>
