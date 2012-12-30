<?php

/**
 * lotinfo.php
 * 
 * Controller for lot info pages.
 * 
 * @author Brandon Telle
 */

require_once('./lib/init.inc.php');
require_once(FILE_ROOT.'include/functions.php');

$header_data['title'] = 'Lot Info';

$pdo = new RTP_PDO;

// Get categories and lots for navigation
try
{
    $res = $pdo -> query("SELECT L.type AS `name`, L.id AS `url`, O.id AS loc_id FROM tbllot L INNER JOIN tbljoin_lot_location J ON L.id=J.lot_id INNER JOIN tbllocation O ON O.id=J.loc_id WHERE O.important=1 GROUP BY L.id ORDER BY L.id ASC;");
    $lots = $res->fetchAll(PDO::FETCH_ASSOC);
    
    $res = $pdo -> query("SELECT id, location FROM tbllocation WHERE important=1;");
    $sections = $res -> fetchAll(PDO::FETCH_ASSOC);
    
    foreach($sections as $section)
    {
        $lot_final[$section['id']] = array();
        foreach($lots as $lot)
        {
            if($lot['loc_id'] == $section['id'])
               $lot_final[$section['id']][] = $lot;
        }
    }
    
    $smarty -> assign('lots', $lot_final);
    $smarty -> assign('sections', $sections);
}
catch(PDOException $e)
{
    $log->log($e->__toString(), LOGGING_FINAL);
    $smarty -> assign('lots', array());
}
$res = NULL;

// Detailed lot detail queries
if(strlen($_GET['lot']) > 0)
{
    try
    {
        $res = $pdo -> query("SELECT L.type as `name`, TIME_FORMAT(L.open_time, '%h:%i %p') AS open_time, TIME_FORMAT(L.close_time, '%h:%i %p') AS close_time, L.img, L.id FROM tbllot L WHERE L.id=".$pdo->quote($_GET['lot']).";");
        $lot_details = $res->fetch(PDO::FETCH_ASSOC);

        $res = $pdo -> query("SELECT type, capacity FROM tblspace WHERE lot_id=".$pdo->quote($_GET['lot'])." ORDER BY capacity DESC;");
        $lot_spaces = $res -> fetchAll(PDO::FETCH_ASSOC);

        $res = $pdo -> query("SELECT `description` FROM tblrestriction WHERE lot_id=".$pdo->quote($_GET['lot']).";");
        $restrictions = $res->fetchAll(PDO::FETCH_COLUMN);
        
        $res = $pdo -> query("SELECT location FROM tbllocation loc INNER JOIN tbljoin_lot_location j ON loc.id=j.loc_id  WHERE j.lot_id=".$pdo->quote($_GET['lot']).";");
        $nearby = $res -> fetchAll(PDO::FETCH_COLUMN);
        
        $res = $pdo -> query("SELECT * FROM tblspace_type;");
        $types = $res -> fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e)
    {
        $log->log($e->__toString(), LOGGING_FINAL);
    }

    foreach($lot_spaces as $space)
    {
        $lot_details[$space['type']] = $space['capacity'];
    }
    
    // Display page
    $smarty -> assign('details', $lot_details);
    $smarty -> assign('restrictions', $restrictions);
    $smarty -> assign('nearby', $nearby);
    $smarty -> assign('types', $types);
    $smarty -> assign('header', $header_data);
    $smarty -> display('lots/info.tpl');
}
else
{   // Display index if no lot is selected
    $smarty -> assign('header', $header_data);
    $smarty -> display('lots/index.tpl');
}
?>
