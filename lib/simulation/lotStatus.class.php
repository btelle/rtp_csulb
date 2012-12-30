<?php

// Author Chris Hines and Brandon Telle

require_once(FILE_ROOT.'lib/init.inc.php');     // include to open the mySQL connection

class lotStatus
{
    public function summaryLotStatus($filter=array())
    {   // this function returns a JSON object to process the AJAX request for the Homepage.

        $pdo = new RTP_PDO();                                       // create PDO object
        $lot_filter = $type_filter = array();                       // to filter results
        if($filter['location'] != '')                               // are we filtering by location?
        {
            $res = $pdo -> prepare("SELECT id FROM tbllot lot INNER JOIN tbljoin_lot_location loc ON lot.id=loc.lot_id WHERE loc.loc_id= :location;");
            $res -> bindValue(':location', $filter['location']);
            $res -> execute();
            $lot_filter = $res ->fetchAll(PDO::FETCH_COLUMN);
        }
        else if($filter['campus_section'] != '')                    // are we filtering by campus section?
        {
            $res = $pdo -> prepare("SELECT lot.id FROM tbllot lot INNER JOIN tbljoin_lot_location j ON lot.id=j.lot_id INNER JOIN tbllocation loc ON j.loc_id=loc.id WHERE loc.section= :section;");
            $res -> bindValue(':section', $filter['campus_section']);
            $res -> execute();
            $lot_filter = $res ->fetchAll(PDO::FETCH_COLUMN);
        }
        if($filter['space_type'] != '')                             // are we filtering by space type?
        {
            $type_filter = array($filter['space_type']);
        }
        if($filter['lot'] != '')                                    // is the user logged in and are we filtering by preferred lot?
        {
            if(!empty($lot_filter))                                 // Empty lot filter means no filtering, ignore preferred lot.
                $lot_filter[] = $filter['lot'];                     // add ID of preferred lot in addition to those already queried.
        }
        if(!empty($lot_filter))
        {
            $in = "IN(".implode(', ', $lot_filter).")";             // clean up query
        }
        if(empty($type_filter))
            $query = "SELECT id, capacity, occupied, type AS `name`, classname FROM tbllot ".($in?"WHERE id ".$in:'').";";    // get info for each lot in the data base
        else
            $query = "SELECT lot.id, SUM(space.capacity) AS capacity, SUM(space.occupied) AS occupied, lot.type AS `name`, lot.classname FROM tbllot lot INNER JOIN tblspace space ON lot.id=space.lot_id INNER JOIN tblspace_type types ON types.type=space.type WHERE types.id IN (".implode(", ", $type_filter).") ".($in?'AND lot.id '.$in:'')." GROUP BY lot.id";
        $lotResult = mysql_query($query) or die(mysql_error());     // query for mySQL database
        $numLots = mysql_num_rows($lotResult);                      // determine # of lots in data base
        for ($i = 0; $i < $numLots; $i++)
        {
            $lot = mysql_fetch_row($lotResult);                     // get the next lot in the result
            $lotID = $lot[0];                                       // save the PK field ID
            $lotClosed = $this->lotIsClosed($lotID);                // determine if lot is closed
            $capacity = $lot[1];                                    // read the total capacity for this lot
            $occupied = $lot[2];                                    // read the total # of spaces occupied in this lot
            $name = $lot[3];                                        // read the name of the lot
            $classname = $lot[4];                                   // class name
            $subArray = array("Occupied" => $occupied, 
                              "Capacity" => $capacity, 
                              "Name" => $name, 
                              "Classname"=>$classname,
                              "Id"=>$lotID,
                              "Closed" => $lotClosed);
            
            $lots[$lotID] = $subArray;                      // save data in associative array that will be passed to AJAX.
        }
        
        return json_encode($lots);                          // send the information for Java Script (AJAX)
    }
    public function detailedLotStatus($lotFilter)
    {   /* this function returns a JSON object to process the AJAX request for the Homepage
           when a user moves the mouse over a parking area icon. */
        
        $lotQuery = "SELECT id, type FROM tbllot WHERE id = '$lotFilter'";      // get info for each lot in the data base
        $lotResult = mysql_query($lotQuery);                    // query for mySQL database
        $lot = mysql_fetch_row($lotResult);                     // get the next lot in the result
        $lotName = $lot[1];                                     // determine the time that the lot opens
        $lot_ids = array($lot[0]);                              // lot ids array, because structs have more than one floor

        $spaceQuery = "SELECT tblspace.lot_id, tblspace_type.full_text, SUM(tblspace.capacity), SUM(tblspace.occupied) FROM tblspace INNER JOIN tblspace_type ON tblspace.type = tblspace_type.type WHERE tblspace.lot_id IN(".implode($lot_ids, ', ').") GROUP BY tblspace.type ORDER BY SUM(tblspace.capacity) DESC";
        $spaceResult = mysql_query($spaceQuery);                // query for mySQL database
        $numSpaceTypes = mysql_num_rows($spaceResult);          // how many types of spaces are there in this lot?

        for ($j = 0; $j < $numSpaceTypes; $j++)
            {
                $spaceType = mysql_fetch_row($spaceResult);         // get the current type of space
                $typeName = $spaceType[1];                          // name of the type of space.
                $typeCapacity = $spaceType[2];                      // determine the current capacity
                $typeOccupied = $spaceType[3];                      // find the current # of occupied spaces
                $typeAvailable = $typeCapacity - $typeOccupied;     // calculate # of empty spaces
                $typeArray[] = array("Available" => $typeAvailable, // fill an array with the name and available space types
                                     "Name" => $typeName);
            }
        $typeDetail = array("Lot_Name" => $lotName,                 // fill another array for the entire lot
                            "Type_Data" => $typeArray);

        return json_encode($typeDetail);                            // send the information for Java Script (AJAX)
    }
    public function lotIsClosed($lot)
    {   /* This function determines if there is currently a special event in progress and returns
           a boolean indicating that the lot is effetced by the event.  */

        $query = "SELECT open_time, close_time FROM tbllot WHERE id = $lot";        // get info for the lot passed from data base
        $result1 = mysql_query($query);
        $lotResult = mysql_fetch_row($result1);
        $currentTime = localtime();                     // determine current time
        $thisTime = time();                             // get current Unix timestamp
        $thisHour = $currentTime[2];                    // extract the hour (0-23) from the current time
        $dateOpen = new DateTime($lotResult[0]);        // create a date object from the database open time query
        $dateClosed = new DateTime($lotResult[1]);      // create a date object from the database closed time query
	$openHour = (int)$dateOpen->format("H");        // extract the hour (0-23) from the lot open time
        $closedHour = (int)$dateClosed->format("H");    // extract the hour (0-23) from the lot closed time

        if($thisHour < $openHour || $thisHour > $closedHour)    // the lot is not open, return true
            return true;
        else                                                    // is there an event?
        {
            $eventQuery = "SELECT start_dt_tm, end_dt_tm FROM tblevent WHERE lot_id = $lot";
            $result2 = mysql_query($eventQuery);                // query database to see if there is an event effecting this lot
            $numOfEvents = mysql_num_rows($result2);            // how many events are there for this lot?
            // this loop looks at every event for the lot and determines whether an event is currently in process
            for ($i = 0; $i < $numOfEvents; $i++)
            {
                $eventResult = mysql_fetch_row($result2);       // get event info
                $eventStart = new DateTime($eventResult[0]);    // create a date object from the event start time
                $eventStop = new DateTime($eventResult[1]);     // create a date object from the event stop time
                $startTime = $eventStart -> format("U");        // get Unix timestamp for the event start time
                $stopTime = $eventStop -> format("U");          // get Unix timestamp for the event stop time
                if ($startTime <= $thisTime && $stopTime >= $thisTime) return true;     // return true if there is an event happening
            }
            return false;       // no events are currently going that effect this lot, so return false
        }
    }
}

?>
