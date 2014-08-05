<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$config['index_page'] = 'index.php';
$config['uri_protocol']	= 'AUTO';
$config['url_suffix'] = '';
$config['charset'] = 'UTF-8';
$config['enable_hooks'] = TRUE;
$config['subclass_prefix'] = 'MY_';
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';
$config['allow_get_array']		= TRUE;
$config['enable_query_strings'] = FALSE;
$config['controller_trigger']	= 'c';
$config['function_trigger']		= 'm';
$config['directory_trigger']	= 'd'; // experimental not currently in use
$config['log_threshold'] = 0;
$config['log_path'] = '';
$config['log_date_format'] = 'Y-m-d H:i:s';
$config['cache_path'] = '';
$config['encryption_key'] = 'alnum';
$config['sess_cookie_name']		= 'ci_session';
$config['sess_expiration']		= 7200;
$config['sess_expire_on_close']	= FALSE;
$config['sess_encrypt_cookie']	= FALSE;
$config['sess_use_database']	= FALSE;
$config['sess_table_name']		= 'ci_sessions';
$config['sess_match_ip']		= FALSE;
$config['sess_match_useragent']	= TRUE;
$config['sess_time_to_update']	= 300;
$config['cookie_prefix']	= "";
$config['cookie_domain']	= "";
$config['cookie_path']		= "/";
$config['cookie_secure']	= FALSE;
$config['global_xss_filtering'] = FALSE;
$config['csrf_protection'] = FALSE;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;
$config['compress_output'] = FALSE;
$config['time_reference'] = 'local';
$config['rewrite_short_tags'] = FALSE;
$config['proxy_ips'] = '';
$config['language']	= '';
 	    
		
		/*
		 * custom settings for local and web servers
		 */
	    if($_SERVER['HTTP_HOST'] == 'localhost')
	    	define('SITEMODE', 'LOCAL');
		else  
			define('SITEMODE', 'DEMO');
			
		if (SITEMODE == 'LOCAL') {
		
	 	  	$config['base_url']	= 'http://localhost/projects/socialresume/';    	
			define('MYSQL_HOST', 'localhost');
			define('MYSQL_USERNAME', 'root');
			define('MYSQL_PASSWORD', '');
			define('MYSQL_DB', 'socialresume');
			define('MYSQL_TABLE_PREFIX', 'tbl_');
			define('FILE_UPLOAD_DIR',  "D:/wamp/www/projects/socialresume/files");
			define('SITEPATH',  "D:/wamp/www/projects/socialresume/");
	 	}
	 	else if (SITEMODE == 'DEMO') {
	 	  	$config['base_url']	= '';
    		define('MYSQL_HOST', '');
 			define('MYSQL_USERNAME', '');
 			define('MYSQL_PASSWORD', '');
 			define('MYSQL_DB', '');
 			define('MYSQL_TABLE_PREFIX', '');
			define('FILE_UPLOAD_DIR',  "");	
			define('SITEPATH',  "");
			
	 	}
	 
/********** New configurations for DB and other settings *******/

 define('MYSQL_FILE_TABLE', 'tbl_files');
 
 
define('BASE_URL', $config['base_url']);
define('SITE_NAME', 'Sonnet');
define ("MAX_UPLOAD_SIZE","1000");
define('PAGE_LIST_COUNT', 10);
define('DEFAULT_CURRENCY', '$');
define('CURRENCY_CODE', 'USD');
define ("MAX_PRICE","5000");
define ("BUMBPERIOD","24");
define ("UPVOTELIMIT","20");
 
   

/************************************/
//  The following code are for custom purpose
//	It will load the db class and logics calsses.
//	we can use the class any where
//  Added by : jinson mathew <jinson@innomindtech.in>
include_once('globals.php');
include 'application/models/db.php';
 
function my_autoloader($class){
	 
	//Split class name from camel case
	$classArray 	= preg_split('/(?<=\\w)(?=[A-Z])/', $class);
	$isValidRequest = true;
	if($isValidRequest == !empty($classArray))	{
		$classPath  		= implode($classArray, '/');
		$classPath  		= strtolower($classPath)  . '.php' ;
 		$logicsClassPath  	= 'application/logics/cls_'.strtolower($classPath);	 
		if(file_exists($logicsClassPath))
			include_once($logicsClassPath);
	}
}

 


 
spl_autoload_register('my_autoloader');

// custom purpose code ends
/****************************************/

/* End of file config.php */
/* Location: ./application/config/config.php */