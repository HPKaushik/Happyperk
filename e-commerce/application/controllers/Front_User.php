<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Front_User extends Front_Controller {

	protected $loggedUser;
	protected $wallet_limit = 20000;

	function __construct() {
		parent::__construct();
		$this->loggedUser = $this->aauth->is_loggedin();
		$this->load->model(array('user_model','employee_model','location_model','transaction_model','order_model','order_recharge_model','awards_model','department_model','employee_configuration_model','home_model','send_mail_token_model','state_city_model','employee_address_model'));
	}
	// login page.
	public function login() {
		if (getShortName() != false || $this->loggedUser == null) {
			$isExist = isShortnameExitst(getShortName());
			if ($isExist) { $data['comapanyDetails'] = $isExist;
			} else { if (getShortName() != '') { exit('Sorry! Company does not exist. '); } }
		} else {
			(!$this->loggedUser) ? redirect(base_url()) : '';
		}
		$this->template->set_template('login');
		$this->template->add_css(CSSPATH.'/front_login.css');
		$this->template->add_js(JSPATH.'/login_scroll.min.js');
		$this->template->add_js(JSPATH.'/user/login.js');
		$data['bodyclass'] = 'index';
		// for secuirity.
		$data['formToken'] = generateFormToken('login');
		$this->template->write('title', 'Login | HappyPerks');
		$this->template->write_view('content', 'user/login', isset($data) ? $data : NULL);
		$this->template->render();
	}

	//Login using Aauth Lib
	// Do auth.
	public function auth(){
		error_reporting(E_ALL);
		if($this->input->post())
		{
			$postdata  = escape_post_strings($this->input->post());
			if(array_key_exists('login_token',get_session_var()))
			{
				if($postdata['login_token'] === get_session_var('login_token'))
				{
					$dologin = $this->aauth->login($postdata['email'],$postdata['password']);	
					if($dologin && $this->aauth->is_loggedin()) {
						$this->createsession(get_session_var('user_id'));
						redirect('home');
					}	
					else {
						$this->aauth->error('Please enter correct email and password.',TRUE);
						redirect('login');
					}
				} redirect('login');	
			} else redirect('login');	
		}
		else
		redirect('login');	
	}
	// login session
	function createsession($user_id) {
       $selects = 'e.user_id,' . CORPORATE_TABLE . '.*,e.corporate_id,e.employee_id,e.dob,e.first_name,e.last_name,' . USER_TABLE . '.group_id, ' . USER_TABLE . '.email, ' . USER_TABLE . '.phone, e.status as estatus, ' . USER_TABLE . '.image, ' . USER_TABLE . '.lastsignedinon, ' . USER_TABLE . '.is_wallet_exist';
       $emp = $this->employee_model->getEmployee($user_id, $selects);
       $sess_array = array(
           'employee_id' => $emp->employee_id,
           'corporate_id' => $emp->corporate_id,
           'user_id' => $emp->user_id,
           'dob' => $emp->dob,
           'fname' => $emp->first_name,
           'lname' => $emp->last_name,
           // 'group_id' => $emp->group_id,
           'email' => $emp->email,
           'phone' => $emp->phone,
           'status' => $emp->estatus,
           'image' => $emp->image,
           'is_wallet_exist' => $emp->is_wallet_exist,
           // 'lastsignedinon' => $emp->lastsignedinon,
       );
       
       if ($emp->estatus == 1 && ($emp->group_id == 4 || $emp->group_id == 3)) {
           $this->session->set_userdata('employeed_logged_in', $sess_array);
           $this->session->set_userdata('logged_in', TRUE);
           if ($emp->lastsignedinon === '1111-11-11 00:00:00') {
               $this->session->set_userdata('is_wallet_exist', FALSE);
           } else {
               $this->session->set_userdata('is_wallet_exist', TRUE);
           }
       }
   }

   public function createwallet() {
		if ($this->loggedUser == TRUE) { 
				$this->template->write('title', 'Create | HP wallet | HappyPerks');
				$this->template->write_view('content', 'wallet/create', isset($data) ? $data : NULL);
				$this->template->render();
		} else {
			redirect('home');
		}
	}		
	public function savewallet(){
			if (!$this->loggedUser) {
				redirect(base_url());
			} else { 
				  if($this->input->post()!='') {
					  $data = $this->input->post();	
					  $data = escape_post_strings($data); 	
						$param = array(
							'mobilenumber' => $data['mobilenumber'], 
							'DOB' => $data['dob'], 
							'Name' => $data['name'], 
							'verificationcode' => $data['verificationcode'] 
						);	
						$response = $this->oxigenapi->create_wallet(CREATE_WALLET_URL,$param);	
						if($response!='' && is_object($response)  && $response->ResponseCode == 0) {
						$update_wallet = $this->user_model->update(array('is_wallet_exist' => 1),array('user_id' =>$this->userId));
						if($update_wallet)
							$this->session->set_flashdata('msg_success','Congratualtions ! Your wallet has been created successfully.');	
							}
						else{
								$this->session->set_flashdata('msg_error', 'Error occured: '.$response->ResponseMessage);
						}
					}

			}
		redirect('user/profile');
	}

	/**
	 * User Profile Page
	 * Date : 7-11-2017
	 * @author Kaushik
	 */
	public function profile() {
		if ($this->loggedUser == TRUE) {
			$userwallet = $this->user_model->getRow('is_wallet_exist',array('user_id'=>$this->USER_DETAILS['user_id']));
			if(is_object($userwallet) && $userwallet->is_wallet_exist == 0) {
				redirect('user/wallet/create');
			}else {
				
			$select = "e.*";
			$data['customer_details'] = $this->employee_model->getEmployee_array($this->USER_DETAILS['user_id'], $select);
			$data['customer_location'] = $this->location_model->getResult('*', array('corporate_id' => $this->USER_DETAILS['corporate_id']));
			$data['customer_transactions'] = $this->transaction_model->getAllTransactionsEmployee($this->USER_DETAILS['employee_id']);
			$data['customer_voucher_orders'] = $this->order_model->getAllOrdersVouchers($this->USER_DETAILS['user_id']);
			$data['customer_recharge_orders'] = $this->order_recharge_model->getAllRechargeOrderInfo($this->USER_DETAILS['user_id']);
			$data['customer_hotel_orders'] = $this->order_model->getAllOrdersHotels($this->USER_DETAILS['user_id']);
			$data['customer_awards'] = $this->awards_model->getmyawards($this->USER_DETAILS['employee_id']); 
			// Pass employee_id
			$join = array(CITY_TABLE . ' city ' => 'city.city_id =' . EMPLOYEE_ADDRESS_TABLE . '.city_id', STATE_TABLE . ' state ' => 'state.state_id =' . EMPLOYEE_ADDRESS_TABLE . '.state_id');
			$data['alladdress'] = $this->employee_address_model->getResult(EMPLOYEE_ADDRESS_TABLE . '.*,state.state_name,city.city_name', array(EMPLOYEE_ADDRESS_TABLE . '.user_id' => $this->userId), '', '', 'id', 'DESC', $join);
			$data['state'] = $this->state_city_model->getState('*');
			$this->template->add_css(CSSPATH.'/bootstrap-datetimepicker.min.css');
			$this->template->add_js(JSPATH.'/user/profile.js');
			$this->template->add_css(CSSPATH.'/profile.css');
			$this->template->add_js(JSPATH.'/moment.js');
			$this->template->add_js(JSPATH.'/owl.carousel.min.js');
			$this->template->add_js(JSPATH.'/bootstrap-datetimepicker.js');
			$this->template->write('title', 'HappyPerks');
			$this->template->write_view('content', 'user/profile', isset($data) ? $data : NULL);
			$this->template->render();
			}
		} else {
			redirect('home');
		}

	}
	public function updateprofilepicture() {
		$user = get_session_var('logged_in');
		if (!$user) {
			redirect(base_url());
		} else {
			if (isset($_FILES['profilepic']) && !empty($_FILES['profilepic'])) {
				$userfile = $_FILES['profilepic'];
				$filename = 'profilepic';
				$ext = "gif|png|jpg|jpeg";
				$config = array(
	                'upload_path' => PROFILE_IMG_UPLOAD_PATH,
	                'allowed_types' => $ext,
	                'overwrite' => TRUE,
	                'file_name' => md5(trim(date('d m y h:i:s'))) . $_FILES['profilepic']['name'],
            	);
				$uploaddata = $this->uploadfile->do_upload($filename, $config);
				if (isset($uploaddata) && !empty($uploaddata) && is_array($uploaddata)) {
					if(!key_exists('FILE_ERROR',$uploaddata) && !key_exists('error',$uploaddata))	
					 {
					 	$uploaddata = $uploaddata['upload_data'];
						$pro_pic = $uploaddata['filename'];
						$update['user_image'] = $pro_pic;
						$result = $this->employee_model->update($update, array('user_id' => $this->userId));
						if ($result) {
							$this->session->set_flashdata('msg_success', 'Profile picture has been updated successfully.');
						} else {
							$this->session->set_flashdata('msg_error', 'Something went wrong. Please try again after some time.');
						}
					} else
					{
						$this->session->set_flashdata('msg_error', $uploaddata['error']);
					}
				} else {
					$this->session->set_flashdata('msg_error', 'Something went wrong. Please try again after some time.');
				}
				redirect('user/profile');
			}
		}
	return false;
	}
	/**
	 * Employee DoLoadMoney
	 * @author Kaushik
	 * @modified_by
	 */
	public function DoLoadMoney() {
		if (!$this->loggedUser) {
			redirect(base_url());
		} else {
			$balance = (double) $this->transaction->getEmployeeWalletBalance($this->employeeId);
			$result = array();

			$loadamount = $this->input->post('loadamount');
			if (!empty($loadamount)) {
				if ($balance >= $this->wallet_limit) {
					$this->session->set_flashdata('msg_error', '<b> Sorry! </b> The wallet limit is '.$this->wallet_limit.'only. You cant load more money.');
				} elseif (($balance + $loadamount) > $this->wallet_limit) {
					$this->session->set_flashdata('msg_error', '<b> Sorry! </b> The wallet limit is '.$this->wallet_limit.'only. You can add only  ' . ($this->wallet_limit - $balance) . ' more money.');
				} else {
					$response = $this->transaction->doEmployeeTransaction('', LOAD_MONEY, $this->employeeId,'','',$loadamount, 'Amount has been loaded.');
					// print_r($response);
					// echo $this->db->last_query();
					if ($response) {
						$this->session->set_flashdata('msg_success', '<b>Congrats! </b> Amount ' . $loadamount . ' has been added to your account');
					} else {
						$this->session->set_flashdata('msg_error', '<b> Sorry! </b> Somthing went wrong. Please try again someime later.');
					}
				}
				redirect('user/profile#wallet');
			}
		}
	}
	public function DoSendMoney() {

		if (!$this->loggedUser) {
			redirect(base_url());
		} else {
			$balance = (double) $this->mybalance;
			$response = array();
			if ($this->input->post() != '') {
				$data = $this->input->post(); //prx($data);
				if ($balance >= $data['amount']) {
					$emp = $this->employee_model->getRow('employee_id', array('user_id' => $this->userId));
					$description = (!empty($this->input->post('comment'))) ? $this->input->post('comment') : 'Amount has been sent to ' . $data['empname'];
					if ($emp) {
						$result = $this->transaction->doEmployeeTransaction('', SEND_MONEY, $this->employeeId, $data['employee_id'], '', $data['amount'], $description);
						$this->session->flashdata('msg_success', '<b>Congrats! </b> Amount ' . $data['amount'] . ' has been added to your account');
					}
				} else {
					$this->session->flashdata('msg_error', '<b> Sorry! </b>The wallet has not enough money to transfer.');
				}
			} else {
				$this->session->flashdata('msg_error', '<b> Sorry! </b>Something went wrong.');
			}
			redirect('user/profile#wallet');
		}
	}


	public function getEmployee() {
		$this->user = $this->employee_model->getRow('corporate_id', array('user_id' => $this->userId));
		if (isset($_GET['term'])) {
			$q = strtolower($_GET['term']);
			$query = $this->employee_model->get_auto_emp($this->USER_DETAILS['corporate_id'], $q, $this->userId);
			if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
					$new_row['label'] = htmlentities(stripslashes($row['first_name'] . " " . $row['last_name']));
					$new_row['name'] = htmlentities(stripslashes($row['first_name'] . " " . $row['last_name']));
					$new_row['email'] = htmlentities(stripslashes($row['email']));
					$new_row['emp_code'] = htmlentities(stripslashes($row['emp_code']));
					$new_row['user_id'] = htmlentities(stripslashes($row['user_id']));
					$new_row['employee_id'] = htmlentities(stripslashes($row['employee_id']));
					$row_set[] = $new_row; //build an array
				}
				echo json_encode($row_set); //format the array into json data
			} else {
				$new_row['label'] = "No match found";
				$new_row['name'] = '';
				$row_set[] = $new_row; //build an array
				echo json_encode($row_set);
			}
		}
	}
	

	public function forgotpassword(){
		if($this->input->post('email')!= '') {
        $this->load->model('email_model');
	        $email = $this->input->post('email');
	        $select = "e.user_id,e.first_name,e.last_name,e.employee_id";
	        $info = $this->employee_model->getEmployee_array(NULL, $select, NULL, $email);
	        if ($info != '') {
		       	// Delete laast token.
		       	if($this->send_mail_token_model->isExists(array('user_id'=>$info['user_id'])))
		        {
		        $this->send_mail_token_model->deleteWhere(array('user_id'=>$info['user_id']));
		        }
		   		// Insert content
	            $token = $this->hash->encrypt_decrypt('encrypt', $email);
	            $insert['user_id'] = $info['user_id'];
	            $insert['email'] = $email;
	            $insert['token'] = $token;
	            $insert['expiry_token'] = 'no';
	            $url = BASEURL.'user/changepassword/'.$token;
           		$result = $this->send_mail_token_model->insert($insert);
	            if ($result != '') {
	              $mail = $this->email_model->sendMail($email, $info['first_name'] . ' ' . $info['last_name'], '3', $url);
				  //$activity_log = $this->activity_log->addActivity($info['user_id'],'', 'USER PROFILE', MODIFY, $info['user_id'], $info['employee_id']);
	              $this->session->set_flashdata('succes_msg',"Forgot password link has been sent. Please check your mail.");
	                
	            } else {
	                $this->session->set_flashdata('error_msg',"Something is wrong, please try again.");
	                 }
		          
	        } else {
	            $this->session->set_flashdata('error_msg', "Email Id is not registered please check & enter registered email id.");
	        }
	      redirect('login');
        } else {
			$this->template->set_template('login');
			$this->template->add_css(CSSPATH.'/front_login.css');
	    	$this->template->add_js(JSPATH.'/login_scroll.min.js');
	    	$this->template->add_js(JSPATH.'/user/forgotpassword.js');
        	$this->template->write_view('content', 'user/forgotpassword', isset($data) ? $data : NULL);
			$this->template->render();
        }
	}
	 public function resetpassword($token = '') {
        // Change template 
        $view ='login';
        $this->template->set_template('login');
        if ($token != "") {
            $data = array(
                'token' => $token
            );
            $isExist = $this->send_mail_token_model->isExists($data);
            if ($isExist) {
                $token_email = $this->hash->encrypt_decrypt('decrypt', $token);
                $update['expiry_token'] = 'yes';
                $result = $this->send_mail_token_model->update($update, array('email' => $token_email));
                // Add JS FILE.
                // $this->template->add_js('assets/frontend/js/user/forgotpassword.js');
                // if ($result != '') {
                //    	$view = 'reset_password';
                //     $this->template->render();
                // } else {
                //     $this->session->set_flashdata('error_msg', 'your token is expired, please try again..');
                //     $data['bodyclass'] = 'index';
                // }
            } else
            $this->session->set_flashdata('error_msg', 'your token is expired, please try again..');
        } 
        $data['bodyclass'] = 'index';
		
	    $this->template->add_css(CSSPATH.'/front_login.css');
	    $this->template->add_js(JSPATH.'/login_scroll.min.js');
	    $this->template->add_js(JSPATH.'/user/forgotpassword.js');
	    $this->template->write_view('content', 'user/resetpassword', isset($data) ? $data : NULL);
		$this->template->render();
        return false;
    }


    public function updatepassword() {
    	if($this->input->post()!= '') {
	        $data = escape_post_strings($this->input->post());
	        $token = $data['_token'];
	        $token_email = $this->hash->encrypt_decrypt('decrypt', $token);
	        $select = "e.user_id,e.first_name,e.last_name,e.corporate_id";
	        $info = $this->employee_model->getEmployee_array(NULL, $select, NULL, $token_email);
			// generate bcrypt password and update.	       
	        $update['password'] = $this->bcrypt->hash_password($data['password']);
	        $result = $this->user_model->update($update, array('email' => $token_email));
	        if ($result != '') {
	            $deleteToken = $this->send_mail_token_model->deleteWhere($where = array('email' => $token_email));
	            $this->session->set_flashdata('succes_msg', "Your Password has been Successfully Updated.");
				//$data['activity_log'] = $this->activity_log->addActivity($info['user_id'], $info['corporate_id'], FORGOTING_PASSWORD_MODULE, FORGOT_PASSWORDS, 1);
	        } else {
	            $this->session->set_flashdata('error_msg', "Something is wrong, please try again.");
	        } 
	     redirect('login');
    	}
    }
	//tested. User logged out.
	public function logout(){
		$this->aauth->logout();
		redirect(BASEURL);
	}





	//
	public function getCity() {
		$state_id = $this->input->post('state');
		$data['cityin'] = $this->state_city_model->getCity($state_id);
		print $this->load->view('helper/getcity', $data, true);
		exit;
	}

	public function addAddress() {
		if ($this->input->post() != '') {
			$insert['user_id'] = $this->userId;
			$data = escape_post_strings($this->input->post());
			$insert['name'] = $data['full_name'];
			$insert['mobile_no'] = $data['mobileno'];
			$insert['address'] = $data['full_address'];
			$insert['pincode'] = $data['pincode'];
			$insert['state_id'] = $data['add_state'];
			$insert['city_id'] = $data['add_city'];

			if ($data['address_ids'] == '') {
				$insert = $this->employee_address_model->insert($insert);
				if ($insert) {
					$this->session->set_flashdata('msg_success', "Your Address has been Successfully Added.");
				} else {
					$this->session->set_flashdata('msg_error', "Something is wrong, please try again.");
				}
			} else {
				$update = $this->employee_address_model->update($insert, array('id' => $data['address_ids']));
				if ($update) {
					$this->session->set_flashdata('msg_success', "Your Address has been Successfully Updated.");
				} else {
					$this->session->set_flashdata('msg_error', "Something is wrong, please try again.");
				}
			}
		} else {
			$this->session->set_flashdata('msg_error', "Something is wrong, please try again.");
		}
		redirect(base_url('user/profile#_customer_address'));
	}

	public function editAddress() {
		$id =  escape_post_strings($this->input->post());
		$join = array(CITY_TABLE . ' city ' => 'city.city_id =' . EMPLOYEE_ADDRESS_TABLE . '.city_id', STATE_TABLE . ' state ' => 'state.state_id =' . EMPLOYEE_ADDRESS_TABLE . '.state_id');
		$data = $this->employee_address_model->getRow(EMPLOYEE_ADDRESS_TABLE . '.*,state.state_name,city.city_name', array(EMPLOYEE_ADDRESS_TABLE . '.id' => $id['id']), $join, 'id', 'DESC');
		echo json_encode($data);
		exit;
	}

	public function deleteAddress($id1 = '') {
		$id = escape_post_strings($this->input->post());
		$result = $this->employee_address_model->deleteWhere($where = array('id' => $id['id1']));
		if ($result) {
			$data['activity_log'] = $this->activity_log->addActivity($this->userId, $this->corporateId, ADD_ADDRESS_MODULE, REMOVE, $result);
			$this->session->set_flashdata('msg_delete', 'Address has been deleted successfully.');
			redirect(base_url('user/profile#_customer_address'));
		}
		return false;
	}

}
	