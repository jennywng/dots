<?php

$servername = "localhost";
$username = "root";
//my passowrd set is pwdpwd
$password = "pwdpwd";
$dbname = "dots2";

// create connection to database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn -> connect_error) {
	die("Unable to connect to DB: " . $conn -> connect_error);
}
echo 'connected successfully to dots2 <br>';


$courseODates = "SELECT SC.dN, SC.sID, RCA.oDY FROM system_courses SC 
INNER JOIN roca_collection_assignments RCA ON SC.id = RCA.cID
INNER JOIN roca_collections RC ON RC.aID = RCA.id";

// query() function of $conn objects runs the SQL query and puts data into variable result
$result = $conn->query($courseODates);

echo '<br>';

// if (!$result) {
// 	echo "Couldn't successfully run query ($courseODates) from DB: " . mysql_error();
// 	exit;
// }

// num_rows() checks that theres more than 1 row
if ($result -> num_rows > 0) {
	echo "<table><tr><th>SC Name</th><th>sID</th><th>RC oDate</th></tr>";
	
	// $cIDArr = array();
	// $codeArr = array();
	// fecth the first element from the collection
	$row1 = $result->fetch_assoc();
	print_r($row1);
	echo '<br>';


	while($row = $result->fetch_assoc()) {
		echo '<tr><td>' . $row['dN'] . '</td><td>' . $row['sID'] . '</td><td>' . $row['oDY'] . '</td></tr>';

		extract($row);
		$course_name[] = $dN; 
		$semester[] = $sID;
		$oDate[] = new Datetime("@$oDY");
		$export[] = array('course_name'=>$dN, 'semester'=>$sID, 'oDate'=>new Datetime("@$oDY"));
	}
	echo '</table><br>';

	// write extracted data to .json file
	$fp = fopen('results.json', 'w');
	// fwrite($fp, json_encode($course_name));
	// fwrite($fp, json_encode($semester));
	// fwrite($fp, json_encode($oDate));
	$encode_export = array('data'=>$export);
	fwrite($fp, json_encode($encode_export));
	fclose($fp);




	// print_r($sc_id) . '<br>';
	// print_r($sc_cid) . '<br>';
	// print_r($name) . '<br>';
	// print_r($rc_id) . '<br>';
	// print_r($date) . '<br>';

	$courses = array_unique($course_name);
	echo '<br>';
	// print_r($courses);
	// echo '<br>';

	// make datetimes pop up depending on which course choice they are for
	$datetimes[] = null;
	foreach($oDate as $key=>$d) {
		echo $d->format('d-m-Y');
		echo '<br>';
	}


	echo '<select id="course-choice">';
	echo '<option selected="selected">Choose A Course </option>';
	foreach($courses as $key=>$course) {
		echo '<option value="' .$course.'">'.$course.'</option>';
	}
	echo "</select>";


} else {
	echo 'No results';
}


$conn->close();


// unix timestamps convert date + time
// ynr, date command
?>

