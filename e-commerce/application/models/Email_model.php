<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->table = EMAILTEMPLATE_TABLE;
        $this->primary_key = EMAILTEMPLATE_TABLE . '.id';
        
    }

    public function getTemplate($id = '') {
        if (isset($id) && !empty($id)) {
            $template = $this->db->where('id', $id)->get(EMAILTEMPLATE_TABLE)->row_array();
            return $template;
        }
        return false;
    }

    public function sendMail($to = '', $name = '', $template_id = '', $token = NULL ,  $order_id = NULL ) {
        $smtp = $this->getSMTPDetails();
        extract($smtp);
        $mail = new PHPMailer();
        $message = $this->getTemplate($template_id);

        if (!is_array($message))
            return false;
        extract($message);
        // SMTP
        $mail->IsSMTP(); // we are going to use SMTP
        $mail->SMTPDebug = false;
        $mail->IsHTML();
        $mail->SMTPSecure = $smtp_secure;  // prefix for secure protocol to connect to the server
        $mail->SMTPAuth = $smtp_auth;                  // enable SMTP authentication
        $mail->Host = $smtp_host;      //smtp.gmail.com sets GMAIL as the SMTP server
        $mail->Port = $smtp_port;                   // set the SMTP port for the GMAIL server
        $mail->Username = $smtp_username;  // GMAIL username
        $mail->Password = $smtp_password;          // password in GMail
        $mail->SetFrom($send_from, $sender_name);  //Who is sending the email
        // Mail
        $mail->Subject = $subject;
        
        $mail->Body = $this->generateHTML($template_id, $body, $to, $token,$order_id);
        $mail->AddEmbeddedImage('http://18.216.79.189/product/hp/assets/frontend/img/logo-footer.png', 'logo');
        $mail->AddAddress($to, $name);

        // Send or not.
        if (!$mail->Send()) {
            return "Message could not be sent.";
        } else
            return true;
    }

    public function getSMTPDetails() {
        $this->table = 'hp_master_settings';
        $this->primary_key = 'hp_master_settings' . '.id';
        $smtp = $this->db->select('hp_key,hp_value')->get($this->table)->result_array();
        foreach ($smtp as $key => $val) {
            $new_array[$val['hp_key']] = $val['hp_value'];
        }
        return $new_array;
    }

    function generateHTML($template_id = '', $html = '', $email = NULL, $token = NULL,$order_id =  NULL) {
       // exit($order_id);
            if(isset($order_id) && !empty($order_id)) {
                $ci=& get_instance();
                $ci->load->model('order_model');
                $order_details = $ci->order_model->get_order_details($order_id);
                  if(get_session_var('is_recharge')!='' && $this->session->set_userdata('is_recharge') == true) 
                        $recharge_details = $ci->order_model->get_recharge_order_details($order_id); 
                  else  $voucher_details = $ci->order_model->get_product_order_details($order_id); 
            }
        $select = "e.first_name,e.last_name";
        $userdetails = $this->employee_model->getEmployee_array(NULL, $select, NULL, $email);
        if (isset($template_id) && !empty($template_id)) {
            $username = $userdetails['first_name'] . ' ' . $userdetails['last_name'];

            switch ($template_id) {
                case 3 :
                    $resetPasswordLink = $token;
                    $html = str_replace('{$username}', $username, $html); //str_replace('{$username}', $username, $html);
                    $html = str_replace('{resetPasswordLink}', $resetPasswordLink, $html);
                case 4 :
                    $generatePasswordLink = $token;
                    $html = str_replace('{$username}', $username, $html); //str_replace('{$username}', $username, $html);
                    $html = str_replace('{generatePasswordLink}', $generatePasswordLink, $html); 
                case 5 :
                if((isset($order_details) && !empty($order_details)) && (isset($recharge_details) && !empty($recharge_details)) )
                { 
                    $html = str_replace('{$logo}', 'http://18.216.79.189/product/hp/assets/frontend/img/logo-footer.png', $html); 
                    $html = str_replace('{$username}', $username, $html); 
                    $html = str_replace('{$order_id}', $order_details->order_code, $html); 
                    $html = str_replace('{$servicenumber}', $recharge_details->mobile_recharge_no, $html); 
                    $html = str_replace('{$amount}', $recharge_details->recharge_amount, $html); 
                    $html = str_replace('{$region}', $recharge_details->region, $html); 
                    $html = str_replace('{$operator}', $recharge_details->operator, $html); 
                }
                case 6 :
                if((isset($order_details) && !empty($order_details)) && (isset($voucher_details) && !empty($voucher_details)) )
                { 
                    $html = str_replace('{$logo}', 'http://18.216.79.189/product/hp/assets/frontend/img/logo-footer.png', $html); 
                    $html = str_replace('{$username}', $username, $html); 
                    $html = str_replace('{$order_id}', $order_details->order_code, $html); 
                    $html = str_replace('{$item_name}', $order_details->invoice_no, $html); 
                    $html = str_replace('{$item_qty}', $voucher_details->quantity, $html); 
                    $html = str_replace('{$amount}', $voucher_details->price, $html); 
                    $html = str_replace('{$date}', date('d-m-Y',strtotime($voucher_details->created_at)), $html); 
                }
                case 7 :
                if((isset($order_details) && !empty($order_details)) && (isset($voucher_details) && !empty($voucher_details)) )
                { 
                    $html = str_replace('{$logo}', 'http://18.216.79.189/product/hp/assets/frontend/img/logo-footer.png', $html); 
                    $html = str_replace('{$username}', $username, $html); 
                    // $html = str_replace('{$order_id}', $order_details->order_code, $html); 
                    // $html = str_replace('{$item_name}', $order_details->invoice_no, $html); 
                    // $html = str_replace('{$item_qty}', $voucher_details->quantity, $html); 
                    // $html = str_replace('{$amount}', $voucher_details->price, $html); 
                    // $html = str_replace('{$date}', date('d-m-Y',strtotime($voucher_details->created_at)), $html); 
                }
            }
            return $html;
        } else
            return false;
    }

}
