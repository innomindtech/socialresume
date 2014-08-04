<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class index extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
 // Layout used in this controller
    public $layout_view = 'layout/admin';
	public function __construct() {
   	 	parent::__construct();
   	 	/*Additional code which you want to run automatically in every function call */
   	 	 $this->load->library('layout');          // Load layout library
	}
    public function index() {

      
       //$this->layout->title('11Site index page'); // Set page title
       $data = array();
       $this->layout->view('login', $data);     // Render view and layout
     }
    
    
    
    
    /*
     * function to load the cms pages
     */
    public function cms(){
    
    	$cmsList = Cms::getAllPages();
    	echopre($cmsList);
    	
    	Pagination::showlinks();
    	$data = array('cmslist' => $cmsList);
       	$this->layout->view('cmslist', $data);
    }
    
    
	/*
	 * function for the admin dashboard
	 */
	public function dashboard() {

      
       //$this->layout->title('11Site index page'); // Set page title
       $data = array();
       $this->layout->view('dashboard', $data);     // Render view and layout

    }
    
    public function filegator() {

      
       //$this->layout->title('11Site index page'); // Set page title
       $data = array();
       $this->layout->view('filegator', $data);     // Render view and layout

    }
    
    /*
     * function to load the cms editor
     */
    public function editcms($cmsid) {
    		//echopre($_POST);
    	
     	if(isset($_POST['btnUpdate'])){
    	 	$imgHeight = '100';
    	 	$imgWidth = '100';
    	 	 
    	 	$fileUpres 	= Fileuploader::uploadfile($_FILES['cmsimage']);
    	 	echopre($fileUpres);
			$thumbRes =  Fileuploader::createThumbnail($fileUpres->file_id,'companylogothumb',false);
    	 	echopre($thumbRes);
    	 	
    	 	
    	 	
     		//echopre($_FILES);
    		//echopre1($_POST);
    	 }
    	
    	
    	
    	
    	
    	 /*
    	if(isset($this->input->post('btnUpdate'))) {
    		$cntId = $this->input->post('txtcntid');
    		$title = $this->input->post('txttitle');
    		$content = $this->input->post('txtcontent');
    		
    		if($cntId != '' && $title != ''){
    			 $cntInfo  = array(
                    'cnt_title'      => $title,
                    'cnt_content'    => $content
                   );
                   
                   Cms::updateContent($cntId,$cntInfo);
    		}
    		
    	}
    	*/
    	
    	
    	if($cmsid != ''){
    		$cmsDetails = Cms::getCmsInfo($cmsid);
    		 
    	}
    	//echopre($_POST);
    	 $message        = "Account added successfully";
    	 	 $msg_class          = "error";
            Message::setPageMessage($message, $msg_class);
    	 $message = Message::getMessage();	
    	//$cmsList = Cms::getAllPages();
    	$data = array('cmsinfo' => $cmsDetails,'message' => $message);
       	$this->layout->view('editcms', $data);
    }
    
    
    
    /*
     * function to use the mailer
     */
    public function mailer() {
    	echo "mailer";
    	$emailAddress['jinson@innomindtech.in'] 	= 'jinson';
		$replaceParameters['NAME'] 					= 'Jinson';
       
      	$replaceParameters['SHOW_MAIL'] 			= 1;
	    // send login details to user
      	$objMailer 		= new Mailer();
     	$objMailer->sendMail($emailAddress, 'registersuccess-user', $replaceParameters); 
	    echopre1($emailAddress);
    	exit();
    }
	 
}

 
