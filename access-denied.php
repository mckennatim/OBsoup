<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_ID']);
	unset($_SESSION['SESS_NAME']);
	unset($_SESSION['SESS_EMAIL']);
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('in access denied');
$pg=$_REQUEST['pg'];
$pid=$_REQUEST['pid'];
$qstr='?pg='.$pg.'&pid='.$pid;
fb($qstr);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>

	<title>Hot Soup</title>
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
			
		</section>
	</div>

<div class="container">
<section class="round">
<h1 align="center"> You need to be logged in </h1>

<h4 align="center" class="err">to access this resource.<br />
<p align="center">&nbsp;</p>
You can login once you have registered to be a SoupTeam potential volunteer. Registering doesn't commit you to anything.
Please <a href="soup-login.php<?=$qstr?>">login</a> or <a href="soup-signup.php<?=$qstr?>">register</a> for SoupTeam</h4>
<p align="center">&nbsp;</p>
<p align="center">Click here to <a href="soup-login.php<?=$qstr?>">Login</a></p>
</section>
</div>
