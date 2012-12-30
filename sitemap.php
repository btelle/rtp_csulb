<?php

/**
 * site_map.php
 * 
 * Controller for site map.
 * 
 * @author Brandon Telle
 * Modified by Chethan G  Added links to Admin files
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
$files[1]['files'][] = array('file'=>'docs/RTP@CSULB_DB_Model.pdf', 'desc'=>'Database UML diagram');

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
$files[3]['files'][] = array('file'=>'js/calendar.js', 'desc'=>'Calendar javascript initialization');
$files[3]['files'][] = array('file'=>'js/rtp.init.js', 'desc'=>'RTP javascript functions');

// Lot Details
$files[4] = array('title'=>'Lot Details', 'files'=>array());
$files[4]['files'][] = array('file'=>'lotinfo.php', 'desc'=>'Controller for lot info pages');
$files[4]['files'][] = array('file'=>'templates/lots/info.tpl', 'desc'=>'Lot info template');
$files[4]['files'][] = array('file'=>'templates/lots/nav.tpl', 'desc'=>'Lot info navigation template');
$files[4]['files'][] = array('file'=>'js/rtp.lotinfo.js', 'desc'=>'Lot info javascript initialization');

// Accounts
$files[5] = array('title'=>'Accounts', 'files'=>array());
$files[5]['files'][] = array('file'=>'account.php', 'desc'=>'Account controller');
$files[5]['files'][] = array('file'=>'login.php', 'desc'=>'Login controller');
$files[5]['files'][] = array('file'=>'logout.php', 'desc'=>'Logout controller');
$files[5]['files'][] = array('file'=>'templates/account/create_new.tpl', 'desc'=>'Create account/settings template');
$files[5]['files'][] = array('file'=>'templates/account/account_confirmed.tpl', 'desc'=>'Account confirm template');
$files[5]['files'][] = array('file'=>'templates/account/login.tpl', 'desc'=>'Login template');

// Admin
$files[6] = array('title'=>'Admin', 'files'=>array());
$files[6]['files'][] = array('file'=>'admin/index.php', 'desc'=>'Admin controller');
$files[6]['files'][] = array('file'=>'admin/actions.php', 'desc'=>'Admin actions controller');
$files[6]['files'][] = array('file'=>'admin/include/functions.php', 'desc'=>'Admin functions');
$files[6]['files'][] = array('file'=>'admin/include/database.php', 'desc'=>'Database functions');
$files[6]['files'][] = array('file'=>'admin/templates/admin/index.tpl', 'desc'=>'Admin template');
$files[6]['files'][] = array('file'=>'admin/templates/layout/admin_header.tpl', 'desc'=>'Admin header template');
$files[6]['files'][] = array('file'=>'admin/templates/layout/admin_footer.tpl', 'desc'=>'Admin footer template');
$files[6]['files'][] = array('file'=>'admin/include/eventForm.php', 'desc'=>'Event form');
$files[6]['files'][] = array('file'=>'admin/include/lotdetailForm.php', 'desc'=>'Lot Details form');
$files[6]['files'][] = array('file'=>'admin/include/pageForm.php', 'desc'=>'Page Form');

// Statics
$files[7] = array('title'=>'Static Pages', 'files'=>array());
$files[7]['files'][] = array('file'=>'index.php', 'desc'=>'Index, serves as controller for module static pages');
$files[7]['files'][] = array('file'=>'contact.php', 'desc'=>'Contact form controller');
$files[7]['files'][] = array('file'=>'syntax.php', 'desc'=>'Controller for syntax highlighting page');
$files[7]['files'][] = array('file'=>'sitemap.php', 'desc'=>'Controller for site map');
$files[7]['files'][] = array('file'=>'templates/static/faq.tpl', 'desc'=>'FAQs template');
$files[7]['files'][] = array('file'=>'templates/static/syntax.tpl', 'desc'=>'Syntax highlighting template');
$files[7]['files'][] = array('file'=>'templates/static/sitemap.tpl', 'desc'=>'Site map template');
$files[7]['files'][] = array('file'=>'templates/util/error.tpl', 'desc'=>'Error handling util template');
$files[7]['files'][] = array('file'=>'templates/util/recaptcha.tpl', 'desc'=>'Recaptcha display util template');

$smarty -> assign('files', $files);
$smarty -> assign('header', $header_data);
$smarty -> display('static/sitemap.tpl');
?>