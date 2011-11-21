<?
//called from password-remind.php
session_start();
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this

$cc=$_POST[cc];
$pid=$_POST[pid];
$emails=$_POST[emails];
$subject=$_POST[subject];
$message=$_POST[message];


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
$headers .= 'FROM: '.$cc."\r\n";
$headers .= 'CC: '.$cc."\r\n";
$thisurl = curPageURL();

$purl = parse_url($thisurl);
//fb($purl);
$host = $purl['host'];
$whpath = $purl['path'];
//fb($whpath);
$pinfo = pathinfo($whpath);
//fb($pinfo);
$path = $pinfo['dirname'];
//fb($path);
$loginurl = "http://".$host.$path."/soup-login.php";

//fb($loginurl);

//$email="mckenna.tim@gmail.com";

$errmsg_arr = array();
$errmsg_arr[] = "emialerror";
if(!mail($emails, $subject, $message, $headers)){
    echo "shit is broken";
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
	header("location: soup-teamContacts.php?pid=".$pid);
}else {
	header("location: soup.php");
}
fb($emails);
?>




