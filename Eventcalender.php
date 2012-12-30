<?php
/**
 * Eventcalender.php
 *
 * Event Calender
 *
 * @author Ibrahim Gokoglu
 * 
 * Modified     Brandon T   Added month's events query
 */
require_once('./lib/init.inc.php');

$pdo = new RTP_PDO();  // connect with database

$month = date('m');  //get the current month
$year = date('Y'); //get the current year

$start = "$year-$month-01 00:00:00"; //getting the sql timestamp for first day of this month

$month = ($month+1)%12; // get the next month
if($month == 1)
    $year = $year+1; // increments the year

$end = "$year-$month-01 00:00:00"; //first day of the next month

$thisMonth = $pdo->prepare("SELECT description, DATE_FORMAT(start_dt_tm, '%m/%d/%Y') AS `date`, DATE_FORMAT(start_dt_tm, '%h:%i %p') AS start_time, DATE_FORMAT(end_dt_tm, '%h:%i %p') AS end_time FROM tblevent WHERE start_dt_tm > :start AND end_dt_tm < :end;"); //gets the information from database
$thisMonth->bindParam(':start', $start);
$thisMonth->bindParam(':end', $end);
$thisMonth->execute();

$header_data['title'] = 'Event Calender';

$smarty -> assign('header', $header_data);
$smarty -> assign('thisMonth', $thisMonth->fetchAll(PDO::FETCH_ASSOC)); // grab whole month from the database assign it
$smarty -> display('calender/calender.tpl'); //display calender smarty
?>