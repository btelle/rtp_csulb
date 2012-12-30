<?php 

/**
 * Validator.class.php
 * 
 * Contains common validation functionality. 
 * 
 * @author Brandon Telle
 */

class Validator
{
	var $image_extensions; 
	/**
	 * Default constructor
	 */
	function __construct()
	{
            $this->image_extensions =  array('jpg', 'jpeg', 'png', 'gif');
	}
	
	/**
	 * Validates an IP address. 
	 * 
	 * @param $ip The IP address(?) to test.
	 * 
	 * @return True if $ip is an IP addess and false otherwise.
	 */
	function is_ip($ip)
	{
		return preg_match("/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}/", $ip); 
	}
	
	/**
	 * Validates an email address
	 * 
	 * @param $email The email address to validate.
	 *
	 * @return True if $email is an email and false otherwise.
	 */
	function is_email($email)
	{
		return preg_match("/[^@]+@[a-zA-Z0-9-_]+\.[a-z]{2,4}/", $email);
	}
	
	/**
	 * Validates a SQL timestamp
	 * 
	 * @param $timestamp The timestamp to validate.
	 * 
	 * @return True if $timestamp looks like a timestamp and false otherwise. Note: may need to be zero-padded.r
	 */
	function is_sql_time($timestamp)
	{
		return preg_match("/[0-9]{4}-[0-9]{1,2}-[0-9]{1,2} [0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2}/", $timestamp);
	}
	
	/**
	 * Validates an image filename
	 * 
	 * @param $image The filename to validate.
	 * 
	 * @return True if filename is an approved image-type, and false if not.
	 */
	function is_image($image)
	{
		$parts = explode('.', $image);
		return in_array($parts[count($parts)-1], $this->image_extensions);
	}
}

?>