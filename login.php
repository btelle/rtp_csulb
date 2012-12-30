<?php
/**
 * login.php
 *
 * Log in controller.
 *
 * @author Brandon Telle
 */

require_once('lib/init.inc.php');

$error = array();
$data = array();

if($_POST['submit'])
{
    // validate log in
    $data['email'] = $_POST['email'];
    if(strlen($data['email']) <= 0)
    {
        $error[] = "Email is required";
    }

    $data['password'] = $_POST['password'];
    if(strlen($data['password']) <= 0)
    {
        $error[] = "Password is required";
    }

    $pdo = new RTP_PDO;

    if(!count($error))
    {
        try
        {
            $ret = $pdo->query("SELECT uid, pwd, name, role, uname FROM tblusers WHERE uname=".$pdo->quote($data['email'])." LIMIT 1;"); 

            if($ret !== FALSE)
            {
                $user = $ret ->fetch(PDO::FETCH_ASSOC);

                // password check
                if(md5($data['password']) == $user['pwd'])
                {   
                    // logged in!
                    $_SESSION['user_id'] = $user['uid'];
                    $_SESSION['user_name'] = $user['name'];
                    $_SESSION['user_role'] = $user['role'];
                    $_SESSION['user_email'] = $user['uname'];
                    header('Location: index.php');
                }
                else
                {
                    $error[] = "Incorrect password";
                }
            }
            else
            {
                $error[] = "Email not found";
            }
        }
        catch (PDOException $e)
        {
            $log->log($e->__toString(), LOGGING_FINAL);
        }
    }

    if($_SESSION['user_id'])
    {
        header('Location: index.php');
        die();
    }
}

// display form
$header_data['title'] = 'Log in';

$smarty -> assign('header', $header_data);
$smarty -> assign('error', $error); 
$smarty -> assign('login_data', $data);
$smarty -> display('account/login.tpl');

?>
