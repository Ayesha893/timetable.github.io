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
<h2 class="title1">Add Subject</h2>
<div class="sign-up-row widget-shadow">
<h5>From here you can add and manage subjects :</h5>





<form method="post" action="">



<div class="sign-u">
<select required name="facultyid">
<option value="" disabled selected>Choose Faculty</option>

<?php 

$facultiesQuery = "SELECT * FROM registrations WHERE role = 'faculty' ";
$resultfaculty = $con->query($facultiesQuery);
if($resultfaculty){

while($rows = $resultfaculty->fetch_assoc()){

$id 		= $rows['id'];
$firstname 	= $rows['firstname'];
$lastname 	= $rows['lastname'];
$name       = $firstname . ' ' . $lastname;

?>

<option value="<?php echo $id ?>"><?php echo $name ?></option>


<?php

}
}


?>




</select>
</div>



<div class="sign-u">
<input type="text" placeholder="Subject Name" name="subject" required>

</div>





<div class="form-group">
<input class="btn btn-primary" type="submit" name="submit" value="Add Subject">
</div>
</form>


<?php 


if(isset($_POST['submit'])){

$facultyid 	= $con->real_escape_string($_POST['facultyid']);
$subject 	= $con->real_escape_string($_POST['subject']);


$addquery = "INSERT INTO subjects (name, faculty) VALUES ('{$subject}' ,'{$facultyid}') ";

$addresult = $con->query($addquery);

	if($addresult){

		header("Location: subjects.php");

	}



}



?>















<table class="table table-bordered table-striped">
<thead>
<tr>
<th class="text-center">No</th>
<th class="text-center">Faculty</th>
<th class="text-center">Name</th>


<th class="text-center">Edit</th>
<th class="text-center">Delete</th>
</tr> 

</thead>

<tbody>


<?php 

$fetch = "SELECT * FROM subjects";
$fetchresults = $con->query($fetch);

$num_rows = $fetchresults->num_rows;
if($num_rows == 0){

echo "<td>No Record.</td>";
}else{

$count = 0;
while($rows = $fetchresults->fetch_assoc()){

$id 		= $rows['id'];
$facultyid 	= $rows['faculty'];

$check 		= "SELECT * FROM registrations WHERE id = '{$facultyid}' ";
$result_c 	= $con->query($check);
$row_ch 	= $result_c->fetch_assoc();
$first 	= $row_ch['firstname'];
$last 	= $row_ch['lastname'];
$name   = $first . ' ' . $last;


$subject = $rows['name'];



$count++;


?>
<tr class="text-center">
<td><?php echo $count ?></td>
<td><?php echo $name ?></td>
<td><?php echo $subject ?></td>


<td><a class="btn btn-warning" href="subjects.php?edit=<?php echo $id ?>">Edit</a></td>
<td><a class="btn btn-danger" href="subjects.php?delete=<?php echo $id ?>">Delete</a></td>

</tr>

<?php



}



}


?>



</tbody>    

</table>



<?php 


if(isset($_GET['edit'])){
$edit_id = $_GET['edit'];

$edit_query = "SELECT * FROM subjects WHERE id = '{$edit_id}' ";
$result_edit = $con->query($edit_query);
$row = $result_edit->fetch_assoc();


$faculty_id = $row['faculty'];
$subject 	= $row['name'];



?>





<br>
<form method="post" action="">


<div class="sign-u">


<select required name="faculty_id">
<option value="<?php if(isset($faculty_id)){echo $faculty_id; } ?>">Choose Faculty</option>

<?php 

$cate_fetch = "SELECT * FROM registrations";
$result_cate = $con->query($cate_fetch);
if($result_cate){

while($rows = $result_cate->fetch_assoc()){

$fid 		= $rows['id'];
$firstname 	= $rows['firstname'];
$lastname 	= $rows['lastname'];
$name       = $firstname . ' ' . $lastname;

?>

<option value="<?php echo $fid ?>"><?php echo $name ?></option>


<?php

}
}


?>




</select>

</div>



<div class="sign-u">

<input type="text"  value="<?php if(isset($subject)){echo $subject; } ?>" name="subject" required>
</div>





<div class="form-group">

<input class="btn btn-danger" type="submit" name="update" value="Update">

</div>
</form>


<?php 

if(isset($_POST['update'])){



$faculty_id = $con->real_escape_string($_POST['faculty_id']);
$subject = $con->real_escape_string($_POST['subject']);


$update_query = "UPDATE subjects SET name = \"$subject\", faculty = \"$faculty_id\" WHERE id = '{$edit_id}' ";

$result_update = $con->query($update_query);
if($result_update){

header("Location: subjects.php");

}else{

	die($con->error);
}


}



?>







<?php

}


?>

















<?php 

if(isset($_GET['delete'])){

$del_id = $_GET['delete'];

$del_cat = "DELETE FROM subjects WHERE id = '{$del_id}' ";
$result_del = $con->query($del_cat);
if($result_del){

header("Location: subjects.php");

}else{

die($con->error);

}





}


?>
















</div>
</div>
</div>

<?php include_once "footer.php"; ?>


<?php }else{header("Location: logout.php"); } ?>
