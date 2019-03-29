<?php 

$servername = "localhost";
$username = "root";
$password = "";
// $password = "pwdpwd";
$dbname = "dots2";

// create connection to database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn -> connect_error) {
	die("Unable to connect to DB: " . $conn -> connect_error);
}

if (isset($_POST['course']) && isset($_POST['course'])) {
    $course = $_POST['course'];
    $date = $_POST['date'];
}


$activities = "SELECT CB.ID, CB.cID, CB.dC, CB.dN, CB.dD, RCD.sT, RCD.eT
FROM roca_code_bank CB
INNER JOIN roca_collection_data RCD ON RCD.bID = CB.id
INNER JOIN roca_collections RC ON RCD.cID = RC.id
INNER JOIN roca_collection_assignments RCA ON RCA.id = RC.aID
INNER JOIN system_courses SC ON SC.id = RCA.cID
WHERE SC.ID = $course AND RCA.oDY = $date";

// $activities = "SELECT CB.ID, CB.cID, CB.dC, CB.dN, CB.dD, RCD.sT, RCD.eT 
// FROM roca_code_bank CB 
// INNER JOIN roca_collection_data RCD ON RCD.bID = CB.id 
// INNER JOIN roca_collections RC ON RCD.cID = RC.id 
// INNER JOIN roca_collection_assignments RCA ON RCA.id = RC.aID 
// INNER JOIN system_courses SC ON SC.id = RCA.cID 
// WHERE SC.ID = 2 AND RCA.oDY = 1497931200";


$result = $conn->query($activities);

if ($result -> num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        extract($row);
        // $name[] = $dName;
        // $desc[] = $dDescription;
        // $start[] = new Datetime("@$sT");
        // $end[] = new Datetime("@$eT");
        // $oDate[] = new Datetime("@$rDY");

        $s = new Datetime("@$sT");
        $s->format('m-d-Y H:i:s');
        $e = new Datetime("@$eT");
        $e->format('m-d-Y H:i:s');

        $export[] = array('name'=>$dN, 'description'=>$dD, 'displayCode'=>$dC, 'startTime'=>$s, 'endTime'=>$e, 'unixStart'=>$sT, 'unixEnd'=>$eT);
    }

    // foreach($start as $key=>$s) {
    //     $startTimes[] = $s->format('m-d-Y H:i:s');
    // }
    // foreach($end as $key=>$e) {
    //     $endTimes[] = $e->format('m-d-Y H:i:s');
    // }

    // $export[] = array('name'=>$dN, 'semester'=>$sID, 'oDate'=>new Datetime("@$oDY"));
    $encode_export = array('data'=>$export);
	echo json_encode($encode_export);
    // echo json_encode($export);
    

} else {
    echo 'No results';
}


$conn->close();

?>