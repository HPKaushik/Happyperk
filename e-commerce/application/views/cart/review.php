<?php
$otpsend = true; 
/*
$loggedUser = get_session_var('employeed_logged_in');
if (!empty($loggedUser['phone'])) {
    $param = array('mobilenumber' => "91" . $loggedUser['phone']);
//    prx($param);
    $data = $this->oxigenapi->is_wallet_exist(VERIFY_WALLET_URL, $param);
    if ($data != false) {
//        $arr = json_decode($data);
//        if ($arr->ResponseCode == 1002) {
            $param['otptype'] = 10;
            $otpdata = $this->oxigenapi->send_otp(SEND_OTP_WALLET_URL, $param);
//            prx($otpdata);
            if (isset($otpdata) && (is_object($otpdata) && $otpdata->ResponseCode == 0) || $otpdata == true) {
                $otpsend = true;
            } else {
                echo "Sorry";
            }
        }
    }*/ 
    ?>
    <div class="container">
        <div class="row col-md-12" align="center">
            <div class="card">
                <div class="card-content">
                    <div class="cardt-items">
                        <?php if ($otpsend == true) { ?>
                            <span><b>Confirm OTP(One Time Passcode)</b></span>
                            <a href="<?php echo base_url('home') ?>" class="btn blue tooltips" data-container="body" data-placement="top" style="align: center; background: #673bb7; color: white;"> Go Back</a>
                            <?php
                            $url = get_session_var('is_recharge') != '' && get_session_var('is_recharge') == 1 ? 'placerechargeorder' : 'placeorder';
                            echo form_open($url);
                            ?>
                            <div class="form-group border-gery-top"></br>
                                <div class="col-md-12">
                                    <label class="control-label">
                                        <span>OTP(One Time Passcode) has sent to your Registered mobile number</span>
                                    </label>
                                </div>
                                <div class="col-md-12">
                                    <label class="control-label">
                                        <span>Please Enter the OTP to Confirm</span>
                                    </label>
                                </div> </br></br>
                                <div id="timer">2:00</div>
                                <div class="col-md-5"></div>
                                <div class="col-md-4 label-floating">
                                    <input class="col-md-5" placeholder="Enter otp" name="otp" type="text" required="true" value="" maxlength="6" minlength="6" aria-required="true" style="text-align: center;" id="text1" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                                    <span id="error" style="color: Red; display: none">* Please Enter Digits</span>
                                </div></br>
                                <div class="form-footer col-md-12"></br>
                                    <button style="align: center; background: #673bb7; color: white;" type="submit" class="btn btn-purple" id="personal_details_update">
                                        Confirm
                                    </button>
                                    <a href="<?php echo base_url('cart/review'); ?>" class="btn blue tooltips" data-container="body" data-placement="top" style="align: center; background: #673bb7; color: white;" data-original-title="reset">Resend OTP</a>
                                </div></br></br>
                            </div></br>

                            <?php echo form_close(); ?>
                        <?php } else { ?>
                            <h4> Please register your mobile no.</h4>
                        <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var timeoutHandle;
    function countdown(minutes) {
        var seconds = 60;
        var mins = minutes
        function tick() {
            var counter = document.getElementById("timer");
            var current_minutes = mins - 1
            seconds--;
            counter.innerHTML =
                    current_minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);
            if (seconds > 0) {
                timeoutHandle = setTimeout(tick, 1000);
            } else {
                if (mins > 1) {
                    setTimeout(function () {
                        countdown(mins - 1);
                    }, 1000);
                }
            }
        }
        tick();
    }
    countdown(2);
</script>
<script type="text/javascript">
    var specialKeys = new Array();
    specialKeys.push(8); //Backspace
    function IsNumeric(e) 
    {
        var keyCode = e.which ? e.which : e.keyCode
        var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
        document.getElementById("error").style.display = ret ? "none" : "inline";
        return ret;
    }
     $('#text1').keypress(function( e ) 
 	{
    if(e.which === 32) 
        return false;
	});
</script><!-- 
<script type="text/javascript">
   
</script> -->

