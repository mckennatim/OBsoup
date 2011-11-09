<?
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this

$errmsg_arr = array();
$errflag = false;

$title=$_GET[title];
$title = "soup";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Hot Soup</title>
	<link type="text/css" href="stylesheets/blueprint/screen.css" rel="stylesheet" />	
	<link type="text/css" href="stylesheets/custom.css" rel="stylesheet" />	
</head>
<body>
	<div class="container">
		<header>
			<nav class="round">
			</nav>
			<section class="round">
			<img src="images/soupbanner.jpg" alt="soup banner" /> 
			</section>
		</header>
		<section class="round">
			<h1>Create a <?echo $title ?> project</h1>
		
		</section>
	</div>
</body>
</html>
