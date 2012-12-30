<?php

/**
 * site_map.php
 * 
 * Controller for site map.
 * 
 * @author Brandon Telle
 */

require_once('./lib/init.inc.php');

$header_data['title'] = "Site Map";

$files = array();

// Libraries
$files[0] = array('title'=>'Libraries', 'files'=>array());
$files[0]['files'][] = array('file'=>'lib/init.inc.php', 'desc'=>'Initialization script');
$files[0]['files'][] = array('file'=>'config/constants.config.php', 'desc'=>'Site settings');
$files[0]['files'][] = array('file'=>'config/email.config.php', 'desc'=>'Email sending configuration');
$files[0]['files'][] = array('file'=>'config/logging.config.php', 'desc'=>'Error logging class');
$files[0]['files'][] = array('file'=>'config/mysql.config.php', 'desc'=>'MySQL connection initialization');
$files[0]['files'][] = array('file'=>'config/pdo.config.php', 'desc'=>'PDO configuration');
$files[0]['files'][] = array('file'=>'config/session.config.php', 'desc'=>'Session configuration');
$files[0]['files'][] = array('file'=>'config/smarty.config.php', 'desc'=>'Smarty initialization');
$files[0]['files'][] = array('file'=>'lib/validator/Validator.class.php', 'desc'=>'Data validation class');
$files[0]['files'][] = array('file'=>'include/functions.php', 'desc'=>'Header functions');

// Data Model
$files[1] = array('title'=>'Data Model', 'files'=>array());
$files[1]['files'][] = array('file'=>'lib/simulation/fillLots.class.php', 'desc'=>'Database filling algorithm');
$files[1]['files'][] = array('file'=>'lib/simulation/lotStatus.class.php', 'desc'=>'Current status query functions');

// Home Page
$files[2] = array('title'=>'Home Page', 'files'=>array());
$files[2]['files'][] = array('file'=>'index.php', 'desc'=>'Home page controller');
$files[2]['files'][] = array('file'=>'ajax.php', 'desc'=>'AJAX request controller');
$files[2]['files'][] = array('file'=>'templates/home/desktop.tpl', 'desc'=>'Home page template');
$files[2]['files'][] = array('file'=>'js/rtp.map.js', 'desc'=>'Home page map initialization');
$files[2]['files'][] = array('file'=>'js/rtp.init.js', 'desc'=>'RTP javascript functions');
$files[2]['files'][] = array('file'=>'css/rtp.mobile.css', 'desc'=>'Mobile stylesheet');

// Event Calendar
$files[3] = array('title'=>'Event Calendar', 'files'=>array());
$files[3]['files'][] = array('file'=>'Eventcalender.php', 'desc'=>'Controller for event calendar');
$files[3]['files'][] = array('file'=>'ajax.php', 'Ajax request controller');
$files[3]['files'][] = array('file'=>'templates/calender/calender.tpl', 'desc'=>'Calendar template'); 
$files[3]['files'][] = array('file'=>'js/rtp.calendar.js', 'desc'=>'Calendar javascript initialization');
$files[3]['files'][] = array('file'=>'js/rtp.init.js', 'desc'=>'RTP javascript functions');



$smarty -> assign('files', $files);
$smarty -> assign('header', $header_data);
$smarty -> display('static/site_map.tpl');
?>