<?php include_once "header.php"; 
if(isset($_SESSION['id']) && isset($_SESSION['role'])){

$active_id 		= $_SESSION['id'];
$active_role 	= $_SESSION['role'];

}

?>



<div class="main-content">
<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
<?php include_once "navbar.php"; ?>
</div>



<?php include_once "top.php"; ?>


<!-- main content start-->
<div id="page-wrapper">
<div class="main-page signup-page">
<h2 class="title1">Student Registration</h2>
<div class="sign-up-row widget-shadow">
<h5>Personal Information :</h5>



<?php 



if(isset($_POST['submit'])){


$firstname 		= $_POST['firstname'];
$lastname 		= $_POST['lastname'];
$email 			= $_POST['email'];
$number 		= $_POST['number'];
$address 		= $_POST['address'];
$gender 		= $_POST['gender'];
$password 		= $_POST['password'];
$conpassword 	= $_POST['conpassword'];


$query = "SELECT * FROM registrations WHERE email = '{$email}'  ";

$find 		= $con->query($query);
$num_rows  	= $find->num_rows; 


if($num_rows > 0){

	echo "<p class='alert alert-warning'>Email already in Use.</p>";

}else{

if($password === $conpassword){


$registration = "INSERT INTO registrations (firstname,lastname,email,phone,address,gender,password,status,role) VALUES ('{$firstname}','{$lastname}','{$email}','{$number}','{$address}','{$gender}','{$password}',0,'user')";

$result = $con->query($registration);

if($result){

echo "<p class='alert alert-success'>Success, your account is created.</p>";

}else{


die($con->error);


}


}else{


echo "<p class='alert alert-danger'>Passwords unmatched, Try Again.</p>";

}

}





}




 ?>


<form method="post">
<div class="sign-u">
<input type="text" name="firstname" name="firstname" placeholder="First Name" required="">
<div class="clearfix"> </div>
</div>
<div class="sign-u">
<input type="text" placeholder="Last Name" name="lastname" required="">
<div class="clearfix"> </div>
</div>
<div class="sign-u">
<input type="email" placeholder="Email Address" name="email" required="">
<div class="clearfix"> </div>
</div>

<div class="sign-u">
<input type="number" placeholder="Phone Number" name="number" required="">
<div class="clearfix"> </div>
</div>

<div class="sign-u">
<input type="text" placeholder="Current Address" name="address" required="">
<div class="clearfix"> </div>
</div>

<div class="sign-u">
<div class="sign-up1">
<h4>Gender :</h4>
</div>
<div class="sign-up2">
<label>
<input type="radio" name="gender" value="male" checked>
Male
</label>
<label>
<input type="radio" name="gender" value="female" required="">
Female
</label>
</div>
<div class="clearfix"> </div>
</div>
<h6>Login Information :</h6>
<div class="sign-u">
<input type="password" placeholder="Password" name="password" required="">
<div class="clearfix"> </div>
</div>
<div class="sign-u">
<input type="password" placeholder="Confirm Password" name="conpassword" required="">
</div>
<div class="clearfix"> </div>
<div class="sub_home">
<input type="submit" name="submit" value="Submit">
<div class="clearfix"> </div>
</div>
<div class="registration">
Already Registered.
<a class="" href="login.php">
Login
</a>
</div>
</form>









</div>
</div>
</div>




<?php include_once "footer.php"; ?>