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


define('META_TITLE','Social Resume ');
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
 

?>