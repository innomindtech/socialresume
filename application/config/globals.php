<?php 

// +----------------------------------------------------------------------+
// | File name : globals.php	                                          |
// | PHP version >= 5.2                                                   |
// +----------------------------------------------------------------------+
// | Author: Jinson Mathew <jinon@innomindtech.in> 				          |
// | in this file we can write the global functions and variables that    |
// | need not to be call using the object								  |
// +----------------------------------------------------------------------+
// | Copyrights Innomindtech 2014	                                      |
// | All rights reserved                                                  |
// +----------------------------------------------------------------------+



//echo "globals loaded..";
define('ADMIN_TEMPLATE', 'application/templates/admin/bootstrap/');
define('ADMIN_FOOTER_TEXT', 'Framework');


define('META_TITLE','Framework ');
define('META_DES',' Framework Description');
define('META_KEYWORDS','Framework keywords');

/*

Function to print the array
*/
function echopre($printArray) {
	echo "<pre>";
	print_r($printArray);
	echo "</pre>";
}
function echopre1($printArray) {
	echo "<pre>";
	print_r($printArray);
	echo "</pre>";
	exit();
}

/*
 * function to split a string with number
 */
function splittext($text,$length=70) {
	if(strlen($text) > $length)
		echo substr($text,0,strrpos(substr($text,0,$length),' ')).'...';
	else echo $text;
}


	/*
	function to generate random key
	*/
	
	function createRandomKey($amount){
		$keyset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		$randkey = "";
		for ($i=0; $i<$amount; $i++)
		$randkey .= substr($keyset, rand(0, strlen($keyset)-1), 1);
		return $randkey;
	}
	
	
	/*
	function to calculate the post item age. It shows how old our details with the current time
	
	*/
	function time_elapsed_string($ptime) {
		if($ptime != '')		{
			$etime = time() - $ptime;
			if ($etime < 1) {
				return '0 seconds';
			}
			$a = array( 24 * 60 * 60            =>  'DAY',
						60 * 60                 =>  'HOUR',
						60                      =>  'MINUTE',
						1                       =>  'SECOND'
						);
			
			foreach ($a as $secs => $str) {
				$d = $etime / $secs;
				if ($d >= 1) {
					$r = round($d);
					return $r . ' ' . $str . ' AGO';
				}
			}
		}
	}
 
 
	/*
	 * function to generate the alias for the product
	 */
	function getAlias($alias_text) {
		$alias = str_replace("&amp;", "and", $alias_text);
		//$alias = htmlspecialchars_decode($alias, ENT_QUOTES);
		$alias = str_replace("-", " ", $alias);
		$alias = preg_replace("/[^a-zA-Z0-9\s]/", "", $alias);
		$alias = preg_replace('/[\r\n\s]+/xms', ' ', trim($alias));
		$alias = strtolower(str_replace(" ", "-", $alias));
		return strtolower($alias);
	}
	
	
	/*
	 * function to create a place holder for all types of images.
	 */
	function showimage($imagename,$type) {
		if($imagename != '' && $type!=''){
			if(file_exists(FILE_UPLOAD_DIR.'/'.$imagename))
				echo BASE_URL.'files/'.$imagename;	
			else{
				switch($type){
					case 'thumb':
						echo BASE_URL.'files/placeholder_product_thumb.gif';
						break;	
					case 'list':
						echo BASE_URL.'files/placeholder_product_list.gif';
						break;	
					default:
						echo BASE_URL.'files/placeholder_product_thumb.gif';	
				}
			}				 				
		}
	 	else 
		 	echo BASE_URL.'files/placeholder_product_thumb.gif';
	}
	
	/*
	 * function to create a place holder for all types of images.
	 */
	function returnimagepath($imagename,$type) {
		if($imagename != '' && $type!=''){
			if(file_exists(FILE_UPLOAD_DIR.'/'.$imagename))
				return BASE_URL.'files/'.$imagename;	
			else{
				switch($type){
					case 'thumb':
						return BASE_URL.'files/placeholder_product_thumb.gif';
						break;	
					case 'list':
						return BASE_URL.'files/placeholder_product_list.gif';
						break;	
					default:
						return BASE_URL.'files/placeholder_product_thumb.gif';	
				}
			}				 				
		}
	 	else 
		 	return BASE_URL.'files/placeholder_product_thumb.gif';
	}
	
	
	
	
	/*
	 *	Function to check the users online availability
	 */
	function checkUserOnline($userid) {
		//echo $userid.' Online';
		//echo " SELECT status FROM  frei_session WHERE session_id =".$userid;
		$sql = mysql_query(" SELECT status FROM  frei_session WHERE session_id =".$userid) or die(mysql_error());
		if (mysql_num_rows($sql) > 0) {
			$status = (mysql_result($sql, 0, 'status'));
			if( $status != '' || $status != 0) {
			 echo '<a href="javascript:return(0)" onclick="FreiChat.create_chat_window_mesg(\'john\', '.$userid.');">chat now</a>';
											
			}
				 
			
		}
		return false;
	}

?>