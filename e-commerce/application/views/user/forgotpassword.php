<?php isset($comapanyDetails) ? extract($comapanyDetails) : ''; ?>
<div class="content height100 p0">
    <div class="col-lg-8 col-md-8 col-sm-6 height100 p0">
        <div id="HpLoginScrolls" class="hp-scroll" data-urlLock="true" >
            <ol class="hp-scroll-indicators hidden-xs">
                <li data-target="#HpLoginScrolls" data-slide-to="0" class="active"></li>
                <li data-target="#HpLoginScrolls" data-slide-to="1"></li>
                <li data-target="#HpLoginScrolls" data-slide-to="2"></li>
                <li data-target="#HpLoginScrolls" data-slide-to="3"></li>
            </ol>
            <div class="hp-scroll-box">
                <div id="a" class="item active">
                    <img src="<?php echo IMGURL.'/login/1.png'; ?>" style="width:100%;" />
                </div>
                <div id="b" class="item">
                    <img src="<?php echo IMGURL.'/login/2.png'; ?>" style="width:100%;"/>
                </div>
                <div id="c" class="item">
                    <img src="<?php echo IMGURL.'/login/3.png'; ?>" style="width:100%;"/>
                </div>
                <div id="d" class="item">
                    <img src="<?php echo IMGURL.'/login/4.png'; ?>" style="width:100%;"/>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 height100 m0 p0">
        <div class="card height100 m0">
            <div class="card-content height100 m0" data-background-color="loginBlue">
                <div class="alignVMiddle" style="margin: 0 auto;width: 280px;padding-top: 30vh;">
                    <?php if (isset($logo) && !empty($logo)) { ?>
                        <img  class="img-responsive" src="<?php echo CRUD_COMPANY_LOGO . '/' . $logo; ?>" alt="<?php echo isset($company_name) && !empty($company_name) ? $company_name : ''; ?>" width="128">
                    <?php } elseif(isset($company_name)) { ?>
                        <h3 class="text-center"><?php echo isset($company_name) && !empty($company_name) ? $company_name : ''; ?></h3>
                    <?php }else ?>
                        <img  class="img-responsive" src="<?php echo HEADER_LOGO; ?>" alt="<?php echo SITE_NAME; ?>">
                    <div id="loginInfo" class="forgot-password text-center">
                        <?php if ($this->session->flashdata('msg') != '') echo $this->session->flashdata('msg'); ?>
                    </div>
                    <div id="loginopen">
                        <br>
                        <?php if ($this->session->flashdata('succes_msg')) { ?>
                            <div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
                                <strong>Success ! </strong><?php echo $this->session->flashdata('succes_msg'); ?>
                            </div>
                        <?php } ?> 
                        <?php if ($this->session->flashdata('error_msg')) { ?>
                            <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
                                <strong>Error ! </strong><?php echo $this->session->flashdata('error_msg'); ?>
                            </div>
                        <?php } ?>

                        <div id="forgotpassword">
                        <h4 class="text-center">Forget Password</h4>
                        <?php echo form_open(BASEURL.'user/forgotpassword', array('id' => 'forgotPasswordForm')); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"> 
                                    <input id="femail" type="email" class="form-control login-boxed-input text-white text-center" placeholder="Email Id" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <button type="submit" class="btn sign-in-button lp1 full-width text-uppercase">Submit</button>
                                </div>
                            </div>
                        </div>
                        <div class="forgot-password text-center">
                            Go Back to <a href="<?php echo BASEURL; ?>" class="text-uppercase">HOME</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
