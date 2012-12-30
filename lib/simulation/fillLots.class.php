<?php

// Author: Chris Hines

require_once(FILE_ROOT.'lib/init.inc.php');                             // include to open the mySQL connection

class fillLots
{
    function __construct() {}

    function writeTime()
    {

        $newFile = fopen(FILE_ROOT.'lib/simulation/lastUpdate', "w");   // open a file to set the last update time
        $currentTime = date('U');
        fwrite($newFile, $currentTime);
        fclose($newFile);
   }
    public function checkTime()
   {
        $currentTime = date('U');
        $myFile = fopen(FILE_ROOT.'lib/simulation/lastUpdate', "r");   // open a file to get the last update time
        $lastNumOfSec = fread($myFile, filesize(FILE_ROOT.'lib/simulation/lastUpdate'));
        fclose($myFile);

        if (($currentTime - $lastNumOfSec) > 60)                       // if more than 60 seconds have passed, run simulation again.
        {
            $this->fillUp();                        // run simulation
            $this->writeTime();                     // update last time simulation ran
            $this->sendEventAlerts();               // send e-mail alerts if any exist
        }
    }
    function fillUp()
    {
        $currentTime = localtime();                         // determine current time
        $mySecond = $currentTime[0];                        // extract the second (0-59) from the current time
        mt_srand($mySecond);                                // seed random number generator
        
        $query = "SELECT id, classname, open_time, close_time FROM tbllot";    // get info for all lots from data base
        $lotResult = mysql_query($query);
        $numLots = mysql_num_rows($lotResult);              // determine # of lots in data base
        
        // run a loop to look through each lot and deterrmine the # of occupied spaces in each space type for that lot.
        for ($i = 0; $i < $numLots; $i++)
        {
            $totalOccupied = $totalCapacity = 0;            // initialize lot variables each time through loop
            $lot = mysql_fetch_row($lotResult);             // get the next lot
            $openTime = $lot[2];                            // determine the time that the lot opens
            $closeTime = $lot[3];                           // determine the time that the lot closes
            $lotID = $lot[0];                               // use this ID for the lot mySQL UPDATE later.
            $lotName = strtolower($lot[1]);                 // get the internal use lot name
            $subQuery = "SELECT id, lot_id, capacity FROM tblspace WHERE lot_id='$lot[0]'";      // query all space types in the current lot
            $spaceResult = mysql_query($subQuery);          // results contain all space types in a lot
            $numSpaceTypes = mysql_num_rows($spaceResult);  // how many types of spaces are there in this lot?
            $formula = $this->findCurve($lotName);          // determine which simulation curve we will use for computation
            $timeProb = $this->probFunctOfTime($openTime, $closeTime, $formula);      // find probability of spaces being full based off time of day
            $emptyFactor = $this->findEmpty($openTime, $closeTime, $formula);         // determine the current empty factor (curve)

            for ($j = 0; $j < $numSpaceTypes; $j++)
            {
                $myGenerator = mt_rand();                                       // get a random integer
                $randomizer = (0.5 - ($myGenerator / mt_getrandmax())) / 15;    // creates a random decimal # from (-0.5 to +0.5) / 15
                $spaceType = mysql_fetch_row($spaceResult);                     // get the current type of space
                $typeCapacity = $spaceType[2];                                  // determine the current capacity
                $typeID = $spaceType[0];                                        // use this ID for the space type UPDATE later.
                $totalProb = ($timeProb + $randomizer) / $emptyFactor;          // calculate the actual probability that the lot id full
                if ($totalProb > 1) $totalProb = 1.0;                           // probability cannot be greater than 1.
                if ($totalProb < 0) $totalProb = 0.0;                           // probability cannot be less than zero.
                $typeOccupied = (int)($typeCapacity * $totalProb);              // number of occupied spaces as an integer
                $updateTypeQuery = "UPDATE tblspace SET occupied='$typeOccupied' WHERE id='$typeID'";
                $confirmType = mysql_query($updateTypeQuery);                   // time to update the tblSpace database table
                $totalCapacity += $typeCapacity;                                // accumulate capacity for total lot info
                $totalOccupied += $typeOccupied;                                // accumulate occupied for total lot info
                
            }
            $updateLotQuery = "UPDATE tbllot SET occupied=$totalOccupied, capacity=$totalCapacity WHERE id='$lotID'";
            $confirmType = mysql_query($updateLotQuery);                        // time to update the tblLot table in the database
        }
    }
    function findCurve($lot)
    {
        /* this function detemines which probability formulas to use depending
         on the day of the year and which lot we are in. */

        $curve = 0;                                     // initialize variable
        $thisDay = new DateTime();                      // create current date object for today.
        $weekDay = $thisDay->format("D");               // returns the day of the week, ie: Mon, Tue, Wed etc.
        $today = $thisDay->format("U");                 // get unix timestamp for today.
        // create semester start and stop date objects
        $fallStartDay = new DateTime("08/29/2011");
        $fallStopDay = new DateTime("12/09/2011");
        $springStartDay = new DateTime("01/23/2012");
        $springStopDay = new DateTime("05/11/2012");
        // convert them into Unix timestamps
        $fallStartTime = $fallStartDay -> format("U");
        $fallStopTime = $fallStopDay -> format("U");
        $springStartTime = $springStartDay -> format("U");
        $springStopTime = $springStopDay -> format("U");

        switch($weekDay)
        {
            case 'Mon':     // is it a busy day of the week?
            case 'Tue':
            case 'Wed':
            case 'Thu':     // the next line determines if we are in the middle of the Fall or Spring semesters.
                if (($today > $fallStartTime && $today < $fallStopTime) || ($today > $springStartTime && $today < $springStopTime))
                {
                    // historically busy lots during the semesters
                    if ($lot == "lot3" || $lot == "lot4" || $lot == "lot5" || $lot == "lot6" ||
                        $lot == "lot7" || $lot == "lot8" || $lot == "lot9" || $lot == "lot10" ||
                        $lot == "lot11c" || $lot == "lot15" || $lot == "lot18" ) $curve = 2;
                    else
                        $curve = 0;          // a normal busy, and high rate-of-change day
                }
                 else
                 {
                     // historically busy lots independent of the time of year
                    if ($lot == "lot3" || $lot == "lot4" || $lot == "lot5" || $lot == "lot6" ||
                        $lot == "lot7" || $lot == "lot8" || $lot == "lot9" || $lot == "lot10" ||
                        $lot == "lot11c" ) $curve = 3;
                    else
                        $curve = 1;          // a weekend or non-busy day
                 }
                break;
            default:                    
                $curve = 1;                 // a weekend or non-busy day
        }
        return $curve;
    }
    function probFunctOfTime($startTime, $stopTime, $equation)
    {   /* This function computes the probability of a lot being full based off
         * of the hour of the day (0 to 23). */
        
        $prob = 0;                                      // initialize variable
        $currentTime = localtime();                     // determine current time
        $myHour = $currentTime[2];                      // extract the hour (0-23) from the current time
        
        switch($equation)
        {
            case 0:     // this formula determines the probability of a lot that changes rapidly.
                $prob = (0.0000005 * pow($myHour, 5.0)) + (0.00004 * pow($myHour, 4.0)) - (0.003 * pow($myHour, 3.0))
                + (0.0495 * pow($myHour, 2.0)) - (0.1652 * $myHour) + 0.1265;
                break;
            case 1:     // a weekend or non-busy day
                $prob = (0.000001 * pow($myHour, 3.0)) - (0.0042 * pow($myHour, 2.0)) + (0.0956 * $myHour) - 0.1;
                break;
            case 2:     // this formula is a signoid function for lots that are almost always full.
                $prob = 1 / (1 + pow(2.71828, (-0.25 * $myHour)));
                break;
            case 3:     // this formula is a signoid function for lots that are mostly full.
                $prob = 0.8 / (1 + pow(2.71828, (-0.3 * $myHour)));
                break;
        }

        $dateStart = new DateTime($startTime);          // create a date object from the database closed time query
	$openHour = (int)$dateStart->format("H");       // extract the hour (0-23) from the lot open time
        $dateStop = new DateTime($stopTime);            // create a date object from the database closed time query
	$closedHour = (int)$dateStop->format("H");      // extract the hour (0-23) from the lot open time

        if ($myHour < $openHour || $myHour > $closedHour) $prob = 0;     // if the lot is not open then force the probability to 0
        return $prob;
    }
    function findEmpty($startTime, $stopTime, $equation)
    {    /* This function computes the empty factor based off of the hour of the day (0 to 23).
         * This number is to be used with calculating the probability of a lot being full.  */

        $fact = 10;
        $currentTime = localtime();     // determine current time
        $myHour = $currentTime[2];      // extract the hour (0-23) from the current time

        switch($equation)
        {
            case 0:     // this formula determines the empty factor of a lot that changes rapidly.
                $fact = (0.0000000000000025 * pow($myHour, 5.0)) + (0.0006 * pow($myHour, 4.0)) - (0.0273 * pow($myHour, 3.0))
                + (0.4633 * pow($myHour, 2.0)) - (3.4426 * $myHour) + 10.352;
                break;
            case 1:     // a weekend or non-busy day
                $fact = (0.000000000000000007 * pow($myHour, 3.0)) + (0.0042 * pow($myHour, 2.0)) - (0.0962 * $myHour) + 1.5;
                break;
            case 2:     // this formula is a signoid function for lots that are almost always full.
                $fact = 1.0;    // 
                break;
            case 3:     // this formula is a signoid function for lots that are mostly full.
                $fact = 1.0 + ($myHour / 100);    
                break;
        }

        $dateStart = new DateTime($startTime);          // create a date object from the database closed time query
	$openHour = (int)$dateStart->format("H");       // extract the hour (0-23) from the lot open time
        $dateStop = new DateTime($stopTime);            // create a date object from the database closed time query
	$closedHour = (int)$dateStop->format("H");      // extract the hour (0-23) from the lot open time

        if ($myHour < $openHour || $myHour > $closedHour) $fact = 10;   // force the value of $fact to be high if the lot is not open
        return $fact;
    }
    function sendEventAlerts()
    {   /* This function checks to see if email alerts for an event have already been sent.
           If emails have not been sent yet, and we are within a week of the event, then this
           function sends all users who have chosen the effected lot as their preferred lot
           and want e-mail alerts sent to them an email. */

        $rightNow = new DateTime("now");                    // create a date object for today
        $eventQuery = "SELECT id, start_dt_tm, lot_id FROM tblevent WHERE email_sent=false";
        $eventResult = mysql_query($eventQuery);            // query database for event that have not been e-mailed yet
        $numOfEvents = mysql_num_rows($eventResult);        // determine number of events

        for ($i = 0; $i < $numOfEvents; $i++)               // loop through all events and send an email to users who want one
        {
            $thisEvent = mysql_fetch_row($eventResult);     // get next event
            $eventDate = new DateTime($thisEvent[1]);       // create date object for the event date
            $eventID = $thisEvent[0];                       // grab the event ID for use later with the mySQL UPDATE
            $lot = $thisEvent[2];                           // find out which lot is effected
            $dateDifference = $eventDate -> format("U");    // get Unix timestamp of event day
            $daysBetween = $rightNow->format("U");          // get Unix timestamp of today
            // the next line determines if we are within a week of the event.
            if (($dateDifference - $daysBetween) < (7 * 24 * 60 * 60) && ($dateDifference - $daysBetween) >= 0)
            {
                $userQuery = "SELECT uname, name from tblusers WHERE lot_id = '$lot' AND email_alert = true";
                $userResult = mysql_query($userQuery);      // find all users who have this preferred lot and want an email
                $numOfUsers = mysql_num_rows($userResult);  // determine how many users that is
                for ($j = 0; $j < $numOfUsers; $j++)        // loop through number of users and send them an email
                {
                    $person = mysql_fetch_row($userResult); // determine current user
                    $em = new Email();                      // create email object
                    $em->AddAddress($person[0]);            // email address = username
                    // The following is a personalized e-mail message informing the user about the event and lot effected
                    $em->Subject = "Notice of CSULB Parking Lot Closure";
                    $em->Body = "Hello $person[1], \n\n We regret to inform you that your preferred lot,".
                            "$lot will be closed on ".$eventDate -> format('m/d/Y')." to accomodate a special event. \n\n Thank you \n\n".
                            "RTP Team" ;
                    $em->Send();                            // send email
                    unset($em);                             // deallocate object to conserve memory
                }
                $updateQuery = "UPDATE tblevent SET email_sent=true WHERE id=$eventID";
                $emailSent = mysql_query($updateQuery);     // update database to show that an email has been sent for this event
            }
        }
    }
}

?>
