<?
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('how are you today');
$pid=$_GET[pid]; 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
	<title>NO Hot Soup</title>
	<link type="text/css" href="stylesheets/blueprint/screen.css" rel="stylesheet" />	
	<link type="text/css" href="stylesheets/custom.css" rel="stylesheet" />	
	<link type="text/css" href="stylesheets/ob.css" rel="stylesheet" />		
<body> 
	<div class="container">
		<header>
			<nav class="round">
			</nav>
			<section class="round">
				<a href="soup.php"><img src="images/soupbanner.jpg" class="stretch" alt="soup banner" /></a> 
				
			</section>
		</header>
		<section class="round">
		<h3 align="center" class="err">Would you like to notify the volunteers?</h3>
		<p align="center">&nbsp;</p>
		<p align="center">Click yes to notify the volunteer pool about this project.</p>
		<p align="center"><a class="notify_button round" href="notify-volunteers.php?pid=<?=$pid?>">YES</a><br/>
		<a class="notify_button round" href="soup.php">NO</a></p>
		</section>
	</div>

<div class="container">
<section class="round">
<div class="add_delete_toolbar" />


</div>
</section>
</div>
<html>
