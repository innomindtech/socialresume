<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter URL Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/url_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Site URL
 *
 * Create a local URL based on your basepath. Segments can be passed via the
 * first parameter either as a string or an array.
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('validateprice'))
{
	function validateprice($uri = '')
	{
	echo "hai";
	exit();
		 
	}
}

// ------------------------------------------------------------------------

/**
 * Check session
 * 
 *  This function redirect the user to login page if the user not loggined in
 * @access	public
 * @param string
 * @return	string
 */
if ( ! function_exists('checksession'))
{
	function checksession($uri = '')
	{
		$CI =& get_instance();
		$userid = $CI->session->userdata('user_id');
		if($userid == '')
			redirect(BASE_URL);
	}
}

// ------------------------------------------------------------------------
  


/* End of file url_helper.php */
/* Location: ./application/helpers/usersession_helper.php */