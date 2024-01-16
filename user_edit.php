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
<div class="main-page signup-page">
<h2 class="title1">Update Account</h2>
<div class="sign-up-row widget-shadow">
<h5>Personal Information :</h5>



<?php 



if(isset($_POST['submit'])){


$id 			= $_POST['id'];
$firstname 		= $_POST['firstname'];
$lastname 		= $_POST['lastname'];
$email 			= $_POST['email'];
$number 		= $_POST['number'];
$address 		= $_POST['address'];
$gender 		= $_POST['gender'];
$password 		= $_POST['password'];






$registration = "UPDATE registrations SET 

firstname 		= '{$firstname}', 
lastname 		= '{$lastname}', 
email 			= '{$email}',
phone 			= '{$number}',
password 		= '{$password}',
gender 			= '{$gender}',
address 		= '{$address}'

WHERE id = '{$id}'  ";


$result = $con->query($registration);

if($result){

echo "<p class='alert alert-success'>Success, Account is Updated.</p>";

}else{


die($con->error);


}






}




 ?>

<?php 

	
	if(isset($_GET['user'])){


$user = $_GET['user'];
$active 		= "SELECT * from registrations WHERE id = '{$user}'  ";
$execute 		= $con->query($active);
$num_rows 		= $execute->num_rows; 

if($num_rows == 0){

echo '<p>No Record.</p>';
}else{

$record 		= $execute->fetch_assoc();
$id 			= $record['id'];
$firstname 		= $record['firstname'];
$lastname 		= $record['lastname'];
$email 			= $record['email'];
$phone 			= $record['phone'];
$gender 		= $record['gender'];


$address 		= $record['address'];
$password 		= $record['password'];

?>



<form method="post">

<input type="hidden" name="id" value="<?php if(isset($id)){echo $id; } ?>">

<div class="sign-u">
<input type="text" name="firstname" value="<?php if(isset($firstname)){echo $firstname; } ?>" name="firstname" placeholder="First Name" required="">
<div class="clearfix"> </div>
</div>
<div class="sign-u">
<input type="text" placeholder="Last Name" value="<?php if(isset($lastname)){echo $lastname; } ?>" name="lastname" required="">
<div class="clearfix"> </div>
</div>
<div class="sign-u">
<input type="email" placeholder="Email Address" value="<?php if(isset($email)){echo $email; } ?>" name="email" required="">
<div class="clearfix"> </div>
</div>

<div class="sign-u">
<input type="number" placeholder="Phone Number" value="<?php if(isset($phone)){echo $phone; } ?>" name="number" required="">
<div class="clearfix"> </div>
</div>

<div class="sign-u">
<input type="text" placeholder="Current Address" value="<?php if(isset($address)){echo $address; } ?>" name="address" required="">
<div class="clearfix"> </div>
</div>

<div class="sign-u">
<div class="sign-up1">
<h4>Gender :</h4>
</div>
<div class="sign-up2">
<label>
<input type="radio" name="gender" value="male" <?php if($gender == 'male'){echo 'checked';}else{echo '';} ?>>
Male
</label>
<label>
<input type="radio" name="gender" value="female" <?php if($gender == 'female'){echo 'checked';}else{echo '';} ?> required="">
Female
</label>
</div>
<div class="clearfix"> </div>
</div>
<h6>Password Information :</h6>
<div class="sign-u">
<input type="password" placeholder="Password" value="<?php if(isset($password)){echo $password; } ?>" name="password" required="">
<div class="clearfix"> </div>
</div>

<div class="clearfix"> </div>
<div class="sub_home">
<input type="submit" name="submit" value="Update">
<div class="clearfix"> </div>
</div>

</form>




<?php

}

	}


 ?>




</div>
</div>
</div>

<?php include_once "footer.php"; ?>


<?php }else{header("Location: logout.php"); } ?>
