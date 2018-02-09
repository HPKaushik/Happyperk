<?php

$limit = (get_session_var('employeed_logged_in')) ? 5 : 6;
$vouchers = $this->vouchers_model->get_vouchers($this->location_id, $limit);
if($this->aauth->is_loggedin()) {
	
	$select = AWARDS_TABLE.".id,".BADGES_TABLE.".title,".AWARDS_TABLE.".employee";
	$award = $this->awards_model->getRow($select, array(AWARDS_TABLE.'.corporate_id' => $this->USER_DETAILS['corporate_id'], AWARDS_TABLE.'.status' => '1'), array(BADGES_TABLE=> AWARDS_TABLE.".badge_id = ".BADGES_TABLE.".id"), AWARDS_TABLE.'.id', 'DESC', 1);
}
//echo $this->db->last_query();
//exit;
$slides = $this->home_model->getHomePageSlider();
?>