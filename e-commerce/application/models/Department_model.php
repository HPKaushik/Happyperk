<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department_model extends Front_Model {
    
    function __construct() {

        parent::__construct();

        $this->table = DEPARTMENT_TABLE;
        $this->primary_key = DEPARTMENT_TABLE.'.id';
    }
	public function getDeptname($dept_id='')
    {
        if(isset($user_id)){
            $dept = $this->db->select('department_name')->where('id',$dept_id)->get(DEPARTMENT_TABLE)->row_array();
            $deptname = $user['department_name'];  
          return $deptname;
        }
     
        return FALSE;
    }
    
}