<?php

 


class customfunctions {
	public function checkSession() {
		echo "hello";
		$CI = get_instance();
       $CI->load->library('session');
		echo $userid		=	$this->session->userdata('u_id');
	}
	 
}

?>