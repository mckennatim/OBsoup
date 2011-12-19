<?php
include_once('tm/dbinfo.php');
require_once('tm/FirePHP.class.php');
require_once('tm/fb.php');
ob_start(); //gotta have this
fb('in template-save');

$pid = mysql_real_escape_string($_REQUEST['pid']);
$title = mysql_real_escape_string($_REQUEST['title']);
$description = mysql_real_escape_string($_REQUEST['desc']);
$info = mysql_real_escape_string($_REQUEST['info']);
$sitecontacts = mysql_real_escape_string($_REQUEST['sitecontacts']);
$link = mysql_real_escape_string($_REQUEST['link']);

$trying ="new template "; //fb($trying);
$sql = "INSERT INTO proutlines (`title`, `description`, `info`, `sitecontacts`, `link`)
 VALUES ('$title', '$description', '$info', '$sitecontacts', '$link')";
//fb($sql);
mysql_query($sql) or die($trying);
$oid= mysql_insert_id();

$trying ="get roles for pid "; //fb($trying);
$sql = "SELECT * FROM team WHERE pid=".$pid;
fb($sql);
$result = mysql_query($sql) or die($trying);
while ($arow = mysql_fetch_assoc($result)) {
	fb($arow);
	$role= $arow['role'];
	$roledesc = $arow['roledesc'];
	$trying ="saving roles for in roles "; //fb($trying);
	$rsql="INSERT INTO roles (`oid`, `role`, `roledesc` ) VALUES ('$oid', '$role', '$roledesc')";
	fb($rsql);
	mysql_query($rsql) or die($trying);
}
header("location: soup.php");
?>