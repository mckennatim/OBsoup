<?
//called from  launch.php
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this

$errmsg_arr = array();
$errflag = false;

function clean($str) {
	$str = @trim($str);
	//if(get_magic_quotes_gpc()) {
	//	$str = stripslashes($str);
	//}
	//return mysql_real_escape_string($str);
	return $str;
}

$name=clean($_POST[name]);
$email=clean($_POST[email]);
$password=clean($_POST[password]);
$cpassword=clean($_POST[cpassword]);

fb($password);
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

mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die("can't even connect");
mysql_select_db (DB_DATABASE) or die("db unavailable");	

if($email != '') {
	$qry = "SELECT * FROM volunteers WHERE email='$email'";
	$result = mysql_query($qry);
	if($result) {
		if(mysql_num_rows($result) > 0) {
			$errmsg_arr[] = 'Email address already registered';
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
	header("location: launch.php");
	exit();
}

$sql = "INSERT INTO `volunteers` (`name`, `email`, `passwd`) 
VALUES('$name','$email', '".md5($_POST['password'])."')";

mysql_query($sql);
fb($sql);
header("location: soup.php"); 
?>

