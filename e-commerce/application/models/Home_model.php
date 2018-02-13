<?php

class Home_model extends Front_Model {

	function __construct() {
        parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
        $this->table = 'hp_announcements_user_read_map';
        $this->primary_key = 'hp_announcements_user_read_map'.'.id';
    }

	function getHomePageSlider() {
		$sliders = $this->db->where('status', '1')->order_by('sort_order', 'DESC')->get(SLIDER_TABLE)->result();
		return $sliders;
	}

	function getAllUnreadAnnoucements() {
		$department_id = '';
		$query = $this->db->select('department_id')->where('user_id', $this->userId)->get(EMPLOYEE_TABLE);
		if ($query->num_rows() >= 1) {
			$department_id = $query->row()->department_id;
		}
		if (!empty($department_id)) {
			$this->db->where('department_id', '0');
			$this->db->or_where('department_id', $department_id);
		}
		$this->db->where('status', '1');
		$this->db->where('corporate_id', $this->corporateId)->order_by('created_at', 'DESC');
		$this->db->where('id NOT in ( select annoucement_id from hp_announcements_user_read_map where user_id='.$this->userId.")");
		$annoucements = $this->db->get(ANNOUNCEMENT_TABLE)->result();
		// echo $this->db->last_query();
		// prx($annoucements);
		return $annoucements;
	}
	function getAllAnnoucements() {
		$department_id = '';
		$read = '';
		$query = $this->db->select('department_id')->where('user_id', $this->userId)->get(EMPLOYEE_TABLE);
		if ($query->num_rows() >= 1) {
			$department_id = $query->row()->department_id;
		}
		if (!empty($department_id)) {
			$this->db->where('department_id', '0');
			$this->db->or_where('department_id', $department_id);
		}
		$this->db->where('status', '1');
		$this->db->where('corporate_id', $this->corporateId)->order_by('created_at', 'DESC');
		$annoucements = $this->db->get(ANNOUNCEMENT_TABLE)->result();
		return $annoucements;
	}
	function MarkAllAsReadAnnoucements($user_id) {
			$annoucements = (array)$this->getAllUnreadAnnoucements();
			if(isset($annoucements) && !empty($annoucements) && is_array($annoucements)) {
				foreach ($annoucements as $key => $value) {
					$data = array('user_id'=>$user_id,'annoucement_id'=>$value->id);
					if($this->isExists($data)) { continue; } 
					else 
					$insert  = $this->db->insert($this->table,$data);
				}
				return true;
			}
			return false;

	}

}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */