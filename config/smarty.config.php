<?php
/**
 * smarty.config.php
 * 
 * Configures Smarty template engine.
 * 
 * @author Brandon Telle
 */

require_once(FILE_ROOT.'lib/smarty/Smarty.class.php');

$smarty = new Smarty();

/* Standard header data elements - can be overwritten by individual pages */
$header_data = array();
$header_data['author'] = "Chris, Chethan, Emre and Brandon";
$header_data['keywords'] = "CECS 470, CSULB, Parking, Real Time,";
$header_data['description'] = "Real Time Parking at CSULB";

$user = array('id'=>$_SESSION['user_id'], 'name'=>$_SESSION['user_name'], 'role'=>$_SESSION['user_role']);
$smarty -> assign('user', $user);

/* TODO: Smarty caching */
?>
