<?php
$is_subsite = getShortName();
if ($is_subsite != false) {
	$isExistSN = isShortnameExitst(getShortName());
	if ($isExistSN != false) {
		$company_logo = $isExistSN['logo'];
	}
} else {
	if (get_session_var('employeed_logged_in')) {
		$employee_corporate_Id = $USER_DETAILS['corporate_id'];
		$corporate = getCompanyDetails($employee_corporate_Id);
		$company_logo = $corporate['logo'];
		$company_name = (key_exists('company_name',$corporate) && !empty($corporate['company_name'])) ? $corporate['company_name'] : '' ;
	}
}
?>
