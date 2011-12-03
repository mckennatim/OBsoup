<?
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('in login-failed');
$pid=$_REQUEST['pid'];
$pg=$_REQUEST['pg'];
$qstr = '?pg='.$pg.'&pid='.$pid;
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
		<h1>Login Failed </h1>
		<p align="center">&nbsp;</p>
		<h4 align="center" class="err">Login Failed!<br />
		Please check your username and password</h4>
		<p align="center">Click here to <a href="soup-login.php">Login</a> again. 
		Or, if you need, you can <a href="launch.php<?=$qstr?>">register</a> or get a <a href="passwd-remind.php<?=$qstr?>">password reminder</a></p>
		</section>
	</div>

<div class="container">
<section class="round">
<div class="add_delete_toolbar" />


</div>
</section>
</div>
<html>
