<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

 
	
 // Layout used in this controller
   
    
	public function __construct() {
   	 	parent::__construct();
   	 	/*Additional code which you want to run automatically in every function call */
   	 	$this->load->library('layout');          // Load layout library
		$this->load->helper('url');
		$this->load->helper('usersession');
		//$this->load->helper('custom');
		
	 
		 
		 
	}
 
 
  
 
 
 
	/* site landing page
	*/
    public function index() {
		 
		$data['bannerlist'] = '';
		
		$this->layout->view('homepage', $data);     // Render view and layout
		 
		  
    }
 
	
	
	
	/*
	 *	Function to show the 404 page
	 */
	public function pagenotfound() {
		$this->layout->view('pagenotfound');
		
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

