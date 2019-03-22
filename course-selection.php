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
	echo '<br>';
    
    print_r($courses);
	echo '<br>';

} else {
	echo 'No results';
}


?>


<form action="" method="POST">
    <select id="course-choice" name="course-choice">
        <option selected="selected">Choose A Course </option>
        <?php
        foreach($courses as $key=>$course) {
            echo '<option value="' . $course . '">' . $course . '</option>';
        }
        ?>
    </select>
    <input type='submit' name='submit' value='Submit'/>
</form>



<?php

$selected_course = '';

if (isset($_POST['submit'])) {
    $selected_course = $_POST['course-choice'];
    
    echo $selected_course;
    echo '<br>';
}



if (strlen($selected_course) > 0) {
    // get course dates
    $courseODates = "SELECT RCA.rDY FROM system_courses SC 
    INNER JOIN roca_collection_assignments RCA ON SC.id = RCA.cID
    INNER JOIN roca_collections RC ON RC.aID = RCA.id WHERE SC.dN = '" . $selected_course . "'";

    $result = $conn->query($courseODates);

    if ($result -> num_rows > 0) {

	    while($row = $result->fetch_assoc()) {
		    extract($row);
		    $oDate[] = new Datetime("@$rDY");
	    }
    
	    foreach($oDate as $key=>$d) {
            $datetimes[] = $d->format('m-d-Y H:i:s');
        }
        

    } else {
	    echo 'No results';
    }


    print_r($oDate);
    print_r($datetimes);

}
?>


<form action="" method="POST">
    <select id="date-choice" name="date-choice">
        <option selected="selected">Choose An Observation Date </option>
        <?php
        foreach($datetimes as $key=>$date) {
            echo '<option value="' . $date . '">' . $date . '</option>';
        }
        ?>
    </select>
    <input type='submit' name='submit' value='Submit'/>
</form>

<?php

?>



<?php
$conn->close();
?>