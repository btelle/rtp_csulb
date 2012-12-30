<?php

/**
 * contact.php
 * 
 * PHP controller for contact us form.
 * 
 * @author Brandon Telle
 */

require_once('./lib/init.inc.php');

$error = array();
$data = array();

if($_POST['submit'])
{
    require_once(FILE_ROOT.'lib/validator/Validator.class.php');
    require_once(FILE_ROOT.'lib/recaptcha/recaptchalib.php');
    $validator = new Validator;
    
    $data['name'] = $_POST['name'];
    if(strlen($_POST['name']) <= 0)
    {
        $error[] = "Name cannot be empty";
    }
    
    $data['email'] = $_POST['email'];
    if(!$validator->is_email($_POST['email']))
    {
        $error[] = "Email is not valid";
    }
    
    $data['comment'] = $_POST['comment'];
    if(strlen($_POST['comment']) <= 0)
    {
        $error[] = "Comment cannot be empty";
    }
    
    $resp = recaptcha_check_answer (RECAPTCHA_PRIVKEY,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

    if (!$resp->is_valid)
    {
        $error[] = "Verification is incorrect";
    }

    
    if(count($error) == 0)
    {
        $pdo = new RTP_PDO();
        
        $insert = $pdo ->prepare("INSERT INTO tblcontact (name, email, comment) VALUES ( :name, :email, :comment);");
        $insert ->bindParam(':name', $_POST['name']);
        $insert ->bindParam(':email', $_POST['email']);
        $insert ->bindParam(':comment', $_POST['comment']);
        $success = $insert ->execute();

        if($success)
        {
            header('Location: contact.php?mode=sent');
            die();
        }
    }
}

switch($_GET['mode'])
{
    case 'sent':
        $header_data['title'] = 'Feedback Sent';
        
        $smarty -> assign('header', $header_data);
        $smarty -> display('contact/sent.tpl');
        break;
    case '':
    default: 
        $header_data['title'] = 'Contact Us';
        
        if($data['name'] == '')
            $data['name'] = $_SESSION['user_name'];
        
        if($data['email'] == '')
            $data['email'] = $_SESSION['user_email'];
        
        $smarty -> assign('header', $header_data);
        $smarty -> assign('error', $error);
        $smarty -> assign('contact_data', $data);
        $smarty -> assign('recaptcha_pubkey', RECAPTCHA_PUBKEY);
        $smarty -> display('contact/form.tpl');
        break;
}

?>
