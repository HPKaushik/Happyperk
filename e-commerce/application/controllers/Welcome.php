<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->template->set_template('common');
		$this->load->model(array('Email_model','employee_model'));
	}
	 public function index() {
        // var_dump(gd_info());
        // phpinfo();
        $this->Email_model->sendMail('kaushik.t@happyperks.com','kaushik','1');
        // $this->load->view('welcome_message');
    }
}
