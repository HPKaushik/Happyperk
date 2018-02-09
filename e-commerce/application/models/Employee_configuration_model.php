<?php

if (!defined('BASEPATH'))    exit('No direct script access allowed');

class Employee_configuration_model extends Front_Model { 


	function __construct() {
        parent::__construct();
        $this->table = EMP_CONFIG_DESIGNATION;
        $this->primary_key = EMP_CONFIG_DESIGNATION . '.employee_id';
    }
    
}