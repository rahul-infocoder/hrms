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
 * CodeIgniter Email Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/email_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Validate email address
 *
 * @access	public
 * @return	bool
 */
if ( ! function_exists('valid_email'))
{
	function valid_email($address)
	{
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $address)) ? FALSE : TRUE;
	}
}

// ------------------------------------------------------------------------

/**
 * Send an email
 *
 * @access	public
 * @return	bool
 */
if ( ! function_exists('send_email'))
{
	function send_email($recipient, $subject = 'Test email', $message = 'Hello World')
	{
		
	
		 
		 $subject = $subject;
		$message =  $message;
		$to = $recipient;
		$type = 'html'; // or HTML
		$charset = 'utf-8';
		
		$mail     = 'no-reply@'.str_replace('www.', '', $_SERVER['SERVER_NAME']);
		$uniqid   = md5(uniqid(time()));
		$headers  = 'From: '.$mail."\n";
		$headers .= 'Reply-to: '.$mail."\n";
		$headers .= 'Return-Path: '.$mail."\n";
		$headers .= 'Message-ID: <'.$uniqid.'@'.$_SERVER['SERVER_NAME'].">\n";
		$headers .= 'MIME-Version: 1.0'."\n";
		$headers .= 'Date: '.gmdate('D, d M Y H:i:s', time())."\n";
		$headers .= 'X-Priority: 3'."\n";
		$headers .= 'X-MSMail-Priority: Normal'."\n";
		$headers .= 'Content-Type: multipart/mixed;boundary="----------'.$uniqid.'"'."\n\n";
		$headers .= '------------'.$uniqid."\n";
		$headers .= 'Content-type: text/'.$type.';charset='.$charset.''."\n";
		$headers .= 'Content-transfer-encoding: 7bit';
	
	 return mail($to, $subject, $message, $headers);
	 
		
	}
}


/* End of file email_helper.php */
/* Location: ./system/helpers/email_helper.php */