<?php
class Error404 extends CI_Controller {

	// private $data = array();

 	function error_404()
	{
		$this->output->set_status_header('404');
		$this->template->set_template('error');
		$this->template->write('title', 'HappyPerks');
		$data = $this->template->write_view('content', '404/error', isset($data) ? $data : NULL,true);
		prx($data);
		// $this->template->render();

	}
}