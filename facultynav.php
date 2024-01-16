<aside class="sidebar-left">
<nav class="navbar navbar-inverse">
	
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>


<h1><a class="navbar-brand" href="index.php"><span class="fa fa-area-chart"></span> Faculty<span class="dashboard_text">Backend Account</span></a></h1>
</div>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<ul class="sidebar-menu">
<li class="header">MAIN NAVIGATION</li>






<li class="treeview">
<a href="home.php">
<i class="fa fa-home"></i> <span>Account</span>
</a>
</li>


<?php 


	$GetType = "SELECT type FROM registrations WHERE id = '{$active_id}' ";
	$GetRes  = $con->query($GetType);
	$GetRow  = $GetRes->fetch_assoc();
	$GetType = $GetRow['type'];

	if($GetType == 'Section Head'){

?>


<li class="treeview">
<a href="generatetimetable.php">
<i class="fa fa-home"></i> <span>Generate Timetable</span>
</a>
</li>


<?php


	}


 ?>



<li class="treeview">
<a href="timetable.php">
<i class="fa fa-home"></i> <span>Timetable</span>
</a>
</li>


<li class="treeview">
<a href="classwise.php">
<i class="fa fa-home"></i> <span>Class Wise</span>
</a>
</li>


<li class="treeview">
<a href="subjectwise.php">
<i class="fa fa-home"></i> <span>Subject Wise</span>
</a>
</li>



<li class="treeview">
<a href="roomwise.php">
<i class="fa fa-home"></i> <span>Room Wise</span>
</a>
</li>


<li class="treeview">
<a href="facultysett.php">
<i class="fa fa-gear"></i> <span>Update Settings</span>
</a>
</li>


<li class="treeview">
<a href="logout.php">
<i class="fa fa-sign-out"></i> <span>Logout</span>
</a>
</li>






</ul>
</div>
<!-- /.navbar-collapse -->
</nav>
</aside>