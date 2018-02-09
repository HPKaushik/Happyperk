<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Send_mail_token_model extends Front_Model {

    function __construct() {
        parent::__construct();
        $this->table = SEND_MAIL_TOKEN_TABLE;
        $this->primary_key = SEND_MAIL_TOKEN_TABLE . '.id';
    }

}
 