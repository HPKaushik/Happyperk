<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Awards_model extends Front_Model {
    
    function __construct() {

        parent::__construct();

        $this->table = AWARDS_TABLE;
        $this->primary_key = AWARDS_TABLE.'.id';
    }
	
	public function change_status_awards($corporate_id, $id, $status){
		$this->db->where('user_id', $corporate_id);
		$this->db->where('id', $id);
		$this->db->update(AWARDS_TABLE, array('status' => $status));
		return true;
	}
	
	public function getAwardEmployee($selects='*,' . USER_TABLE . '.*', $emp_id) {        
        $this->db->select($selects);
        $this->db->order_by(USER_TABLE . '.user_id', 'DESC');
        $this->db->from(EMPLOYEE_TABLE);
        $this->db->join(USER_TABLE, USER_TABLE . '.user_id = ' . EMPLOYEE_TABLE . '.user_id');
        $this->db->where(EMPLOYEE_TABLE . '.employee_id', $emp_id);
        $query = $this->db->get();
        return $query->row();
    }
	
	public function getCorporateInfo($user_id, $selects='*') {
		$this->db->select($selects);
        $this->db->order_by(USER_TABLE . '.user_id', 'DESC');
        $this->db->from(EMPLOYEE_TABLE);
        $this->db->join(USER_TABLE, USER_TABLE . '.user_id = ' . EMPLOYEE_TABLE . '.user_id');
        $this->db->where(EMPLOYEE_TABLE . '.user_id', $user_id);
        $query = $this->db->get();
        return $query->row();
        }
        public function getmyawards($id){
            $myawards = $this->db->where('employee',$id)->get(AWARDS_TABLE)->result();
            return $myawards;
        }
       
    public function get_Badges($id)
    {
        $this->db->select('*');
        $this->db->from('hp_badges hp');
        $this->db->where('hp.id',$id);
        $res = $this->db->get();
        return $res->result_array();
    }
}