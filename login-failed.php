<?
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('how are you today');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
	<title>NO Hot Soup</title>
	<link type="text/css" href="stylesheets/blueprint/screen.css" rel="stylesheet" />	
	<link type="text/css" href="stylesheets/custom.css" rel="stylesheet" />		
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
		<h1>Login Failed </h1>
		<p align="center">&nbsp;</p>
		<h4 align="center" class="err">Login Failed!<br />
		Please check your username and password</h4>
		<p align="center">Click here to <a href="soup-login.php">Login</a>
		Or, if you need, get a <a href="passwd-remind.php">password reminder</a></p>
		</section>
	</div>

<div class="container">
<section class="round">
<div class="add_delete_toolbar" />


</div>
</section>
</div>
<html>
