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

$coursesSQL = "SELECT SC.dN, SC.sID FROM system_courses SC 
INNER JOIN roca_collection_assignments RCA ON SC.id = RCA.cID
INNER JOIN roca_collections RC ON RC.aID = RCA.id";

// get course names
$result = $conn->query($coursesSQL);

if ($result -> num_rows > 0) {

	while($row = $result->fetch_assoc()) {

		extract($row);
		$course_name[] = $dN; 
		$semester[] = $sID;
	}

	$courses = array_unique($course_name);
    echo json_encode($courses);

    

} else {
	echo 'No results';
}


?>
