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
<h2 class="title1">Add Classes</h2>
<div class="sign-up-row widget-shadow">
<h5>From here you can add and manage all classes:</h5>









<?php 



	if(isset($_GET['edit'])){


		$edit = $_GET['edit'];

		$classEdit 	= "SELECT * FROM classes WHERE id = '{$edit}' ";
		$classRun 	= $con->query($classEdit);
		$classrow 	= $classRun->fetch_assoc();
		$classid 	= $classrow['id'];
		$className 	= $classrow['name'];



	}



 ?>



<?php 


if(isset($_POST['update'])){

$id 	= $_POST['id'];
$name 	= $_POST['update'];

$update = "UPDATE classes SET name = '{$name}' WHERE id = '{$id}' ";
$run  	 	 = $con->query($update);

if($run){

header("Location: classes.php");

}



}



?>


<form method="post">


<input type="hidden" name="id" value="<?php if(isset($classid)){echo $classid; } ?>">

<div class="sign-u">
<input type="text" name="<?php if(isset($className)){echo 'update';}else{echo 'class'; } ?>" value="<?php if(isset($className)){echo $className; } ?>" placeholder="Add Class" required>
<div class="clearfix"> </div>
</div>
</form>




<?php 


if(isset($_POST['class'])){

$class = $_POST['class'];

$addclass = "INSERT INTO classes (name) VALUES ('{$class}') ";
$run  	 	 = $con->query($addclass);

if($run){

header("Location: classes.php");

}



}



?>


<br>
<table class="table table-striped table-dark">

<tr>
<th>No</th>
<th>Class</th>
<th>Edit</th>
<th>Delete</th>
</tr> 






<?php 

$classes 	= "SELECT * FROM classes ORDER BY id DESC";
$run 	= $con->query($classes);


if($run->num_rows == 0){

echo "<td>No Class.</td>";


}else{

$no = 0;
while($get = $run->fetch_assoc()){

$id 	= $get['id'];
$name 	= $get['name'];



$no++;


?>
<tr>
<td><?php echo $no ?></td>
<td><?php echo $name ?></td>




<td><a class="btn btn-info" href="classes.php?edit=<?php echo $id ?>">Edit</a></td>
<td><a class="btn btn-danger" href="classes.php?remove=<?php echo $id ?>">X</a></td>

</tr>

<?php



}



}


?>



   

</table>

<?php 

if(isset($_GET['remove'])){

$id 		= $_GET['remove'];
$remove 	= "DELETE FROM classes WHERE id = '{$id}' ";
$run 		= $con->query($remove);

if($run){

header("Location: classes.php");

}





}


?>
















</div>
</div>
</div>

<?php include_once "footer.php"; ?>


<?php }else{header("Location: logout.php"); } ?>
