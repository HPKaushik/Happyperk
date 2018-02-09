<?php

class Home_model extends Front_Model {

	function __construct() {
		date_default_timezone_set('Asia/Kolkata');
	}

	function getHomePageSlider() {
		$sliders = $this->db->where('status', '1')->order_by('sort_order', 'DESC')->get(SLIDER_TABLE)->result();
		return $sliders;
	}

	function getAllAnnoucements() {
		$department_id = '';
		$query = $this->db->select('department_id')->where('user_id', $this->userId)->get(EMPLOYEE_TABLE);
		if ($query->num_rows() >= 1) {
			$department_id = $query->row()->department_id;
		}
		if (!empty($department_id)) {
			$this->db->where('department_id', $department_id);
			$this->db->or_where('department_id', '0');
		}
		$this->db->where('status', '1');
		$this->db->where('corporate_id', $this->corporateId)->order_by('created_at', 'DESC');
		$annoucements = $this->db->get(ANNOUNCEMENT_TABLE)->result();
		return $annoucements;
	}

}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */