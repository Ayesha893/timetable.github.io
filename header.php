<?php 
ob_start();
session_start();
$con = new mysqli('localhost','root','','rtimetable');


?>
<!DOCTYPE HTML>
<html>
<head>
<title>Timetable Management System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/custom.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
 <link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
 
 <!-- js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>

<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">

<script src="js/metisMenu.min.js"></script>


</head> 
<body class="cbp-spmenu-push">