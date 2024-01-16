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
<h2 class="title1">Add Rooms</h2>
<div class="sign-up-row widget-shadow">
<h5>From here you can add and manage all Class Rooms:</h5>









<?php 



	if(isset($_GET['edit'])){


		$edit = $_GET['edit'];

		$roomEdit 	= "SELECT * FROM rooms WHERE id = '{$edit}' ";
		$roomRun 	= $con->query($roomEdit);
		$roomrow 	= $roomRun->fetch_assoc();
		$roomid 	= $roomrow['id'];
		$roomname 	= $roomrow['name'];



	}



 ?>



<?php 


if(isset($_POST['update'])){

$id 	= $_POST['id'];
$name 	= $_POST['update'];

$update = "UPDATE rooms SET name = '{$name}' WHERE id = '{$id}' ";
$run  	 	 = $con->query($update);

if($run){

header("Location: rooms.php");

}



}



?>


<form method="post">


<input type="hidden" name="id" value="<?php if(isset($roomid)){echo $roomid; } ?>">

<div class="sign-u">
<input type="text" name="<?php if(isset($roomname)){echo 'update';}else{echo 'room'; } ?>" value="<?php if(isset($roomname)){echo $roomname; } ?>" placeholder="Add Room" required>
<div class="clearfix"> </div>
</div>
</form>




<?php 


if(isset($_POST['room'])){

$room = $_POST['room'];

$roomquery = "INSERT INTO rooms (name) VALUES ('{$room}') ";
$run  	 	 = $con->query($roomquery);

if($run){

header("Location: rooms.php");

}



}



?>


<br>
<table class="table table-striped table-dark">

<tr>
<th>No</th>
<th>Room</th>
<th>Edit</th>
<th>Delete</th>
</tr> 






<?php 

$rooms 	= "SELECT * FROM rooms ORDER BY id ASC";
$run 	= $con->query($rooms);


if($run->num_rows == 0){

echo "<td>No Room.</td>";


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




<td><a class="btn btn-info" href="rooms.php?edit=<?php echo $id ?>">Edit</a></td>
<td><a class="btn btn-danger" href="rooms.php?remove=<?php echo $id ?>">X</a></td>

</tr>

<?php



}



}


?>



   

</table>

<?php 

if(isset($_GET['remove'])){

$id 		= $_GET['remove'];
$remove 	= "DELETE FROM rooms WHERE id = '{$id}' ";
$run 		= $con->query($remove);

if($run){

header("Location: rooms.php");

}





}


?>
















</div>
</div>
</div>

<?php include_once "footer.php"; ?>


<?php }else{header("Location: logout.php"); } ?>
