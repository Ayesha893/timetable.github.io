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
<div class="main-page signup-page" style="width: 90% !important;">
<h2 class="title1">Room Wise Timetable</h2>
<div class="sign-up-row widget-shadow">
<h5>From here you view the timetable of any class room.</h5>

<form method="post">


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




<div class="form-group">
<input class="btn btn-primary" type="submit" name="submit" value="Generate">
</div>


</form>


<?php 




	if(isset($_POST['submit'])){


	$roomid = $_POST['roomid'];



$fetch 			= "SELECT * FROM timetables WHERE roomid = '{$roomid}' AND status = 1";
$fetchresults 	= $con->query($fetch);
$num_rows 		= $fetchresults->num_rows;

if($num_rows == 0){

echo "<td>No Record.</td>";

}else{


?>


<a class="pull-right btn btn-warning" href="rdownload.php?roomid=<?php echo $roomid ?>" style="margin-bottom:5px !important">Download</a>
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
</tr> 

</thead>

<tbody>


<?php


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
</tr>

<?php

}

}






?>



</tbody>    

</table>




<?php



	}





 ?>



</div>
</div>
</div>

<?php include_once "footer.php"; ?>


<?php }else{header("Location: logout.php"); } ?>
