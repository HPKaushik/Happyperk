<?php
$verificationcode = false;  
$loggedUser = get_session_var('employeed_logged_in');
if (!empty($loggedUser['phone'])) {
    $param = array('mobilenumber' => "91" . $loggedUser['phone']);
    // prx($loggedUser);
    $data = $this->oxigenapi->is_wallet_exist(VERIFY_WALLET_URL, $param);
    if ($data != false) {
        $arr = json_decode($data);
        if ($arr->ResponseCode == 1002) {
            $update_last_loggedin = $this->user_model->update(array('is_wallet_exist' => '1'), array('user_id' => $this->userId));    
            redirect('home');
        }
        elseif ($arr->ResponseCode != 0) {
            // $param['otptype'] = 10;
            $vcode = $this->oxigenapi->send_verification_code(MOBILE_VERIFICATION_URL, $param);
            if ( isset($vcode)  && (is_object($vcode)  && $vcode->ResponseCode == 0) || $vcode == true)
            {    $verificationcode = true; } 
            else { echo "Sorry"; }
        }
    }
}
?>
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-content">  
                <div class="cardt-items">
                    <?php if ($verificationcode == true ) { ?>
                        <h3>Create wallet</h3>
                        <?php   echo form_open(base_url().'user/wallet/save');  ?>
                        <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group label-floating"> 
                                <label class="control-label">
                                    Username / Display Name
                                    <small>*</small>
                                </label>
                                <input class="form-control col-md-6" placeholder="Enter  Username / Display Name" name="name" type="text" value="<?php echo !empty($loggedUser['fname']) ? $loggedUser['fname']  :''; ?>" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group label-floating"> 
                                <label class="control-label">
                                    Mobile number
                                    <small>*</small>
                                </label>
                                <input class="form-control col-md-6" placeholder="Enter Mobile number" name="mobilenumber" type="text" 

                                value="<?php echo !empty($loggedUser['phone']) ? $loggedUser['phone']  :''; ?>" >
                            </div>
                        </div><div class="col-md-6">
                            <div class="form-group label-floating"> 
                                <label class="control-label">
                                    Birthdate
                                    <small>*</small>
                                </label>
                                <input class="form-control col-md-6" placeholder="Enter Birthdate" name="dob" type="text" value="<?php echo !empty($loggedUser['dob']) ? date('d-m-Y',strtotime($loggedUser['dob'])):''; ?>" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group label-floating"> 
                                <label class="control-label">
                                    Verification code
                                    <small>*</small>
                                </label>
                                <input class="form-control col-md-6" placeholder="Enter Verification code" name="verificationcode" type="text" value="" >
                            </div>
                        </div>  
                        <div class="form-footer">
                           <button type="submit" class="btn btn-yellow btn-fill btn-round">
                                Confirm
                            </button>
                        </div>
                        </div>  
                        <?php echo form_close(); ?>
                        <?php }else { ?>
                        <h3>Something went wrong. Please try again after sometime.  
                        <?php } ?>
                   </div>
            </div>
        </div>
    </div>
</div>