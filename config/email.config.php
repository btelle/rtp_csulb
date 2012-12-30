<?php
/**
 * email.config.php
 * 
 * Email class - extension of PHPMailer.
 * 
 * @author Brandon Telle
 */

require_once(FILE_ROOT.'lib/phpmailer/class.phpmailer.php');

class Email extends phpmailer
{
    var $Host = "ssl://smtp.gmail.com";
    var $Mailer = "smtp";
    var $Port = 465;
    var $SMTPAuth = true; 
    var $Username = EMAIL_ADDR;
    var $Password = EMAIL_PASS;
    var $From = EMAIL_ADDR;
    var $FromName = EMAIL_NAME;
    
    function __construct() {
        $this->IsSMTP(true);
    }
}
?>
