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
				else {	
					if(isset($_POST['chkregister'])) {	// we will treat the user as a new user
						// check the email exist
						$uid = User::checkEmail($userEmail);
						if(empty($uid)) {
							$user['u_email']	= $userEmail;
							$user['u_pwd']		= md5($userPwd);
							$user['u_status']		= 1;
							$uid  = User::addUser($user);
							
							 
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
		$message  = '';
		 
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
				
				$writeentry = isset($_POST['writeentry'])?$_POST['writeentry']:'';
				// store this email address in database
				$userInfo['u_id']			=	$userid	; 
				$userInfo['ls_msg']			= ($writeentry != '')?$writeentry:"Please write some thing about me";
				$userInfo['ls_msgtoemail']	= $_POST['uemail'];
				$postInfo  = User::addEmailInfo($userInfo);
				 
				// send the email to the email address
				if(!empty($postInfo)) {
					//TODO: convert this to dynamic
					$emailAddress[$userInfo['ls_msgtoemail']] 	= 'User';
					$replaceParameters['MESSAGE'] 				= 'Hello Man <br> Please write some thing about me';
					$replaceParameters['LINK'] 					= '<a href="'.BASE_URL.'writeentry/'.$postInfo.'">Click here</a>';
				   
					$replaceParameters['SHOW_MAIL'] 			= 1;
					 
					// send invitation details to user
					$objMailer 		= new Mailer();
					$objMailer->sendMail($emailAddress, 'initiationmail', $replaceParameters); 
					$message		= "Successfully sent the request";
				}
			 
			}
			
		}		
		
		// entry deletion checking
		if(isset($_GET['action']) && $_GET['action'] == 'delete'){
			$eid = $_GET['eid'];
			if($eid != '') {
				if(User::deleteEntry($eid,$userid))	// call the delete function
					$message = 'Successfully deleted the entry';
			}
		}
		 
		// get the entries for the user
		$entryList		= User::getEntryList($userid);
		$data['entryList'] = $entryList; 
		 

				
		$data['message'] = $message;
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
	
		$message = '';
		if(isset($_POST['btnsubmit'])) {	// if the user submitted the form
			 
			$result  =false;
			$entry 			=  $_POST['writeentry'];
			$requestuserid 	=  $_POST['requestuserid'];
			// validation process starts
			if($entry != '' && $requestuserid != '')
				$result  =true;
				
			if($result == true) {		// if validation success we can continue
				$data['u_id'] = $requestuserid;
				$data['u_poster_id'] = $userid;
				$data['u_message'] = $entry ;
				User::addUserComment($data);
				$message = "Successfully added comment<br> Thank you.";
			} else 
				$message = "Error.. Please enter all the details.";
		}
	
	
	
	
		
		
		// find the requested user information from ref id
		$requesterInfo = User::getRefUserInfo($refid);
		if(sizeof($requesterInfo ) > 0) {
			$data['requesterEmail'] = $requesterInfo->u_email;
			$data['requestuserid'] = $requesterInfo->u_id;
		}
		
		
		
		$data['message'] = $message ;
		
		$this->layout->view('writeentry', $data);
	}
	
	
	
	/*
	 *	function to view the message details
	 */
	public function entry($entryid, $action='view') {
	
		
	
		//TODO: convert the login into a single function
		// check the login and redirect to the login page
		$userid		=	$this->session->userdata('u_id');
		if(empty($userid))
			redirect(BASE_URL.'login?redirect='.BASE_URL.'entry/'.$entryid.'/'.$action);
		$message = '';
		
		
		// send the entry to the particular email
		if(isset($_POST['btnsubmit'])) {	
			$continue = false; // set for the vlaidation
			$emailId = $_POST['uemail'];
			$entryid = $_POST['entryid'];
			
			if($emailId != '' && $entryid  != '')
				$continue = true;
				
			if($continue) {
				$emailAddress[$emailId] 	= 'User';
				$replaceParameters['MESSAGE'] 				= 'Hello Man <br> Please check entry abount me';
				$replaceParameters['LINK'] 					= '<a href="'.BASE_URL.'entry/'.$entryid.'/view">Click here</a>';
				   
				$replaceParameters['SHOW_MAIL'] 			= 1;
					 
				// send invitation details to user
				$objMailer 		= new Mailer();
				$objMailer->sendMail($emailAddress, 'entrymail', $replaceParameters); 
				$message		=outputmessage('Successfully sent the message','success');   
			}
		
		}
		$continue = false;
		
		// check the inputs are valid	
		 
		if($entryid != '' && $action != '' )
			$continue = true;
		if($continue) {
			 $eventInfo = User::getEntryInfo($entryid);
 
			 $data['eventInfo'] = $eventInfo;
		} else 	
			$message = 'Invalid inputs';
	
		 
		$data['message'] 	= $message;
		$data['action'] 	= $action;
		$data['loguserid'] 	= $userid	;
		
		$this->layout->view('entry', $data);
	}
	
	
	/*
	 *	function to logout the user
	 */
	public function logout(){
	 
		// destorying the user session 
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

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

