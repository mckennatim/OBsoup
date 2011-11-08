<?
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this

$errmsg_arr = array();
$errflag = false;

$name=$_GET[name];
$email=$_GET[email];
$password=$_GET[password];
$cpassword=$_GET[cpassword];

//Input Validations
if($name == '') {
	$errmsg_arr[] = 'Name missing';
	$errflag = true;
}
if($email == '') {
	$errmsg_arr[] = 'Email missing';
	$errflag = true;
}
if($password == '') {
	$errmsg_arr[] = 'Password missing';
	$errflag = true;
}
if($cpassword == '') {
	$errmsg_arr[] = 'Confirm password missing';
	$errflag = true;
}
if( strcmp($password, $cpassword) != 0 ) {
	$errmsg_arr[] = 'Passwords do not match';
	$errflag = true;
}
if($errflag) {
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
	header("location: launch.php");
	exit();
}

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$sql = "INSERT INTO `OBsoupVolunteers` (`name`, `email`, `password`) VALUES('$name','$email', '$password')";
$db->query($sql);
//fb($sql);
$db->close;
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
			<h1>OB Hot Soup project is starting soon</h1>
			<p>
Thanks, <? echo $name; ?>. We will let you know when we are ready to go.
			</p>
		</section>
	</div>
</body>
</html>
