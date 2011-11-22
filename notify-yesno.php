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
		<h3 class="err">Would you like to notify volunteers?</h3>
		<h4><p align="justify">Perhaps you have only modified the project a little and don't 
		need to email everybody again. </p></h4>
		<a class="notify_button round" href="soup.php">NO, don't notify now</a></p>
		<h4><p align="justify">Clicking YES will send a message to SoupTeam volunteers in your area. 
		Besides the current SoupTeam members, consider letting some friends know 
		about your project. Make it a party. Adding their emails below will send them your message plus
		a link to your project page. </p></h4>
<form id="form1" name="Update" method="get" action="notify-volunteers.php">
	<input type="hidden" name="pid" id="pid" value="<?=$pid?>" />	
	<input class="notify_button round" type="submit" value="YES, notify SoupTm&friends" />
  type email addressess separated by commas	<br/>
  <label>
  to: <textarea name="emails" id="emails" cols="50" rows="2"><?=$estr?></textarea>
  </label>
  <br/>
  <label>
  from: <input type="text" name="from" id="from" size=35"/>
  </label>
  <br/>
  <label>
  subject: <input type="text" name="subject" id="subject" size="25"/>
  </label>
  <br />
  <label>
  note to friends:<br> <textarea name="friend" id="friend" cols="50" rows="4"></textarea>
  </label><br/>
  <label>
  note to friends & SoupTeam members: <br/><textarea name="everyone" id="everyone" cols="50" rows="4"></textarea>
  </label><br/>
</form>

		</section>
	</div>

<div class="container">
<section class="round">
<div class="add_delete_toolbar" />


</div>
</section>
</div>
<html>
