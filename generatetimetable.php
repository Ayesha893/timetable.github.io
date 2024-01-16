<?php 
include_once "header.php"; 
if(isset($_SESSION['id']) && isset($_SESSION['role'])){

$active_id 		= $_SESSION['id'];
$active_role 	= $_SESSION['role'];

}else{

	header("Location: logout.php");
}



?>


<?php if($active_role == 'faculty'){ ?>




<div class="main-content">
<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">

<?php include_once "facultynav.php"; ?>


</div>



<?php include_once "top.php"; ?>


<!-- main content start-->
<div id="page-wrapper">
<div class="main-page signup-page" style="width: 90% !important">
<h2 class="title1">Generate Timetable</h2>
<div class="sign-up-row widget-shadow">
<h5>From here you can generate and manage timetables:</h5>





<form method="post" action="">



<div class="sign-u">
<select required name="roomid">
<option value="" disabled selected>Choose Room</option>

<?php 

$roomsquery 	= "SELECT * FROM rooms ";
$roomsresult 	= $con->query($roomsquery);
if($roomsresult){

while($rows = $roomsresult->fetch_assoc()){

$rid 		= $rows['id'];
$rname       = $rows['name'];

?>

<option value="<?php echo $rid ?>"><?php echo $rname ?></option>


<?php

}
}


?>




</select>
</div>




<div class="sign-u">
<select required name="classid">
<option value="" disabled selected>Choose Class</option>

<?php 

$classquery 	= "SELECT * FROM classes ";
$classresult 	= $con->query($classquery);
if($classresult){

while($rows = $classresult->fetch_assoc()){

$sid 		= $rows['id'];
$sname       = $rows['name'];

?>

<option value="<?php echo $sid ?>"><?php echo $sname ?></option>


<?php

}
}


?>




</select>
</div>




<div class="sign-u">
<select required name="subjectid">
<option value="" disabled selected>Choose Subject</option>

<?php 

$subjectquery 	= "SELECT * FROM subjects ";
$subjectresult 	= $con->query($subjectquery);
if($subjectresult){

while($rows = $subjectresult->fetch_assoc()){

$ssid 			= $rows['id'];
$ssname       	= $rows['name'];

?>

<option value="<?php echo $ssid ?>"><?php echo $ssname ?></option>


<?php

}
}


?>




</select>
</div>





<div class="sign-u">
<select name="day" required>
	<option value="" disabled selected>Choose Day</option>
	<option value="Monday">Monday</option>
	<option value="Tuesday">Tuesday</option>
	<option value="Wednesday">Wednesday</option>
	<option value="Thursday">Thursday</option>
	<option value="Friday">Friday</option>
</select>
</div>



<div class="sign-u">
<select name="timeslot" required>
	<option value="" disabled selected>Choose Timeslot</option>
	<option value="8:00 AM To 9:00 AM">8:00 AM To 9:00 AM</option>
	<option value="9:00 AM To 10:00 AM">9:00 AM To 10:00 AM</option>
	<option value="10:00 AM To 11:00 AM">10:00 AM To 11:00 AM</option>
	<option value="11:30 AM To 12:30 PM">11:30 AM To 12:30 PM</option>
	<option value="12:30 PM To 1:30 PM">12:30 PM To 1:30 PM</option>
</select>
</div>





<div class="form-group">
<input class="btn btn-primary" type="submit" name="submit" value="Add To Timetable">
</div>
</form>


<?php 


if(isset($_POST['submit'])){


$roomid 		= $con->real_escape_string($_POST['roomid']);
$classid 		= $con->real_escape_string($_POST['classid']);
$subjectid 		= $con->real_escape_string($_POST['subjectid']);
$day 			= $con->real_escape_string($_POST['day']);
$timeslot 		= $con->real_escape_string($_POST['timeslot']);

// Check Overall

$check          = "SELECT * FROM timetables WHERE roomid = '{$roomid}' AND subjectid = '{$subjectid}' AND day = '{$day}' AND timeslot = '{$timeslot}' ";
$checkR1        = $con->query($check);
$checkR1num     = $checkR1->num_rows;


if($checkR1num == 0){


// Check Day & Slot


$checkDS          = "SELECT * FROM timetables WHERE day = '{$day}' AND timeslot = '{$timeslot}' ";
$checkR2        = $con->query($checkDS);
$checkR2num     = $checkR2->num_rows;

if($checkR2num == 0){

// check Day & Subject


$checkDSub          = "SELECT * FROM timetables WHERE day = '{$day}' AND subjectid = '{$subjectid}' ";
$checkR3        = $con->query($checkDSub);
$checkR3num     = $checkR3->num_rows;

if($checkR3num == 0){


	$addquery = "INSERT INTO timetables (roomid, classid, subjectid, day, timeslot) VALUES ('{$roomid}' ,'{$classid}', '{$subjectid}', '{$day}', '{$timeslot}') ";

$addresult = $con->query($addquery);

	if($addresult){

		header("Location: generatetimetable.php");

	}



}else{

	echo '<p class="alert alert-warning">Subject is already added.</p>';

}




}else{


	echo '<p class="alert alert-warning">Change Day or Timeslot.</p>';


}




}else{

	echo '<p class="alert alert-warning">Already Added.</p>';

}







}



?>















<table class="table table-bordered table-striped">
<thead>
<tr>
<th class="text-center">No</th>
<th class="text-center">Day</th>
<th class="text-center">Timeslot</th>
<th class="text-center">Room</th>
<th class="text-center">Class</th>
<th class="text-center">Subject</th>
<th class="text-center">Faculty</th>
<th class="text-center">Status</th>
<th class="text-center">Delete</th>
</tr> 

</thead>

<tbody>


<?php 

$fetch 			= "SELECT * FROM timetables";
$fetchresults 	= $con->query($fetch);
$num_rows 		= $fetchresults->num_rows;

if($num_rows == 0){

echo "<td>No Record.</td>";

}else{

$count = 0;
while($rows = $fetchresults->fetch_assoc()){

$id 		= $rows['id'];
$roomid 	= $rows['roomid'];

$roomQuery 		= "SELECT * FROM rooms WHERE id = '{$roomid}' ";
$roomRes 		= $con->query($roomQuery);
$roomRow 		= $roomRes->fetch_assoc();
$room 			= $roomRow['name'];




$classid 		= $rows['classid'];
$classQuery 	= "SELECT * FROM classes WHERE id = '{$classid}' ";
$classRes 		= $con->query($classQuery);
$classRow 		= $classRes->fetch_assoc();
$class 			= $classRow['name'];


$subjectid 		= $rows['subjectid'];
$subjectQuery 	= "SELECT * FROM subjects WHERE id = '{$subjectid}' ";
$subjectRes 	= $con->query($subjectQuery);
$subjectRow 	= $subjectRes->fetch_assoc();
$subject 		= $subjectRow['name'];
$faculty 		= $subjectRow['faculty'];


$facultyQuery 	= "SELECT * FROM registrations WHERE id = '{$faculty}' ";
$facultyRes 	= $con->query($facultyQuery);
$facultyRow 	= $facultyRes->fetch_assoc();
$firstname 		= $facultyRow['firstname'];
$lastname 		= $facultyRow['lastname'];
$faculty 		= $firstname . ' ' . $lastname;





$day 			= $rows['day'];
$timeslot 		= $rows['timeslot'];
$status 		= $rows['status'];

switch ($status) {
	case 0:
		$status = 'Pending';
		break;

	case 1:
		$status = 'Approved';
		break;
	
	
}



$count++;


?>
<tr class="text-center">
<td><?php echo $count ?></td>
<td><?php echo $day ?></td>
<td><?php echo $timeslot ?></td>
<td><?php echo $room ?></td>
<td><?php echo $class ?></td>
<td><?php echo $subject ?></td>
<td><?php echo $faculty ?></td>
<td><?php echo $status ?></td>


<td><a class="btn btn-danger" href="generatetimetable.php?delete=<?php echo $id ?>">X</a></td>

</tr>

<?php



}



}


?>



</tbody>    

</table>

















<?php 

if(isset($_GET['delete'])){

$id = $_GET['delete'];

$query 	= "DELETE FROM timetables WHERE id = '{$id}' ";
$result = $con->query($query);
if($result){

header("Location: generatetimetable.php");

}else{

die($con->error);

}





}


?>
















</div>
</div>
</div>

<?php include_once "footer.php"; ?>


<?php }else{header("Location: logout.php"); } ?>
