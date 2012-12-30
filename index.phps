<?php

/**
 * index.php
 * 
 * Temporary demo index page
 * 
 * @author Brandon Telle
 * Modified Chethan G     Added support to render static pages from this file
 */

/* Include the init file in all pages. Starts database, smarty, logging. */
require_once('./lib/init.inc.php');
$pdo = new RTP_PDO();

// Filtering options
$filter = array();

if($_SESSION['user_id'])
{
    $userID = $_SESSION['user_id'];
    $prefQuery = "SELECT lot_id, pref_location, space_type FROM tblusers WHERE uid = '$userID'";  // place holder query until tables are changed
    $prefResult = mysql_query($prefQuery) or die(mysql_error());
    $userPref = mysql_fetch_row($prefResult);
    $filter['lot'] = $userPref[0];
    $filter['location'] = $userPref[1];
    $filter['space_type'] = $userPref[2];
}

if(isset($_GET['location'])) $filter['location'] = $_GET['location'];
if(isset($_GET['space_type'])) $filter['space_type'] = $_GET['space_type'];
$filter['campus_section'] = $_GET['campus_section'];

// Get the lot info
require_once('./lib/simulation/lotStatus.class.php');

$lot_status = new lotStatus();
$lots = json_decode($lot_status->summaryLotStatus($filter), TRUE);

for($i=0; $i<count($lots); $i++)
{
    $lots[$i]['Name'] = str_replace("Structure", "Struct", $lots[$i]['Name']);
    if($lots[$i]['Classname'] == 'lotdr')
    {
        $lots[$i]['Classname'] = strtolower('lot'.str_replace(array(' ', '.'), array('_', ''), $lots[$i]['Name']));
    }
}

// Preference select options
try
{
    // Locations
    $res = $pdo -> prepare("SELECT id, location FROM tbllocation WHERE important=1;");
    $res -> execute();
    $locations = $res -> fetchAll(PDO::FETCH_ASSOC);

    // Sections
    $res = $pdo -> prepare("SELECT id, section FROM tblcampus_section;");
    $res -> execute();
    $sections = $res -> fetchAll(PDO::FETCH_ASSOC);

    // Space Types
    $res = $pdo -> prepare("SELECT id, full_text FROM tblspace_type;");
    $res -> execute();
    $spaces = $res -> fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
    $log->log($e->__toString(), LOGGING_DEBUG);
}

/* Add a page title to the header_data array defined in config/smarty.config.php */
$header_data['title'] = ucfirst($module);
$header_data['homepage'] = TRUE;

/* Assigning Smarty variables */
$smarty -> assign('header', $header_data);

/* Display the demo template */
if ($module == 'pages')
{
    $res = $pdo -> prepare("SELECT id, title, content FROM tblpages WHERE status=1 and slug='".$_GET['type']."';");
    $res -> execute();
    $pagedata = $res -> fetch(PDO::FETCH_ASSOC);
    $smarty -> assign('page', $pagedata);
    $smarty -> display('static/page.tpl');
}
else
{
    $smarty -> assign('pref_lot', $filter['lot']);
    $smarty -> assign('lots', $lots);
    $smarty -> assign('sections', $sections);
    $smarty -> assign('locations', $locations);
    $smarty -> assign('space_types', $spaces);
    $smarty -> assign('filter', $filter);
    $smarty -> display('home/desktop.tpl');
}
?>