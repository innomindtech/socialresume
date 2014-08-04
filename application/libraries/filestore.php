<?php
// +----------------------------------------------------------------------+
// | File name : FILE STORE : ABSTRACT CLASS  	                                          |
// |(SETS TEMPLATE FOR FILE STORES) |
// | PHP version >= 5.2                                                   |
// +----------------------------------------------------------------------+
// | Author: Jinson Mathew <jinson@innomindtech.in>              		  |
// +----------------------------------------------------------------------+
 
abstract class Filestore {
	abstract function storeFile($file_path, $tmp_file);
}

?>