<?php
/**
 * session.config.php
 * 
 * Configures and starts session.
 * 
 * @author Brandon Telle
 */

/* Set session save path -- not very secure, readable to anyone.*/
/* FIXME: configure SQL sessions */
ini_set('session.save_path', FILE_ROOT.'sessions');

session_start();
?>
