<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

// +----------------------------------------------------------------------+
// | File name : cls_util.php                                      		  |
// | PHP version >= 5.2                                                   |
// +----------------------------------------------------------------------+ 
// +----------------------------------------------------------------------+
// | Copyrights Innomindtech                                              |
// | All rights reserved                                                  |
// +----------------------------------------------------------------------+
// | This script may not be distributed, sold, given away for free to     |
// | third party, or used as a part of any internet services such as      |
// | webdesign etc.                                                       |
// +----------------------------------------------------------------------+

class Util {

		function generate_password( $length = 8 ) {
		
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
			$password = substr( str_shuffle( $chars ), 0, $length );
			return $password;
		
		}
		function randomCode($length=10) { 
			/* Only select from letters and numbers that are readable - no 0 or O etc..*/
			$characters = "23456789ABCDEFHJKLMNPRTVWXYZ";
			$string ="";		 
			for ($p = 0; $p < $length; $p++)
			{
			$string.= $characters[mt_rand(0, strlen($characters)-1)];
			}			 
			return $string;			
		}
		/* function to get the country name from an ipo address */
		function getIP() {
				
				if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
					$ip = $_SERVER['HTTP_CLIENT_IP'];
				} elseif (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
				{
					$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				} else {
					$ip = $_SERVER['REMOTE_ADDR'];
				}
				return $ip;
		}
 

    /*
     * function to get the settings values
     */

    public static function getSettings($alias) {
        if ($alias) {
            $db 		= new Db();
            $pageData 	= $db->selectRecord('settings', 'settings_value', " settings_name='" . $alias . "'");
            return $pageData->settings_value;
        }
    } 
	
	/*
	 * function to return image id
	 */
	public static function getImageId($imageName) {
		if($imageName != '') {
			$db 		= new Db();
            $imgId 	= $db->selectRow('files', 'file_id', " file_path='" . $imageName . "'");
            return $imgId;
		}
	}
}
?>