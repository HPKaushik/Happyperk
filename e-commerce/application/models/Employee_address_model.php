<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Employee_address_model extends Front_Model 
{ 
   function __construct() {
      parent::__construct();
      $this->table = EMPLOYEE_ADDRESS_TABLE;
      $this->primary_key = EMPLOYEE_ADDRESS_TABLE.'.address_id';
   }
    
   
    
}