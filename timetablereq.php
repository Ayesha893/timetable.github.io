<?php 
include_once "header.php"; 
if(isset($_SESSION['id']) && isset($_SESSION['role'])){

$active_id 		= $_SESSION['id'];
$active_role 	= $_SESSION['role'];

}else{

	header("Location: logout.php");
}



?>


<?php if($active_role == 'admin'){ ?>




<div class="main-content">
<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">

<?php include_once "adminnav.php"; ?>


</div>



<?php include_once "top.php"; ?>


<!-- main content start-->
<div id="page-wrapper">
<div class="main-page signup-page" style="width: 90% !important">
<h2 class="title1">Generated Timetable</h2>
<div class="sign-up-row widget-shadow">
<h5>Approve/Reject Timetable Request:</h5>



<a class="pull-right btn btn-warning" href="download.php" style="margin-bottom:5px !important">Download</a>
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
<th class="text-center">Approve</th>
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


<td><a class="btn btn-warning btn-sm" href="timetablereq.php?approve=<?php echo $id ?>">Approve</a></td>
<td><a class="btn btn-danger btn-sm" href="timetablereq.php?delete=<?php echo $id ?>">X</a></td>

</tr>

<?php



}



}




if(isset($_GET['approve'])){

$approve 	= $_GET['approve'];
$approved  = "UPDATE timetables SET status = 1 WHERE id = '{$approve}' ";
$execute = $con->query($approved);

if($execute){
header("Location: timetablereq.php");
}else{

	die($con->error);
}


}



?>



</tbody>    

</table>





</div>
</div>
</div>

<?php include_once "footer.php"; ?>


<?php }else{header("Location: logout.php"); } ?>
