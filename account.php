<?php

/**
 * account.php
 *
 * PHP controller for the form to create and modify an account.
 *
 * @author Brandon, Chris
 * Modified Chethan G    data and error array variables are declared in functions.php.
 *                       Added functions.php and data variable(which holds
 *                        header and footer menu data)
 */
/*
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
 * more details.
 */


require_once('./lib/init.inc.php');             // initialize mySQL connection
$pdo = new RTP_PDO();                           // create the persistent database object

if($_POST['submit'])
{
    require_once(FILE_ROOT.'lib/validator/Validator.class.php');        // include form validation rules
    require_once(FILE_ROOT.'lib/recaptcha/recaptchalib.php');           // include captcha functionality
    $validator = new Validator;                                         // create validator object

    $data['name'] = $_POST['name'];                                     // check name for being empty
    if(strlen($_POST['name']) <= 0)
    {
        $error[] = "Name cannot be empty";                              // produce error message if it is empty
    }

    $data['email'] = $_POST['email'];
    if(!$validator->is_email($_POST['email']))                          // check to seee is we have a valid email address
    {
        $error[] = "Email is not valid";                                // produce error message if not a valid email address
    }

    $data['password'] = $_POST['password'];
    if(strlen($_POST['password']) < 6 || strlen($_POST['password']) > 15)   // check password for length 6 to 15 char
    {
        $error[] = "Password must be between 6 and 15 characters.";         // produce error message if too short/long
    }
    $data['confirm'] = $_POST['confirm'];                                   // make sure they entered the same password when confirming
    if($_POST['password'] != $_POST['confirm'])
    {
        $error[] = "Please re-confirm your password";                       // produce error message if different from above
    }
    
    $data['alerts'] = $_POST['alerts'] == "on" ? 1 : 0;                     // check to see if they desire email alerts
    $data['spaceType'] = $_POST['spaceType'];                               // get their space type preference
    $data['location'] = $_POST['location'];                                 // get their location preference
    $data['lot'] = $_POST['lot'];                                           // get their preferred lot
    
    $resp = recaptcha_check_answer (RECAPTCHA_PRIVKEY,                      // code for checking the captcha
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

    if (!$resp->is_valid)
    {
        $error[] = "Verification is incorrect";                             // if captcha entry is bad issue warning message
    }

    if(count($error) == 0)
    {
            if ($_GET['mode'] == "settings")                    // user is changing their account settings only
            {
                if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == 0)   // make sure they are really logged in
                {
                    header('Location: login.php');
                    die();
                }
                else            // perform query to update their account settings in the database
                {    $insert = mysql_query("UPDATE tblusers SET uname='".mysql_real_escape_string($_POST['email'])."',
                          pwd = '".mysql_real_escape_string(md5($_POST['password']))."',
                          name= '".mysql_real_escape_string($_POST['name'])."',
                          space_type= '".mysql_real_escape_string($_POST['spaceType'])."',
                          lot_id= '".mysql_real_escape_string($_POST['lot'])."',
                          pref_location='".mysql_real_escape_string($_POST['location'])."',
                          email_alert={$data['alerts']}, modified_dt= NOW() WHERE uid={$_SESSION['user_id']};");
                }
            }
            else            // this is for creating a new account it checks to prevent duplicate email addresses in the database.
            {
                $duplicate = mysql_query("SELECT uname FROM tblusers WHERE uname='".mysql_real_escape_string($_POST['email'])."';");
                if(mysql_num_rows($duplicate) == 0)
                {       // create a new record in the database with the users account settings
                        $insert = mysql_query("INSERT INTO tblusers (uname, pwd, name,
                              role, user_typ, space_type, lot_id, pref_location, email_alert,
                              acct_stts, created_dt) VALUES ('"
                              .mysql_real_escape_string($_POST['email'])."', '"
                              .mysql_real_escape_string(md5($_POST['password']))."', '"
                              .mysql_real_escape_string($_POST['name'])."', '0', 'Student', '"
                              .mysql_real_escape_string($_POST['spaceType'])."', '"
                              .mysql_real_escape_string($_POST['lot'])."', '"
                              .mysql_real_escape_string($_POST['location'])."', 
                              {$data['alerts']}, '0', NOW());");
                }
                else
                {
                    $error[] = "email/user name already taken.";        // error messsage for duplicate email addresses
                }
            
                if($insert)     // account succesfully created or modified so we login the user and send them to the home page
                {
                    if ($_GET['mode'] != 'settings') $_SESSION['user_id'] = mysql_insert_id();      // only for new accounts
                    $_SESSION['user_name'] = $_POST['name'];
                    $_SESSION['user_role'] = '0';
                    $_SESSION['user_email'] = $_POST['email'];
                    header('Location: index.php');
                    die();
                }
                else
                {
                    $error[] = mysql_error();           // something went wrong with the database queries
                }
        }
    }
}

 // Preference select options
        try
        {
            // Locations
            $res = $pdo -> prepare("SELECT id, location FROM tbllocation WHERE important=1;");
            $res -> execute();
            $locations = $res -> fetchAll(PDO::FETCH_ASSOC);

            // Space Types
            $res = $pdo -> prepare("SELECT id, full_text FROM tblspace_type;");
            $res -> execute();
            $spaceTypes = $res -> fetchAll(PDO::FETCH_ASSOC);

            // Preferred Lot
            $res = $pdo -> prepare("SELECT id, type FROM tbllot;");
            $res -> execute();
            $lots = $res -> fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e)
        {
            $log->log($e->__toString(), LOGGING_DEBUG);
        }

switch($_GET['mode'])
{
    case 'settings':    // account settings changed not created

        $result = mysql_query("SELECT uname, name, space_type, lot_id, pref_location, email_alert FROM tblusers WHERE uid = {$_SESSION['user_id']};");
        $thisUser = mysql_fetch_row($result);   // get user account information
        // here we assign that information to variables
        $data['name'] = $thisUser[1];
        $data['email'] = $thisUser[0];
        $data['location'] = $thisUser[4];
        $data['lot'] = $thisUser[3];
        $data['spaceType'] = $thisUser[2];
        $data['alerts'] = $thisUser[5];
        $header_data['title'] = 'Modify Your Account';
        if ($insert)
            $header_data['intro'] = 0;      // we are about to change settings
        else
            $header_data['intro'] = 2;      // we have successfully changed setttings once and can again if the user decides to
        // here we assign smarty variables to retain previosuly entered form information
        $smarty -> assign('header', $header_data);
        $smarty -> assign('error', $error);
        $smarty -> assign('data', $data);
        $smarty -> assign('mode', "settings");
        $smarty -> assign('spaceTypes', $spaceTypes);
        $smarty -> assign('locations', $locations);
        $smarty -> assign('lots', $lots);
        $smarty -> assign('recaptcha_pubkey', RECAPTCHA_PUBKEY);
        $smarty -> display('account/create_new.tpl');
        break;
    case '':
    default:        // this is where a new account is created
        $header_data['title'] = 'Create New Account';
        $smarty -> assign('error', $error);
        $smarty -> assign('data', $data);
        $header_data['intro'] = 1;          // show introductory message for new users
        // assign smarty variables
        $smarty -> assign('header', $header_data);
        $smarty -> assign('spaceTypes', $spaceTypes);
        $smarty -> assign('locations', $locations);
        $smarty -> assign('lots', $lots);
        $smarty -> assign('recaptcha_pubkey', RECAPTCHA_PUBKEY);
        $smarty -> display('account/create_new.tpl');
        break;
}

?>
