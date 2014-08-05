<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

// +----------------------------------------------------------------------+
// | File name : cls_user.php                                      		  |
// | PHP version >= 5.2                                                   |
// | This class is for using the user functions                           |
// +----------------------------------------------------------------------+ 
// +----------------------------------------------------------------------+
// | Copyrights Innomindtech                                              |
// | All rights reserved                                                  |
// +----------------------------------------------------------------------+
// | This script may not be distributed, sold, given away for free to     |
// | third party, or used as a part of any internet services such as      |
// | webdesign etc.                                                       |
// +----------------------------------------------------------------------+

class User {

		  
	/*
	 *	This function checks the user login inputs and check the login is success or not
	 */
	public static function checkLogin($uanme,$upwd) {
		if($uanme == '' || $upwd == '') {
			return 0;
		}
		else {
			 
			$db 		= new Db();
			$condition 	= "u_email ='".$uanme."' AND u_pwd ='".$upwd."'";
            $userInfo 	= $db->selectRecord('user', '*',$condition );
	 
            return $userInfo;
		}
		
	}
		  
	/*
	 *	function to store the user email details in DB
	 */	
	public static function addEmailInfo($data) {
		$data['ls_date'] 	= date('Y-m-d H:i:s');
		$db 		= new Db();
		$postedId	= $db->addFields('sendlist',$data);
		return $postedId;
	}	
		  
	/*
	 *	function to get the user details from the reference id
	 */
	public static function getRefUserInfo($refid) {
		if(!empty($refid)) {
			$db 		= new Db();
			$condition 	= "L.ls_id ='".$refid."'";
            $userEmail 	= $db->selectRecord('sendlist AS L LEFT JOIN tbl_user AS U ON U.u_id=L.u_id', 'U.u_email,U.u_id ',$condition );
 
            return $userEmail;
		}
	}	

    
}
?>