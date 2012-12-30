<?php
/**
 * logout.php
 *
 * Logout controller
 *
 * @author Brandon Telle
 */

require_once('lib/init.inc.php');

unset($_SESSION['user_id']);
unset($_SESSION['user_name']);

header('Location: index.php');

?>
