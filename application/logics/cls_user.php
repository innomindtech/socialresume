<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

// +----------------------------------------------------------------------+
// | File name : cls_user.php                                      		  |
// | PHP version >= 5.2                                                   |
// | Created by = Jinson on 08/07/14                                      |
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


/*
 *	This class is used for the user mangament function
 *
 */
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
	public static function addUser($data) {
		 
		$db 		= new Db();
		$uId	= $db->addFields('user',$data);
		return $uId;
	}	
		  
	
	
		  
	/*
	 *	function to store the user email details in DB
	 */	
	public static function addEmailInfo($data) {
		$data['ls_date'] 	= date('Y-m-d H:i:s');
		$db 				= new Db();
		$postedId			= $db->addFields('sendlist',$data);
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

	/*
	 *	function to add user comment into database
	 */
	public static function addUserComment($data) {
		$data['u_postedon'] 	= date('Y-m-d H:i:s');
		$db 					= new Db();
		$commentId				= $db->addFields('entry',$data);
		return $commentId;
	}
	
	
	/*
	 *	function to get the entry list for the user
	 */
	public static function getEntryList($userid) {
		if(!empty($userid)) {
			$db 		= new Db();
			$condition 	= "E.u_id ='".$userid."'";
            $eventList 	= $db->selectResult('entry AS E LEFT JOIN tbl_user AS U ON U.u_id=E.u_poster_id ', 'E.*,U.u_email ',$condition );
            return $eventList;
		}
	}
    
	/*
	 *	function to get the details of a particular entry
	 */
	public static function getEntryInfo($entryId) {
		if(!empty($entryId)) {
			$db 		= new Db();
			$condition 	= "E.e_id ='".$entryId."'";
            $eventInfo 	= $db->selectRecord('entry AS E LEFT JOIN tbl_user AS U ON U.u_id=E.u_poster_id ', 'E.*,U.u_email ',$condition );
            return $eventInfo;
		}
	}
	
	
	/*
	 *	function to delete an entry of a user
	 */
	public static function deleteEntry($eid, $userid) {
		if($eid != '' && $userid != '') {
			// check the entry exist with user
			$db 		= new Db();
			$condition 	= "E.e_id ='".$eid."' AND u_id =".$userid;
            $entryInfo 	= $db->selectRecord('entry AS E', 'E.e_id ',$condition );
			
			if(sizeof($entryInfo) > 0 ){	// yes, the entry exist. we will delete the entry
				$condition 	= "e_id ='".$eid."'";
				$delStatus 	= $db->deleteRecord('entry',$condition );
				return true;
			}
		}
	}
	
	
	/*
	 *	function to check the email exist in our database
	 */
	public static function checkEmail($email) {
		if($email != '') {
			$db 		= new Db();
			$condition 	= "u_email ='".$email."'";
            $uid 		= $db->selectRow('user', 'u_id ',$condition );
			return $uid;
		}
	}
	
	
}
?>