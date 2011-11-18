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
				<img src="images/soupbanner.jpg" class="stretch" alt="soup banner" /> 
				<p align="right">
				
				<a href="soup.php">Home</a> | <a href="logout.php">Logout</a></p>
			</section>
		</header>
		<section class="round">
			<h1>My Profile </h1>
			<p>Hi <?=$_SESSION['SESS_NAME']?> This is another secure page. </p>
		</section>
	</div>

<div class="container">
<section class="round">
<div class="add_delete_toolbar" />

			<form id="loginForm" name="loginForm" method="post" action="profile-mod.php">
			<table width="200" border="0" align="center" cellpadding="2" cellspacing="0">
			<tr>
			<td width="80"><b></b></td>
			<td width="40">Email:</td><td>     <input name="email" size="30" type="text" class="textfield" id="email" /></td>
			</tr>
			<tr>
			<td><b></b></td>
			<td>Password:</td><td>  <input name="password" type="password" class="textfield" id="password" /></td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			<td><input type="submit" class="button" name="Submit" value="Login" /></td>
			</tr>
			</table>
			</form>
</div>
</section>
</div>
<html>


