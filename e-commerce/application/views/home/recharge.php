<div class="card m0" id="recharge">
    <div class="card-content">
        <ul class="nav nav-pills nav-pills-purple percentage-width border-bottom-color m0">
            <li class="active">
                <a href="#pill1" class="lp1 text-center" data-toggle="tab">
                    <img alt="" src="<?php echo IMGURL.'/home/mobile-recharge.png'; ?>" class="img-responsive"/>Mobile
                </a>
            </li>
            <li>
                <a href="#pill2" class="lp1 text-center" data-toggle="tab">
                    <img alt="" src="<?php echo IMGURL.'/home/landline.png'; ?>" class="img-responsive"/>Landline
                </a>
            </li>
            <li>
                <a href="#pill3" class="lp1 text-center" data-toggle="tab">
                    <img alt="" src="<?php echo IMGURL.'/home/broadband.png'; ?>" class="img-responsive"/>Broadband
                </a>
            </li>
            <li>
                <a href="#pill4" class="lp1 text-center" data-toggle="tab">
                    <img alt="" src="<?php echo IMGURL.'/home/data-card.png'; ?>" class="img-responsive"/>Datacard
                </a>
            </li>
            <li>
                <a href="#pill5" class="lp1 text-center" data-toggle="tab">
                    <img alt="" src="<?php echo IMGURL.'/home/dth.png'; ?>" class="img-responsive"/>DTH
                </a>
            </li>
            <li>
                <a href="#pill6" class="lp1 text-center" data-toggle="tab">
                    <img alt="" src="<?php echo IMGURL.'/home/electricity.png'; ?>" class="img-responsive"/>Electricity
                </a>
            </li>
            <li>
                <a href="#pill7" class="lp1 text-center" data-toggle="tab">
                    <img alt="" src="<?php echo IMGURL.'/home/gas-bill.png'; ?>" class="img-responsive"/>Gas Bill
                </a>
            </li>
        </ul>
        <p class="text-center mobile-view-all mt15" style=""> <a href="javascript:void(0);" >View all</a></p>
        <div class="tab-content form-margin0 active m0">
            <div class="tab-pane active" id="pill1">
                <div class="card">

                    <div class="card-content plrt15-50 m0"  data-background-color="purple">
                        <?php if($this->session->flashdata('msg_err')!='')  :?>
                        <div class="row col-md-12">
                            <span class="col-md-6 alert alert-danger">
                                <?php echo  $this->session->flashdata('msg_err'); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($this->session->flashdata('msg_succ')!='')  :?>
                        <div class="row col-md-12">
                            <span class="col-md-6 alert alert-success">
                                <?php echo  $this->session->flashdata('msg_succ'); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php 
                        $url = ($this->aauth->is_loggedin()) ? "cart/recharges" : "user/login";
                        echo form_open($url, array('id' => 'formMobileRecharge')) ?>
                        <div class="row m0">
                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="sim_type" id="sim_type" value="Prepaid" checked="checked">
                                        <span class="circle"></span>
                                        <span class="check"></span> Prepaid
                                    </label>
                                    <label>
                                        <input type="radio" name="sim_type" id="sim_type" value="Postpaid">
                                        <span class="circle"></span>
                                        <span class="check"></span> Postpaid
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3">
                                <div class="input-group p10">
                                    <span class="input-group-addon">+91</span>
                                    <div class="form-group">
                                        <input name="mobilerechargeno" id="mobilerechargeno" minlength="10" maxlength="10" placeholder="Enter Mobile No." type="text" onkeypress='return isNumberKeyRCV(event);' class="boxed-input">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <select class="selectpicker boxed-select text-uppercase" name="operatorname" id="operatorname">
                                    <option value="">Choose Operator</option>
                                    <?php
                                    if (isset($operatorlist) && is_object($operatorlist)) {
                                    foreach ($operatorlist->Operator as $key => $value) : ?>
                                    <option value="<?php echo $value->{'@alias'} ?>">
                                        <?php echo $value->{'@name'}; ?>
                                    </option>
                                    <?php  endforeach;
                                    } else { ?>
                                     <option value="AIRC">Aircel</option>
                                     <option value="AIRTFTT">Airtel</option>
                                     <option value="BSNL">BSNL</option>
                                     <option value="IDEA">Idea</option>
                                     <option value="MTNL">MTNL</option>
                                     <option value="MTS">MTS</option>
                                     <option value="RELG">Reliance GSM</option>
                                     <option value="T24">T24</option>
                                     <option value="DOCO">TATA Docomo</option>
                                     <option value="INDI">Tata Indicom</option>
                                     <option value="UNIN">Uninor</option>
                                     <option value="VIDEOCON">Videocon</option>
                                     <option value="VODA">Vodafone</option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="input-group p10">
                                    <span class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></span>
                                    <div class="form-group">
                                        <input name="mobilerechargeamount" id="mobilerechargeamount" type="text" placeholder="Enter amount" class="boxed-input" maxlength="6">
                                    </div>
                                </div>
                                <span class="browse-plan" id="mbrechrgeplans">

                                    <a data-toggle="modal" id="showplansbutton"  class="hide pull-right" href="#" data-target="#planModal">
                                    Browse Plans
                                    </a>
                                </span>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <button type="submit" class="btn btn-green btn-fill btn-round full-width">Recharge Now !</button>
                                <input id="regioncircle" type="hidden" name="regioncircle" value="">
                                <input id="region" type="hidden" name="region" value="">
                                <input id="operator" type="hidden" name="operator" value="">
                                <input id="rechargeOfType" type="hidden" name="rechargeOfType" value="1">
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="pill2">
                <div class="card">
                    <div class="card-content plrt15-50 m0"  data-background-color="purple">
                        <?php echo form_open('cart/recharges', array('id' => 'landlineRechargeForm')) ?>
                        <div class="row">
                            <div class="col-lg-3 col-md-3">
                                <div class="input-group p10">
                                    <span class="input-group-addon">+91</span>
                                    <div class="form-group">
                                        <input name="mobilerechargeno" id="mobilerechargeno" minlength="10" maxlength="10" placeholder="Enter Land Line No." type="text" onkeypress='return isNumberKeyRCV(event);' class="boxed-input">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div>
                                    <div>
                                        <select class="selectpicker boxed-select text-uppercase" name="operatorname" id="operatorname">
                                            <option value="">Choose Operator</option>
                                            <?php
                                            if (isset($operatorlist) && is_object($operatorlist)) {
                                                foreach ($operatorlist->Operator as $key => $value) :
                                                ?>
                                                <option value="<?php echo $value->{'@alias'} ?>">
                                                <?php echo $value->{'@name'}; ?>
                                                </option>
                                                <?php
                                                endforeach;
                                            } else { ?>
                                                <option value=""> No Operator found.</option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div>
                                    <div>
                                        <select class="selectpicker boxed-select text-uppercase" name="regioncircle" id="regioncircle">
                                            <option value="">Choose Circle</option>
                                            <?php
                                            if (isset($regionlist) && is_object($regionlist)) {
                                                foreach ($regionlist->Region as $key => $value) :
                                                ?>
                                                <option value="<?php echo $value->{'@name'} ?>">
                                                <?php echo $value->{'@name'}; ?>
                                                </option>
                                                <?php
                                                endforeach;
                                            } else {
                                            ?>
                                                <option value=""> No Region found.</option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <button type="submit" class="btn btn-green btn-fill btn-round full-width">Recharge Now !</button>
                                <input id="region" type="hidden" name="region" value="">
                                <input id="operator" type="hidden" name="operator" value="">
                                <input id="rechargeOfType" type="hidden" name="rechargeOfType" value="2">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-3 col-md-3">
                                <div class="input-group p10">
                                    <span class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></span>
                                    <div class="form-group">
                                        <input name="mobilerechargeamount" id="mobilerechargeamount" type="text" placeholder="Enter amount" class="boxed-input" maxlength="6">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="pill3">
                <div class="card">
                    <div class="card-content plrt15-50 m0"  data-background-color="purple">
                        <?php echo form_open('cart/recharges', array('id' => 'broadbandRechargeForm')) ?>
                        <div class="row m0">
                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="offer_type" id="offer_type" value="Topup" checked="true">
                                        <span class="circle"></span>
                                        <span class="check"></span> Topup
                                    </label>
                                    <label>
                                        <input type="radio" name="offer_type" id="offer_type" value="Recharge" >
                                        <span class="circle"></span>
                                        <span class="check"></span> Recharge
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3">
                                <select class="selectpicker boxed-select" id="operatorname" name="operatorname">
                                    <option value="">Choose Operator</option>
                                    <option value="tikona">Tikona</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="input-group p10">
                                    <span class="input-group-addon">+91</span>
                                    <div class="form-group">
                                        <input name="mobilerechargeno" id="mobilerechargeno" minlength="10" maxlength="10" type="text" placeholder="Enter mobile number" onkeypress='return isNumberKeyRCV(event);' class="boxed-input">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="input-group p10">
                                    <span class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></span>
                                    <div class="form-group">
                                        <input name="mobilerechargeamount" id="mobilerechargeamount" type="text" placeholder="Enter amount" class="boxed-input" maxlength="6">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <button type="submit" class="btn btn-green btn-fill btn-round full-width">Recharge Now !</button>
                                <input id="regioncircle" type="hidden" name="regioncircle" value="">
                                <input id="region" type="hidden" name="region" value="">
                                <input id="operator" type="hidden" name="operator" value="">
                                <input id="rechargeOfType" type="hidden" name="rechargeOfType" value="3">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-3 col-md-3">
                                <div>
                                    <div>
                                        <select class="selectpicker boxed-select" id="broadband_package" name="broadband_package">
                                            <option value="">Select Package</option>
                                            <option value="Test">Test</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="input-group p10">
                                    <span class="input-group-addon">ID</span>
                                    <div class="form-group">
                                        <input name="broadband_userid" id="broadband_userid" type="text" placeholder="Enter User Id" class="boxed-input">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="pill4">
                <div class="card">
                    <div class="card-content plrt15-50 m0"  data-background-color="purple">
                        <?php echo form_open('cart/recharges', array('id' => 'datacardRechargeForm')) ?>
                        <div class="row m0">
                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="sim_type" id="sim_type" value="Prepaid" checked="true">
                                        <span class="circle"></span>
                                        <span class="check"></span> Prepaid
                                    </label>
                                    <label>
                                        <input type="radio" name="sim_type" id="sim_type" value="Postpaid">
                                        <span class="circle"></span>
                                        <span class="check"></span> Postpaid
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3">
                                <div class="input-group p10">
                                    <span class="input-group-addon">+91</span>
                                    <div class="form-group">
                                        <input name="mobilerechargeno" id="mobilerechargeno" minlength="10" maxlength="10" type="text" placeholder="Enter mobile number" onkeypress='return isNumberKeyRCV(event);' class="boxed-input">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <select class="selectpicker boxed-select" name="operatorname" id="operatorname">
                                    <option value="">Choose Operator</option>
                                    <option value="RELNET">Reliance Net Connect</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="input-group p10">
                                    <span class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></span>
                                    <div class="form-group">
                                        <input name="mobilerechargeamount" id="mobilerechargeamount" type="text" placeholder="Enter amount" class="boxed-input" maxlength="6">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <button type="submit" class="btn btn-green btn-fill btn-round full-width">Recharge Now !</button>

                                <input id="regioncircle" type="hidden" name="regioncircle" value="">
                                <input id="region" type="hidden" name="region" value="">
                                <input id="operator" type="hidden" name="operator" value="">
                                <input id="rechargeOfType" type="hidden" name="rechargeOfType" value="4">
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="pill5">
                <div class="card">
                    <div class="card-content plrt15-50 m0"  data-background-color="purple">
                        <?php echo form_open('cart/recharges', array('id' => 'dthRechargeForm')) ?>
                        <div class="row">
                            <div class="col-lg-3 col-md-3">
                                <div class="input-group p10">
                                    <span class="input-group-addon">ID</span>
                                    <div class="form-group">
                                        <input name="subscribe_id" id="subscribe_id" placeholder="Enter Subscribe Id" type="text" class="boxed-input">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <select class="selectpicker boxed-select" name="operatorname" id="operatorname">
                                    <option value="">Choose Operator</option>
                                    <option value="Airtel_tv">Airtel TV</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="input-group p10">
                                    <span class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></span>
                                    <div class="form-group">
                                        <input name="mobilerechargeamount" id="mobilerechargeamount" type="text" placeholder="Enter amount" class="boxed-input" maxlength="6">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <button type="submit" class="btn btn-green btn-fill btn-round full-width">Recharge Now !</button>
                                <input id="regioncircle" type="hidden" name="regioncircle" value="">
                                <input id="mobilerechargeno" type="hidden" name="mobilerechargeno" value="-">
                                <input id="region" type="hidden" name="region" value="">
                                <input id="operator" type="hidden" name="operator" value="">
                                <input id="rechargeOfType" type="hidden" name="rechargeOfType" value="5">
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="pill6">
                <div class="card">
                    <div class="card-content plrt15-50 m0"  data-background-color="purple">
                        <?php echo form_open('cart/recharges', array('id' => 'electricityRechargeForm')) ?>
                        <div class="row">
                            <div class="col-lg-3 col-md-3">
                                <select class="selectpicker boxed-select" name="operatorname" id="operatorname">
                                    <option value="">Choose Operator</option>
                                    <option value="bangalore_electricity">BANGALORE ELECTRICITY SUPPLY COMPANY (BESCOM)</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="input-group p10">
                                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                                    <div class="form-group">
                                        <input name="account_no" id="account_no" type="text" placeholder="Enter Account Number" class="boxed-input" maxlength="16">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="input-group p10">
                                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                                    <div class="form-group">
                                        <input name="confirm_account_no" id="confirm_account_no" type="text" placeholder="Enter Confirm Account Number" class="boxed-input" maxlength="16">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <button type="submit" class="btn btn-green btn-fill btn-round full-width">Recharge Now !</button>
                                <input id="regioncircle" type="hidden" name="regioncircle" value="">
                                <input id="mobilerechargeno" type="hidden" name="mobilerechargeno" value="-">
                                <input id="region" type="hidden" name="region" value="">
                                <input id="operator" type="hidden" name="operator" value="">
                                <input id="rechargeOfType" type="hidden" name="rechargeOfType" value="6">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-3 col-md-3">
                                <div class="input-group p10">
                                    <span class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></span>
                                    <div class="form-group">
                                        <input name="mobilerechargeamount" id="mobilerechargeamount" type="text" placeholder="Enter amount" class="boxed-input" maxlength="6">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>

            <div class="tab-pane" id="pill7">
                <div class="card">
                    <div class="card-content plrt15-50 m0"  data-background-color="purple">
                        <?php echo form_open('cart/recharges', array('id' => 'gasbillRechargeForm')) ?>
                        <div class="row">
                            <div class="col-lg-3 col-md-3">
                                <select class="selectpicker boxed-select" name="operatorname" id="operatorname">
                                    <option value="">Choose Operator</option>
                                    <option value="INDGAS">INDANE GAS</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="input-group p10">
                                    <span class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></span>
                                    <div class="form-group">
                                        <input name="mobilerechargeamount" id="mobilerechargeamount" type="text" placeholder="Enter amount" class="boxed-input" maxlength="6">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="input-group p10">
                                    <span class="input-group-addon">+91</span>
                                    <div class="form-group">
                                        <input name="mobilerechargeno" id="mobilerechargeno" minlength="10" maxlength="10" placeholder="Delivery Person's Mobile No." type="text" class="boxed-input">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <button type="submit" class="btn btn-green btn-fill btn-round full-width">Recharge Now !</button>
                                <input id="regioncircle" type="hidden" name="regioncircle" value="">
                                <input id="region" type="hidden" name="region" value="">
                                <input id="operator" type="hidden" name="operator" value="">
                                <input id="rechargeOfType" type="hidden" name="rechargeOfType" value="7">
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="planModal" class="modal fade hp-browse-plans" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="hp-icons font-30">highlight_off</i></button>
                <h4 class="modal-title text-center">Browser Plans</h4>
            </div>
            <div class="modal-body">
                <div class="text-center">
                   <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                        <h4>Operator</h4>
                        </div>
                        <div class="col-md-4">
                        <h4>Circle</h4>
                        </div>
                        <div class="col-md-4">
                        <h4>All Plans</h4>
                        </div>        
                    </div>        
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>