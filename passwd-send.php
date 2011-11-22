<?
//called from password-remind.php
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb("in passwd-send.php");
$errmsg_arr = array();
$errflag = false;
/* this clean shit doesn't work
function clean($str) {
	$str = @trim($str);
	if(get_magic_quotes_gpc()) {
		$str = stripslashes($str);
	}
	return mysql_real_escape_string($str);
}

//$email=clean($_GET[email]);
*/
$email=$_GET[email];


fb($email);
fb("put Validations");

if($email == '') {
	$errmsg_arr[] = 'Email address not entered';
	$errflag = true;
}

mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't even connect");
mysql_select_db (DB_DATABASE) or die("db unavailable");	

if($email != '') {
	$qry = "SELECT * FROM volunteers WHERE email='$email'";
	fb($qry);
	$result = mysql_query($qry);
	if($result) {
		if(mysql_num_rows($result) == 0) {
			$errmsg_arr[] = 'Email address not registered You can try another email or
			perhaps you would like to (re)<a href="launch.php">register</a>.';
			$errflag = true;
		}
		@mysql_free_result($result);
	}
	else {
		die("Query failed");
	}
}
if($errflag) {
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
	header("location: passwd-remind.php");
	exit();
}
$pwd=md5('soup');
$trying ="changing password "; fb($trying);
$sql = "UPDATE volunteers SET `passwd` = '$pwd' WHERE email='$email'";
fb($sql);
$hm = mysql_query($sql) or die($trying);

function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}


$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: perimckenna@yahoo.com.com' . "\r\n";
$thisurl = curPageURL();

$purl = parse_url($thisurl);
fb($purl);
$host = $purl['host'];
$whpath = $purl['path'];
fb($whpath);
$pinfo = pathinfo($whpath);
fb($pinfo);
$path = $pinfo['dirname'];
fb($path);
$loginurl = "http://".$host.$path."/soup-login.php";

fb($loginurl);

//$email="mckenna.tim@gmail.com";

$message = "New password = 'soup'. Hi, the system has reset your password to 'soup'. You can login 
at ".$loginurl. " (You may see a warning; sorry I'll try to fix that)";
mail($email, 'HotSoup password', $message, $headers);
//mail($email, 'HotSoup password', $message);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Hot Soup</title>
	<link type="text/css" href="stylesheets/blueprint/screen.css" rel="stylesheet" />	
	<link type="text/css" href="stylesheets/custom.css" rel="stylesheet" />	
	<link type="text/css" href="stylesheets/ob.css" rel="stylesheet" />		
</head>
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
			<h1>Check your email</h1>
			<p>
There you should find a new temporary password. Login with it on 
<a href="soup-login.php">this page</a>. From there
you can go to your profile and change your password.
			</p>
		</section>
	</div>
</body>
</html>




