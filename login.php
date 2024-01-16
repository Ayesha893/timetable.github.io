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
<div class="main-page login-page ">
<h2 class="title1">Login Here</h2>
<div class="widget-shadow">
<div class="login-body">


<?php 


if(isset($_POST['submit'])){

$email  	= $_POST['email'];
$password  	= $_POST['password'];


$accesscheck = "SELECT * FROM registrations WHERE email = '{$email}' AND password = '{$password}' ";

$execute 	 = $con->query($accesscheck);
$num_rows    = $execute->num_rows; 

if($num_rows == 0){

echo "<p class='alert alert-warning'>Your Credentials Are Not Correct.</p>";

}else{

$record 		= $execute->fetch_assoc();
$id 			= $record['id'];
$role 			= $record['role'];
$status   		= $record['status'];


if($status == 1){

	$_SESSION['id']   = $id;
	$_SESSION['role'] = $role;
	header("Location: home.php");

}else{


echo "<p class='alert alert-warning'>Wait For Admin Approvel.</p>";


}



}

} 




?>


<form method="post">
<input type="email" class="user" name="email" placeholder="Enter Your Email" required="">
<input type="password" name="password" class="lock" placeholder="Enter Your Password" required="">

<input type="submit" name="submit" value="Sign In">
<div class="registration">
Don't have an account ?
<a class="" href="register.php">
Create an account
</a>
</div>
</form>








</div>
</div>

</div>
</div>

<?php include_once "footer.php"; ?>