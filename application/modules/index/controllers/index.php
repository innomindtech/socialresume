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
	 * Get the user details and check the login details
	 */
    public function index() {
	
		// check the login and redirect the user to dashboard if the user is logged in
		$userid		=	$this->session->userdata('u_id');
		if(!empty($userid))
			redirect(BASE_URL.'dashboard');
	
	
	
		$message = '';
		// check the data is submitted
		if(isset($_POST['btnsubmit'])) {
			 
			$userEmail 	= $_POST['username'];
			$userPwd 	= $_POST['password'];
			$status 	= 0;	// this is to check the validations are success
			
			// validate the inputs
			$this->load->library('form_validation');
            $this->form_validation->set_rules(array(
                                                    array('field'=>'username','label'=>'User Name','rules'=>'required'),
                                                    array('field'=>'password','label'=>'Password','rules'=>'max_length[20]|required')
            ));
            if ($this->form_validation->run()===FALSE)   { 
				 
				$message = validation_errors();
				$status = 1;
			 
			} 
			
			
			
			// the validations are success and we can proceed to check login
			if($status == 0){	
				$userInfo = User::checkLogin($userEmail,md5($userPwd));
				if(sizeof($userInfo) > 0 ) { // login successfull
 
					// set the user session
					$userSession = array(  'u_id'  		=> $userInfo->u_id,
										   'email'    	=> $userInfo->u_email,
										   'logged_in'	=> TRUE
									   );						
					$this->session->set_userdata($userSession);
					
					
					// redirect the user to the redirect page
					$redirectUrl = ($_POST['redirect']=='')?BASE_URL.'dashboard':$_POST['redirect'];
					redirect($redirectUrl);
					
					
				}
				else {		// invalid login
					$message = "Invalid login credentials";
				}
			}
		
		}
		// add the redirect url after the successful login
		$data['redirect'] = '';
		if(!empty($_GET['redirect']))
			$data['redirect'] =$_GET['redirect'];
		$data['message'] =$message;
		
		$this->layout->view('homepage', $data);     // Render view and layout
		 
		  
    }
 
	/*
	 *	function to show the dashboard of the logined user
	 */
	public function dashboard() {
	 
		// check the login and redirect to login page
		$userid		=	$this->session->userdata('u_id');
		if(empty($userid))
			redirect(BASE_URL);
		$status = 0;	
		
		// the user submitted the email for sending the mail
		if(isset($_POST['btnsubmit']))		{
		
			// validate the inputs
			$this->load->library('form_validation');
            $this->form_validation->set_rules(array(
                                                    array('field'=>'uemail','label'=>'User Name','rules'=>'required'),
            ));
            if ($this->form_validation->run()===FALSE)   { 
				$message = validation_errors();
				$status = 1;
			} 
			if($status == 0) {		// the input is valid
				
				// store this email address in database
				$userInfo['u_id']		=	$userid	;
				$userInfo['ls_msg']		= "Please write some thing about me";
				$userInfo['ls_msgtoemail']	= $_POST['uemail'];
				$postInfo  = User::addEmailInfo($userInfo);
				
				// send the email to the email address
				if(!empty($postInfo)) {
					echo "sending email";
					$emailAddress['jinson@innomindtech.in'] 	= 'jinson';
					$replaceParameters['NAME'] 					= 'Jinson';
				   
					$replaceParameters['SHOW_MAIL'] 			= 1;
					//TODO: write the email sending code
					// send invitation details to user
					$objMailer 		= new Mailer();
					$objMailer->sendMail($emailAddress, 'initiationmail', $replaceParameters); 
					echopre1($emailAddress);
				}
			 
			}
			
		}		
		 

				
		$data['message'] = '';
		$this->layout->view('dashboard', $data);
	}
	
	
	
	/*
	 *	Function to write the entry for another user
	 */
	public function writeentry($refid=''){
	
	echopre($_POST);
	
		if(isset($_POST['btnsubmit']))
	
	
	
	
		if(empty($refid))
			$data['message'] = 'Invalid input';
			
		// check the login and redirect to the login page
		$userid		=	$this->session->userdata('u_id');
		if(empty($userid))
			redirect(BASE_URL.'login?redirect='.BASE_URL.'writeentry/'.$refid);	
		
		// find the requested user information from ref id
		$requesterInfo = User::getRefUserInfo($refid);
		if(sizeof($requesterInfo ) > 0) {
			$data['requesterEmail'] = $requesterInfo->u_email;
			$data['requestuserid'] = $requesterInfo->u_id;
		}
		$data['message'] = '';
		
		$this->layout->view('writeentry', $data);
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

