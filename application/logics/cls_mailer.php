<?php 
// +----------------------------------------------------------------------+
// | File name : cls_mailer                                      		  |
// | PHP version >= 5.2                                                   |
// +----------------------------------------------------------------------+ 
//	jinson mathew <jinsn@innomindtech.in>
// this class is for sending email from the system using the phpmailer
// +----------------------------------------------------------------------+
// | Copyrights Innomindtech                                              |
// | All rights reserved                                                  |

class Mailer{
	
	public $siteName;
	public $siteLogo;
	public $siteDate;
	public $siteCopyRight;
	public $mailSignature;
	 
	
	/*
	 * here we are insitializing the mailer
	 */
	public function  __construct() {
		// common parameters
		$this->siteName 		= SITE_NAME;
		$this->siteLogo 		= 'Logo';
		$this->siteCopyRight 	= '  ';
		$this->siteDate 		= date("F j, Y, g:i a");
		$this->mailSignature 	= '<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#333333">Thank You,<br>
Site | '.BASE_URL.'</p>';
		include_once 'application/libraries/phpmailer/class.phpmailer.php';
		
	}
    
	
    /*
     * function to send mail
     */
    public function sendMail($mailIds,$template,$replaceparams) {
    	
    	$db                = new Db();
    	
        // get the mail template
    	$mailTemplate      = $db->selectRecord("mail_template", "*", "mail_template_name='".$template."' AND mail_template_status=1");
	 
    	$replaceparams['SIGNATURE'] 		= $this->mailSignature;
    	$replaceparams['CURRENCY'] 			= DEFAULT_CURRENCY;
    	//echopre($replaceparams);
    	if(sizeof($replaceparams) > 0) {
    		foreach($replaceparams as $key=>$parms) {
     			$mailTemplate->mail_template_body 	= str_replace('{'.$key.'}',$parms, $mailTemplate->mail_template_body);
     			$mailTemplate->mail_template_sub 	= str_replace('{'.$key.'}',$parms, $mailTemplate->mail_template_sub);
    		}
    	}
    	
    	$emailBody 				= $this->prepareMail($mailTemplate->mail_template_body);  
    	
		//TODO: make it dynamic
    	// Need to convert this to dynamic
        $adfromemail       		= 'jinson@innomindtech.com';
        $adfromemailname      	= 'Jinson';
        $adreplyemail         	= 'jinson@innomindtech.com';
        $adreplyemailname     	= 'jinson';
          
		$mailBody   			= $emailBody;
		
		if($replaceparams['SHOW_MAIL'] == 1)
			echopre($mailBody);
		
       	$mailSubject 			= str_replace('{SITE_NAME}', $this->siteName, $mailTemplate->mail_template_sub);
       
        $mail               	= new PHPMailer();
        $mail->AddReplyTo($adreplyemail,$adreplyemailname);
        $mail->SetFrom($adfromemail, $adfromemailname);
		
        foreach($mailIds as $key=>$name)
        	$mail->AddAddress($key);
        $mail->Subject              = $mailSubject;
        $mail->AltBody              = ''; // Optional, comment out and test.
    	$mail->MsgHTML($mailBody);
	 
		
    	if(SITEMODE != 'LOCAL')
                $mailsent           = $mail->Send();
        return true;
    }
    
    

    /*
     * function to add the mail template with mail body
     */
	public function prepareMail($mailBody) {
 		$db                		= new Db();
		// get the mail body
    	$mailContainer      	= $db->selectRecord("mail_template", "*", "mail_template_name='mailcontainer' AND mail_template_status=1");
		$arrTSearch     		= array("{SITE_LOGO}", "{COPYRIGHT}", "{DATE}");
        $arrTReplace    		= array($this->siteLogo ,$this->siteCopyRight, $this->siteDate  );  
		foreach($arrTSearch as $tempkey =>$tempValue) {
        	$mailContainer->mail_template_body = str_replace($tempValue, $arrTReplace[$tempkey], $mailContainer->mail_template_body);
        }
       	$emailBody 				= str_replace('{MAIL_BODY}', $mailBody, $mailContainer->mail_template_body);
		
		return $emailBody;
    }
    

}


?>