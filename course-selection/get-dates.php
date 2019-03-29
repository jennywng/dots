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

// if (isset($_POST['course'])) {
//     $selected_course = $_POST['course'];
// }

$selected_course = $_REQUEST['c'];

$courseODates = "SELECT RCA.oDY FROM system_courses SC 
INNER JOIN roca_collection_assignments RCA ON SC.id = RCA.cID
INNER JOIN roca_collections RC ON RC.aID = RCA.id WHERE SC.dN = '" . $selected_course . "'";

$result = $conn->query($courseODates);

if ($result -> num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        extract($row);
        $oDate[] = new Datetime("@$oDY");
    }

    foreach($oDate as $key=>$d) {
        $datetimes[] = $d->format('m-d-Y H:i:s');
    }

    echo json_encode($datetimes);
    

} else {
    echo 'No results';
}


$conn->close();

?>