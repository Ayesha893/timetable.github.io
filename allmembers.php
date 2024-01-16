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

<h4 class="title2">All Active Users:</h4>




<form method="post">
	
	<input type="text" name="search" placeholder="Search BY Email" required class="form-control">

	<input type="submit" name="submit" value="Filter" class="btn btn-info btn-sm" style="display: none">


</form>


<?php 


if(isset($_POST['submit'])){

$search = $_POST['search'];

?>


<table class="table table-striped " style="margin-top:1em !important">

<tr>

<th>No</th>
<th>Full-Name</th>
<th>Email</th>
<th>Phone</th>
<th>Gender</th>
<th>Address</th>
<th>Role</th>
<th>Edit</th>
<th>Delete</th>


</tr>


<?php

$searched   = "SELECT * FROM registrations WHERE status = 1 AND role != 'admin' AND (email = '{$search}')  ";

$execute  = $con->query($searched);
$num = $execute->num_rows; 
if($num == 0){

	echo '<tr><td>No Record.</td></tr>';

}else{

$no = 0;
while($record = $execute->fetch_assoc()){

$id 			= $record['id'];
$firstname 		= $record['firstname'];
$lastname 		= $record['lastname'];
$name 			= $firstname . ' ' . $lastname;
$email 			= $record['email'];
$phone 			= $record['phone'];
$gender 		= $record['gender'];
$address 		= $record['address'];
$role 			= $record['role'];


$no++;
?>

<tr>

<td><?php echo $no ?></td>
<td><?php echo $name ?></td>
<td><?php echo $email ?></td>
<td><?php echo $phone ?></td>
<td><?php echo $gender ?></td>
<td><?php echo $address ?></td>
<td><?php echo ucfirst($role); ?></td>


<td><a  class="btn btn-warning btn-sm" href="user_edit.php?user=<?php echo $id ?>">Edit</a></td>

<td><a  class="btn btn-danger btn-sm" href="allmembers.php?delete=<?php echo $id ?>">X</a></td>


</tr>



<?php
}
}

?>



</table>




<?php }else{ ?>


<table class="table table-striped " style="margin-top:1em !important">

<tr>

<th>No</th>
<th>Full-Name</th>
<th>Email</th>
<th>Phone</th>
<th>Gender</th>
<th>Address</th>
<th>Role</th>
<th>Edit</th>
<th>Delete</th>

</tr>


<?php

$query   = "SELECT * FROM registrations WHERE status = 1 AND role != 'admin'";
$result  = $con->query($query);
$num = $result->num_rows; 
if($num == 0){

	echo '<tr><td>Nothing Found.</td></tr>';

}else{

$no = 0;
while($record = $result->fetch_assoc()){

$id 			= $record['id'];
$firstname 		= $record['firstname'];
$lastname 		= $record['lastname'];
$name 			= $firstname . ' ' . $lastname;
$email 			= $record['email'];
$phone 			= $record['phone'];
$gender 		= $record['gender'];
$address 		= $record['address'];
$role 			= $record['role'];


$no++;
?>

<tr>

<td><?php echo $no ?></td>
<td><?php echo $name ?></td>
<td><?php echo $email ?></td>
<td><?php echo $phone ?></td>
<td><?php echo $gender ?></td>
<td><?php echo $address ?></td>
<td><?php echo ucfirst($role); ?></td>


<td><a  class="btn btn-warning btn-sm" href="user_edit.php?user=<?php echo $id ?>">Edit</a></td>

<td><a  class="btn btn-danger btn-sm" href="allmembers.php?delete=<?php echo $id ?>">X</a></td>


</tr>


<?php
}
}

?>



</table>



<?php } ?>






















<?php 

if(isset($_GET['delete'])){

$id    	= $_GET['delete'];
$query 	= "DELETE FROM registrations WHERE id = '{$id}' ";
$result = $con->query($query);

if($result){
header("Location: allmembers.php");
}



}







?>      











<div class="clearfix"> </div>
</div>






</div>
</div>

<?php include_once "footer.php"; ?>


<?php }else{header("Location: logout.php"); } ?>
