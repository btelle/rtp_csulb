<?php
/**
 * init.inc.php
 * 
 * Initializes site services, including:
 *  + Constants 
 *  + MySQL connection
 *  + Smarty template engine
 *  + Sessions
 * 
 * @author Brandon Telle
 * Modified by Chethan G     Added DOC_ROOT to the application path
 */

/* This probably needs to be changed when uploaded to a different web account */
define('FILE_ROOT', '/net/d3/u5/s/btelle/htdocs/cecs470/rtp_csulb/');
define('DOC_ROOT', 'http://www.cecs.csulb.edu/~btelle/cecs470/rtp_csulb/');
/*define('DOC_ROOT', 'http://www.cecs.csulb.edu/~igokoglu/cecs470/rtp/');*/
/*define('FILE_ROOT', 'C:/xampp/htdocs/rtp_n/');
define('DOC_ROOT', 'http://localhost:82/rtp_n/');*/


/* Enable Error Reporting */
ini_set('display_errors', 'On');
error_reporting(E_ALL ^ E_NOTICE);

/* Include config files */
try 
{
    require_once(FILE_ROOT.'config/constants.config.php');
    require_once(FILE_ROOT.'config/logging.config.php');
    require_once(FILE_ROOT.'config/mysql.config.php');
    require_once(FILE_ROOT.'config/session.config.php');
    require_once(FILE_ROOT.'config/smarty.config.php');
    require_once(FILE_ROOT.'config/email.config.php');
    require_once(FILE_ROOT.'config/pdo.config.php');
    require_once(FILE_ROOT.'lib/simulation/fillLots.class.php');
    
    // Prevent redeclaration of functions in admin pages.
    if(!strstr($_SERVER['REQUEST_URI'], 'admin/'))
        require_once(FILE_ROOT.'include/functions.php');

    // Run data simulation
    $lot_simulation = new fillLots();
    $lot_simulation -> checkTime();
    unset($lot_simulation);

} 
catch (ErrorException $e) /* Fatal errors in config files throw ErrorExceptions */
{
    $message = 'Exception ['.$e->getCode().'] '.$e->getMessage().' on line '.
                $e->getLine().' in '.$e->getFile();
    
    $log->log($message, LOGGING_FINAL);
    
    if($e->getSeverity() < E_USER_ERROR)
    {
        die($message);
    }
}

//var_dump($_SESSION);

?>
