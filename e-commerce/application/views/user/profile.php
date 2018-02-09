<?php
(isset($customer_details)) ? extract($customer_details) : '';
?>
<div class="container">
<div class="row">
<div class="col-lg-3 col-md-4">
<div class="card mt25">
<div class="card-header text-center mtb15">
<h5 class="card-title f12">
<smal class='theme-color'>Hello! </smal><?php echo isset($first_name) ? $first_name : ''; ?> <?php echo isset($last_name) ? $last_name : ''; ?>
</h5>
<div class="card-profile-icon">
<?php if (isset($user_image) && $user_image != '') {?>
    <img src="<?php echo PROFILE_IMG_UPLOAD_PATH . '/' . $user_image; ?>" alt="" class="mtb15">
<?php } else {?>
    <img src="<?php echo IMGURL; ?>/default-profile-avatar.png" alt="" class="mtb15">
<?php }?>
<p><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i> <small class="f12">Edit Picture </small></a></p>
</div>
</div>
<div class="card-content p0">
<ul class="nav nav-pills nav-pills-purple border-right-color nav-stacked">
<li class="active">
    <a href="#info" data-toggle="tab">Basic Information</a>
</li>
<li>
    <a href="#wallet" data-toggle="tab">Wallet</a>
</li>
<li>
    <a href = "#orders" data-toggle = "tab">Orders</a>
</li>
<li>
    <a href = "#change_password" data-toggle = "tab">Change Password</a>
</li>
<li>
    <a href = "#announcement" data-toggle = "tab">Annoucements</a>
</li>
<li>
    <a href = "#_customer_address" data-toggle = "tab">My Addresses</a>
</li>
</ul>
</div>
</div>
</div>
<div class = "col-lg-9 col-md-8">
<?php if (count($customer_awards) > 0) {?>
<div class = "card mt25">
    <div class="card-header ptb15">
        <div class="row">
            <div class="col-sm-12 mtb15">
                <div class="col-xs-12">
                    <?php foreach ($customer_awards as $awards): ?>
                        <img src="<?php echo IMGURL.'/profile/medal.png'; ?>" width="30" class="mlr10"/>
                        <?php echo $awards->title; ?>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }?>

<?php if ($this->session->flashdata('msg_success') || $this->session->flashdata('msg_error') || $this->session->flashdata('msg_delete')) {?>
<div class = "card mt25">
    <?php if ($this->session->flashdata('msg_success')) {?>
<div class="alert alert-success text-left" role="alert"> <?php echo $this->session->flashdata('msg_success'); ?></div>
<?php }if ($this->session->flashdata('msg_error')) {?>
<div class="alert alert-danger text-left" role="alert"> <?php echo $this->session->flashdata('msg_error'); ?></div>
<?php }if ($this->session->flashdata('msg_delete')) {?>
<div class="alert alert-success text-left" role="alert"> <?php echo $this->session->flashdata('msg_delete'); ?></div>
<?php }?>
</div>
<?php }?>
<div class="card">
<div class="card-content p0">
<div class="tab-content m0">
<div class="tab-pane active" id="info">
    <ul class="nav nav-pills nav-pills-purple border-bottom-color m0">
        <li class="active">
            <a href="#basic1" class="active no-border-radius" data-toggle="tab">Personal Details</a>
        </li>
        <li>
            <a href="#basic2" class="no-border-radius" data-toggle="tab">Professional Details</a>
        </li>
        <li>
            <a href="#basic3" class="no-border-radius" data-toggle="tab">KYC Details</a>
        </li>
    </ul>
    <div class="tab-content">
        <!--Personal details-->
        <div class="tab-pane active" id="basic1">
            <?php echo form_open(BASEURL. 'user/updateprofile', array('id' => 'update_personal_profile_form')) ?>
            <div class="card-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <label class="control-label">
                                First Name
                                <small>*</small>
                            </label>
                            <input class="form-control" placeholder="Enter first name" name="first_name" type="text" required="true" value="<?php echo isset($first_name) ? $first_name : ''; ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Last Name
                            </label>
                            <input class="form-control" name="last_name" placeholder="Enter last name" type="text" value="<?php echo isset($last_name) ? $last_name : ''; ?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Email ID
                            </label>
                            <input class="form-control" name="email" placeholder="Enter email" type="text" value="<?php echo isset($email) ? $email : ''; ?>" readonly=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Alternative Email ID
                            </label>
                            <input class="form-control" name="alternate_email" placeholder="Enter alternative email" type="text" value="<?php echo isset($alternate_email) ? $alternate_email : ''; ?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Phone no
                            </label>
                            <input class="form-control" name="phone_no" placeholder="Enter phone no" type="text" value="<?php echo isset($phone) ? $phone : ''; ?>"  readonly=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Alternative Phone no
                            </label>
                            <input class="form-control" name="alternate_phone" placeholder="Enter alternative phone no" type="text" value="<?php echo isset($alternate_phone) ? $alternate_phone : ''; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <h4 class="header-title m-l-20 mt20">More about me</h4>
                    <div class="col-md-4">
                        <div class="form-group label-floating">
                            <label class="control-label">
                                DOB
                            </label>
                            <input class="form-control" name="dob" id="dob" type="text" placeholder="select date of birth" value="<?php echo isset($dob) ? $dob : ''; ?>" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Gender
                                <small>*</small>
                            </label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="gender" value="male" <?php echo (isset($gender) && $gender == 'male') ? 'checked' : ''; ?>>
                                    <span class="circle"></span>
                                    <span class="check"></span> Male
                                </label>
                                <label>
                                    <input type="radio"  value="female" name="gender" <?php echo (isset($gender) && $gender == 'female') ? 'checked' : ''; ?>>
                                    <span class="circle"></span>
                                    <span class="check"></span> Female
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Marital Status
                            </label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="marital_status"  value="married"  <?php echo (isset($marital_status) && $marital_status == 'married') ? 'checked' : ''; ?>>
                                    <span class="circle"></span>
                                    <span class="check"></span> Married
                                </label>
                                <label>
                                    <input type="radio" name="marital_status" value="single" <?php echo (isset($marital_status) && $marital_status == 'single') ? 'checked' : ''; ?>>
                                    <span class="circle"></span>
                                    <span class="check"></span> Single
                                </label>
                                <label>
                                    <input type="radio" name="marital_status" value="divorcee" <?php echo (isset($marital_status) && $marital_status == 'divorcee') ? 'checked' : ''; ?>>
                                    <span class="circle"></span>
                                    <span class="check"></span> Divorcee
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Confirm Password
                            </label>
                            <input class="form-control" name="password" placeholder="Please confirm password" type="password"/>
                        </div>
                    </div>
                </div>
                <div class="form-footer text-right">
                        <button type="submit" class="btn btn-yellow btn-fill btn-round"  id="personal_details_update">
                            Update
                        </button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
        <!--Personal details-->

        <!-- Professional details-->
        <div class="tab-pane" id="basic2">
            <?php echo form_open(BASEURL. 'user/updateprofile', array('id' => 'update_professional_profile_form')); ?>
            <div class="card-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Company name
                            </label>
                            <input class="form-control" placeholder="Enter company name" type="text" readonly="" value="<?php echo isset($company_name) ? $company_name : ''; ?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Employee Code
                                <small>*</small>
                            </label>
                            <input class="form-control" name="emp_code" type="text" placeholder="Enter emp code" required="true"  value="<?php echo isset($emp_code) ? $emp_code : ''; ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Department
                            </label>
                            <select class="form-control" name="department_id">
                                <option value="">Select department</option>
                                <?php
$departmemts = $this->department_model->getResult('id,department_name', array('corporate_id' => $corporate_id));
foreach ($departmemts as $key => $value) {?>
                                    <option value="<?php echo $value->id; ?> "<?php echo (isset($department_id) && ($value->id == $department_id)) ? 'selected' : ''; ?>>
                                    <?php echo $value->department_name; ?>
                                    </option>
                                    <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Joining Date
                            </label>
                            <input class="form-control" name="joining_date" id="joining_date" placeholder="Joining Date" type="text" value="<?php echo isset($joining_date) ? $joining_date : ''; ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Designation
                            </label>
                            <select class="form-control" name="designation_id">
                                <option value="">Select designation</option>
                                <?php
$designation = $this->employee_configuration_model->getResult('id,name');
foreach ($designation as $key => $value) {?>
                                    <option value="<?php echo $value->id; ?>"
                                        <?php echo (isset($designation_id) && ($value->id == $designation_id)) ? 'selected' : ''; ?> >
                                        <?php echo $value->name; ?>
                                    </option>
                                    <!--<input class = "form-control" name = "designation_id" placeholder = "Enter city name" type = "text" value = "<?php echo isset($designation_name) ? $designation_name : ''; ?>" /> -->
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class = "col-md-6">
                        <div class = "form-group label-floating">
                            <label class = "control-label">
                                Annual Income range
                            </label>
                            <select class = "form-control">
                                <option>Upto 1 Lac</option>
                                <option>1 Lac to 3 Lac</option>
                                <option>3 Lac to 5 Lac</option>
                                <option>5 Lac to 10 Lac</option>
                            </select>
                        </div>
                    </div>
                    <div class = "col-md-6">
                        <div class = "form-group label-floating">
                            <label class = "control-label">
                                Office Location
                            </label>
                            <select class="form-control">
                                <?php foreach ($customer_location as $info) {?>
                                    <option value="<?php echo $info->id; ?>" <?php echo (isset($location_id) && ($info->id == $location_id)) ? 'selected' : ''; ?> >
                                        <?php echo $info->location_name; ?>
                                    </option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                </div>
                <input class="form-control" name="email" placeholder="Enter last name" type="hidden" value="<?php echo isset($email) ? $email : ''; ?>" readonly=""/>
                <h4 class = "header-title m-t-20" >Reporting Manager</h4>
                <div class = "row">
                    <div class = "col-md-6">
                        <div class = "form-group label-floating">
                            <label class = "control-label">
                                Name
                            </label>
                            <input class = "form-control" type = "text" name="rm_name" placeholder="Name" value = "<?php echo isset($reporting_manager_name) ? $reporting_manager_name : ''; ?>" />
                        </div>
                    </div>
                    <div class = "col-md-6">
                        <div class = "form-group label-floating">
                            <label class = "control-label">
                                Email ID
                            </label>
                            <input class = "form-control" type = "text" name="rm_email" placeholder="Email" value = "<?php echo isset($reporting_manager_email) ? $reporting_manager_email : ''; ?>" />
                        </div>
                    </div>
                </div>
                <div class = "row">
                    <div class = "col-md-6">
                        <div class = "form-group label-floating">
                            <label class = "control-label">
                                Confirm Password
                            </label>
                            <input class = "form-control" name = "password" placeholder = "Please confirm password" type = "password">
                        </div>
                    </div>
                </div>
                <div class="form-footer text-right">
                    <button type = "submit" class = "btn btn-yellow btn-fill btn-round"  id = "professional_details_update">
                        Update
                    </button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- Professional details-->

        <!-- Other details-->
        <div class="tab-pane" id="basic3">
            <?php echo form_open(BASEURL. 'user/updateprofile', array('id' => 'update_other_profile_form')); ?>
            <div class="card-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Aadhar No
                            </label>
                            <input class="form-control" name="aadhar_number" placeholder="Enter Aadhar No" type="text" value="<?php echo isset($aadhar_number) ? $aadhar_number : ''; ?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Have Passport ?
                            </label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="passport_no" value="yes" <?php echo (isset($passport_no) && $passport_no != '') ? 'checked' : ''; ?>>
                                    <span class="circle"></span>
                                    <span class="check"></span> Yes
                                </label>
                                <label>
                                    <input type="radio"   name="passport_no" value="no" <?php echo (isset($passport_no) && $passport_no == '') ? 'checked' : ''; ?>>
                                    <span class="circle"></span>
                                    <span class="check"></span> No
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Passport No.
                            </label>
                            <input class="form-control" name="passport_no" placeholder="Enter Passport no" type="text" value="<?php echo isset($passport_no) ? $passport_no : ''; ?> " />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <label class="control-label">
                                PAN No.
                            </label>
                            <input class="form-control" name="pan_no" id="pan_no" placeholder="Pan no" type="text" value="<?php echo isset($pan_no) ? $pan_no : ''; ?>" />
                        </div>
                    </div>
                </div>
                <div class = "row">
                    <div class = "col-md-6">
                        <div class = "form-group label-floating">
                            <label class = "control-label">
                                Confirm Password
                            </label>
                            <input class = "form-control" name = "password" placeholder = "Please confirm password" type = "password">
                        </div>
                    </div>
                </div>
                <input class="form-control" name="email" placeholder="Enter last name" type="hidden" value="<?php echo isset($email) ? $email : ''; ?>" readonly=""/>
                <div class="form-footer text-right">
                    <button type = "submit" class = "btn btn-yellow btn-fill btn-round"  id = "other_details_update">
                        Update Other Details
                    </button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<div class="tab-pane" id="wallet">

    <div class="tab-content">
        <div class="tab-pane active" id="add">
            <div class="card-header">
                <h4 class="header-title display-inline-block">Wallet Transactions</h4>
                <div class="card-extra text-right pull-right" >
                    <button type="button" class="btn btn-yellow btn-round" data-target="#_load_money_popup" data-toggle="modal">Load Money</button>
                    <button type="button" class="btn btn-yellow btn-round" data-target="#_send_money_popup" data-toggle="modal">Send Money</button>
                </div>
            </div>
            <div class="card-content">
                <?php if (count($customer_transactions) > 0): ?>
                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Begin Balance</th>
                                <th>Withdraw</th>
                                <th>Deposit</th>
                                <th>Balance</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;foreach ($customer_transactions as $key => $value): ?>
                            <tr>
                                <td><?php echo isset($i) ? $i : ''; ?></td>
                                <td>
                                    <p>
                                        <?php echo isset($value->created_at) ? $value->created_at : ''; ?>
                                    </p>
                                    <small>
                                    <?php echo isset($value->transaction_code) && !empty($value->transaction_code) ? '<p>Transaction ID: <u>' . $value->transaction_code . '</u></p>' : ''; ?><?php echo isset($value->order_code) && !empty($value->order_code) ? '<p>Order ID: <u>' . $value->order_code . '</u></p>' : ''; ?>
                                    </small>
                                </td>
                                <td><?php echo isset($value->description) && !empty($value->description) ? $value->description : 'None'; ?></td>
                                <td><?php echo isset($value->begin_balance) ? round($value->begin_balance) : '0'; ?></td>
                                <td><?php echo isset($value->spent_amount) && $value->spent_amount > 0 ? '- ' . round($value->spent_amount) : '-'; ?></td>
                                <td><?php echo isset($value->received_amount) && $value->received_amount > 0 ? '+ ' . round($value->received_amount) : '-'; ?></td>
                                <td><?php echo isset($value->end_balance) ? round($value->end_balance) : ''; ?></td>
                                <td><?php echo isset($value->status) ? $value->status : ''; ?></td>
                            </tr>
                                <?php $i++;endforeach;?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="category">No Transactions found</p>
                <?php endif;?>
                <div id="_load_money_popup" class="modal fade hp-load-money" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><i class="hp-icons font-30">highlight_off</i></button>
                                <h4 class="modal-title text-center">Load Money</h4>
                            </div>
                            <div class="modal-body">
                                <form id="AddLoadMoney" method="post" action="<?php echo base_url().'user/wallet/doload'; ?>" novalidate="novalidate">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">
                                                    Enter amount
                                                    <small>*</small>
                                                </label>
                                                <input class="form-control" placeholder="Enter amount" name="loadamount"  type="text"  />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-footer text-center">
                                        <button type="submit" id="loadsend" class="btn btn-yellow btn-fill btn-round">Load Money</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="_send_money_popup" class="modal fade hp-send-money" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><i class="hp-icons font-30">highlight_off</i></button>
                                <h4 class="modal-title text-center">Send Money</h4>
                            </div>
                            <div class="modal-body">
                                    <?php echo form_open(BASEURL. 'user/wallet/dosend', array('id', 'SendMoneyInfoForm')); ?>
                                    <div class="row visible" id='sform1'>
                                        <div class="col-sm-12 col-xs-12 col-md-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">
                                                    Employee Name
                                                    <small>*</small>
                                                </label>
                                                <input class="form-control empname" name="empname" id="empname" placeholder="Enter Employee Name" autocomplete="off">
                                            </div>
                                            <div class="form-group label-floating">
                                                <label class="control-label">
                                                    Amount
                                                    <small>*</small>
                                                </label>
                                                <input class="form-control" name="amount" id="amount" placeholder="Enter Amount" placeholder="Enter Employee Name" autocomplete="off">
                                                <input type="hidden" class="form-control" name="employee_id" id="employee_id" value=""  >
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-xs-12 col-md-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">
                                                    Comment
                                                    ( Optional )
                                                </label>
                                                <textarea name="comment" class="form-control" placeholder="Enter Comments"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-center m-b-0">
                                        <div id="sendalertmsg" class=" col-md-6 alert text-left" role="alert" style="display: none;"></div>
                                        <button class="btn btn-yellow btn-fill btn-round" id="moneysend">
                                            Send Money
                                        </button>
                                    </div>
                                    <div class="row text-center">
                                        <div class="col-xs-12">
                                            <h6 class="text-middle-line text-uppercase mtb15 lp1 theme-grey-color"><span>How it works??</span></h6>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="https://www.oxigenwallet.com/public/images/price.png" class="img-circle background-grey img-responsive"/>
                                            <div class="sennd-money-process process-flow-icon">
                                                <h4 class="font-12"><b>Enter Amount</b></h4>
                                                <span class="text-center font-11">Enter amount & promo code, if applicable.</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="https://www.oxigenwallet.com/public/images/price.png" class="img-circle background-grey img-responsive"/>
                                            <div class="sennd-money-process process-flow-icon">
                                                <h4 class="font-12"><b>Select Payment Method</b></h4>
                                                <span class="text-center font-11">Select Mode of Payments & enter details.</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="https://www.oxigenwallet.com/public/images/price.png" class="img-circle background-grey img-responsive"/>
                                            <div class="sennd-money-process">
                                                <h4 class="font-12"><b>Add Money</b></h4>
                                                <span class="text-center font-11">Click "Pay Now".</span>
                                            </div>
                                        </div>
                                    </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tab-pane" id="orders">
    <ul class="nav nav-pills nav-pills-purple border-bottom-color m0">
        <li class="active">
            <a href="#_recharge_orders" class="active no-border-radius" data-toggle="tab" aria-expanded="true">Recharges ( <?php echo isset($customer_recharge_orders) ? count($customer_recharge_orders) : '0'; ?> )</a>
        </li>
        <li class="">
            <a href="#_voucher_orders" class="no-border-radius" data-toggle="tab">Vouchers ( <?php echo isset($customer_voucher_orders) ? count($customer_voucher_orders) : '0'; ?> )</a>
        </li>
        <li class="">
            <a href="#_hotel_package_orders" class="no-border-radius" data-toggle="tab">Hotel Packages ( <?php echo isset($customer_hotel_orders) ? count($customer_hotel_orders) : '0'; ?> )</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="_recharge_orders">
            <?php if (count($customer_recharge_orders) > 0): ?>
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Invoice no</th>
                            <th>Order code</th>
                            <th>Order price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customer_recharge_orders as $key => $value): ?>
                            <tr>
                                <td><?php echo isset($key) ? $key + 1 : ''; ?></td>
                                <td><?php echo isset($value->created_at) ? $value->created_at : ''; ?></td>
                                <td><?php echo isset($value->invoice_no) ? $value->invoice_no : ''; ?></td>
                                <td><?php echo isset($value->order_code) ? $value->order_code : ''; ?></td>
                                <td><?php echo isset($value->total) ? $value->total : '0'; ?></td>
                                <td><?php echo isset($value->order_status_id) ? $value->order_status_id : ''; ?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="category pall20">No orders found</p>
            <?php endif;?>
        </div>
        <div class="tab-pane" id="_voucher_orders">
            <?php if (count($customer_voucher_orders) > 0): ?>
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Invoice no</th>
                            <th>Order code</th>
                            <th>Order price</th>
                            <th>Status</th>
                            <th>View</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($customer_voucher_orders as $key => $value): ?>
                            <tr>
                                <td><?php echo isset($key) ? $key + 1 : ''; ?></td>
                                <td><?php echo isset($value->created_at) ? $value->created_at : ''; ?></td>
                                <td><?php echo isset($value->invoice_no) ? $value->invoice_no : ''; ?></td>
                                <td><?php echo isset($value->order_code) ? $value->order_code : ''; ?></td>
                                <td><?php echo isset($value->total) ? $value->total : '0'; ?></td>
                                <td><?php echo (isset($value->order_status_id) && $value->order_status_id == 1) ? 'completed' : ''; ?></td>
                                <td><a target="_blank" href="<?php echo base_url('order/invoice/' . $value->order_id); ?>">Download invoice</a></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="category pall20">No orders found</p>
            <?php endif;?>
        </div>
        <div class="tab-pane" id="_hotel_package_orders">
            <?php if (count($customer_hotel_orders) > 0): ?>
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Invoice no</th>
                            <th>Order code</th>
                            <th>Order price</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($customer_hotel_orders as $key => $value): ?>
                            <tr>
                                <td><?php echo isset($key) ? $key + 1 : ''; ?></td>
                                <td><?php echo isset($value->created_at) ? $value->created_at : ''; ?></td>
                                <td><?php echo isset($value->invoice_no) ? $value->invoice_no : ''; ?></td>
                                <td><?php echo isset($value->order_code) ? $value->order_code : ''; ?></td>
                                <td><?php echo isset($value->total) ? $value->total : '0'; ?></td>
                                <td><?php echo isset($value->order_status_id) ? $value->order_status_id : ''; ?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="category pall20">No orders found</p>
            <?php endif;?>
        </div>
    </div>
</div>
<div class="tab-pane" id="change_password">
    <div class="tab-content card-content">
        <h4>Change Password</h4>
        <?php echo form_open(BASEURL. 'user/changepassword', array('id' => 'changePassword')) ?>
        <div class="row">
            <div class="col-md-6 m-l-10">
                <div class="form-group label-floating">
                    <label class="control-label">
                        Old Password
                    </label>
                    <input class="form-control" id="old_password" name="old_password" placeholder="Please enter old password" type="password">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 m-l-10">
                <div class="form-group label-floating">
                    <label class="control-label">
                        New Password
                    </label>
                    <input class="form-control" id="new_password" name="new_password" placeholder="Please enter new password" type="password">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 m-l-10">
                <div class="form-group label-floating">
                    <label class="control-label">
                        Confirm Password
                    </label>
                    <input class="form-control" id="confirm_password" name="confirm_password" placeholder="Please enter confirm password" type="password">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12 m-l-10">
                <div class="form-footer text-right">
                    <div id="changepasswordalertmsg" class="col-md-6 alert text-left" role="alert" style="display: none;"></div>
                    <button type="submit" class="btn btn-yellow btn-fill btn-round" id="change_password_update">Update Password</button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="tab-pane" id="announcement">
    <div class="tab-content card-content">
        <h4>All Annoucements</h4>
        <ul class="ann-list-latest nav">
            <?php $announcements = $this->home_model->getAllAnnoucements();
if (isset($announcements) && !empty($announcements) && count($announcements) > 0) {
	foreach ($announcements as $key => $value): ?>
                    <li class="read pall20 mb10">
                        <h5 class="mb5"><?php echo (!empty($value->name)) ? $value->name : ''; ?></h5>
                        <div class="ann-body">
                            <p class="text-right font-11">
                                <?php echo (!empty($value->description)) ? $value->description : ''; ?>
                            </p>
                        </div>
                    </li>
                <?php endforeach;?>
            <?php }?>
        </ul>
    </div>
</div>
<div class="tab-pane" id="_customer_address">
    <div class="tab-content">
        <div class="card-header">
            <h4 class="header-title display-inline-block">Your Addresses</h4>
            <div class="card-extra text-right pull-right m-10">
                <a href="#" data-target="#_add_address_popup" data-toggle="modal"><b>Add your address</b> <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
            </div>
        </div>
        <?php if (isset($alladdress)  && count($alladdress) > 0): ?>
            <table class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Pin code</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alladdress as $key => $value): ?>
                        <tr>
                            <td><?php echo isset($key) ? $key + 1 : ''; ?></td>
                            <td><?php echo isset($value->name) ? $value->name : ''; ?></td>
                            <td><?php echo isset($value->mobile_no) ? $value->mobile_no : ''; ?></td>
                            <td><?php echo isset($value->address) ? $value->address : ''; ?></td>
                            <td><?php echo isset($value->pincode) ? $value->pincode : ''; ?></td>
                            <td><?php echo isset($value->state_name) ? $value->state_name : ''; ?></td>
                            <td><?php echo isset($value->city_name) ? $value->city_name : ''; ?></td>
                            <td class="actions">
                                <a href="#" title="edit address" class="on-default edit-row"><i id="<?php echo $value->id; ?>" class="fa fa-pencil"></i></a>
                                &nbsp;&nbsp;<a href="javascript:" id="<?php echo $value->id; ?>" onclick="deleteAddress(this.id)" title="remove address" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="category pall20">No Address found</p>
        <?php endif;?>
    </div>
</div>
</div>
</div>
</div>

</div>
<div class="row"  style="display: none;">
<div class="col-xs-12">
<div class="card" >
<div class="card-content">
<h4 class="header-title m-t-20">Invite Family</h4>
<div class="row">
    <?php echo form_open(); ?>
    <div class="col-md-5">
        <div class="form-group label-floating">
            <label class="control-label">
                Email ID
            </label>
            <input class="form-control" name="invite_member_email[]" type="text"/>
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group label-floating">
            <label class="control-label">
                Relation
            </label>
            <select name="invite_member_relation[]" class="form-control">
                <option value="Sibling">Sibling</option>
                <option value="Spouse">Spouse</option>
                <option value="Wife">Wife</option>
                <option value="Father">Father</option>
                <option value="Mother">Mother</option>
                <option value="Other">Other</option>
            </select>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<div class="">
    <button type="submit" class="btn btn-yellow btn-fill btn-round" name="send_invitation" id="send_invitation">Send Invitation </button>
</div>
</div>
</div>
</div>
</div>
</div>
<!--image upload modal-->
<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; padding-right: 17px;">
<!--<form id="profileImageForm" method="post" enctype="multipart/form-data">-->
<?php echo form_open_multipart(BASEURL. 'user/upload/profile', array('id' => 'profileImageForm')); ?>
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
<i class="material-icons">x</i>
</button>
<h4 class="modal-title">Upload Profile Image</h4>
</div>
<div id="errorext" style="color:red;margin-left:20px;"></div>
<div class="modal-body">
<?php if (isset($user_image) && $user_image != '') {?>
<img width="150" height="150"  id="blah" src="<?php echo PROFILE_IMG_UPLOAD_PATH; ?>/<?php echo $user_image; ?>" >
<?php } else {?>
<img width="150" height="150"  id="blah" src="<?php echo IMGURL; ?>/default-profile-avatar.png" >
<?php }?>
<h5></h5>
<input type="file" name="profilepic" id="profilepic" onchange="read(this);"  value="<?php echo (!empty($user_image)) ? $user_image : ''; ?>"><br>
<p><b>(recommended size of image : 120 x 120)</b></p>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-yellow btn-fill btn-Upload">Uplaod</button>
<button type="button" id="closeImagePopup" class="btn btn-danger btn-fill btn-round" data-dismiss="modal">Close</button>
</div>
</div>
</div>
<?php echo form_close(); ?>
</div>
<!--end image upload modal-->

<div id="_send_money_otp_popup" class="modal fade hp-send-money" role="dialog" style="display:none;">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><i class="hp-icons font-30">highlight_off</i></button>
<h4 class="modal-title text-center">Send Money</h4>
</div>
<div class="modal-body">
<?php echo form_open(BASEURL. 'user/wallet/dosend', array('id' => 'otpForm')); ?>
<div class="row visible" id='sform1'>
<div class="col-sm-12 col-xs-12 col-md-6">
    <div class="form-group label-floating">
        <label class="control-label">
            OTP
            <small>*</small>
        </label>
        <input name="otp" id="otp" class="form-control" placeholder="Enter OTP" type="text" minlength="6" maxlength="6">
    </div>
</div>
</div>
<div class="form-group text-center m-b-0">
<div id="sendalertmsg" class=" col-md-6 alert text-left" role="alert" style="display: none;"></div>
<button type="submit" class="btn btn-yellow btn-fill btn-round">Send Money</button>
</div>
</form>
</div>
</div>
</div>
</div>
<!--start for add multiple addresses-->
<div id="_add_address_popup" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><i class="hp-icons font-30">highlight_off</i></button>
<h4 class="modal-title text-center" id="textadd">Add Address</h4>
<h4 class="modal-title text-center" id="textedit"></h4>
</div>
<div class="modal-body">
<?php echo form_open(BASEURL. 'user/address', array('id' => 'addressFrom')); ?>
<input  type="hidden" name="address_ids" id="address_ids" value="">
<div class="row" id="inputadd">
<div class="col-md-12 m-l-10">
    <div class="col-md-6 m-l-10">
        <div class="form-group label-floating">
            <label class="control-label">
                Full Name
            </label>
            <input  type="text" class="form-control" id="full_name" name="full_name" placeholder="Please enter your name">
        </div>
    </div>
    <div class="col-md-6 m-l-10">
        <div class="form-group label-floating">
            <label class="control-label">
                Mobile No.
            </label>
            <input class="form-control onumeric" id="mobileno" minlength="10" maxlength="10" name="mobileno" placeholder="Please enter your mobile no.">
        </div>
    </div>
    <div class="col-md-6 m-l-10">
        <div class="form-group label-floating">
            <label class="control-label">
                Address
            </label>
            <input class="form-control" id="full_address" name="full_address" placeholder="Please enter your address">
        </div>
    </div>
    <div class="col-md-6 m-l-10">
        <div class="form-group label-floating">
            <label class="control-label">
                Pin code
            </label>
            <input  type="text" class="form-control onumeric"  minlength="6" maxlength="6" id="pincode" name="pincode" placeholder="Please enter your pincode">
        </div>
    </div>
    <div class="col-md-6 m-l-10">
        <div class="form-group label-floating">
            <label class="control-label">
                State
            </label>
            <select class="form-control stateadd" id="add_state" name="add_state">
                <option value="">Select State</option>
                <?php if(isset($state))  { ?>
                <?php foreach ($state as $info) {?>
                     <?php //echo (!empty($singlelocation) && ($singlelocation->state == $info->state_id)) ? "selected" : ''; ?>
                    <option value="<?php echo $info->state_id; ?>"><?php echo $info->state_name; ?></option>
                <?php }?>
                <?php }?>
            </select>
        </div>
    </div>
    <div class="col-md-6 m-l-10">
        <div class="form-group label-floating">
            <label class="control-label">
                City
            </label>
            <select class="form-control cityadd" id="add_city" name="add_city">
            </select>
        </div>
    </div>
</div>
<div class="col-md-12 m-l-10">
    <div class="form-footer text-right">
        <button type="submit" class="btn btn-yellow btn-fill btn-round" id="address_update">Save</button>
    </div>
</div>
</div>
<?php echo form_close(); ?>
</div>
</div>
</div>
</div>
</div>
<!--end address section-->