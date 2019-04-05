<?php

// get all courses + all the observation dates per course
// exclude courses that don't have observations

$courses = "SELECT SC.dN, SC.sID FROM system_courses SC 
INNER JOIN roca_collection_assignments RCA ON SC.id = RCA.cID
INNER JOIN roca_collections RC ON RC.aID = RCA.id";

$courseODates = "SELECT SC.dN, SC.sID, RCA.oDY FROM system_courses SC 
INNER JOIN roca_collection_assignments RCA ON SC.id = RCA.cID
INNER JOIN roca_collections RC ON RC.aID = RCA.id";



// once user choose course + observation date, use that to get the specific data
// WHERE RC.oDate = date AND SC.cID = course

// select for activities for 1 course and 1 observation date
$activities = "SELECT CB.ID, CB.cID, CB.code, CB.dName, CB.dDescription, RCD.sT, RCD.eT
FROM roca_code_bank CB ((((
INNER JOIN roca_collection_data RCD ON RCD.bID = CB.id)
INNER JOIN roca_collections RC ON RCD.cID = RC.id)
INNER JOIN roca_collections_assignments RCA ON RCA.id = RC.aID)
INNER JOIN systems_courses SC ON SC.id = RCA.cID)
WHERE RCA.oDY = 1493611200 AND SC.dName = 'MAE 6250' AND RCD.eT != 0";

// select for all activities for 1 course and 1 observation date
$events = "SELECT CB.ID, CB.cID, CB.code, CB.dName, CB.dDescription, RD.sT
FROM code_bank CB ((((
INNER JOIN roca_collection_data RCD ON RCD.bID = CB.id)
INNER JOIN roca_collections RC ON RCD.cID = RC.id)
INNER JOIN roca_collection RC ON RD.cID = RC.id)
INNER JOIN systems_courses SC ON SC.id = RC.cID)
WHERE RC.oDate = 1498795200 AND SC.cID = '6250-F16' AND RD.eTime == 0";

//select for all intervals for 1 course and 1 observation date
$intervals = "SELECT CB.ID, CB.cID, CB.code, CB.dName, CB.dDescription, RI.sTime, RI.oID
FROM code_bank CB ((((
INNER JOIN roca_intervals RI ON RI.dID = CB.id)
INNER JOIN roca_data RD ON RD.dID = CB.id)
INNER JOIN roca_collection RC ON RD.cID = RC.id)
INNER JOIN systems_courses SC ON SC.id = RC.cID)
WHERE RC.oDate = 1498795200 AND SC.cID = '6250-F16'";


$activities = "SELECT CB.ID, CB.cID, CB.dC, CB.dN, CB.dD, RCD.sT, RCD.eT
FROM roca_code_bank CB
INNER JOIN roca_collection_data RCD ON RCD.bID = CB.id
INNER JOIN roca_collections RC ON RCD.cID = RC.id
INNER JOIN roca_collection_assignments RCA ON RCA.id = RC.aID
INNER JOIN system_courses SC ON SC.id = RCA.cID
WHERE SC.ID = $course AND RCA.oDY = $date AND RCD.eT != 0";

$events = "SELECT CB.ID, CB.cID, CB.dC, CB.dN, CB.dD, RCD.sT
FROM roca_code_bank CB 
INNER JOIN roca_collection_data RCD ON RCD.bID = CB.id
INNER JOIN roca_collections RC ON RCD.cID = RC.id
INNER JOIN roca_collection_assignments RCA ON RCA.id = RC.aID
INNER JOIN systems_courses SC ON SC.id = RCA.cID
WHERE RC.oDY = $date AND SC.ID = $course AND RCD.eTime == 0";

/*
3 JSON files (1 per timeline)
*/


/*
------------- Examples ----------------
*/

// number of activities/events that happened in SYS 6001 on Feb 16
$s1 = "SELECT count(CB.id)
FROM code_bank CB (((
INNER JOIN roca_data RD ON RD.dID = CB.id)
INNER JOIN roca_collection RC ON RD.cID = RC.id)
INNER JOIN systems_courses SC ON SC.id = RC.cID)
WHERE SC.cName='SYS 6001' && RC.rDate='Feb 16'
";

// get lecturing events in SYS 6001
$s2 = "SELECT CB.dName, CB.dDescription, RD.sTime, RD.eTime
FROM code_bank CB (((
INNER JOIN roca_data RD ON RD.dID = CB.id)
INNER JOIN roca_collection RC ON RD.cID = RC.id)
INNER JOIN systems_courses SC ON SC.id = RC.cID)
WHERE SC.cName='SYS 6001' AND CB.id=1
";

// get interval data
$s3 = "SELECT CB.dName, CB.dDescription, roca_intervals.sTime, roca_intervals.dID
FROM roca_intervals RI ((((
INNER JOIN code_bank CB ON RI.dID = CB.id)
INNER JOIN roca_data RD ON RD.dID = CB.id)
INNER JOIN roca_collection RC ON RD.cID = RC.id)
INNER JOIN systems_courses SC ON SC.id = RC.cID)
WHERE SC.cName='SYS 6001' && CB.id=1
";

// $sql = "SELECT ID, cID, code FROM code_bank WHERE cID=7";
?>