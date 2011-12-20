<?
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
require_once('tm/cpu.php');

ob_start(); //gotta have this
fb('how are you toda y');
if (isset($_GET['pid'])) $pid=$_GET['pid'];

$thisurl = curPageURL();//in cpu
$purl = parse_url($thisurl);
//fb($purl);
$host = $purl['host'];
$whpath = $purl['path'];
//fb($whpath);
$pinfo = pathinfo($whpath);
//fb($pinfo);
$path = $pinfo['dirname'];
//fb($path);
$baseurl = "http://" . $host . $path . "/";
$joinurl = "http://".$host.$path."/soup-joinTeam.php?pid=".$pid;
$homeurl = "http://".$host.$path."/soup.php";

$trying ="get organizer vid"; //fb($trying);
$sql = "SELECT `vid`, `location`, `title`, `organizer` ,`projdate`, `leadtime`, `zipcode`
FROM projects
WHERE pid = '$pid' LIMIT 1";
fb($sql);
$result = mysql_query($sql) or die($trying);
$ida = mysql_fetch_assoc($result);

$vid =$ida['vid'];
$location =$ida['location'];
$title =$ida['title'];
$organizer =$ida['organizer'];
$projdate =$ida['projdate'];
$leadtime =$ida['leadtime'];
$zip =$ida['zipcode'];
$sprojdate= strtotime($projdate);
$timestr = $sprojdate-$leadtime*86400;
fb($timestr);
$teamby = date("l\, m/d/Y",$timestr);
$projdate = date("l\, m/d/Y",$sprojdate);
fb($teamby);

$trying ="get organizer data"; //fb($trying);
$sql = "SELECT `email`
FROM volunteers
WHERE id = '$vid' LIMIT 1";
fb($sql);
$result = mysql_query($sql) or die($trying);
$vinfo = mysql_fetch_assoc($result);
$email =$vinfo['email'];

$tmessage = "Hi SoupTeam members,<br/>
I am organizing an OccupyBoston ".$title." Soup project for <b>".$projdate. "</b>. It will takeplace in ".$location.". In order to pull this off I need a team in place by <b>".$teamby. "</b>.  If you are interested in perhaps volunteering check out the project and the roles you mighttake on here at ".$joinurl.". The listing of all projects is on the home page: ".$homeurl. "<br/><br/>Thanks,<br/>"
.$organizer."<br/>";
$junk="  ";

$fmessage = "Hi, <br/>
I support the <b>Occupy</b> movement and have come up with a way to help them. Would you consider working with me on this project? SoupTeam is helping me form a team. The following message announces the creation of my project. It is easy to register and join my team. <br/><br/>";
fb($tmessage);
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
<form id="form1" name="Update" method="post" action="notify-volunteers.php">
	<input type="hidden" name="pid" id="pid" value="<?=$pid?>" />
	<input type="hidden" name="zip" id="zip" value="<?=$zip?>" />
	<input type="hidden" name="baseurl" id="baseurl" value="<?=$baseurl?>" />
	<input class="notify_button round" type="submit" value="YES, notify SoupTm&friends" />
	<p align="center">Thsi will take a minute</p>

  Type email addressess of friends, separated by commas.	<br/>
  <label>
  to: <textarea name="emails" id="emails" cols="50" rows="2"></textarea>
  </label>
  <br/>
  <label>
  from: <input type="text" name="from" id="from" size="35" value="<?php echo $email; ?>"/>
  </label>
  <br/>
  <label>
  subject: <input type="text" name="subject" id="subject" size="30" value="<?='New Soup Project -'.$title?>"/>
  </label>
  <br />
  Here is some template text that you can change however you want. But please try to leave the url links in.
  <br/>
  <label>
  note to friends:<br>
  <textarea name="friend" id="friend" cols="60" rows="5"><?=$fmessage?></textarea>
  </label><br/>
  <label>
  note to friends & SoupTeam members: <br/>
  <textarea name="everyone" id="everyone" cols="60" rows="10"><?=$tmessage?></textarea>
  </label><br/>
</form>

		</section>
	</div>

<div class="container">
<section class="round">

</div>
</section>
</div>
<html>
