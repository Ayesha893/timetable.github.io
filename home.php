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
<h2 class="title1">Welcome To Your Admin Account:</h2>
<div class="panel-info widget-shadow">

<h4 class="title2">Registration Info:</h4>



<table class="table table-striped">
	
<?php 

$active 		= "SELECT * from registrations WHERE id = '{$active_id}' AND status = 1 ";
$execute 		= $con->query($active);
$num_rows 		= $execute->num_rows; 

if($num_rows == 0){

	echo '<p>No Info Available.</p>';
}else{

$record 		= $execute->fetch_assoc();
$id 			= $record['id'];
$firstname 		= $record['firstname'];
$lastname 		= $record['lastname'];
$email 			= $record['email'];
$phone 			= $record['phone'];
$gender 		= $record['gender'];
$address 		= $record['address'];
$role  			=$record['role'];
?>
	

<tr>
	<th>First-Name</th>
	<td><?php echo $firstname ?></td>
</tr>


<tr>
	<th>Last-Name</th>
	<td><?php echo $lastname ?></td>
</tr>


<tr>
	<th>Email</th>
	<td><?php echo $email ?></td>
</tr>



<tr>
	<th>Phone</th>
	<td><?php echo $phone ?></td>
</tr>




<tr>
	<th>Address</th>
	<td><?php echo $address ?></td>
</tr>



<tr>
	<th>Gender</th>
	<td><?php echo $gender ?></td>
</tr>


<tr>
	
	<th>Role</th>
	<td><?php echo $role ?></td>
</tr>

<?php } ?>

</table>





<div class="clearfix"> </div>
</div>






</div>
</div>

<?php include_once "footer.php"; ?>


<?php }elseif($active_role == 'user'){ ?>




<div class="main-content">
<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">

<?php include_once "usernav.php"; ?>


</div>



<?php include_once "top.php"; ?>


<!-- main content start-->
<div id="page-wrapper">
<div class="main-page general">
<h2 class="title1">Welcome To Your Student Account:</h2>
<div class="panel-info widget-shadow">
<h4 class="title2">Registration Info:</h4>




<table class="table table-striped">
	
<?php 

$active 		= "SELECT * from registrations WHERE id = '{$active_id}' AND status = 1 ";
$execute 		= $con->query($active);
$num_rows 		= $execute->num_rows; 

if($num_rows == 0){

	echo '<p>No Info Available.</p>';
}else{

$record 		= $execute->fetch_assoc();
$id 			= $record['id'];
$firstname 		= $record['firstname'];
$lastname 		= $record['lastname'];
$email 			= $record['email'];
$phone 			= $record['phone'];
$gender 		= $record['gender'];
$address 		= $record['address'];

?>
	

<tr>
	<th>First-Name</th>
	<td><?php echo $firstname ?></td>
</tr>


<tr>
	<th>Last-Name</th>
	<td><?php echo $lastname ?></td>
</tr>


<tr>
	<th>Email</th>
	<td><?php echo $email ?></td>
</tr>



<tr>
	<th>Phone</th>
	<td><?php echo $phone ?></td>
</tr>




<tr>
	<th>Address</th>
	<td><?php echo $address ?></td>
</tr>



<tr>
	<th>Gender</th>
	<td><?php echo $gender ?></td>
</tr>


<?php } ?>

</table>




<div class="clearfix"> </div>
</div>






</div>
</div>

<?php include_once "footer.php"; ?>



<?php }elseif($active_role == 'faculty'){

?>





<div class="main-content">
<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">

<?php include_once "facultynav.php"; ?>


</div>



<?php include_once "top.php"; ?>


<!-- main content start-->
<div id="page-wrapper">
<div class="main-page general">
<h2 class="title1">Welcome To Your Faculty Account:</h2>
<div class="panel-info widget-shadow">
<h4 class="title2">Registration Info:</h4>




<table class="table table-striped">
	
<?php 

$active 		= "SELECT * from registrations WHERE id = '{$active_id}' AND status = 1 ";
$execute 		= $con->query($active);
$num_rows 		= $execute->num_rows; 

if($num_rows == 0){

	echo '<p>No Info Available.</p>';
}else{

$record 		= $execute->fetch_assoc();
$id 			= $record['id'];
$firstname 		= $record['firstname'];
$lastname 		= $record['lastname'];
$email 			= $record['email'];
$phone 			= $record['phone'];
$gender 		= $record['gender'];
$address 		= $record['address'];
$designation 	= $record['designation'];
$type 			= $record['type'];

?>
	

<tr>
	<th>First-Name</th>
	<td><?php echo $firstname ?></td>
</tr>


<tr>
	<th>Last-Name</th>
	<td><?php echo $lastname ?></td>
</tr>


<tr>
	<th>Email</th>
	<td><?php echo $email ?></td>
</tr>



<tr>
	<th>Phone</th>
	<td><?php echo $phone ?></td>
</tr>




<tr>
	<th>Address</th>
	<td><?php echo $address ?></td>
</tr>



<tr>
	<th>Gender</th>
	<td><?php echo $gender ?></td>
</tr>

<tr>
	<th>Designation</th>
	<td><?php echo $designation ?></td>
</tr>


<tr>
	<th>Type</th>
	<td><?php echo $type ?></td>
</tr>


<?php } ?>

</table>




<div class="clearfix"> </div>
</div>






</div>
</div>

<?php include_once "footer.php"; ?>



<?php


}else{header("Location: logout.php"); } ?>
