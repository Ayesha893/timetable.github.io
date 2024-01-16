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
<div class="main-page general">
<h2 class="title1">Welcome To The Backend Of The Application:</h2>
<div class="panel-info widget-shadow">

<h4 class="title2">Approve Registration Requests:</h4>



<table class="table table-striped">

<tr>

<th>No</th>
<th>First-Name</th>
<th>Last-Name</th>
<th>Email</th>
<th>Phone</th>
<th>Role</th>

<th>Approve</th>
<th>Remove</th>


</tr>


<?php

$fetchRecords = "SELECT * FROM registrations WHERE status = 0 AND role != 'admin'";
$execute  = $con->query($fetchRecords);
$totalrec = $execute->num_rows; 
if($totalrec == 0){

	echo '<tr><td>No Record.</td></tr>';

}else{

$no = 0;
while($fetch = $execute->fetch_assoc()){

$id 			= $fetch['id'];
$firstname 		= $fetch['firstname'];
$lastname 		= $fetch['lastname'];
$email 		= $fetch['email'];
$phone 		= $fetch['phone'];
$role 		= $fetch['role'];



$no++;
?>

<tr>

<td><?php echo $no ?></td>
<td><?php echo $firstname ?></td>
<td><?php echo $lastname ?></td>
<td><?php echo $email ?></td>
<td><?php echo $phone ?></td>
<td><?php echo ucfirst($role); ?></td>


<td><a  class="btn btn-success btn-sm" href="reg_requests.php?approve=<?php echo $id ?>">Approve</a></td>

<td><a  class="btn btn-warning btn-sm" href="reg_requests.php?delete=<?php echo $id ?>">X</a></td>


</tr>


<?php
}
}

?>



</table>




<?php 

if(isset($_GET['delete'])){

$remove    		= $_GET['delete'];
$delete 	    = "DELETE FROM registrations WHERE id = '{$remove}' ";
$execute 		= $con->query($delete);

if($execute){
header("Location: reg_requests.php");
}else{

	die($con->error);
}



}



if(isset($_GET['approve'])){

$approve 	= $_GET['approve'];
$approved  = "UPDATE registrations SET status = 1 WHERE id = '{$approve}' ";
$execute = $con->query($approved);

if($execute){
header("Location: reg_requests.php");
}else{

	die($con->error);
}


}




?>      






<div class="clearfix"> </div>
</div>






</div>
</div>

<?php include_once "footer.php"; ?>


<?php }else{header("Location: logout.php"); } ?>
