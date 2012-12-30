<?php

/**
 * ajax.php
 * 
 * AJAX controller
 * 
 * @param mode the return mode of the script:
 * @author Brandon Telle
 */

require_once 'lib/init.inc.php';

switch($_GET['mode'])
{
    case 'map':
        $filter = array();
        $filter['location'] = $_GET['location'] == 'undefined'?'':$_GET['location'];
        $filter['space_type'] = $_GET['space_type'] == 'undefined'?'':$_GET['space_type'];
        $filter['campus_section'] = $_GET['campus_section'] == 'undefined'?'':$_GET['campus_section'];

        require_once 'lib/simulation/lotStatus.class.php';
        $lot = new lotStatus();

        $lots = json_decode($lot->SummaryLotStatus($filter), TRUE);

        for($i=0; $i<count($lots); $i++)
        {
            $lots[$i]['Name'] = str_replace("Structure", "Struct", $lots[$i]['Name']);
        }
        die(json_encode($lots));
        break;

    case 'details':
        require_once 'lib/simulation/lotStatus.class.php';
        
        $lot = new lotStatus();
        $pdo = new RTP_PDO();
        
        $res = $pdo -> prepare("SELECT id FROM tbllot WHERE classname= :classname;");
        $res ->bindParam(':classname', $_GET['lot']);
        $res ->execute();
        $id = $res->fetch(PDO::FETCH_COLUMN);
        
        die($lot->detailedLotStatus($id));
        break;

    case 'calendar':
        $dateparts = explode('/', $_GET['day']);        // mm/dd/yyyy

        $date = "{$dateparts[2]}-{$dateparts[0]}-{$dateparts[1]}";
        $start = $date.' 00:00:00';
        $end = $date.' 23:59:59';

        $pdo = new RTP_PDO();

        $event = $pdo->prepare("SELECT description, DATE_FORMAT(start_dt_tm, '%m/%d/%Y %h:%i %p') AS start, DATE_FORMAT(end_dt_tm, '%m/%d/%Y %h:%i %p') AS end, tbllot.type AS lot FROM tblevent INNER JOIN tbllot ON tblevent.lot_id=tbllot.id WHERE start_dt_tm > :start AND end_dt_tm <= :end;");
        $event ->bindParam(':start', $start);
        $event ->bindParam(':end', $end);
        $event ->execute();

        die(json_encode($event->fetchAll(PDO::FETCH_ASSOC)));
        
        break;
    case 'cal_month':
        $start = $_GET['year']."-".$_GET['month']."-01 00:00:00";
        
        $newmonth = $_GET['month']+1;
        $newyear = $_GET['year'];
        
        if($newmonth == 1)
            $newyear+=1;
        $end = "$newyear-$newmonth-01 00:00:00";
        
        $pdo = new RTP_PDO();
        
        $thisMonth = $pdo->prepare("SELECT description, DATE_FORMAT(start_dt_tm, '%m/%d/%Y') AS `date`, DATE_FORMAT(start_dt_tm, '%h:%i %p') AS start_time, DATE_FORMAT(end_dt_tm, '%h:%i %p') AS end_time FROM tblevent WHERE start_dt_tm > :start AND end_dt_tm < :end;");
        $thisMonth->bindParam(':start', $start);
        $thisMonth->bindParam(':end', $end);
        $thisMonth->execute();
        
        die(json_encode($thisMonth->fetchAll(PDO::FETCH_ASSOC)));
        break;
}
?>