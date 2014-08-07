<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

// +----------------------------------------------------------------------+
// | File name : index.php                                      		  |
// | PHP version >= 5.2                                                   |
// | Created by = Jinson on 08/07/14                                      |
// | This is the controller of the user functions                         |
// +----------------------------------------------------------------------+ 
// +----------------------------------------------------------------------+
// | Copyrights Innomindtech                                              |
// | All rights reserved                                                  |
// +----------------------------------------------------------------------+
// | This script may not be distributed, sold, given away for free to     |
// | third party, or used as a part of any internet services such as      |
// | webdesign etc.                                                       |
// +----------------------------------------------------------------------+


/*
 *	This class is the controller for user management
 *
 */
class Index extends CI_Controller {

  
   
    /*
	 *	constructor function of the controller
	 */
	public function __construct() {
   	 	parent::__construct();
   	 	$this->load->library('layout');          // Load layout library
		$this->load->helper('url');
		$this->load->helper('usersession');
	}
 
	/*
	 *	check the user session and redirect to the login page
	 */
	public function checkSession()     {
		$userid		=	$this->session->userdata('u_id');
		if(empty($userid))
			redirect(BASE_URL);
    }
 
 
 
	/* site landing page
	 * Get the user details and check the login details
	 */
    public function index() {
	
		// check the login and redirect the user to dashboard if the user is logged in
		$userid			=	$this->session->userdata('u_id');
	 
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
				$message 	= validation_errors();
				$status 	= 1;
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
				else {	
					if(isset($_POST['chkregister'])) {	// we will treat the user as a new user
						// check the email exist in our database
						$uid = User::checkEmail($userEmail);
						if(empty($uid)) {
						
							// insert the user details to database
							$user['u_email']	= $userEmail;
							$user['u_pwd']		= md5($userPwd);
							$user['u_status']	= 1;
							$uid  				= User::addUser($user);
							
							// set the user session
							$userSession = array(  'u_id'  		=> $uid ,
												   'email'    	=> $userEmail,
												   'logged_in'	=> TRUE
											   );						
							$this->session->set_userdata($userSession);
					
							// redirect the user to the redirect page
							$redirectUrl = ($_POST['redirect']=='')?BASE_URL.'dashboard':$_POST['redirect'];
							redirect($redirectUrl);
						}
						else 
							$message = outputmessage('This email id already exist.','danger'); 
					}
					else// invalid login
						$message = outputmessage('Invalid login credentials.','danger'); 
				}
			}
		}
		
		// add the redirect url after the successful login
		$data['redirect'] 		= '';
		if(!empty($_GET['redirect']))	// if the url is not null, the user will redirect to that url
			$data['redirect'] 	= $_GET['redirect'];
		$data['message'] 		= $message;
		
		$this->layout->view('homepage', $data);     // Render view and layout
    }
 
	/*
	 *	function to show the dashboard of the logined user
	 */
	public function dashboard() {
	 
		// check the login and redirect to login page
		$this->checkSession();
		$userid		=	$this->session->userdata('u_id');
		
		$status 	= 0;	
		$message  	= '';
		 
		/************* invitation sending code starts   ***********************/
		// the user submitted the email for sending the mail
		if(isset($_POST['btnsubmit']))		{
			// validate the inputs
			$this->load->library('form_validation');
            $this->form_validation->set_rules(array(
                                                    array('field'=>'uemail','label'=>'User Name','rules'=>'required'),
            ));
            if ($this->form_validation->run() === FALSE)   { 
				$message 	= validation_errors();
				$status 	= 1;
			} 
			if($status == 0) {		// the input is valid
				
				$writeentry 				= isset($_POST['writeentry'])?$_POST['writeentry']:'';
				// store this email address in database
				$userInfo['u_id']			= $userid	; 
				$userInfo['ls_msg']			= ($writeentry != '')?$writeentry:"Please write some thing about me";
				$userInfo['ls_msgtoemail']	= $_POST['uemail'];
				$postInfo  					= User::addEmailInfo($userInfo);	// insert the details to db
				 
				// send the email to the email address
				if(!empty($postInfo)) {
					$emailAddress[$userInfo['ls_msgtoemail']] 	= 'User';
					$replaceParameters['MESSAGE'] 				= 'Hello Man <br> Please write some thing about me';
					$replaceParameters['LINK'] 					= '<a href="'.BASE_URL.'writeentry/'.$postInfo.'">Click here</a>';
					$replaceParameters['SHOW_MAIL'] 			= 1;
					 
					// send invitation details to user
					$objMailer 		= new Mailer();
					$objMailer->sendMail($emailAddress, 'initiationmail', $replaceParameters); 
					$message 		= outputmessage('Successfully sent the request','success'); 
				}
			}
		}		
		/************ invitation sending code ends **********************/
		
		// entry deletion checking
		if(isset($_GET['action']) && $_GET['action'] == 'delete'){
			$eid = $_GET['eid'];
			if($eid != '') {
				if(User::deleteEntry($eid,$userid))	// call the delete function
					$message 	= outputmessage('Successfully deleted the entry','success'); 
			}
		}
		 
		// get the entries for the user
		$entryList			= User::getEntryList($userid);
		$data['entryList'] 	= $entryList; 
				
		$data['message'] 	= $message;
		$this->layout->view('dashboard', $data);
	}
	
	
	
	/*
	 *	Function to write the entry for another user
	 */
	public function writeentry($refid=''){
	
		if(empty($refid))
			$data['message'] = 'Invalid input';
			
		// check the login and redirect to the login page
		$userid		=	$this->session->userdata('u_id');
		if(empty($userid))
			redirect(BASE_URL.'login?redirect='.BASE_URL.'writeentry/'.$refid);	
	
		$message 	= '';
		
		/********* entry adding section starts       ********************/
		if(isset($_POST['btnsubmit'])) {	// if the user submitted the form
			$result  		=  false;
			$entry 			=  $_POST['writeentry'];
			$requestuserid 	=  $_POST['requestuserid'];
			// validation process starts
			if($entry != '' && $requestuserid != '')
				$result  = true;
				
			if($result == true) {		// if validation success we can continue
				$data['u_id'] 			= $requestuserid;
				$data['u_poster_id'] 	= $userid;
				$data['u_message'] 		= $entry ;
				User::addUserComment($data);	// insert the user comment to database
				$message 	= outputmessage('Successfully added comment<br> Thank you','success'); 
			} else 
				$message 	= outputmessage('Error.. Please enter all the details','danger'); 
		}
		/*********** Entry adding section ends *****************/
		
		// find the requested user information from reference id
		$requesterInfo = User::getRefUserInfo($refid);
		if(sizeof($requesterInfo ) > 0) {
			$data['requesterEmail'] = $requesterInfo->u_email;
			$data['requestuserid'] 	= $requesterInfo->u_id;
		}

		$data['message'] = $message ;
		$this->layout->view('writeentry', $data);
	}
	
	
	
	/*
	 *	function to view the message details
	 */
	public function entry($entryid, $action='view') {
		 
		// check the login and redirect to the login page
		$userid		=	$this->session->userdata('u_id');
		if(empty($userid))
			redirect(BASE_URL.'login?redirect='.BASE_URL.'entry/'.$entryid.'/'.$action);
		$message = '';
		
		/********  Send the entry to another user via email code starts   ********/
		// send the entry to the particular email
		if(isset($_POST['btnsubmit'])) {	
			$continue 	= false; 	// set for the vlaidation
			$emailId 	= $_POST['uemail'];
			$entryid 	= $_POST['entryid'];
			
			if($emailId != '' && $entryid  != '')
				$continue = true;
				
			if($continue) {
				$emailAddress[$emailId] 			= 'User';
				$replaceParameters['MESSAGE'] 		= 'Hello Man <br> Please check entry abount me';
				$replaceParameters['LINK'] 			= '<a href="'.BASE_URL.'entry/'.$entryid.'/view">Click here</a>';
				$replaceParameters['SHOW_MAIL'] 	= 1;
					 
				// send invitation details to user
				$objMailer 							= new Mailer();
				$objMailer->sendMail($emailAddress, 'entrymail', $replaceParameters); 
				$message							= outputmessage('Successfully sent the message','success');   
			}
		}
		/************ Entry sending code ends   *************/
		
		$continue = false;
		// check the inputs are valid	
		if($entryid != '' && $action != '' )
			$continue 			= true;
		if($continue) {
			 $eventInfo 		= User::getEntryInfo($entryid);
			 $data['eventInfo'] = $eventInfo;
		} else 	
			$message 			= 'Invalid inputs';

		$data['message'] 		= $message;
		$data['action'] 		= $action;
		$data['loguserid'] 		= $userid;
		
		$this->layout->view('entry', $data);
	}
	
	
	/*
	 *	function to logout the user
	 */
	public function logout(){
		// destroying the user session 
		$this->session->sess_destroy();
		redirect(BASE_URL);
	}
	
	/*
	 *	Function to show the 404 page
	 */
	public function pagenotfound() {
		$this->layout->view('pagenotfound');
	}

	
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */

