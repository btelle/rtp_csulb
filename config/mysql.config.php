<?php
/**
 * mysql.config.php
 * 
 * Contains MySQL connection variables, creates a connection to the 
 * given database. 
 * 
 * @author Brandon Telle
 */

/* SQL Connection Variables */
$sql_config = array('user'=>SQL_USER, 
                    'pass'=>SQL_PASS, 
                    'host'=>SQL_HOST, 
                    'name'=>SQL_DB);

/* Create connection to database */
$con = @mysql_connect($sql_config['host'], 
                      $sql_config['user'], 
                      $sql_config['pass']); 

/* Throw fatal ErrorException if connection fails */
if(!$con)
    throw new ErrorException(mysql_error(), mysql_errno(), E_USER_ERROR);

/* Select database name */
@mysql_select_db($sql_config['name']);

?>
